<?php

namespace App\Http\Controllers\FrontEnd;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OAuth2\Response;
use Illuminate\Http\JsonResponse;

use DB;
use App\User;
use FunctionUtils;

class DoctorsController extends Controller
{
    public function doctors(Request $request) {
        $data = array();
        $locations = DB::table('providers')->select('city')->where('city', '!=', '')->distinct()->get();

        $specialist = DB::table('providers')->select('specialty')->where('specialty', '!=', '')->get();

        $as_specialist = array();
        foreach ($specialist as $as_value) {            
            foreach ($as_value as $value) {                
                foreach (explode(',', $value) as $un) {
                    $as_specialist[] = $un;
                }
            }
        }
        $as_specialist = array_unique($as_specialist);

        $where = array();
        $where[] = array('users.group_id', '=', 2);
        
        $is_online = $request->has('is_online') ? array($request->get('is_online')) : array(0,1);

       


        if($request->isMethod('post')) {                        
            if($request->has('specialist') && $request->get('specialist') != '') {
                $where[] = array('providers.specialty','LIKE', '%'.$request->get('specialist').'%');
            }
            if($request->has('location') && $request->get('location') != '') {
                $where[] = array('providers.city','=', $request->get('location'));
            }
        }

        $base_query = DB::table('users')            
            ->select('users.id','users.email','users.displayname','users.firstname','users.lastname','users.middle','users.title','users.active',
                rsql("IFNULL(providers.description,' It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.') AS description"),
                rsql("IFNULL(providers.language,'English') AS language"),
                'providers.city',
                'providers.Country','providers.photo','providers.certificate','providers.specialty','providers.sun_o','providers.sun_c','providers.mon_o','providers.mon_c','providers.tue_o','providers.tue_c','providers.wed_o','providers.wed_c','providers.thu_o','providers.thu_c','providers.fri_o','providers.fri_c','providers.sat_o','providers.sat_c',
                rsql("'09:00 AM - 10:00 PM' AS working_hours")
            )
            ->leftjoin('providers', 'providers.id', '=', 'users.id')            
            ->where($where);

        $doctors_online = $request->get('is_online');

        if($doctors_online){
            $online_doctors = User::getOnlineDoctors();
            $base_query = $base_query->whereIn('users.id',$online_doctors);
        }


        $doctors  = $base_query
                            ->orderBy('providers.id','DESC')
                            ->paginate(5);

        if(\Request::ajax()) {

            return view("FrontEnd.search_doctor_block", compact('doctors','request')); 
        }        

        $data['specialist'] = $as_specialist;
        $data['locations'] = $locations;
        $data['doctors'] = $doctors;        

        return view('FrontEnd.doctors', $data);
    }

    public function getDoctorSpeciality() {

        $specialist = DB::table('providers')->select('specialty')->where('specialty', '!=', '')->get();

        $as_specialist = array();
        foreach ($specialist as $as_value) {            
            foreach ($as_value as $value) {                
                foreach (explode(',', $value) as $un) {
                    $as_specialist[] = $un;
                }
            }
        }
        $as_specialist = array_unique($as_specialist);

        return Response::json($as_specialist);
    }

    public function getDoctorLocations() {

        $locations = DB::table('providers')->select('city')->where('city', '!=', '')->distinct()->get();

        return Response::json($locations);        
    }
}