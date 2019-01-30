<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use DB;
use Illuminate\Http\Request;
use Response;
use URL;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function patient_schedule(Request $request)
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
}
