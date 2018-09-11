@extends('FrontEnd.layouts.master')
@section('content')
    <title>Telemedicine | About</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        /* FontAwesome for working BootSnippet :> */

        @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        #team {
            background: #eee !important;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #108d6f;
            border-color: #108d6f;
            box-shadow: none;
            outline: none;
        }

        .btn-primary {
            color: #fff;
            background-color: #007b5e;
            border-color: #007b5e;
        }

        section {
            padding: 60px 0;
        }

        section .section-title {
            text-align: center;
            color: #007b5e;
            margin-bottom: 50px;
            text-transform: uppercase;
        }

        #team .card {
            border: none;
            background: #ffffff;
        }

        .image-flip:hover .backside,
        .image-flip.hover .backside {
            -webkit-transform: rotateY(0deg);
            -moz-transform: rotateY(0deg);
            -o-transform: rotateY(0deg);
            -ms-transform: rotateY(0deg);
            transform: rotateY(0deg);
            border-radius: .25rem;
        }

        .image-flip:hover .frontside,
        .image-flip.hover .frontside {
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
            -o-transform: rotateY(180deg);
            transform: rotateY(180deg);
        }

        .mainflip {
            -webkit-transition: 1s;
            -webkit-transform-style: preserve-3d;
            -ms-transition: 1s;
            -moz-transition: 1s;
            -moz-transform: perspective(1000px);
            -moz-transform-style: preserve-3d;
            -ms-transform-style: preserve-3d;
            transition: 1s;
            transform-style: preserve-3d;
            position: relative;
        }

        .frontside {
            position: relative;
            -webkit-transform: rotateY(0deg);
            -ms-transform: rotateY(0deg);
            z-index: 2;
            margin-bottom: 30px;
        }

        .backside {
            position: absolute;
            top: 0;
            left: 0;
            background: white;
            -webkit-transform: rotateY(-180deg);
            -moz-transform: rotateY(-180deg);
            -o-transform: rotateY(-180deg);
            -ms-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
            -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        }

        .frontside,
        .backside {
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            -ms-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transition: 1s;
            -webkit-transform-style: preserve-3d;
            -moz-transition: 1s;
            -moz-transform-style: preserve-3d;
            -o-transition: 1s;
            -o-transform-style: preserve-3d;
            -ms-transition: 1s;
            -ms-transform-style: preserve-3d;
            transition: 1s;
            transform-style: preserve-3d;
        }

        .frontside .card,
        .backside .card {
            min-height: 312px;
        }

        .backside .card a {
            font-size: 18px;
            color: #007b5e !important;
        }

        .frontside .card .card-title,
        .backside .card .card-title {
            color: #007b5e !important;
        }

        .frontside .card .card-body img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
        }
        .w3layouts-banner-top123{
        background-image: url("{{url('images/EMR.jpg')}}");
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            min-height:700px;
        }
        .w3layouts-banner-top1234{
            background-image: url("{{url('images/EMR2.jpg')}}");
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            min-height:700px;
        }
        .w3layouts-banner-top12345{
            background-image: url("{{url('images/EMR4.jpg')}}");
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            min-height:700px;
        }
    </style>
    <!-- banner -->
    <div class="banner1 jarallax">
        <div class="container">
        </div>
    </div>
    <div class="services-breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('homepage')}}">Home</a><i>|</i></li>
                <li>About</li>
            </ul>
        </div>
    </div>
    <!-- //banner -->
    <!-- about -->
    <div class="about" id="about">
        <div class="container">
            <h2 class="w3_heade_tittle_agile">Our vision</h2>
            {{--<p class="sub_t_agileits">Impacting lives through technology</p>--}}

            <p class="ab" style="text-align: justify">
                To have intelligent smart healthcare services armed with diagnostic and treatment information capabilities with enhanced features and monitor patients on an ongoing and continuous basis.
                {{--<br>--}}
                To enable patients to take charge of their health information, even becoming co-creators of their personal health records. Our platform would allow clinicians to monitor patients from a distance online

            </p>
            <h2 class="w3_heade_tittle_agile">What we do</h2>
            {{--<p class="sub_t_agileits">Impacting lives through technology</p>--}}

            <p class="ab" style="text-align: justify">
                Through effective coordination involving multiple healthcare stakeholders our features help clinicians, social workers and care coordinators to monitor patients with calls and visits, encouraging them to embrace healthy lifestyle regimens, fill prescriptions and keep physician appointments
                {{--<br>--}}
                Our apps are designed to become as important to clinicians as they are to patients ensuring health record information are secure and handled for data streaming from many sources, including personal health devices.

            </p>

            <div class="about-w3lsrow">

                <div class="col-md-6 w3about-img">
                    <img src="{{asset('images/front/xprofessional1.jpg.pagespeed.ic.9W82aAtyiV.jpg')}}" alt=" " class="img-responsive">
                </div>
                <div class="col-md-6 col-sm-7 w3about-img two">
                    <ul class="w3about-text" style="font-size: 17px;">
                        {{--<h5 class="w3l-subtitle">What we do</h5>--}}
                        <p style="text-align: justify;">
                            <li>   Store yours and your families a: medical history b: prescriptions c. doctors d. pharmacies e: insurance.</li>
                            <li>   Save time, able to retrieve accurate information about the condition for your history on health and prescriptions, helps you and your doctor assess yours and your family medical needs faster and more accurately, you don't have to rely on your memory</li>
                            <li>   Create and send medical details for any: Specialist, school enrolment, flu shots, dentist and more...</li>
                            <li>   The medical provider receives clearly readable information which reduces the cost of care and you don't have to remember your history time and time again for you or your family. You'll have the details for your doctor at your fingertip.</li>
                            <li>   Send securely generated information from your desktop or any mobile device via email or to a wireless printer. </li>
                            <li>   You don't have to worry on carrying files or records while consulting with doctors or arrive in person for an appointment nor you don't have to take the stress to remember we help gives you control of your health.</li>
                            </p>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- /about-bottom -->
    <!-- services-bottom -->
    <div class="services-bottom">
        <div class="col-md-5 wthree_services_bottom_right" style="height: 570px;">
                {{--<div class="banner-silder">--}}
                    <div id="JiSlider" class="jislider">
                        <ul>
                            <li>
                                <div class="w3layouts-banner-top123">

                                    <div class="container">
                                        <div class="agileits-banner-info">
                                            <span>Health Care Center</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="w3layouts-banner-top w3layouts-banner-top1234">
                                    <div class="container">
                                        <div class="agileits-banner-info">
                                            <span>Hospital Departments</span>

                                            {{--<p>Store all of your medical records in our secure blockchain and access anywhere anytime.</p>--}}

                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="w3layouts-banner-top w3layouts-banner-top12345">
                                    <div class="container">
                                        <div class="agileits-banner-info">
                                            <span>Video Consultation</span>

                                            {{--<p>Stay organized and check in at your next appointment through our Telemedicine App.</p>--}}

                                        </div>

                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                {{--</div>--}}
        </div>
        <div class="col-md-7 wthree_services_bottom_left">
            <div class="wthree_services_bottom_left_grid">
                <div class="col-md-6 w3_agileits_services_bottom_l_grid">
                    <div class="agile_services_bottom_l_grid1">
                        <img src="{{asset('images/g6.jpg')}}" alt=" " class="img-responsive" />
                        <div class="w3_service_bottom_grid_pos">
                            <h3>Quality Care</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 w3_agileits_services_bottom_r_grid">
                    <h4>Best Physicians</h4>
                    <p>Our platform provides patients access to Best Physicians communications through various healthcare centers.</p>

                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="wthree_services_bottom_left_grid">
                <div class="col-md-6 w3_agileits_services_bottom_r_grid">
                    <h4>Video Consultation</h4>
                    <p>Our platform is designed to video consultation portal that was connect patient and doctor.</p>

                </div>
                <div class="col-md-6 w3_agileits_services_bottom_l_grid">
                    <div class="agile_services_bottom_l_grid1">
                        <img src="{{asset('images/g9.jpg')}}" alt=" " class="img-responsive" />
                        <div class="w3_service_bottom_grid_pos">
                            <h3>Quality Care</h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="clearfix"> </div>
    </div>
    <!-- //services-bottom -->
    <!-- Team -->
    <section id="team" class="pb-5">
        <div class="container">
            <h3 class="w3_heade_tittle_agile">Few Of Our Physicians</h3>
            <p class="sub_t_agileits">Meet Our Amazing Team of Phasicians</p>
            <div class="row">
                <!-- Team member -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img class=" img-fluid" src="{{asset('images/index_team2.png')}}" alt="card image"></p>
                                        <h4 class="card-title">Dr. Annabella Edlin</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="backside">
                                <div class="card">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title">Dr. Annabella Edlin/h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Team member -->
                <!-- Team member -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img class=" img-fluid" src="{{asset('images/index_team1.png')}}" alt="card image"></p>
                                        <h4 class="card-title">Dr. Jade Urps</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="backside">
                                <div class="card">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title">Dr. Jade Urps</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Team member -->
                <!-- Team member -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img class=" img-fluid" src="{{asset('images/index_team3.png')}}" alt="card image"></p>
                                        <h4 class="card-title">Dr. Eric Martt</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="backside">
                                <div class="card">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title">Dr. Eric Martt</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Team member -->
                <!-- Team member -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img class=" img-fluid" src="{{asset('images/index_team5.png')}}" alt="card image"></p>
                                        <h4 class="card-title">Dr. Ann Anreozzi</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="backside">
                                <div class="card">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title">Dr. Ann Anreozzi</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Team member -->
                <!-- Team member -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img class=" img-fluid" src="https://sunlimetech.com/portfolio/boot4menu/assets/imgs/team/img_02.png" alt="card image"></p>
                                        <h4 class="card-title">Dr. Edith Kiesz</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="backside">
                                <div class="card">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title">Dr. Edith Kiesz</h4>
                                        <p class="card-text"> Profile Details have been hidden for now to ensure confidentiality ! </p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Team member -->
                <!-- Team member -->
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                        <div class="mainflip">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img class=" img-fluid" src="{{asset('images/index_team4.png')}}" alt="card image"></p>
                                        <h4 class="card-title">Dr. Jeffrey Poynor</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="backside">
                                <div class="card">
                                    <div class="card-body text-center mt-4">
                                        <h4 class="card-title">Dr. Jeffrey Poynor</h4>
                                        <p class="card-text">Profile Details have been hidden for now to ensure confidentiality !</p>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="social-icon text-xs-center" target="_blank" href="#">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./Team member -->

            </div>
        </div>
    </section>
    <!-- Team -->
    <!-- stats -->
    <div class="stats_inner jarallax" id="stats">
        <div class="container">
            <div class="inner_w3l_agile_grids">
                <div class="col-md-3 w3layouts_stats_left w3_counter_grid">
                    <i class="fa fa-user-md" aria-hidden="true"></i>
                    <p class="counter">120</p>
                    <h3>Physicians</h3>
                </div>
                <div class="col-md-3 w3layouts_stats_left w3_counter_grid1">
                    <i class="fa fa-stethoscope" aria-hidden="true"></i>
                    <p class="counter">165</p>
                    <h3>Assistants</h3>
                </div>
                <div class="col-md-3 w3layouts_stats_left w3_counter_grid2">
                    <i class="fa fa-wheelchair" aria-hidden="true"></i>
                    <p class="counter">563</p>
                    <h3>Patients</h3>
                </div>
                <div class="col-md-3 w3layouts_stats_left w3_counter_grid3">
                    <i class="fa fa-heartbeat" aria-hidden="true"></i>
                    <p class="counter">245</p>
                    <h3>Saved hearts</h3>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //stats -->
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <script>$('#moble_nav_item_2').addClass('menu__item--current');</script>	<!-- Custom Css -->

    @endsection