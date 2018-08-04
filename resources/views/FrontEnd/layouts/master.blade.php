<!DOCTYPE html><html lang="en"><head>    <!-- for-meta-tags-->    <meta name="viewport" content="width=device-width, initial-scale=1">    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    <meta name="keywords" content="Health Plus Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,Smartphone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);        function hideURLbar(){ window.scrollTo(0,1); } </script>    <!-- //for-meta-tags-->    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen" Department="" />    <link href="{{asset('css/services.css')}}" rel="stylesheet" type="text/css" media="all" />    <link href="{{asset('css/ziehharmonika.css')}}" rel="stylesheet" type="text/css">    <link href="{{asset('css/JiSlider.css')}}" rel="stylesheet">    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />    <link href="{{asset('css/subscribe.css')}}" rel="stylesheet" type="text/css" media="all" />    <!-- font-awesome icons -->    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">    <!-- //font-awesome icons -->    <link href="//fonts.googleapis.com/css?family=Raleway:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">    <link href="//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet"></head><body>@include('FrontEnd.includes.header')@yield('content')@include('FrontEnd.includes.footer')<!-- Appointment --><div class="modal" id="appointment" tabindex="-1" role="dialog" aria-hidden="true">    <div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal">&times;</button>                <h4>Request For Appointment</h4>            </div>            <div class="modal-body">                <div class="row">                    <div class="col-sm-6 col-xs-12 m-t-40">                        <fieldset class="form_shadow">                            <form action="" method="POST" class="patient_register">                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />                                    <div class="form-group aboutus_select consult_dept">                                    <select class="form-control" style="width: 100%; height: 45px" name="services" required>                                        <option selected="" value="" disabled="">Choose Department</option>                                        <option value="Doctor">Doctor</option>                                        <option value="Pharmacy">Pharmacy</option>                                        <option value="Hospital">Hospital</option>                                        <option value="Patholgy">Pathology</option>                                        <option value="Radiology">Radiology</option>                                    </select>                                </div>                                <div class="form-group">                                    <label>First Name</label>                                    <br/>                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" required>                                </div>                                <div class="form-group">                                    <label>Last Name</label>                                    <br/>                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name">                                </div>                                <div class="form-group">                                    <label>Phone Number</label>                                    <br/>                                    <input type="number" class="form-control" name="contact_no" placeholder="Phone Number" required>                                </div>                                <div class="form-group">                                    <label>Email Address</label>                                    <br/>                                    <input type="email" class="form-control" name="user_email" placeholder="Email Address" required>                                </div>                                <div class="form-group">                                    <div class="row">                                        <div class="col-md-6 col-xs-12">                                            <label>Date</label>                                            <br/>                                            <div class='input-group date datetimepicker_single datetimepicker_res'>                                                <input type='date' class="form-control" placeholder="MM/DD/YYYY" name="user_date" required>                                                <span class="input-group-addon">                                                    {{--<span class="glyphicon glyphicon-calendar"></span>--}}                                                </span>                                            </div>                                        </div>                                        <div class="clearfix visible-xs-block"></div>                                        <div class='col-md-6 col-xs-12'>                                            <label>Time</label>                                            <div class='input-group date datetimepicker_single2 datetimepicker_res'>                                                <input type='time' class="form-control" placeholder="HH:MM:AM" name="user_time" required>                                                <span class="input-group-addon">                                                    <span class="glyphicon glyphicon-time"></span>                                                </span>                                            </div>                                        </div>                                    </div>                                </div>                                <div class="text-center m-t-20">                                    <button type="submit" class="btn btn-primary">Submit</button>                                </div>                            </form>                        </fieldset>                    </div>                    <div class="col-sm-6 col-xs-12 m-t-20">                        <img src="{{url('images/front/health-mobile-phone.jpg')}}" width="400px" style="padding-top: 15px;" class="img-responsive" alt="Image missing"/>                    </div>                </div>            </div>        </div>    </div></div><!-- End of Appointment --><a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a><!-- js --><script src="{{asset('js/jquery-2.2.3.min.js')}}"></script><script src="{{asset('js/JiSlider.js')}}"></script><script>    $(window).load(function () {        $('#JiSlider').JiSlider({color: '#fff', start: 3, reverse: true}).addClass('ff')    })</script>{{--<script type="text/javascript">--}}    {{--var _gaq = _gaq || [];--}}    {{--_gaq.push(['_setAccount', 'UA-36251023-1']);--}}    {{--_gaq.push(['_setDomainName', 'jqueryscript.net']);--}}    {{--_gaq.push(['_trackPageview']);--}}    {{--(function() {--}}        {{--var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;--}}        {{--ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';--}}        {{--var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);--}}    {{--})();--}}{{--</script>--}}<script src="{{asset('js/ziehharmonika.js')}}"></script><script>    $(document).ready(function() {        $('.ziehharmonika').ziehharmonika({            collapsible: true,            prefix: ''        });    });</script><!-- stats --><script src="{{asset('js/jquery.waypoints.min.js')}}"></script><script src="{{asset('js/jquery.countup.js')}}"></script><script>    $('.counter').countUp();</script><!-- //stats --><script type="text/javascript">    $(function(){        $("#bars li .bar").each(function(key, bar){            var percentage = $(this).data('percentage');            $(this).animate({                'height':percentage+'%'            }, 1000);        })    })</script><!-- Gallery-Tab-JavaScript --><script src="{{asset('js/cbpFWTabs.js')}}"></script><script>    (function() {        [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {            new CBPFWTabs( el );        });    })();</script><!-- //Gallery-Tab-JavaScript --><!-- Swipe-Box-JavaScript --><script src="{{asset('js/jquery.swipebox.min.js')}}"></script><script type="text/javascript">    jQuery(function($) {        $(".swipebox").swipebox();    });</script><!-- //Swipe-Box-JavaScript --><!-- bootstrap-pop-up --><div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">    <div class="modal-dialog" role="document">        <div class="modal-content">            <div class="modal-header">                Health Plus                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>            </div>            <section>                <div class="modal-body">                    <img src="images/g9.jpg" alt=" " class="img-responsive" />                    <p>Ut enim ad minima veniam, quis nostrum                        exercitationem ullam corporis suscipit laboriosam,                        nisi ut aliquid ex ea commodi consequatur? Quis autem                        vel eum iure reprehenderit qui in ea voluptate velit                        esse quam nihil molestiae consequatur, vel illum qui                        dolorem eum fugiat quo voluptas nulla pariatur.                        <i>" Quis autem vel eum iure reprehenderit qui in ea voluptate velit                            esse quam nihil molestiae consequatur.</i></p>                </div>            </section>        </div>    </div></div><!-- //bootstrap-pop-up --><!-- flexSlider --><script defer src="{{asset('js/jquery.flexslider.js')}}"></script><script type="text/javascript">    $(window).load(function(){        $('.flexslider').flexslider({            animation: "slide",            start: function(slider){                $('body').removeClass('loading');            }        });    });</script><!-- //flexSlider --><!-- start-smoth-scrolling --><script type="text/javascript" src="{{asset('js/move-top.js')}}"></script><script type="text/javascript" src="{{asset('js/easing.js')}}"></script><script type="text/javascript">    jQuery(document).ready(function($) {        $(".scroll").click(function(event){            event.preventDefault();            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);        });    });</script><!-- start-smoth-scrolling --><script src="{{asset('js/jarallax.js')}}"></script><script src="{{asset('js/SmoothScroll.min.js')}}"></script><script type="text/javascript">    /* init Jarallax */    $('.jarallax').jarallax({        speed: 0.5,        imgWidth: 1366,        imgHeight: 768    })</script><script src="{{asset('js/bootstrap.js')}}"></script><!-- //for bootstrap working --><!-- here stars scrolling icon --><script type="text/javascript">    $(document).ready(function() {        /*            var defaults = {            containerID: 'toTop', // fading element id            containerHoverID: 'toTopHover', // fading element hover id            scrollSpeed: 1200,            easingType: 'linear'            };        */        $().UItoTop({ easingType: 'easeOutQuart' });    });</script><!-- //here ends scrolling icon --></body><!--Start of Tawk.to Script--><script type="text/javascript">    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();    (function(){        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];        s1.async=true;        s1.src='https://embed.tawk.to/5af43a26227d3d7edc252091/default';        s1.charset='UTF-8';        s1.setAttribute('crossorigin','*');        s0.parentNode.insertBefore(s1,s0);    })();</script><!--End of Tawk.to Script--></html>