<?php $__env->startSection('content'); ?>
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

<section class="index_bg_image" style="padding-top: 50px; padding-bottom: 50px; background-image: url(<?php echo e(url('images/index1_world.jpg')); ?>);">
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
                            <form method="POST" id="register_frm" action="<?php echo e(route('register')); ?>">
                                <?php echo e(csrf_field()); ?>

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
                                            <input type="text" name="first_name" id="first_name" class="form-control<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('first_name')); ?>" required placeholder="First Name" autocomplete="off">
                                            <?php if($errors->has('first_name')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('first_name')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="last_name">Last Name *</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control<?php echo e($errors->has('last_name') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('last_name')); ?>" required  placeholder="Last Name" autocomplete="off">
                                            <?php if($errors->has('last_name')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('last_name')); ?></span>
                                            <?php endif; ?>                        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="dob">Date Of Birth *</label>
                                            <div class='input-group date date_picker'>
                                                <input type='text' name="dob" id="dob" class="form-control<?php echo e($errors->has('dob') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('dob')); ?>" required placeholder="YYYY-MM-DD" autocomplete="off">
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            <?php if($errors->has('dob')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('dob')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label for="sex">Sex *</label>
                                        <div class="form-group">                    
                                            <label class="radio-inline">
                                                <input type="radio" name="sex" value="m" <?php echo e(old('sex') == 'm' ? 'checked' : ''); ?> checked="">Male
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="sex" value="f" <?php echo e(old('sex') == 'f' ? 'checked' : ''); ?>>Female
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="sex" value="o" <?php echo e(old('sex') == 'o' ? 'checked' : ''); ?>>Other
                                            </label>                                            
                                            <?php if($errors->has('sex')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('sex')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                    
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="email">E-Mail *</label>
                                            <input type="email" name="email" id="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('email')); ?>" required placeholder="Email Address" autocomplete="off">
                                            <?php if($errors->has('email')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('email')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="user_name">User Name *</label>
                                            <input type="text" name="user_name"  id="user_name" class="form-control<?php echo e($errors->has('user_name') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('user_name')); ?>" required placeholder="User Name" autocomplete="off">
                                            <?php if($errors->has('user_name')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('user_name')); ?></span>
                                            <?php endif; ?>                                                
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="password">Password *</label>
                                            <input type="password" name="password" id="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" required placeholder="Password" autocomplete="off">
                                            <?php if($errors->has('password')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('password')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">                        
                                            <label for="password-confirm">Confirm Password *</label>
                                            <input type="password" name="confirm_password" id="password-confirm" class="form-control" required placeholder="Confirm Password" autocomplete="off">
                                            <?php if($errors->has('confirm_password')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('confirm_password')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row doctors_field" style="display: none;">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="phone_number">Phone No. *</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control<?php echo e($errors->has('phone_number') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('phone_number')); ?>" placeholder="Phone Number" autocomplete="off">
                                            <?php if($errors->has('phone_number')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('phone_number')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        
                                        <div class="form-group">
                                            <label for="city">City *</label>
                                            <input type="text" name="city" id="city" class="form-control<?php echo e($errors->has('city') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('city')); ?>" placeholder="City Name" autocomplete="off">
                                            <?php if($errors->has('city')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('city')); ?></span>
                                            <?php endif; ?>                        
                                        </div>
                                    </div>
                                </div>
                                <div class="row doctors_field" style="display: none;">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="specialty">Speciality *</label>
                                            <select type="text" name="specialty" id="specialty" class="form-control<?php echo e($errors->has('specialty') ? ' is-invalid' : ''); ?>">
                                                <option value=""<?php echo e(old('specialty')); ?>></option>
                                                <?php if(isset($specialties)): ?>
                                                    <?php $__currentLoopData = $specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                        <option value=""<?php echo e($specialty); ?>><?php echo e($specialty); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php if($errors->has('specialty')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('specialty')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="secret_question">Secret Question *</label>
                                            <input type="text" name="secret_question" id="secret_question" class="form-control<?php echo e($errors->has('secret_question') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('secret_question')); ?>" required placeholder="Secret Question">
                                            <?php if($errors->has('secret_question')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('secret_question')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="secret_answer">Secret Question Answer *</label>
                                            <input type="text" name="secret_answer" id="secret_answer" class="form-control<?php echo e($errors->has('secret_answer') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('secret_answer')); ?>" required placeholder="Secret Question Answer">
                                            <?php if($errors->has('secret_answer')): ?>
                                                <span class="error_msg"><?php echo e($errors->first('secret_answer')); ?></span>
                                            <?php endif; ?>
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
<script src="<?php echo e(asset('js/jquery-2.2.3.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('FrontEnd.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>