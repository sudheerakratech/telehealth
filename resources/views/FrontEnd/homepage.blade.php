@extends('FrontEnd.layouts.master')
@section('content')
    <title>Telemedicine | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- banner -->
    <div class="banner-silder">
        <div id="JiSlider" class="jislider">
            <ul>
                <li>
                    <div class="w3layouts-banner-top">

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
                    <div class="w3layouts-banner-top w3layouts-banner-top1">
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
                    <div class="w3layouts-banner-top w3layouts-banner-top2">
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
    <!-- //banner -->
    <!-- about -->
    <div class="about" id="about">
        <div class="container">
            <h2 class="w3_heade_tittle_agile">Welcome to Akra Health</h2>
            <p class="sub_t_agileits">Impacting lives through technology</p>

            <p class="ab" style="text-align: justify">
                AKRA HEALTH provides Telehealth portal services connecting patients to specialized physicians , nurses , medical experts through “ON DEMAND” online video consultation anytime anywhere.
                {{--<br>--}}
                Our patient-centered solution approach ensures data privacy protection over cloud to ensure Patient have control of their health medical records and information is based on digital consent standards, blockchain identity, and blockchain audit. This enables each patient to own and completely control their health records within a secure environment and enable communication across various healthcare providers, pharmacies, Medical Associations, Clinics and other healthcare  institutions seamlessly.

            </p>

            <div class="about-w3lsrow">

                <div class="col-md-6 w3about-img">
                    <img src="{{asset('images/front/sprott-shaw-college-post-grad-in-nursing-1.jpg')}}" style="height: 450px; width: 520px" alt="">
                </div>
                <div class="col-md-6 col-sm-7 w3about-img two">
                    <div class="w3about-text">
                        <h5 class="w3l-subtitle">We Care About Your Health</h5>
                        <ul style="text-align: justify; font-size: 17px;">
                        <li> - Maintain Patient and Related Family Members Health Information.</li>
                        <li> - Allow Users to Create Profiles for as many family members as needed.</li>
                        <li> - Keep your medical history in one place, under your control.</li>
                        <li> - Provide or Remove access to your medical history to medical providers of your choice.</li>
                        <li> - Ensure accuracy of information communicated by patients.</li>
                        <li> - Keep track of prescription information for yourself and family members.</li>
                        <li> - Ensure vital allergy and other health conditions are known your new physician.</li>
                        <li> - Eliminate the need for you to walk down to click for medical consultation.</li>
                        </ul>

                        <div class="read"><a href="{{route('singlepage')}}" class="hvr-rectangle-in">Read More</a></div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- /about-bottom -->
    <!-- /girds_agileits -->
    <div class="Department_girds_agileits">
        <div class="agile_team_grid">
            <div class="col-md-3 w3ls_banner_bottom_grid">
                <img src="{{asset('images/p1.png')}}" alt=" " class="img-responsive" />
                <div class="overlay">
                    <h4><a onclick="document.getElementById('id01').style.display='block'">Patient Profile</a></h4>
                    <!-- Modal -->
                    <div class="w3-container">
                        <div id="id01" class="w3-modal w3-animate-opacity">
                            <div class="w3-modal-content w3-card-4">
                                <header class="w3-container w3-teal">
                                    <span onclick="document.getElementById('id01').style.display='none'"
                                        class="w3-button w3-large w3-display-topright">&times;</span>
                                    <h2>Patient Profile</h2>
                                </header>
                                <div class="w3-container">
                                    <img src="{{asset('images/Patient_Profile.JPG')}}" class="img-responsive">
                                </div>
                                <div class="w3-container">
                                    <p class="ab">
                                        We help maintain and secure individuals’ “Electronic protected health information” through latest technologies.  Individual’s health information is provided “On demand” , any time

                                        Our services help older adults and their families keep track of lengthy and frequently-changing medication lists. Family caregivers will be able to maintain online list of medications,  specific application  of which isn’t available in the market. Elderly patients, find online way to keep track of their relatives  list of complex medications.

                                        Enable patients to take charge of more of their own care, even becoming co-creators of their personal health records. The product would allow assistants to monitor patients from a distance online

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //Modal -->
                </div>
            </div>
            <div class="col-md-3 w3ls_banner_bottom_grid">
                <img src="{{asset('images/p2.jpg')}}" alt=" " class="img-responsive" />
                <div class="overlay">
                    <h4><a onclick="document.getElementById('id02').style.display='block'">Medical Consultancy</a></h4>
                    <!-- Modal -->
                    <div class="w3-container">
                        <div id="id02" class="w3-modal w3-animate-opacity">
                            <div class="w3-modal-content w3-card-4">
                                <header class="w3-container w3-teal">
                                    <span  onclick="document.getElementById('id02').style.display='none'"
                                          class="w3-button w3-large w3-display-topright">&times;</span>
                                    <h2>Medical Consultancy</h2>
                                </header>
                                <div class="w3-container">
                                    <img src="{{asset('images/Medical_Consultancy.JPG')}}" class="img-responsive">
                                </div>
                                <div class="w3-container">
                                    <p class="ab">
                                        We capture the patient health complaints and medical  problems to help Physicians determine the problem / complaint and understand the problem’s significance from the patient’s perspective. Based on the medical problem physicians can flag early signs of trouble and suggest diagnostic and treatment information.

                                        Through active participation of patients physicians can help determine parameters to monitor course and status of problem and suggest appropriate therapy

                                        All vital patient record information such as heart rate, electrocardiography, respiratory rate, skin temperature, activity and posture, is stored and shared with respective physician based on consent wherever they are, ensuring health record information are secure and handled for data streaming
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //Modal -->
                </div>
            </div>
            <div class="col-md-3 w3ls_banner_bottom_grid hvr-shutter-in-horizontal">
                <img src="{{asset('images/p3.jpg')}}" alt=" " class="img-responsive" />
                <div class="overlay">
                    <h4><a onclick="document.getElementById('id03').style.display='block'">Information Workflow</a></h4>
                    <!-- Modal -->
                    <div class="w3-container">
                        <div id="id03" class="w3-modal w3-animate-opacity">
                            <div class="w3-modal-content w3-card-4">
                                <header class="w3-container w3-teal">
                                    <span onclick="document.getElementById('id03').style.display='none'"
                                          class="w3-button w3-large w3-display-topright">&times;</span>
                                    <h2>Information Workflow</h2>
                                </header>
                                <div class="w3-container">
                                    <img src="{{asset('images/Inoformation_Overflow.JPG')}}" class="img-responsive">
                                </div>
                                <div class="w3-container">
                                    <p class="ab">
                                        Doctor-patient communication is maintained on a long term basis through effective coordination involving multiple healthcare stakeholders such as assistants, patient care coordinators to monitor patients with calls and visits, encouraging them to embrace healthy lifestyle regimens, prescriptions and keep physician appointments
                                        Secure online patient forms to help greater convenience, accuracy and office visit for patients improving medical efficiency
                                        We use medical progress notes for Patient’s, without which clinicians may easily fail to recognise trends and correlations in data, lose track of significant test results, fail to consider interactions among multiple problems, or fail to coordinate their activities with other practitioners.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //Modal -->
                </div>
            </div>
            <div class="col-md-3 w3ls_banner_bottom_grid">
                <img src="{{asset('images/p4.jpg')}}" alt=" " class="img-responsive" />
                <div class="overlay">
                    <h4><a onclick="document.getElementById('id04').style.display='block'">Reports & Integration</a></h4>
                    <!-- Modal -->
                    <div class="w3-container">
                        <div id="id04" class="w3-modal w3-animate-opacity">
                            <div class="w3-modal-content w3-card-4">
                                <header class="w3-container w3-teal">
                                    <span onclick="document.getElementById('id04').style.display='none'"
                                          class="w3-button w3-large w3-display-topright">&times;</span>
                                    <h2>Reports & Integration</h2>
                                </header>
                                <div class="w3-container">
                                    <img src="{{asset('images/Reports_Integration.JPG')}}" class="img-responsive">
                                </div>
                                <div class="w3-container">
                                    <p class="ab">
                                        Relying on patient’s memory for their medical history increases the risk of sharing inaccurate or incomplete information with their providers. We help save time and money by easy access of patient reports and complaint records. This increases the quality of care and saves both patients time and money
                                        Our reports ensure your medical history in one place under your control and provide access to your medical history at any time. Thereby increasing accuracy of information communicated by patients while interacting with physicians
                                        Our Portal is aimed to bolster integration with medical regulatory compliance and standards published by the state from time to time and meet the regulatory review and seek regulatory stamp of approval.

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //Modal -->

                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
    <!-- //girds_agileits -->
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
    <!-- //why us -->
    <!-- services section -->
    <div class="service-w3l jarallax" id="service">
        <div class="container">
            <h3 class="w3_heade_tittle_agile two">What We Do Best</h3>
            <p class="sub_t_agileits"></p>
            <div class="col-lg-4 col-md-4 col-sm-12 serv-agileinfo1">
                <div class="col-lg-12 col-md-12 col-sm-6 serv-wthree1" data-aos="zoom-in">
                    <ul class="ch-grid">
                        <li>
                            <div class="ch-item">
                                <div class="ch-info">
                                    <div class="ch-info-front ch-img-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                    <div class="ch-info-back">
                                        <h5>Pediatric features</h5>
                                        <p>Best In Services</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h4 class="text-center">Pediatric features</h4>
                    <p class="text-center">
                        Growth charts , Immunization tracking, Well child check documentation, Vaccine information Sheet printouts.
                    </p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 serv-wthree2" data-aos="zoom-in">
                    <ul class="ch-grid">
                        <li>
                            <div class="ch-item">
                                <div class="ch-info">
                                    <div class="ch-info-front ch-img-2"><i class="fa fa-user-md" aria-hidden="true"></i></div>
                                    <div class="ch-info-back">
                                        <h5>Easy Appointments</h5>
                                        <p>Best In Services</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h4 class="text-center">Easy Appointments</h4>
                    <p class="text-center">
                        Schedule appointments online with the provider & Automatic appointment reminders via email or SMS
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 serv-agileinfo2">
                <div class="col-lg-12 col-md-12 col-sm-6 serv-wthree4" data-aos="zoom-in">
                    <ul class="ch-grid">
                        <li>
                            <div class="ch-item">
                                <div class="ch-info">
                                    <div class="ch-info-front ch-img-3"><i class="fa fa-ambulance" aria-hidden="true"></i></div>
                                    <div class="ch-info-back">
                                        <h5>Patient Charts</h5>
                                        <p>Best In Services</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h4 class="text-center">Patient Charts</h4>
                    <p class="text-center">
                        Features List of Active issues , Medication, Supplements,
                        Allergies , Encounters etc
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 serv-agileinfo3">
                <div class="col-lg-12 col-md-12 col-sm-6 serv-wthree6" data-aos="zoom-in">
                    <ul class="ch-grid">
                        <li>
                            <div class="ch-item">
                                <div class="ch-info">
                                    <div class="ch-info-front ch-img-4"><i class="fa fa-tint" aria-hidden="true"></i></div>
                                    <div class="ch-info-back">
                                        <h5>Forms & Reports</h5>
                                        <p>Best In Services</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h4 class="text-center">Forms & Reports</h4>
                    <p class="text-center">
                        Personalized electronic patient forms , automated task reminder and alert system
                    </p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 serv-wthree5" data-aos="zoom-in">
                    <ul class="ch-grid">
                        <li>
                            <div class="ch-item">
                                <div class="ch-info">
                                    <div class="ch-info-front ch-img-5"><i class="fa fa-wheelchair" aria-hidden="true"></i></div>
                                    <div class="ch-info-back">
                                        <h5>Documentation</h5>
                                        <p>Best In Services</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h4 class="text-center">Documentation
                    </h4>
                    <p class="text-center">
                        Health supplements & Vaccine documentation and inventory tracking, create tags for encounters and messages
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- /services section -->
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
    <!-- services-bottom -->
    <div class="services-bottom">
        <div class="col-md-5 wthree_services_bottom_right">
            <section class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="w3_agile_services_bottom_right_grid">
                                <p class="w3layouts_head_slide">Primary Health Care <span>Center</span></p>
                            </div>
                        </li>
                        <li>
                            <div class="w3_agile_services_bottom_right_grid1">
                                <p class="w3layouts_head_slide">General Medicine  <span> Departments</span></p>
                            </div>
                        </li>
                        <li>
                            <div class="w3_agile_services_bottom_right_grid2">
                                <p class="w3layouts_head_slide">Family Care<span>Center</span></p>
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
                    <p style="text-align: justify; font-size: 11px;">Our platform provides patients access to their health medical records and forms and enable communication through various healthcare providers, pharmacies, medical associations, clinics and other healthcare institutions, ensuring an efficient modern medical practice.</p>

                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="wthree_services_bottom_left_grid">
                <div class="col-md-6 w3_agileits_services_bottom_r_grid">
                    <h4>Enabling “Extenders”</h4>
                    <p style="text-align: justify; font-size: 11px;">Our platform is designed to allow nurses, medical practitioners etc. to do more in the field of healthcare, as we see scope for these so-called “extenders” to expand. As clinicians could offset shortages of physicians our portal is designed to facilitate all caregivers thereby enabling “extenders” to help in healthcare services.</p>

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
    <script>$('#m_nav_item_1').addClass('menu__item--current');</script>	<!-- Custom Css -->
    @endsection







