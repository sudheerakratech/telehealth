<?php

namespace App\Http\Controllers\FrontEnd;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OAuth2\Response;
use Illuminate\Http\JsonResponse;

use DB;
use FunctionUtils;

class DoctorsController extends Controller
{
    public function doctors(Request $request) {
        
        $data = array();

        $locations = DB::table('providers')->select('Country')->where('Country', '!=', '')->distinct()->get();

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
        $where[] = array('users.active', '=', 1);

        if($request->isMethod('post')) {                        

            if($request->has('specialist') && $request->get('specialist') != '') {
                $where[] = array('providers.specialty','LIKE', '%'.$request->get('specialist').'%');
            }

            if($request->has('location') && $request->get('location') != '') {
                $where[] = array('providers.Country','=', $request->get('location'));
            }
        }

        $doctors = DB::table('users')            
            ->select('users.id','users.email','users.displayname','users.firstname','users.lastname','users.middle','users.title','providers.description','providers.language','providers.Country','providers.photo','providers.certificate','providers.specialty')            
            ->leftjoin('providers', 'providers.id', '=', 'users.id')            
            ->where($where)
            ->orderBy('providers.id','DESC')
            ->paginate(10);

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

        $locations = DB::table('providers')->select('Country')->where('Country', '!=', '')->distinct()->get();

        return Response::json($locations);        
    }
}