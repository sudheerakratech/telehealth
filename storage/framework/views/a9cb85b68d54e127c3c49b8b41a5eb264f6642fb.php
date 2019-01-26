<?php $__env->startSection('content'); ?>
        <div class="container" style="padding-bottom:50px; padding-top: 50px; width: 100%; background-image: url(<?php echo e(url('images/index1_world.jpg')); ?>)">
        <div class="row">

            <style type="text/css">
            .login_side_box{
                position: relative;
                margin-right: -100px;
                z-index: 9;
                width: 275px;
                background: #fff;
                margin-top: 60px;                
                text-align: right;
                box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
                padding: 110px 15px 15px 15px;
                height: 420px;
                border: 4px solid #09ACFF;
                float: right;   
            }
            .form-horizontal .control-label {
                font-size: 13px;
            }
            </style>

            <div class="col-md-3 col-md-offset-1 hidden-xs hidden-sm">                
                <div class="login_side_box">

                    <div id="login_practice_logo" class="text-center">
                        <a href="<?php echo e(url('/')); ?>"> <img src="<?php echo e(asset('assets/akrahealth.png')); ?>" style="padding: 15px;" ></a>                        
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <?php if($patient_centric == 'n' && $demo == 'n'): ?>
                                <a class="btn btn-primary btn-block" href="#" id="register"><?php echo e(trans('nosh.new_patient_portal')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary btn-block" id="connectUportBtn" onclick="loginBtnClick()" >
                                <img src="<?php echo e(asset('assets/uport-logo-white.svg')); ?>" height="25" width="25" style="margin-right:5px"></img> <?php echo e(trans('nosh.login_uport')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">                

                <div class="panel panel-default">
                    <div class="panel-heading text-center" style="font-size: 21px; background-color: #09ACFF; color: white;"><b><?php echo e(trans('nosh.login_heading')); ?></b></div>
                    <div class="panel-body" style="min-height: 440px;">                       

                        <div style="text-align: center;">                            
                            <div id="login_practice_logo">
                                <a href="<?php echo e(url('/')); ?>"> <img src="<?php echo e(asset('assets/akrahealth.png')); ?>" style="padding: 15px; height: 81px" ></a>
                                
                            </div>
                            <?php if($errors->has('tryagain')): ?>
                                <div class="form-group has-error">
                                <span class="help-block has-error">
                                    <strong><?php echo e($errors->first('tryagain')); ?></strong>
                                </span>
                                </div>
                            <?php endif; ?>
                            <?php if(isset($attempts)): ?>
                                <div class="form-group has-error">
                                <span class="help-block has-error">
                                    <strong><?php echo e($attempts); ?></strong>
                                </span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if(isset($pnosh_provider)): ?>
                            <?php if($pnosh_provider == 'n'): ?>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a class="btn btn-primary btn-block" href="<?php echo e(url('/uma_auth')); ?>">
                                            <i class="fa fa-btn fa-openid"></i> <?php echo e(trans('nosh.button_pnosh_login')); ?>

                                        </a>
                                        <br><br><a href="#" id="show_login_form"><?php echo e(trans('nosh.button_pnosh_admin')); ?></a><br><br>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a class="btn btn-primary btn-block" href="<?php echo e(url('/uma_auth')); ?>">
                                            <i class="fa fa-btn fa-openid"></i> <?php echo e(trans('nosh.button_pnosh_login_with')); ?> HIE of One
                                        </a>
                                        <a class="btn btn-primary btn-block" href="<?php echo e(url('/oidc')); ?>">
                                            <i class="fa fa-btn fa-openid"></i> <?php echo e(trans('nosh.button_pnosh_login_with')); ?> mdNOSH
                                        </a>
                                        <a class="btn btn-primary btn-block" href="<?php echo e(url('/google_auth')); ?>">
                                            <i class="fa fa-btn fa-google"></i> <?php echo e(trans('nosh.button_pnosh_login_with')); ?> Google
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(isset($login_form)): ?>
                            <?php if($login_form == 'y'): ?>
                                <form id="login_form" class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                                    <?php else: ?>
                                        <form id="login_form" class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>" style="display:none;">
                                            <?php endif; ?>
                                            <?php echo e(csrf_field()); ?>


                                            <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                                                <label for="username" class="col-md-4 control-label"><?php echo e(trans('nosh.username')); ?></label>

                                                <div class="col-lg-6 col-md-8">
                                                    <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>">

                                                    <?php if($errors->has('username')): ?>
                                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('username')); ?></strong>
                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                                <label for="password" class="col-md-4 control-label"><?php echo e(trans('nosh.password')); ?></label>

                                                <div class="col-lg-6 col-md-8">
                                                    <input id="password" type="password" class="form-control" name="password">

                                                    <?php if($errors->has('password')): ?>
                                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <?php if(isset($practice_list)): ?>
                                                <div class="form-group<?php echo e($errors->has('practice_id') ? ' has-error' : ''); ?>">
                                                    <label for="password" class="col-md-4 control-label"> <?php echo e(trans('nosh.organization_practice')); ?></label>

                                                    <div class="col-lg-6 col-md-8">
                                                        <select id="practice_id" class="form-control" name="practice_id" value="<?php echo e(old('practice_id')); ?>"><?php echo $practice_list; ?></select>

                                                        <?php if($errors->has('practice_id')): ?>
                                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('practice_id')); ?></strong>
                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <div class="form-group">                        
                                                <div class="col-lg-3 col-md-4 col-md-offset-4">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="remember"> <?php echo e(trans('nosh.remember_me')); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4">
                                                    <a class="btn btn-primary btn-block" href="<?php echo e(url('/password_email')); ?>"><?php echo e(trans('nosh.forgot_password')); ?></a>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-6 col-md-8 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        <i class="fa fa-btn fa-sign-in"></i> <?php echo e(trans('nosh.login_heading')); ?>

                                                    </button>                                                    
                                                    <?php if($patient_centric == 'n' && $demo == 'n'): ?>
                                                        <a class="btn btn-primary btn-block hidden-md hidden-lg" href="#" id="register"><?php echo e(trans('nosh.new_patient_portal')); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group hidden-md hidden-lg">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button type="button" class="btn btn-primary btn-block" id="connectUportBtn" onclick="loginBtnClick()">
                                                        <img src="<?php echo e(asset('assets/uport-logo-white.svg')); ?>" height="25" width="25" style="margin-right:5px"></img> <?php echo e(trans('nosh.login_uport')); ?>

                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php if($errors->has('registration_code') || $errors->has('lastname') || $errors->has('firstname') || $errors->has('dob') || $errors->has('email') || $errors->has('username1') || $errors->has('numberReal')): ?>
                                            <form id="register_form" class="form-horizontal" role="form" method="POST" action="<?php echo e(url('register_user')); ?>">
                                                <?php else: ?>
                                                    <form id="register_form" class="form-horizontal" role="form" method="POST" action="<?php echo e(url('register_user')); ?>" style="display:none;">
                                                        <?php endif; ?>
                                                        <?php echo e(csrf_field()); ?>

                                                        <input type="hidden" name="count" id="new_password_count" value="" />
                                                        <input type="hidden" name="practice_id" id="register_practice_id" value="" />

                                                        <div class="well">
                                                            <p><?php echo e(trans('nosh.instruct_patient_portal1')); ?></p>
                                                            <p><?php echo e(trans('nosh.instruct_patient_portal2')); ?></p>
                                                            <p><?php echo e(trans('nosh.instruct_patient_portal3')); ?></p>
                                                            <p><?php echo e(trans('nosh.instruct_patient_portal4')); ?></p>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('lastname') ? ' has-error' : ''); ?>">
                                                            <label for="lastname" class="col-md-4 control-label"><?php echo e(trans('nosh.lastname')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="lastname" type="text" class="form-control" name="lastname" value="<?php echo e(old('lastname')); ?>" required>

                                                                <?php if($errors->has('lastname')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('lastname')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('firstname') ? ' has-error' : ''); ?>">
                                                            <label for="firstname" class="col-md-4 control-label"><?php echo e(trans('nosh.firstname')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="firstname" type="text" class="form-control" name="firstname" value="<?php echo e(old('firstname')); ?>" required>

                                                                <?php if($errors->has('firstname')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('firstname')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('dob') ? ' has-error' : ''); ?>">
                                                            <label for="dob" class="col-md-4 control-label"><?php echo e(trans('nosh.dob')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="dob" class="form-control" type="date" name="dob" value="<?php echo e(old('dob')); ?>" required>

                                                                <?php if($errors->has('dob')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('dob')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                            <label for="email" class="col-md-4 control-label"><?php echo e(trans('nosh.email')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                                                <?php if($errors->has('email')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('username1') ? ' has-error' : ''); ?>">
                                                            <label for="username1" class="col-md-4 control-label"><?php echo e(trans('nosh.desired_username')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="username1" type="text" class="form-control" name="username1" value="<?php echo e(old('username1')); ?>" required>

                                                                <?php if($errors->has('username1')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('username1')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('password1') ? ' has-error' : ''); ?>">
                                                            <label for="password1" class="col-md-4 control-label"><?php echo e(trans('nosh.password')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="password1" type="password" class="form-control" name="password1">

                                                                <?php if($errors->has('password1')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('password1')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('confirm_password1') ? ' has-error' : ''); ?>">
                                                            <label for="confirm_password1" class="col-md-4 control-label"><?php echo e(trans('nosh.confirm_password')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="confirm_password1" type="password" class="form-control" name="confirm_password1">

                                                                <?php if($errors->has('confirm_password1')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('confirm_password1')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('secret_question') ? ' has-error' : ''); ?>">
                                                            <label for="secret_question" class="col-md-4 control-label"><?php echo e(trans('nosh.secret_question')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="secret_question" type="text" class="form-control" name="secret_question">

                                                                <?php if($errors->has('secret_question')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('secret_question')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('secret_answer') ? ' has-error' : ''); ?>">
                                                            <label for="secret_answer" class="col-md-4 control-label"><?php echo e(trans('nosh.secret_answer')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="secret_answer" type="text" class="form-control" name="secret_answer">

                                                                <?php if($errors->has('secret_answer')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('secret_answer')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('registration_code') ? ' has-error' : ''); ?>">
                                                            <label for="registration_code" class="col-md-4 control-label"><?php echo e(trans('nosh.registration_code')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="registration_code" type="password" class="form-control" name="registration_code" placeholder="<?php echo e(trans('nosh.optional')); ?>">

                                                                <?php if($errors->has('registration_code')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('registration_code')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group<?php echo e($errors->has('numberReal') ? ' has-error' : ''); ?>">
                                                            <label for="numberReal" class="col-md-4 control-label"><?php echo e(trans('nosh.captcha_code')); ?></label>

                                                            <div class="col-md-6">
                                                                <input id="numberReal" type="text" class="form-control" name="numberReal" placeholder="<?php echo e(trans('nosh.captcha_code1')); ?>">

                                                                <?php if($errors->has('numberReal')): ?>
                                                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('numberReal')); ?></strong>
                                        </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fa fa-btn fa-sign-in"></i> <?php echo e(trans('nosh.button_register')); ?>

                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                            </form>
                                </form>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('view.scripts'); ?>
    <script src="<?php echo e(asset('assets/js/web3.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/uport-connect.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if (noshdata.message_action !== '') {
                if (noshdata.message_action.search('Error - ') == -1) {
                    toastr.success(noshdata.message_action);
                } else {
                    toastr.error(noshdata.message_action);
                }
            }
            if ($("#register_form").is(':visible')) {
                $("#lastname").focus();
                $("#login_form").hide();
            } else {
                $("#username").focus();
            }
            $('#show_login_form').click(function() {
                $('#login_form').show();
            });
            $("#register").click(function(){
                $("#register_form").show();
                $("#login_form").hide();
                $(".footer").css('bottom', '-60px');
            });
            $('#numberReal').realperson({includeNumbers: true});
            function loadlogo() {
                var a = $('#practice_id').val();
                if (a !== undefined) {
                    $.ajax({
                        type: "POST",
                        url: noshdata.practice_logo,
                        data: "practice_id=" + a,
                        success: function(data){
                            $("#login_practice_logo").html(data);
                        }
                    });
                }
            }
            $('#practice_id').change(function(){
                loadlogo();
            });
            if ($('#practice_id').val() !== '') {
                loadlogo();
            }
        });

        // Uport
        const Connect = window.uportconnect.Connect;
        const appName = 'AKRAHEALTH';
        const connect = new Connect(appName, {
            clientId: '2ozeHuN5rinLEMGP6CD7QcHm4HMdrYaEwhh',
            network: 'rinkeby',
            signer: window.uportconnect.SimpleSigner('e6afba2de6c0039c130922862a32570feaa4c04c3c3150f8edd84da2c44b1bab')
        });
        const web3 = connect.getWeb3();
        const loginBtnClick = () => {
            connect.requestCredentials({
                requested: ['name', 'phone', 'country', 'email', 'description'],
                notifications: true // We want this if we want to recieve credentials
            }).then((credentials) => {
                console.log(credentials);
            var uport_data = 'name=' + credentials.name + '&uport=' + credentials.address;
            if (typeof credentials.description !== 'undefined') {
                uport_data += '&npi=' + credentials.description;
            }
            if (typeof credentials.email !== 'undefined') {
                uport_data += '&email=' + credentials.email;
            }
            $.ajax({
                type: "POST",
                url: noshdata.login_uport,
                data: uport_data,
                dataType: 'json',
                success: function(data){
                    if (data.message !== 'OK') {
                        toastr.error(data.message);
                    } else {
                        window.location = data.url;
                    }
                }
            });
        }, console.err);
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('FrontEnd.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>