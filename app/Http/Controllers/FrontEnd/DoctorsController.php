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

        $where = array();
        $where[] = array('users.group_id', '=', 2);
        $where[] = array('users.active', '=', 1);

        $locations = DB::table('providers')
            ->select('Country')
            ->where('country', '!=', '')
            ->distinct()->get();        

        /*$physicians = DB::table('users')            
            ->select('users.id','providers.photo','users.firstname','providers.specialty')
            ->leftjoin('providers', 'providers.id', '=', 'users.id')
            ->where($where)
            ->get();            

        $specialist = DB::table('users')            
            ->select('users.id','providers.photo','users.firstname','providers.specialty')
            ->leftjoin('providers', 'providers.id', '=', 'users.id')
            ->where('providers.specialty', '!=', '')
            ->where($where)
            ->get();*/        

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
            ->get();

        if(\Request::ajax()) {

            return view("FrontEnd.search_doctor_block", compact('doctors','request')); 
        }

        /*$data['physicians'] = $physicians;
        $data['specialist'] = $specialist;*/
        $data['locations'] = $locations;
        $data['doctors'] = $doctors;

        return view('FrontEnd.doctors', $data);
    }    
}