@extends('FrontEnd.layouts.master')
@section('content')
<title>Telemedicine | Registration</title>    
    <style>
        .btn-sq-lg {
            width: 150px !important;
            height: 150px !important;
            margin: 23px;
        }
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
        #img-upload-container{
        }    

        #img-upload{
            width: auto;
            max-height: 200px;
        }

    </style>            

<section class="index_bg_image" style="padding-top: 50px; padding-bottom: 50px; background-image: url({{url('images/index1_world.jpg')}});">
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="col-md-4"></div>
                    <a href="javascript:void(0);" id="pat_register" class="btn btn-sq-lg btn-primary active"><br>
                        <i class="fa fa-medkit fa-5x"></i><br/>
                        <h4><b>Patients <br> Register</b></h4>
                    </a>
                    <a href="javascript:void(0);" id="doc_register" class="btn btn-sq-lg btn-primary"><br>
                        <i class="fa fa-user-md fa-5x"></i><br/>
                        <h4><b>Doctors <br> Register</b></h4>
                    </a>                    
                </div>
            </div>
        <div class="row">            
            <div class="col-md-offset-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center" id="register_title">Patient Registration</div>
                    <div class="panel-body" style="min-height: 440px;">                        
                        <div class="col-md-12">
                            <form method="POST" id="register_frm" action="{{route('register')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="practice_id" id="register_practice_id" value="1">
                                <input type="hidden" name="group_id" id="register_group_id" value="100">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Upload Image</label>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <span class="btn btn-default btn-file">
                                                        Browse… <input type="file" id="imgInp">
                                                    </span>
                                                </span>
                                                <input type="text" class="form-control" readonly>
                                            </div>
                                            <div id="img-upload-container">
                                                <img id='img-upload'/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="first_name">First Name *</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name') }}" required placeholder="First Name" autocomplete="off">
                                            @if ($errors->has('first_name'))
                                                <span class="error_msg">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="last_name">Last Name *</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') }}" required  placeholder="Last Name" autocomplete="off">
                                            @if ($errors->has('last_name'))
                                                <span class="error_msg">{{ $errors->first('last_name') }}</span>
                                            @endif                        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="dob">Date Of Birth *</label>
                                            <div class='input-group date date_picker'>
                                                <input type='text' name="dob" id="dob" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" value="{{ old('dob') }}" required placeholder="YYYY-MM-DD" autocomplete="off">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            @if ($errors->has('dob'))
                                                <span class="error_msg">{{ $errors->first('dob') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label for="sex">Sex *</label>
                                        <div class="form-group">                    
                                            <label class="radio-inline">
                                                <input type="radio" name="sex" value="m" {{ old('sex') == 'm' ? 'checked' : ''}} checked="">Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="sex" value="f" {{ old('sex') == 'f' ? 'checked' : ''}}>Female
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="sex" value="o" {{ old('sex') == 'o' ? 'checked' : ''}}>Other
                                            </label>                                            
                                            @if ($errors->has('sex'))
                                                <span class="error_msg">{{ $errors->first('sex') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="email">E-Mail *</label>
                                            <input type="email" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required placeholder="Email Address" autocomplete="off">
                                            @if ($errors->has('email'))
                                                <span class="error_msg">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="user_name">User Name *</label>
                                            <input type="text" name="user_name"  id="user_name" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" value="{{ old('user_name') }}" required placeholder="User Name" autocomplete="off">
                                            @if ($errors->has('user_name'))
                                                <span class="error_msg">{{ $errors->first('user_name') }}</span>
                                            @endif                                                
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="password">Password *</label>
                                            <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="Password" autocomplete="off">
                                            @if ($errors->has('password'))
                                                <span class="error_msg">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">                        
                                            <label for="password-confirm">Confirm Password *</label>
                                            <input type="password" name="confirm_password" id="password-confirm" class="form-control" required placeholder="Confirm Password" autocomplete="off">
                                            @if ($errors->has('confirm_password'))
                                                <span class="error_msg">{{ $errors->first('confirm_password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row doctors_field" style="display: none;">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="phone_number">Phone No. *</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{ old('phone_number') }}" placeholder="Phone Number" autocomplete="off">
                                            @if ($errors->has('phone_number'))
                                                <span class="error_msg">{{ $errors->first('phone_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        {{-- <div class="form-group">
                                            <label for="country">Country *</label>
                                            <input type="text" name="country" id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" value="{{ old('country') }}" placeholder="Country" autocomplete="off">
                                            @if ($errors->has('country'))
                                                <span class="error_msg">{{ $errors->first('country') }}</span>
                                            @endif                        
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="city">City *</label>
                                            <input type="text" name="city" id="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ old('city') }}" placeholder="City Name" autocomplete="off">
                                            @if ($errors->has('city'))
                                                <span class="error_msg">{{ $errors->first('city') }}</span>
                                            @endif                        
                                        </div>
                                    </div>
                                </div>
                                <div class="row doctors_field" style="display: none;">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="specialty">Speciality *</label>
                                            <select type="text" name="specialty" id="specialty" class="form-control{{ $errors->has('specialty') ? ' is-invalid' : '' }}">
                                                <option value=""{{ old('specialty') }}></option>
                                            </select>
                                            @if ($errors->has('specialty'))
                                                <span class="error_msg">{{ $errors->first('specialty') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="secret_question">Secret Question *</label>
                                            <input type="text" name="secret_question" id="secret_question" class="form-control{{ $errors->has('secret_question') ? ' is-invalid' : '' }}" value="{{ old('secret_question') }}" required placeholder="Secret Question">
                                            @if ($errors->has('secret_question'))
                                                <span class="error_msg">{{ $errors->first('secret_question') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="secret_answer">Secret Question Answer *</label>
                                            <input type="text" name="secret_answer" id="secret_answer" class="form-control{{ $errors->has('secret_answer') ? ' is-invalid' : '' }}" value="{{ old('secret_answer') }}" required placeholder="Secret Question Answer">
                                            @if ($errors->has('secret_answer'))
                                                <span class="error_msg">{{ $errors->first('secret_answer') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="registration_code">Registration Code</label>
                                            <input type="text" name="registration_code" id="registration_code" class="form-control" placeholder="Optional">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center m-t-20">
                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                    <button type="reset" class="btn btn-warning">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>

@endsection