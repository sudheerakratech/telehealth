<!-- header --><div class="main" id="home">    <div class="header_agileinfo">        <div class="w3_agileits_header_text">            <ul class="m_nav menu__list">                <!-- Authentication Links -->                <?php if(Auth::guest()): ?>                    <?php if(!isset($noheader)): ?>                       <li style="overflow: hidden; float: left;"> <a href="<?php echo e(url('/login')); ?>" style="color: white;" class="font-14 mr-4"><i class="fa fa-sign-in"></i><b>Login</b></a></li>                        <li style="padding-left: 10px; overflow: hidden; float: left;"><a href="<?php echo e(route('register')); ?>" style="color: white;" class="font-14"><i class="fa fa-user"></i><b>Register</b></a></li>                    <?php endif; ?>                <?php else: ?>                    <li class="dropdown">                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">                            <b style="color: white;"><?php echo e(Auth::user()->displayname); ?></b> <span class="caret"></span>                        </a>                        <ul class="dropdown-menu" role="menu">                            <li><a href="<?php echo e(route('core_form', ['users', 'id', Session::get('user_id'), Session::get('group_id')])); ?>"><i class="fa fa-btn fa-cogs"></i><?php echo e(trans('nosh.my_information')); ?></a></li>                            <?php if(Session::get('group_id') == '2'): ?>                                <li><a href="<?php echo e(route('user_signature')); ?>"><i class="fa fa-btn fa-pencil"></i><?php echo e(trans('nosh.user_signature')); ?></a></li>                            <?php endif; ?>                            <?php if(Session::get('patient_centric') == 'y'): ?>                                <li><a href="<?php echo e(route('fhir_connect')); ?>"><i class="fa fa-btn fa-plug"></i><?php echo e(trans('nosh.fhir_connect')); ?></a></li>                                <li><a href="<?php echo e(str_replace('/nosh', '', route('dashboard'))); ?>"><i class="fa fa-btn fa-openid"></i><?php echo e(trans('nosh.hieofone')); ?></a></li>                            <?php endif; ?>                            <li><a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-btn fa-dashboard"></i>Dashboard</a></li>                            <li><a href="<?php echo e(route('password_change')); ?>"><i class="fa fa-btn fa-cog"></i><?php echo e(trans('nosh.password_change')); ?></a></li>                            <li><a href="<?php echo e(route('logout')); ?>"><i class="fa fa-btn fa-sign-out"></i><?php echo e(trans('nosh.logout')); ?></a></li>                        </ul>                    </li>                <?php endif; ?>            </ul>        </div>        <div class="agileinfo_social_icons">            <ul class="agileits_social_list">                <li>                    <a href="<?php echo e(route('contactus')); ?>" class="w3_agile_contact"  title="Contact Us" style="background-color: wh: ">                        <i>                        <img src="<?php echo e(asset('images/icons/connect-icon.png')); ?>" alt="" width="33px" height="33px"style='padding-bottom: 4px;padding-right: 4px'>                        </i>                        <!-- <i class="fa fa-question" aria-hidden="true">                                                    </i> -->                    </a>                </li>                <li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>                <li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>                                            </ul>        </div>               <div class="clearfix"> </div>    </div>    <div class="header-bottom">        <nav class="navbar navbar-default">            <!-- Brand and toggle get grouped for better mobile display -->            <div class="navbar-header">                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">                    <span class="sr-only">Toggle navigation</span>                    <span class="icon-bar"></span>                    <span class="icon-bar"></span>                    <span class="icon-bar"></span>                </button>                <div class="logo" style="padding-left: 17px;">                     <span class="navbar-brand" id="logo" data-toggle="offcanvas" style="padding:0px">                   <a href="<?php echo e(route('homepage')); ?>"> <img src="<?php echo e(asset('assets/akrahealth.png')); ?>" style="height: 100%; "></a>                </span>                </div>            </div>            <!-- Collect the nav links, forms, and other content for toggling -->            <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">                <nav class="menu menu--sebastian">                    <ul id="m_nav_list" class="m_nav menu__list">                        <li class="m_nav_item menu__item" id="m_nav_item_1"> <a href="<?php echo e(route('homepage')); ?>" class="menu__link"> Home </a></li>                        <li class="m_nav_item menu__item" id="moble_nav_item_2"> <a href="<?php echo e(route('aboutus')); ?>" class="menu__link"> About Us </a> </li>                                                <?php if(Auth::check()): ?>                            <li class="m_nav_item menu__item dropdown" id="moble_nav_item_4">                                <a href="#" data-toggle="dropdown" class="menu__link dropdown-toggle">Appointment<span class="caret"></span></a>                                <ul class="dropdown-menu">                                       <li class="m_nav_item menu__item" id="moble_nav_item_7">                                            <a href="javascript:void(0);" class="menu__link" id="menu_appointment">Request Appointment</a>                                       </li>                                       <li class="m_nav_item menu__item" id="moble_nav_item_9">                                            <a href="<?php echo e(route('my-appointments')); ?>" class="menu__link" id="menu_appointment">My Appointment</a>                                       </li>                                </ul>                            </li>                        <?php else: ?>                            <li class="m_nav_item menu__item dropdown" id="moble_nav_item_4">                                <a href="#" data-toggle="dropdown" class="menu__link dropdown-toggle">Appointment<span class="caret"></span></a>                                <ul class="dropdown-menu">                                   <li class="m_nav_item menu__item" id="moble_nav_item_4"> <a href="<?php echo e(route('login')); ?>" class="menu__link">Request Appointment</a>                                   </li>                                </ul>                            </li>                        <?php endif; ?>                        <li class="m_nav_item menu__item" id="moble_nav_item_6"> <a href="<?php echo e(route('features')); ?>" class="menu__link">Features</a> </li>                       <li class="m_nav_item menu__item" id="moble_nav_item_5"> <a href="<?php echo e(route('doctors')); ?>" class="menu__link">Physicians</a> </li>                        <li class="m_nav_item menu__item" id="moble_nav_item_3"> <a href="<?php echo e(route('subscribe')); ?>" class="menu__link">Pricing</a> </li>                        <li class="m_nav_item menu__item" id="moble_nav_item_8">                            <a href="<?php echo e(route('singlepage')); ?>" class="menu__link" target="_blank"> Blog</a>                        </li>                    </ul>                </nav>            </div>            <!-- /.navbar-collapse -->        </nav>    </div></div><!-- end header -->