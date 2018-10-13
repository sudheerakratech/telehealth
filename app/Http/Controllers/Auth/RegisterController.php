<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;
use Validator;
use DB;
use Auth;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            "first_name" => "required",
            "last_name" => "required",            
            "user_name" => "required|unique:users,username",
            "email" => 'required|unique:users,email',
            "password" => 'required|min:6',            
            'confirm_password' => 'same:password',
            "secret_question" => "required",
            "secret_answer" => "required",
            "group_id" => "required",
        ],[
            "group_id.required" => "Please select registration type.",
            "confirm_password.same" => "Confirm password could not match."
        ]);       
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            "firstname" => $data['first_name'],
            "lastname" => $data['last_name'],
            "displayname" => $data['first_name']." ".$data['last_name'],
            "username" => $data['user_name'],
            "email" => $data['email'],
            "password" => bcrypt($data['password']),
            "secret_question" => $data['secret_question'],
            "secret_answer" => $data['secret_answer'],
            "group_id" => $data['group_id'],
            "practice_id" => $data['practice_id'],
            "active" => 1,
        ]);

        if($user) {

            Session::put('user_id', $user->id);
            Session::put('displayname', $user->displayname);
            Session::put('group_id', $user->group_id);
            Session::put('practice_id', $user->practice_id);

            if($user->group_id == '100') {

                $practice = DB::table('practiceinfo')->where('practice_id', '=', $user->practice_id)->first();

                Session::put('version', $practice->version);
                Session::put('practice_active', $practice->active);            
                Session::put('documents_dir', $practice->documents_dir);
                Session::put('rcopia', $practice->rcopia_extension);
                Session::put('mtm_extension', $practice->mtm_extension);
                Session::put('patient_centric', $practice->patient_centric);

                $demographics_id = DB::table('demographics')->insert(array(
                    "id" => $user->id,
                    "firstname" => $user->firstname,
                    "lastname" => $user->lastname,
                    "email" => $user->email,
                    "DOB" => date('Y-m-d H:i:s', strtotime($data['dob'])),
                    "sex" => $data['sex'],
                    "reminder_method" => "Email",
                    "reminder_interval" => "Default",
                    "active" => 1
                ));

                $demographics = DB::table('demographics')->select('pid')->where('id',$user->id)->first();

                Session::put('pid', $demographics->pid);

                $demographics_relate = DB::table('demographics_relate')->insert(array(
                    "pid" => $demographics->pid,
                    "practice_id" => $practice->practice_id,
                    "id" => $user->id,
                    "appointment_reminder" => "n"
                ));

                $demographics_notes = DB::table('demographics_notes')->insert(array(
                    "pid" => $demographics->pid,
                    "practice_id" => $practice->practice_id
                )); 
            }

            return $user;
        }
        return redirect()->intended('register');
        
    }     
}
