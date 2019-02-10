@extends('FrontEnd.layouts.master')
@section('content')
    <title>Telemedicine | Contact</title>
    <style>
        .contact-grid{
            min-height: 175px;
        }
        @media(max-width:976px){
            min-height: 0px
        }
    </style>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId={APP_ID}";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- banner -->
    <!-- banner1 -->
    <div class="banner1 jarallax contact-us">
        <div class="container">
        </div>
    </div>

    <div class="services-breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('homepage')}}">Home</a><i>|</i></li>
                <li>Contact</li>
            </ul>
        </div>
    </div>
    <!-- //banner1 -->
    <div class="banner-bottom" id="about">
        <div class="container">
            <h2 class="w3_heade_tittle_agile">Contact Us</h2>
            <p class="sub_t_agileits">Get in touch...</p>

            <div class="contact-top-agileits">
                <div class="col-md-6 contact-grid facebook-connect" style="max-height: 175px;overflow: hidden;">
                    <div class="contact-grid1 agileits-w3layouts">
                        <div class="fb-page" 
                        data-href="https://www.facebook.com/akrahealth" 
                        data-tabs="timeline" 
                        data-small-header="false" 
                        data-adapt-container-width="true" 
                        data-hide-cover="false" 
                        data-show-facepile="true"
                        data-width="483px"
                        data-height="100px"
                        >
                        <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/facebook">
                        <a href="https://www.facebook.com/facebook">Facebook</a>
                        </blockquote>
                        </div>
                        </div>
                        {{-- <i class="fa fa-location-arrow"></i>
                        <div class="con-w3l-info">
                            <h4>Facebook Share</h4>
                            <p><a href="">Link for sharing</a></p>
                        </div> --}}
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-6 contact-grid">
                    <div class="contact-grid2 w3">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <div class="con-w3l-info">
                            <h4>Call Us</h4>
                            <p><span>+91 6381 250 184</span></p>
                        </div>
                        <div class="con-w3l-info" style="margin-top: 10px">
                            <h4>Email</h4>
                            <p><a href="mailto:support@akrahealth.com">support@akrahealth.com</a>

                            </p></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="contact-form-aits">
                <form action="#" method="post">
                    <input type="text" class="margin-right" name="Name" placeholder="Name" required="">
                    <input type="email" name="Email" placeholder="Email" required="">
                    <input type="text" class="margin-right" name="Phone Number" placeholder="Phone Number" required="">
                    <input type="text" name="Subject" placeholder="Subject" required="">
                    <textarea name="Message" placeholder="Message" required=""></textarea>
                    <div class="send-button agileits w3layouts">
                        <button class="btn btn-primary">SEND MESSAGE</button>
                    </div>
                </form>
                <ul class="agileits_social_list two">
                    <li class="fallow"> Follow Us :</li>
                    <li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="skype:akra.tech?call" class="agile_twitter"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                </ul>

            </div>
        </div>
    </div>

   {{--  <div class="map_agile">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387142.84010033106!2d-74.25819252532891!3d40.70583163828471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1475140387172" style="border:0"></iframe>


    </div> --}}
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <script>$('#moble_nav_item_7').addClass('menu__item--current');</script>	<!-- Custom Css -->
    @endsection