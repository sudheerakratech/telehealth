@extends('FrontEnd.layouts.master')
@section('content')
    <title>Telemedicine | Doctors</title>
    <!-- banner -->
    <!-- banner1 -->
    <div class="banner1 jarallax">
        <div class="container">
        </div>
    </div>
    <div class="services-breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('homepage')}}">Home</a><i>|</i></li>
                <li>Physicians</li>
            </ul>
        </div>
    </div>
    <!-- //banner1 -->
    <!-- Portfolio -->
    <div class="portfolio" id="specials">
        <div class="container">
            <h2 class="w3_heade_tittle_agile">Our Departments</h2>
            <p class="sub_t_agileits">Quality Care...</p>

            <div class="tabs tabs-style-bar">
                <nav>
                    <ul>
                        <li><a href="#section-bar-1" class="icon icon-box"><span>General Practitioner</span></a></li>
                        <li><a href="#section-bar-2" class="icon icon-display"><span>Pediatrics</span></a></li>
                        <li><a href="#section-bar-3" class="icon icon-upload"><span>Family Physician</span></a></li>
                    </ul>
                </nav>

                <div class="content-wrap">

                    <!-- Tab-1 -->
                    <section id="section-bar-1" class="agileits w3layouts">
                        <div class="gallery-grids">
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g1.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g1.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g2.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g2.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g3.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g3.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g4.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g4.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g5.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g5.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g6.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g6.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </section>
                    <!-- //Tab-1 -->

                    <!-- Tab-2 -->
                    <section id="section-bar-2" class="agileits w3layouts">
                        <div class="gallery-grids">
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g7.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g7.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g3.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g3.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g2.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g2.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g3.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g3.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g5.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g5.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g6.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g6.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </section>
                    <!-- //Tab-2 -->

                    <!-- Tab-3 -->
                    <section id="section-bar-3" class="agileits w3layouts">
                        <div class="gallery-grids">
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g7.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g7.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g3.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g3.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-4 gallery-top">
                                <a href="{{asset('images/g9.jpg')}}" class="swipebox">
                                    <figure class="effect-apollo">
                                        <img src="{{asset('images/g9.jpg')}}" alt="Health Plus" class="img-responsive">
                                        <figcaption></figcaption>
                                    </figure>
                                </a>
                            </div>




                            <div class="clearfix"></div>
                        </div>
                    </section>
                    <!-- //Tab-3 -->

                </div><!-- //Content -->
            </div><!-- //Tabs -->

        </div>
    </div>
    <!-- //Portfolio -->
    <!-- Start Doctor List Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-r-30">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar fa fa-filter text-primary">&nbsp;Filter</span>
                </button>
            </div>
        </div>
        <div class="row m-t-60">
            <div class="col-md-3 col-sm-4 m-t-10" id="location1">
                <form action="#">
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <div class="newsticker_border p-d-25">
                                <h5 class="m-t-30 text-primary" style="text-align: center;">Filter Results</h5>
                                <div class="form-group doctors">
                                    <label>Category</label>
                                    <select class="form-control select2 dept_select2" style="width: 100%">
                                        <option selected="" value="" disabled="">Choose</option>
                                        <option>Family Physician</option>
                                        <option>General Practitioner</option>
                                        <option>Pediatrics</option>
                                        <option>Primary Care</option>
                                     </select>
                                </div>
                                <div class="form-group doctors">
                                    <label>Location</label>
                                    <select class="form-control select2 dept_select2" style="width: 100%">
                                        <option selected="" value="" disabled="">Choose</option>
                                        <option>India</option>
                                        <option>United States</option>
                                        <option>United Kingdom</option>
                                        <option>Australia</option>
                                        <option>New Zealand</option>
                                        <option>Ireland</option>
                                        <option>UAE</option>
                                        <option>Canada</option>
                                        <option>France</option>
                                        <option>Germany</option>
                                    </select>
                                </div>

                                <div class="text-center m-t-20">
                                    <button class="btn btn-primary m-b-20">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-md-9 col-sm-8">
                <div class="row m-t-30">
                    <div class="col-md-7 col-md-offset-1 col-sm-7 doctors">
                        <div class="row">
                            <div class="col-md-12 m-r-30">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location2" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar fa fa-info text-primary">&nbsp;MORE DETAILS</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-3 m-t-20">
                                <img src="{{asset('images/index_team2.png')}}" alt="loading" class="img-responsive img-circle img_border">
                            </div>
                            <div class="col-md-9 col-xs-9"><h4>Dr. Annabella Edlin</h4>
                                <p>General Pracitioner </p>
                                <p class="small m-t-n15">12 years Experience</p>

                                <div class="row doctors_links">
                                    <ul>
                                        <li>General Medicine</li>
                                        <!--<li>Internal Medicine</li>-->
                                        <li>Family Medicine</li>
                                        <li><a href="#">Veiw All Services</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-t-20 col-sm-5  doc_feedback collapse navbar-collapse" id="location2">
                        <ul class="m-t-10">
                            <li>
                                <i class="fa font20 fa-commenting m-b-15 m-r-15 text-primary"></i><span class="font15">Feedback 94</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-home m-b-15 m-r-15 text-primary"></i><span class="font15">Australia	</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i><span class=" font15">$ 18</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-clock-o m-b-15 m-r-15 text-primary"></i><span class="font15">MON - SAT</span>
                                <p class="m-l-30 small m-t-n15">11:00 AM - 10:00 PM</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center m-b-10">
                        <a href="{{route('appointment')}}" class="btn btn-primary m-t-20">Make An Appointment</a>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-7 col-md-offset-1 col-sm-7 doctors">
                        <div class="row">
                            <div class="col-md-12 m-r-30">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location3" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar fa fa-info text-primary">&nbsp;MORE DETAILS</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-3 m-t-20">
                                <img src="{{asset('images/index_team1.png')}}" alt="loading" class="img-responsive img-circle img_border">
                            </div>

                            <div class="col-md-9 col-xs-9"><h4>Dr. Jade Urps</h4>
                                <p>Family Physician</p>
                                <p class="small m-t-n15">9 years Experience</p>
                                <div class="row doctors_links">
                                    <ul>
                                        <li>General Medicine</li>
                                        <li>Internal Medicine</li>
                                        <!--<li>Cosmetic Dentestry</li>-->
                                        <li><a href="#">Veiw All Services</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-t-20 col-sm-5 doc_feedback collapse navbar-collapse" id="location3">
                        <ul class="m-t-10">
                            <li>
                                <i class="fa font20 fa-commenting m-b-15 m-r-15 text-primary"></i><span class="font15">Feedback 45</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-home m-b-15 m-r-15 text-primary"></i><span class="font15">United States</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i><span class=" font15">$ 15</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-clock-o m-b-15 m-r-15 text-primary"></i><span class="font15">MON - SAT </span>
                                <p class="m-l-30 small m-t-n5">12:00 AM - 11:00 PM</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center m-b-10">
                        <a href="{{route('appointment')}}" class="btn btn-primary m-t-20">Make An Appointment</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-7 col-md-offset-1 col-sm-7 doctors">
                        <div class="row">
                            <div class="col-md-12 m-r-30">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location4" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar fa fa-info text-primary">&nbsp;MORE DETAILS</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-3 m-t-20">
                                <img src="{{asset('images/index_team3.png')}}" alt="loading" class="img-responsive img-circle img_border">
                            </div>

                            <div class="col-md-9 col-xs-9"><h4>Dr. Eric Martt</h4>
                                <p>General Practitioner </p>
                                <p class="small m-t-n15">5 years Experience</p>
                                <div class="row doctors_links">
                                    <ul>
                                        <!--<li>Zerconia Crown</li>-->
                                        <li>Primary Care</li>
                                        <li>General Practice cancer</li>
                                        <li><a href="#">Veiw All Services</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-t-20 col-sm-5 doc_feedback collapse navbar-collapse" id="location4">
                        <ul class="m-t-10">
                            <li>
                                <i class="fa font20 fa-commenting m-b-15 m-r-15 text-primary"></i><span class="font15">Feedback 85</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-home m-b-15 m-r-15 text-primary"></i><span class="font15">Canada</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i><span class=" font15">$ 20</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-clock-o m-b-15 m-r-15 text-primary"></i><span class="font15">MON - SAT</span>
                                <p class="m-l-30 small m-t-n5">10:00 AM - 6:00 PM</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center m-b-10">
                        <a href="{{route('appointment')}}" class="btn btn-primary m-t-20">Make An Appointment</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-7 col-md-offset-1 col-sm-7 doctors">
                        <div class="row">
                            <div class="col-md-12 m-r-30">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location5" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar fa fa-info text-primary">&nbsp;MORE DETAILS</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-3 m-t-20">
                                <img src="{{asset('images/index_team5.png')}}" alt="loading" class="img-responsive img-circle img_border">
                            </div>

                            <div class="col-md-9 col-xs-9"><h4>Dr. Ann Anreozzi</h4>
                                <p>Pediatrics</p>
                                <p class="small m-t-n15">17 years Experience</p>
                                <div class="row doctors_links">
                                    <ul>
                                        <li>Pediatrics</li>
                                        <li>Pediatric Surgery</li>
                                        <li><a href="#">Veiw All Services</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-t-20 col-sm-5 doc_feedback collapse navbar-collapse" id="location5">
                        <ul class="m-t-10">
                            <li>
                                <i class="fa font20 fa-commenting m-b-15 m-r-15 text-primary"></i><span class="font15">Feedback 96</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-home m-b-15 m-r-15 text-primary"></i><span class="font15">United States</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i><span class=" font15">$ 13</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-clock-o m-b-15 m-r-15 text-primary"></i><span class="font15">MON - SAT</span>
                                <p class="m-l-30 small m-t-n5">10:00 AM - 8:00 PM</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center m-b-10">
                        <a href="{{route('appointment')}}" class="btn btn-primary m-t-20">Make An Appointment</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-7 col-md-offset-1 col-sm-7 doctors">
                        <div class="row">
                            <div class="col-md-12 m-r-30">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location6" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar fa fa-info text-primary">&nbsp;MORE DETAILS</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-3 m-t-20">
                                <img src="https://sunlimetech.com/portfolio/boot4menu/assets/imgs/team/img_02.png" alt="loading" class="img-responsive img-circle img_border">
                            </div>

                            <div class="col-md-9 col-xs-9"><h4>Dr. Edith Kiesz</h4>
                                <p>Family Physician</p>
                                <p class="small m-t-n15">9 years Experience</p>
                                <div class="row doctors_links">
                                    <ul>
                                        <li>Primary Care</li>
                                        <!--<li>Dental Implant</li>-->
                                        <li>General Surgery</li>
                                        <li><a href="#">Veiw All Services</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-t-20 col-sm-5 doc_feedback collapse navbar-collapse" id="location6">
                        <ul class="m-t-10">
                            <li>
                                <i class="fa font20 fa-commenting m-b-15 m-r-15 text-primary"></i><span class="font15">Feedback 78</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-home m-b-15 m-r-15 text-primary"></i><span class="font15">United States</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i><span class=" font15">$ 14</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-clock-o m-b-15 m-r-15 text-primary"></i><span class="font15">MON - SAT </span>
                                <p class="m-l-30 small m-t-n5">9:00 AM - 7:00 PM</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center m-b-10">
                        <a href="{{route('appointment')}}" class="btn btn-primary m-t-20">Make An Appointment</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-7 col-md-offset-1 col-sm-7 doctors">
                        <div class="row">
                            <div class="col-md-12 m-r-30">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location7" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar fa fa-info text-primary">&nbsp;MORE DETAILS</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-xs-3 m-t-20">
                                <img src="{{asset('images/index_team4.png')}}" alt="loading" class="img-responsive img-circle img_border">
                            </div>

                            <div class="col-md-9 col-xs-9"><h4>Dr. Jeffrey Poynor</h4>
                                <p>General Practitioner</p>
                                <p class="small m-t-n15">13 years Experience</p>
                                <div class="row doctors_links">
                                    <ul>
                                        <li>Internal Medicine</li>
                                        <li>General Practice & Dietetic</li>
                                        <li><a href="#">Veiw All Services</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-t-20 col-sm-5 doc_feedback collapse navbar-collapse" id="location7">
                        <ul class="m-t-10">
                            <li>
                                <i class="fa font20 fa-commenting m-b-15 m-r-15 text-primary"></i><span class="font15">Feedback 96</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-home m-b-15 m-r-15 text-primary"></i><span class="font15">United Kingdom</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i><span class=" font15">$ 16</span>
                            </li>
                            <li>
                                <i class="fa font20 fa-clock-o m-b-15 m-r-15 text-primary"></i><span class="font15">MON - SAT</span>
                                <p class="m-l-30 small m-t-n5">10:00 AM - 9:00 PM</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center m-b-10">
                        <a href="{{route('appointment')}}" class="btn btn-primary m-t-20">Make An Appointment</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-left">
                            <a href="#" class="text-primary">
                                <i class="fa fa-long-arrow-left"></i>
                                <span class="m-l-10"> Previous </span>
                            </a>
                        </div>
                        <div class="text-right m-t-n25">
                            <a href="#" class="text-primary">
                                <span class="m-r-7"> Next</span>
                                <i class="fa fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Doctor List Section -->
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <script>$('#moble_nav_item_5').addClass('menu__item--current');</script>	<!-- Custom Css -->
    @endsection