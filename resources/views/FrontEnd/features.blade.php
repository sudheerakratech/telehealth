@extends('FrontEnd.layouts.master')
@section('content')
    <title>Telemedicine | Features</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}


    <!-- banner -->
     <div class="banner-silder">
        <div id="JiSlider" class="jislider">
            <ul>
                <li>
                    <div class="w3layouts-banner-top w3layouts-banner-top0">

                        <div class="container">
                            <div class="agileits-banner-info">
                                <span>Akra Health</span>
                                <h3>Video Consultation </h3>
                                <p>Our online consulting eliminates the need for you to fill up any paper work.</p>

                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="w3layouts-banner-top features-banner-2">
                        <div class="container">
                            <div class="agileits-banner-info">
                                <span>Akra Health</span>
                                <h3>Information Security </h3>
                                <p>Store all of your medical records in our secure blockchain and access anywhere anytime.</p>

                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="w3layouts-banner-top features-banner-3">
                        <div class="container">
                            <div class="agileits-banner-info">
                                <span>Akra Health</span>
                                <h3>Medical Appointments</h3>
                                <p>Stay organized and check in at your next appointment through our Telemedicine App.</p>

                            </div>

                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <div class="services-breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('homepage')}}">Home</a><i>|</i></li>
                <li>Features</li>
            </ul>
        </div>
    </div>
    <!-- //banner -->
    <!-- why us -->
    <div class="agile_menu" id="menu">
        <div class="container">
            <h3 class="w3_heade_tittle_agile">Why Us</h3>
            <p class="sub_t_agileits">Our customers choose us because we provide leading technology.</p>
            <div class="menu_w3ls_agile_top_section">
                <div class="ziehharmonika">
                    <h3>Impact Lives</h3>
                    <div>
                        <div class="w3_agile_recipe-grid">

                            <div class="col-md-6 col-sm-6 tab-image">
                                <img src="{{asset('images/w1.jpg')}}" alt="Medicinal">
                            </div>
                            <div class="col-md-6 col-sm-6 tab-info">
                                <h4>How we can impact lives?</h4>
                                <p>
                                    Each year thousands of deaths are attributed to people not seeking good medical advice and taking appropriate consultancy on time. Failure to do so results in your treatment not working properly. This is particularly the case for common illnesses, high cholesterol, hypertension, diabetes. When left untreated or undertreated complications can arise decreasing your quality of life and increasing mortality
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <h3>Save Money</h3>
                    <div>
                        <div class="w3_agile_recipe-grid">


                            <div class="col-md-6 col-sm-6 tab-info two">
                                <h4>How we can Save Money?</h4>
                                <p>
                                    Ever talked to a new doctor about what medications you’ve taken in the past, Ever tried to remember the name of a treatment that you thought didn’t work but the new doctor was about to suggest it to you ? Next time have your medication history in your hand and help him by having the correct information about your medication history
                                </p>
                            </div>
                            <div class="col-md-6 col-sm-6 tab-image two">
                                <img src="{{asset('images/w2.jpg')}}" alt="Medicinal">
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <h3>Improve Outcome</h3>
                    <div>
                        <div class="w3_agile_recipe-grid">

                            <div class="col-md-6 col-sm-6 tab-image">
                                <img src="{{asset('images/w3.jpg')}}" alt="Medicinal">
                            </div>
                            <div class="col-md-6 col-sm-6 tab-info">
                                <h4>How we can Improve Outcome?</h4>
                                <p>
                                    Do you sometimes stop taking your medicine when it seems to make you feel worse? Or do you sometimes stop your medicine when you feel better? Maybe you take less or more than you were prescribed. Knowing when to take your prescriptions, taking your meds on time and not skipping doses results in better treatment of your condition, improving your health and quality of life.
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>


                    </div>
                    <h3>Reduce Stress</h3>
                    <div>
                        <div class="w3_agile_recipe-grid">


                            <div class="col-md-6 col-sm-6 tab-info two">
                                <h4>How we can Reduce Stress?</h4>
                                <p>
                                    Starting a new medication regime can be stressful or maybe you have just gone out for the day and worrying about whether you remembered to take your pills before you left the house? Let us take the stress out remembering your medication, giving you peace of mind that you are giving your health. The importance it deserves, we empower you to self-manage your health giving you more time to enjoy life
                                </p>
                            </div>
                            <div class="col-md-6 col-sm-6 tab-image two">
                                <img src="{{asset('images/g2.jpg')}}" alt="Medicinal">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //why us ended -->

    <!-- services-bottom -->
    <div class="services-bottom row">
        <div class="col-md-5 wthree_services_bottom_right">
            <section class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="w3_agile_services_bottom_right_grid">
                                <p class="w3layouts_head_slide">Health Care <span>Center</span></p>
                            </div>
                        </li>
                        <li>
                            <div class="w3_agile_services_bottom_right_grid1">
                                <p class="w3layouts_head_slide">Hospital <span> Departments</span></p>
                            </div>
                        </li>
                        <li>
                            <div class="w3_agile_services_bottom_right_grid2">
                                <p class="w3layouts_head_slide">Health Care <span>Center</span></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <div class="col-md-7 wthree_services_bottom_left">
            <div class="wthree_services_bottom_left_grid">
                <div class="col-md-6 w3_agileits_services_bottom_l_grid">
                    <div class="agile_services_bottom_l_grid1">
                        <img src="{{asset('images/g4.jpg')}}" alt=" " class="img-responsive" />
                        <div class="w3_service_bottom_grid_pos">
                            <h3>Quality Care</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 w3_agileits_services_bottom_r_grid">
                    <h4>Secure Platform</h4>
                    <p style="text-align: justify; font-size: 14px;">Our platform provides patients access to their health medical records and forms and enable communications through various healthcare providers, pharmacies, medical associations, clinics and other healthcare institutions, ensuring an efficient modern medical practice.</p>

                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="wthree_services_bottom_left_grid">
                <div class="col-md-6 w3_agileits_services_bottom_r_grid">
                    <h4>Enabling “Extenders”</h4>
                    <p style="text-align: justify; font-size: 14px;">Our platform is designed to allow nurses, medical practitioners etc. to do more in the field of healthcare, as we see scope for these so-called “extenders” to expand. As clinicians could offset shortages of physicians our portal is designed to facilitate all caregivers thereby enabling “extenders” to help in healthcare services.</p>

                </div>
                <div class="col-md-6 w3_agileits_services_bottom_l_grid">
                    <div class="agile_services_bottom_l_grid1">
                        <img src="{{asset('images/g2.jpg')}}" alt=" " class="img-responsive" />
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
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <script>$('#moble_nav_item_6').addClass('menu__item--current');</script>	<!-- Custom Css -->

    @endsection