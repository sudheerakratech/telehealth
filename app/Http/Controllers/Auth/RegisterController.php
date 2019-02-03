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
use App\Helper\FunctionUtils;

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
        view()->composer('auth.register', function($view){
            return $view->with('specialties',FunctionUtils::specialties());
        });
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
        $rules = array();
        $rules["first_name"] = "required";
        $rules["last_name"] = "required";           
        $rules["user_name"] = "required|unique:users,username";
        $rules["email"] = "required|unique:users,email";
        $rules["password"] = "required|min:6";
        $rules["confirm_password"] = "same:password";
        $rules["secret_question"] = "required";
        $rules["secret_answer"] = "required";
        $rules["group_id"] = "required";
        $rules["profile_image"] = "required|image|mimes:jpg,jpeg,png,gif|max:5120";

        $rules_msg = array();
        $rules_msg["group_id.required"] = "Please select registration type.";
        $rules_msg["confirm_password.same"] = "Confirm password could not match.";
        $rules_msg["profile_image.required"] = "Please upload profile image";
        $rules_msg["profile_image.image"] = "Please upload only image";
        $rules_msg["profile_image.mimes"] = "Please upload only jpg, jpeg, png image";
        $rules_msg["profile_image.max"] = "Please upload image less than 5 MB";

        if(isset($data['group_id']) && $data['group_id'] == 2) {
            $rules["phone_number"] = "required|regex:/^[0-9 +]+$/u";
            /*$rules["country"] = "required|max:100";*/
            $rules["city"] = "required|max:100";
            $rules["specialty"] = "required|max:255";

            $rules_messages["phone_number.regex"] = "Please enter valid phone no";
          
        }       
        return Validator::make($data, $rules, $rules_msg);       
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
            /*"active" => 1,*/
        ]);

        if($user) {
            if(array_key_exists('profile_image', $data)){
                $profile_image = $data['profile_image'];
                $extension = $profile_image->extension();
                $file_name = $data['user_name'].'.'.$extension;
                $path = \Storage::disk('public')->putFileAs('profile', $profile_image,$file_name);
            }


            Session::put('user_id', $user->id);
            Session::put('displayname', $user->displayname);
            Session::put('group_id', $user->group_id);
            Session::put('practice_id', $user->practice_id);

            $practice = DB::table('practiceinfo')->where('practice_id', '=', $user->practice_id)->first();

            Session::put('version', $practice->version);
            Session::put('practice_active', $practice->active);            
            Session::put('documents_dir', $practice->documents_dir);
            Session::put('rcopia', $practice->rcopia_extension);
            Session::put('mtm_extension', $practice->mtm_extension);
            Session::put('patient_centric', $practice->patient_centric);

            if($user->group_id == '100') {

                $demographics_id = DB::table('demographics')->insert(array(
                    "id" => $user->id,
                    "firstname" => $user->firstname,
                    "lastname" => $user->lastname,
                    "email" => $user->email,
                    "DOB" => date('Y-m-d H:i:s', strtotime($data['dob'])),
                    "sex" => $data['sex'],
                    "reminder_method" => "Email",
                    "reminder_interval" => "Default",
                    "active" => 1,
                    'photo' => $file_name 
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

       
            if($user->group_id == '2') {

                $providers = DB::table('providers')->insert([
                    "id" => $user->id,
                    "Email_Address" => $user->email,
                    "Date_of_Birth" => date('Y-m-d H:i:s', strtotime($data['dob'])),
                    "Mobile" => $data['phone_number'],                    
                    /*"Country" => $data['country'],*/
                    "city" => $data['city'],
                    "photo" => $file_name,
                    "specialty" => $data['specialty'],
                    "practice_id" => $practice->practice_id
                ]);                
            }
            return $user;
        }
        return redirect()->intended('register');
        
    }     
}
