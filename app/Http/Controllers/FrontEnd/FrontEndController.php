<?php

namespace App\Http\Controllers\FrontEnd;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OAuth2\Response;
use Illuminate\Http\JsonResponse;

use DB;
use Auth;
use FunctionUtils;
use Validator;
use Session;

class FrontEndController extends Controller
{
    public function homepage() {
        return view('FrontEnd.homepage');
    }

    public function aboutus() {
        return view('FrontEnd.about');
    }

    public function contactus() {
        return view('FrontEnd.contact');
    }

    public function singlepage() {
        return view('FrontEnd.single');
    }

    public function department() {
        return view('FrontEnd.department');
    }

    public function appointment() {

        $data = array();
        $data['provider_list'] = '';
        
        return view('FrontEnd.appointment', $data);
    }

    public function subscribe() {
        return view('FrontEnd.subscribe');
    }
       
    public function registration(Request $request) {

        return view('FrontEnd.registration_type');
    }

    public function generateJWT() {
        //Zoom API credentials from https://developer.zoom.us/me/
        $key = '9HEaq1NESUKQp2zjbsbkmg';
        $secret = 'ImEqqKlNKBn7U4jt3h6pzqFuhGdeJvItSp1S';
        $token = array(
            "iss" => $key,
            // The benefit of JWT is expiry tokens, we'll set this one to expire in 1 minute
            "exp" => time() + 3600
        );
        return JWT::encode($token, $secret);
    }

    public function getUsers() {
        //list users endpoint GET https://api.zoom.us/v2/users
        $ch = curl_init('https://api.zoom.us/v2/users');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // add token to the authorization header
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . FrontEndController::generateJWT()
        ]);
        
        $response = curl_exec($ch);
        $response = json_decode($response);
        return response()->json($response);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMeeting() {
        //list users endpoint GET https://api.zoom.us/v2/users
        $ch = curl_init('https://api.zoom.us/v2/users/iViW_PXnQ1umXAiAZFfHIA/meetings');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $meetings =  array([
            "uuid"=> "iViW_PXnQ1umXAiAZFfHIA",
            "id"=> "123456789",
            "real_id"=> "123456789",
            "start_url"=> "https://zoom.us/s/123456789?zak=xxxxxx",
            "join_url"=> "https://zoom.us/j/123456789",
            "created_at"=> "2012-11-25T12:00:00Z",
            "host_id"=> "unique_id",
            "topic"=> "Topic for this meeting",
            "type"=> 2,
            "option_jbh"=> false,
            "option_start_type"=> "video",
            "start_time"=> "2012-11-25T12:00:00Z",
            "duration"=> 30,
            "timezone"=> "America/Los_Angeles",
            "password"=> "123",
            "h323_password"=> "123456",
            "option_host_video"=> false,
            "option_participants_video"=> false,
            "option_audio"=> "both",
            "option_enforce_login"=> false,
            "option_enforce_login_domains "=> "",
            "option_alternative_hosts"=> "",
            "status"=> 0
        ]);
        // add token to the authorization header
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . FrontEndController::generateJWT($meetings)
        ]);

        $response = curl_exec($ch);
        $item = json_decode($response);
        // dd($item);
        $meet = response()->json($item);        
        return view('create_meeting',compact('meet'));
    }

    public function meetingForm(){
        return view('create_meeting');
    }

    public function videoConferenceRoom(Request $request) {
        return view('FrontEnd.conferencePage');
    }
}