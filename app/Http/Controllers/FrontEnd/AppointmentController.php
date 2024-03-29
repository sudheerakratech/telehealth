<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\ProcessEvent;
use App\Http\Requests;
use App\Libraries\OpenIDConnectClient;
use Date;
use DB;
use Event;
use File;
use Form;
use Hash;
use HTML;
use Illuminate\Support\MessageBag;
use Imagick;
use Minify;
use rcamposp\tcpdi_merger\MyTCPDI;
use rcamposp\tcpdi_merger\Merger;
use QrCode;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Schema;
use Session;
use SoapBox\Formatter\Formatter;
use URL;
use ZipArchive;


class AppointmentController extends Controller
{
    public function schedule1(Request $request, $provider_id='')
    {
        if ($provider_id == '') {
            // Check if this is the provider logging in
            $provider_query = DB::table('providers')->where('id', '=', Session::get('user_id'))->first();
            if ($provider_query) {
                $provider_id = $provider_query->id;
            }
        }
        $provider_arr = $this->array_providers();
        $data['provider_list'] = '<option value="">Select a provider</option>';
        foreach ($provider_arr as $provider_id_key => $provider_name) {
            $data['provider_list'] .= '<option value="' . $provider_id_key . '">' . $provider_name . '</option>';
        }
        if ($provider_id !== '') {
            // Show default schedule
            $practice = DB::table('practiceinfo')->where('practice_id', '=', Session::get('practice_id'))->first();
            if ($practice->weekends == '1') {
                $data['weekends'] = 'true';
            } else {
                $data['weekends'] = 'false';
            }
            $data['minTime'] = Date::parse($practice->minTime)->toTimeString();
            $data['maxTime'] = Date::parse($practice->maxTime)->toTimeString();
            $data['timezone'] = $practice->timezone;
            if (Session::has('pid')) {
                $data['pid'] = Session::get('pid');
                $patient_query = DB::table('demographics')->where('pid', '=', Session::get('pid'))->first();
                $data['pt_name'] = $patient_query->lastname . ', ' . $patient_query->firstname . ' (DOB: ' . date('m/d/Y', strtotime($patient_query->DOB)) . ') (ID: ' . $patient_query->pid . ')';
            }
            $query = DB::table('calendar')
                ->where('active', '=', 'y')
                ->where('practice_id', '=', Session::get('practice_id'))
                ->where(function($query_array1) use ($provider_id) {
                    $query_array1->where('provider_id', '=', '0')
                        ->orWhere('provider_id', '=', $provider_id);
                })
                ->get();
            $data['visit_type'] = '';
            if ($query->count()) {
                foreach ($query as $row) {
                    if ($row->visit_type !== 'Closed') {
                        $data['visit_type'] .= '<option value="' . $row->visit_type . '">' . $row->visit_type . '</option>';
                    }
                }
            }
            $data['provider_id'] = $provider_id;
            Session::put('provider_id', $provider_id);
        }
        // Just show provider selector
        $data['title'] = 'AKRA TELEHEALTH';
        if (Session::has('pid')) {
            $data = array_merge($data, $this->sidebar_build('chart'));
        }
        $data['content'] = '';
        if (Session::get('group_id') != '100') {
            $data['colorlegend'] = 'yes';
        }
        $data['back'] = '<div class="btn-group"><button type="button" class="btn btn-primary">Action</button><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
        $data['back'] .= '<ul class="dropdown-menu"><li><a href="#">Action</a></li><li><a href="#">Another action</a></li><li><a href="#">Something else here</a></li><li role="separator" class="divider"></li><li><a href="#">Separated link</a></li></ul></div>';
        $data['assets_js'] = $this->assets_js('schedule');
        $data['assets_css'] = $this->assets_css('schedule');
        return view('FrontEnd.appointment', $data);
    }

    public function delete_event1(Request $request)
    {
        $id = $request->input('appt_id');
        $id_check = strpbrk($id, 'R');
        if ($id_check == false) {
            DB::table('schedule')->where('appt_id', '=', $id)->delete();
            $this->audit('Delete');
        } else {
            $rid = str_replace('R', '', $id);
            DB::table('repeat_schedule')->where('repeat_id', '=', $rid)->delete();
            $this->audit('Delete');
        }
        return 'Event deleted';
    }

    public function drag_event1(Request $request)
    {
        $start = $this->timezone($request->input('start'));
        $end = $this->timezone($request->input('end'));
        $id = $request->input('id');
        $id_check = strpbrk($id, 'R');
        if ($id_check == FALSE) {
            $data = [
                'start' => $start,
                'end' => $end
            ];
            DB::table('schedule')->where('appt_id', '=', $id)->update($data);
            $this->audit('Update');
            $this->schedule_notification($id);
        } else {
            $rid = str_replace('R', '', $id);
            $repeat_day1 = date('l', $start);
            $repeat_day = strtolower($repeat_day1);
            $repeat_start_time = date('h:ia', $start);
            $repeat_end_time = date('h:ia', $end);
            $data1 = [
                'repeat_day' => $repeat_day,
                'repeat_start_time' => $repeat_start_time,
                'repeat_end_time' => $repeat_end_time
            ];
            DB::table('repeat_schedule')->where('repeat_id', '=', $rid)->update($data1);
            $this->audit('Update');
        }
        return 'Event updated.';
    }

    public function edit_event1(Request $request)
    {
        if (Session::get('group_id') == '100') {
            $pid = Session::get('pid');
            $row1 = DB::table('demographics')->where('pid', '=', $pid)->first();
            $title = $row1->lastname . ', ' . $row1->firstname . ' (DOB: ' . date('m/d/Y', strtotime($row1->DOB)) . ') (ID: ' . $pid . ')';
        } else {
            $pid = $request->input('pid');
            if ($pid == '' || $pid == '0') {
                $title = $request->input('reason');
            } else {
                $title = $request->input('title');
            }
        }
        $start = strtotime($request->input('start_date') . " " . $request->input('start_time'));
        if ($pid == '' || $pid == '0') {
            $end = strtotime($request->input('start_date') . " " . $request->input('end'));
            $visit_type = '';
        } else {
            $visit_type = $request->input('visit_type');
            $row = DB::table('calendar')
                ->select('duration')
                ->where('visit_type', '=', $visit_type)
                ->where('active', '=', 'y')
                ->where('practice_id', '=', Session::get('practice_id'))
                ->first();
            $end = $start + $row->duration;
        }
        $provider_id = Session::get('provider_id');
        $reason = $request->input('reason');
        $id = $request->input('event_id');
        $repeat = $request->input('repeat');
        if ($id == '') {
            if (Session::get('group_id') == '100') {
                $status = 'Pending';
            } else {
                if ($pid == '' || $pid == '0') {
                    $status = '';
                } else {
                    $status = 'Pending';
                }
            }
        } else {
            $status = $request->input('status');
        }
        if ($repeat != '') {
            $repeat_day1 = date('l', $start);
            $repeat_day = strtolower($repeat_day1);
            $repeat_start_time = date('h:ia', $start);
            $repeat_end_time = date('h:ia', $end);
            if ($request->input('until') != '') {
                $until = strtotime($request->input('until'));
            } else {
                $until = '0';
            }
            $data1 = [
                'repeat_day' => $repeat_day,
                'repeat_start_time' => $repeat_start_time,
                'repeat_end_time' => $repeat_end_time,
                'repeat' => $repeat,
                'until' => $until,
                'title' => $title,
                'reason' => $reason,
                'provider_id' => $provider_id,
                'start' => $start
            ];
            if ($id == '') {
                DB::table('repeat_schedule')->insert($data1);
                $this->audit('Add');
                $data['message'] = 'Repeated event added.';
            } else {
                $id_check = strpbrk($id, 'N');
                if ($id_check == TRUE) {
                    $nid = str_replace('N', '', $id);
                    DB::table('repeat_schedule')->insert($data1);
                    $this->audit('Add');
                    DB::table('schedule')->where('appt_id', '=', $nid)->delete();
                    $this->audit('Delete');
                    $data['message'] = 'Repeated event updated.';
                } else {
                    $rid = str_replace('R', '', $id);
                    DB::table('repeat_schedule')->where('repeat_id', '=', $rid)->update($data1);
                    $this->audit('Update');
                    $data['message'] = 'Repeated event updated.';
                }
            }
        } else {
            $data = [
                'pid' => $pid,
                'start' => $start,
                'end' => $end,
                'title' => $title,
                'visit_type' => $visit_type,
                'reason' => $reason,
                'status' => $status,
                'provider_id' => $provider_id,
                'user_id' => Session::get('user_id')
            ];
            if (Session::get('group_id') != '100') {
                $data['notes'] = $request->input('notes');
            }
            if ($id == '') {
                $data['timestamp'] = null;
                $appt_id = DB::table('schedule')->insertGetId($data);
                $this->audit('Add');
                if ($pid != '0' && $pid !== '') {
                    $this->schedule_notification($appt_id);
                }
                $data['message'] = 'Appointment/Event added.';
            } else {
                $id_check1 = strpbrk($id, 'NR');
                if ($id_check1 == TRUE) {
                    $nid1 = str_replace('NR', '', $id);
                    DB::table('schedule')->insert($data);
                    $this->audit('Add');
                    DB::table('repeat_schedule')->where('repeat_id', '=', $nid1)->delete();
                    $this->audit('Delete');
                    $data['message'] = 'Event updated.';
                } else {
                    $notify = DB::table('schedule')->where('appt_id', '=', $id)->first();
                    DB::table('schedule')->where('appt_id', '=', $id)->update($data);
                    $this->audit('Update');
                    if ($notify->start != $start && $notify->end != $end) {
                        if ($pid != '0' && $pid !== '') {
                            $this->schedule_notification($id);
                        }
                    }
                    $data['message'] = 'Appointment updated.';
                }
            }
        }
        $data['response'] = 'FrontEnd.appointment';
        return $data;
    }

    public function provider_schedule1(Request $request)
    {
        $start = strtotime($request->input('start'));
        $end = strtotime($request->input('end'));
        $id = Session::get('provider_id');
        $events = [];
        $query = DB::table('schedule')->where('provider_id', '=', $id)->whereBetween('start', [$start, $end])->get();
        if ($query) {
            foreach ($query as $row) {
                if ($row->visit_type != '') {
                    $row1 = DB::table('calendar')
                        ->select('classname')
                        ->where('visit_type', '=', $row->visit_type)
                        ->where('practice_id', '=', Session::get('practice_id'))
                        ->first();
                    $classname = $row1->classname;
                } else {
                    $classname = 'colorblack';
                }
                if ($row->pid == '0') {
                    $pid = '';
                } else {
                    $pid = $row->pid;
                }
                if ($row->timestamp == '0000-00-00 00:00:00' || $row->user_id == '') {
                    $timestamp = '';
                } else {
                    $user_row = DB::table('users')->where('id', '=', $row->user_id)->first();
                    $timestamp = 'Appointment added by ' . $user_row->displayname . ' on ' . $row->timestamp;
                }
                $row_start = date('c', $row->start);
                $row_end = date('c', $row->end);
                $event = [
                    'id' => $row->appt_id,
                    'start' => $row_start,
                    'end' => $row_end,
                    'visit_type' => $row->visit_type,
                    'className' => $classname,
                    'provider_id' => $row->provider_id,
                    'pid'=> $pid,
                    'timestamp' => $timestamp
                ];
                if (Session::get('group_id') == '100' || Session::get('group_id') == 'schedule') {
                    if (Session::get('pid') != $pid) {
                        $event['title'] = 'Appointment taken';
                        $event['reason'] = 'Private';
                        $event['status'] = 'Private';
                        $event['notes'] = '';
                        $event['editable'] = false;
                    } else {
                        $event['title'] = $row->title;
                        $event['reason'] = $row->reason;
                        $event['status'] = $row->status;
                        $event['notes'] = '';
                        $event['editable'] = true;
                    }
                } else {
                    $event['title'] = $row->title;
                    $event['reason'] = $row->reason;
                    $event['status'] = $row->status;
                    $event['notes'] = $row->notes;
                    if (Session::get('group_id') == '1') {
                        $event['editable'] = false;
                    } else {
                        $event['editable'] = true;
                    }
                    if ($row->status == 'Attended') {
                        $event['borderColor'] = 'green';
                    }
                    if ($row->status == 'DNKA') {
                        $event['borderColor'] = 'black';
                    }
                    if ($row->status == 'LMC') {
                        $event['borderColor'] = 'red';
                    }
                }
                $events[] = $event;
            }
        }
        $query2 = DB::table('repeat_schedule')->where('provider_id', '=', $id)->get();
        if ($query2) {
            foreach ($query2 as $row2) {
                if ($row2->start <= $end || $row2->start == "0") {
                    if ($row2->repeat == "86400") {
                        if ($row2->start <= $start) {
                            $repeat_start = strtotime('this ' . strtolower(date('l', $start)) . ' ' . $row2->repeat_start_time, $start);
                            $repeat_end = strtotime('this ' . strtolower(date('l', $start)) . ' ' . $row2->repeat_end_time, $start);
                        } else {
                            $repeat_start = strtotime('this ' . $row2->repeat_day . ' ' . $row2->repeat_start_time, $start);
                            $repeat_end = strtotime('this ' . $row2->repeat_day . ' ' . $row2->repeat_end_time, $start);
                        }
                    } else {
                        $repeat_start = strtotime('this ' . $row2->repeat_day . ' ' . $row2->repeat_start_time, $start);
                        $repeat_end = strtotime('this ' . $row2->repeat_day . ' ' . $row2->repeat_end_time, $start);
                    }
                    if ($row2->until == '0') {
                        while ($repeat_start <= $end) {
                            $repeat_id = 'R' . $row2->repeat_id;
                            $until = '';
                            if ($row2->reason == '') {
                                $row2->reason = $row2->title;
                            }
                            $repeat_start1 = date('c', $repeat_start);
                            $repeat_end1 = date('c', $repeat_end);
                            $event1 = array(
                                'id' => $repeat_id,
                                'start' => $repeat_start1,
                                'end' => $repeat_end1,
                                'repeat' => $row2->repeat,
                                'until' => $until,
                                'className' => 'colorblack',
                                'provider_id' => $row2->provider_id,
                                'status' => 'Repeated Event',
                                'notes' => ''
                            );
                            if (Session::get('group_id') == '100') {
                                $event1['title'] = 'Provider Not Available';
                                $event1['reason'] = 'Provider Not Available';
                                $event1['editable'] = false;
                            } else {
                                $event1['title'] = $row2->title;
                                $event1['reason'] = $row2->reason;
                                if (Session::get('group_id') == '1') {
                                    $event1['editable'] = false;
                                } else {
                                    $event1['editable'] = true;
                                }
                            }
                            $events[] = $event1;
                            $repeat_start = $repeat_start + $row2->repeat;
                            $repeat_end = $repeat_end + $row2->repeat;
                        }
                    } else {
                        while ($repeat_start <= $end) {
                            if ($repeat_start > $row2->until) {
                                break;
                            } else {
                                $repeat_id = 'R' . $row2->repeat_id;
                                $until = date('m/d/Y', $row2->until);
                                if ($row2->reason == '') {
                                    $row2->reason = $row2->title;
                                }
                                $repeat_start1 = date('c', $repeat_start);
                                $repeat_end1 = date('c', $repeat_end);
                                $event1 = array(
                                    'id' => $repeat_id,
                                    'start' => $repeat_start1,
                                    'end' => $repeat_end1,
                                    'repeat' => $row2->repeat,
                                    'until' => $until,
                                    'className' => 'colorblack',
                                    'provider_id' => $row2->provider_id,
                                    'status' => 'Repeated Event',
                                    'notes' => ''
                                );
                                if (Session::get('group_id') == '100') {
                                    $event1['title'] = 'Provider Not Available';
                                    $event1['reason'] = 'Provider Not Available';
                                    $event1['editable'] = false;
                                } else {
                                    $event1['title'] = $row2->title;
                                    $event1['reason'] = $row2->reason;
                                    if (Session::get('group_id') == '1') {
                                        $event1['editable'] = false;
                                    } else {
                                        $event1['editable'] = true;
                                    }
                                }
                                $events[] = $event1;
                                $repeat_start = $repeat_start + $row2->repeat;
                                $repeat_end = $repeat_end + $row2->repeat;
                            }
                        }
                    }
                }
            }
        }
        $row3 = DB::table('practiceinfo')->where('practice_id', '=', Session::get('practice_id'))->first();
        $compminTime = strtotime($row3->minTime);
        $compmaxTime = strtotime($row3->maxTime);
        if ($row3->sun_o != '') {
            $comp1o = strtotime($row3->sun_o);
            $comp1c = strtotime($row3->sun_c);
            if ($comp1o > $compminTime) {
                $events = $this->add_closed1('sunday', $row3->minTime, $row3->sun_o, $events, $start, $end);
            }
            if ($comp1c < $compmaxTime) {
                $events = $this->add_closed2('sunday', $row3->maxTime, $row3->sun_c, $events, $start, $end);
            }
        } else {
            $events = $this->add_closed3('sunday', $row3->minTime, $row3->maxTime, $events, $start, $end);
        }
        if ($row3->mon_o != '') {
            $comp2o = strtotime($row3->mon_o);
            $comp2c = strtotime($row3->mon_c);
            if ($comp2o > $compminTime) {
                $events = $this->add_closed1('monday', $row3->minTime, $row3->mon_o, $events, $start, $end);
            }
            if ($comp2c < $compmaxTime) {
                $events = $this->add_closed2('monday', $row3->maxTime, $row3->mon_c, $events, $start, $end);
            }
        } else {
            $events = $this->add_closed3('monday', $row3->minTime, $row3->maxTime, $events, $start, $end);
        }
        if ($row3->tue_o != '') {
            $comp3o = strtotime($row3->tue_o);
            $comp3c = strtotime($row3->tue_c);
            if ($comp3o > $compminTime) {
                $events = $this->add_closed1('tuesday', $row3->minTime, $row3->tue_o, $events, $start, $end);
            }
            if ($comp3c < $compmaxTime) {
                $events = $this->add_closed2('tuesday', $row3->maxTime, $row3->tue_c, $events, $start, $end);
            }
        } else {
            $events = $this->add_closed3('tuesday', $row3->minTime, $row3->maxTime, $events, $start, $end);
        }
        if ($row3->wed_o != '') {
            $comp4o = strtotime($row3->wed_o);
            $comp4c = strtotime($row3->wed_c);
            if ($comp4o > $compminTime) {
                $events = $this->add_closed1('wednesday', $row3->minTime, $row3->wed_o, $events, $start, $end);
            }
            if ($comp4c < $compmaxTime) {
                $events = $this->add_closed2('wednesday', $row3->maxTime, $row3->wed_c, $events, $start, $end);
            }
        } else {
            $events = $this->add_closed3('wednesday', $row3->minTime, $row3->maxTime, $events, $start, $end);
        }
        if ($row3->thu_o != '') {
            $comp5o = strtotime($row3->thu_o);
            $comp5c = strtotime($row3->thu_c);
            if ($comp5o > $compminTime) {
                $events = $this->add_closed1('thursday', $row3->minTime, $row3->thu_o, $events, $start, $end);
            }
            if ($comp5c < $compmaxTime) {
                $events = $this->add_closed2('thursday', $row3->maxTime, $row3->thu_c, $events, $start, $end);
            }
        } else {
            $events = $this->add_closed3('thursday', $row3->minTime, $row3->maxTime, $events, $start, $end);
        }
        if ($row3->fri_o != '') {
            $comp6o = strtotime($row3->fri_o);
            $comp6c = strtotime($row3->fri_c);
            if ($comp6o > $compminTime) {
                $events = $this->add_closed1('friday', $row3->minTime, $row3->fri_o, $events, $start, $end);
            }
            if ($comp6c < $compmaxTime) {
                $events = $this->add_closed2('friday', $row3->maxTime, $row3->fri_c, $events, $start, $end);
            }
        } else {
            $events = $this->add_closed3('friday', $row3->minTime, $row3->maxTime, $events, $start, $end);
        }
        if ($row3->sat_o != '') {
            $comp7o = strtotime($row3->sat_o);
            $comp7c = strtotime($row3->sat_c);
            if ($comp7o > $compminTime) {
                $events = $this->add_closed1('saturday', $row3->minTime, $row3->sat_o, $events, $start, $end);
            }
            if ($comp7c < $compmaxTime) {
                $events = $this->add_closed2('saturday', $row3->maxTime, $row3->sat_c, $events, $start, $end);
            }
        } else {
            $events = $this->add_closed3('saturday', $row3->minTime, $row3->maxTime, $events, $start, $end);
        }
        return $events;
    }

    public function event_encounter1(Request $request, $appt_id)
    {
        $query = DB::table('encounters')->where('appt_id', '=', $appt_id)->first();
        $query1 = DB::table('schedule')->where('appt_id', '=', $appt_id)->first();
        if ($query) {
            $edit = $this->access_level('2');
            if ($edit == true && $query->encounter_signed == 'No') {
                return redirect()->route('superquery_patient', ['encounter', $query1->pid, $query->eid]);
            } else {
                return redirect()->route('superquery_patient', ['encounter_view', $query1->pid, $query->eid]);
            }
        } else {
            $user_query = DB::table('users')->where('id', '=', $query1->provider_id)->first();
            $practice = DB::table('practiceinfo')->where('practice_id', '=', Session::get('practice_id'))->first();
            $data = [
                'pid' => $query1->pid,
                'appt_id' => $appt_id,
                'encounter_age' => Session::get('age'),
                'encounter_type' => $query1->visit_type,
                'encounter_signed' => 'No',
                'addendum' => 'n',
                'user_id' => $query1->user_id,
                'practice_id' => Session::get('practice_id'),
                'encounter_location' => $practice->default_pos_id,
                'encounter_template' => $practice->encounter_template,
                'encounter_cc' => $query1->reason,
                'encounter_role' => 'Primary Care Provider',
                'encounter_provider' => $user_query->displayname,
                'encounter_DOS' => date('Y-m-d H:i:s', $query1->start),
                'encounter_condition_work' => 'No',
                'encounter_condition_auto' => 'No'
            ];
            $eid = DB::table('encounters')->insertGetId($data);
            $this->audit('Add');
            // $this->api_data('add', 'encounters', 'eid', $eid);
            $data2['status'] = 'Attended';
            DB::table('schedule')->where('appt_id', '=', $appt_id)->update($data2);
            $this->audit('Update');
            $data3['addendum_eid'] = $eid;
            DB::table('encounters')->where('eid', '=', $eid)->update($data3);
            $this->audit('Update');
            // $this->api_data('update', 'encounters', 'eid', $eid);
            Session::put('message_action', 'Encounter created.');
            return redirect()->route('superquery_patient', ['encounter', $query1->pid, $eid]);
        }
    }

}
