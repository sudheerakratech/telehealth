<!DOCTYPE html><html lang="en"><head>    <!-- for-meta-tags-->    <meta name="viewport" content="width=device-width, initial-scale=1">    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    <meta name="keywords" content="Health Plus Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,Smartphone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);        function hideURLbar(){ window.scrollTo(0,1); } </script>    <!-- //for-meta-tags-->    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen" Department="" />    <link href="{{asset('css/services.css')}}" rel="stylesheet" type="text/css" media="all" />    <link href="{{asset('css/ziehharmonika.css')}}" rel="stylesheet" type="text/css">    <link href="{{asset('css/JiSlider.css')}}" rel="stylesheet">    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />    <link href="{{asset('css/subscribe.css')}}" rel="stylesheet" type="text/css" media="all" />    <!-- font-awesome icons -->    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">    <!-- //font-awesome icons -->    <link href="//fonts.googleapis.com/css?family=Raleway:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">    <link href="//fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet"></head><body>@include('FrontEnd.includes.header')@yield('content')@include('FrontEnd.includes.footer')<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a><!-- js --><script src="{{asset('js/jquery-2.2.3.min.js')}}"></script><script src="{{asset('js/JiSlider.js')}}"></script><script>    $(window).load(function () {        $('#JiSlider').JiSlider({color: '#fff', start: 3, reverse: true}).addClass('ff')    })</script><script type="text/javascript">    var _gaq = _gaq || [];    _gaq.push(['_setAccount', 'UA-36251023-1']);    _gaq.push(['_setDomainName', 'jqueryscript.net']);    _gaq.push(['_trackPageview']);    (function() {        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);    })();</script><script src="{{asset('js/ziehharmonika.js')}}"></script><script>    $(document).ready(function() {        $('.ziehharmonika').ziehharmonika({            collapsible: true,            prefix: ''        });    });</script><!-- stats --><script src="{{asset('js/jquery.waypoints.min.js')}}"></script><script src="{{asset('js/jquery.countup.js')}}"></script><script>    $('.counter').countUp();</script><!-- //stats --><script type="text/javascript">    $(function(){        $("#bars li .bar").each(function(key, bar){            var percentage = $(this).data('percentage');            $(this).animate({                'height':percentage+'%'            }, 1000);        })    })</script><!-- Gallery-Tab-JavaScript --><script src="{{asset('js/cbpFWTabs.js')}}"></script><script>    (function() {        [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {            new CBPFWTabs( el );        });    })();</script><!-- //Gallery-Tab-JavaScript --><!-- Swipe-Box-JavaScript --><script src="{{asset('js/jquery.swipebox.min.js')}}"></script><script type="text/javascript">    jQuery(function($) {        $(".swipebox").swipebox();    });</script><!-- //Swipe-Box-JavaScript --><!-- bootstrap-pop-up --><div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">    <div class="modal-dialog" role="document">        <div class="modal-content">            <div class="modal-header">                Health Plus                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>            </div>            <section>                <div class="modal-body">                    <img src="images/g9.jpg" alt=" " class="img-responsive" />                    <p>Ut enim ad minima veniam, quis nostrum                        exercitationem ullam corporis suscipit laboriosam,                        nisi ut aliquid ex ea commodi consequatur? Quis autem                        vel eum iure reprehenderit qui in ea voluptate velit                        esse quam nihil molestiae consequatur, vel illum qui                        dolorem eum fugiat quo voluptas nulla pariatur.                        <i>" Quis autem vel eum iure reprehenderit qui in ea voluptate velit                            esse quam nihil molestiae consequatur.</i></p>                </div>            </section>        </div>    </div></div><!-- //bootstrap-pop-up --><!-- flexSlider --><script defer src="{{asset('js/jquery.flexslider.js')}}"></script><script type="text/javascript">    $(window).load(function(){        $('.flexslider').flexslider({            animation: "slide",            start: function(slider){                $('body').removeClass('loading');            }        });    });</script><!-- //flexSlider --><!-- start-smoth-scrolling --><script type="text/javascript" src="{{asset('js/move-top.js')}}"></script><script type="text/javascript" src="{{asset('js/easing.js')}}"></script><script type="text/javascript">    jQuery(document).ready(function($) {        $(".scroll").click(function(event){            event.preventDefault();            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);        });    });</script><!-- start-smoth-scrolling --><script src="{{asset('js/jarallax.js')}}"></script><script src="{{asset('js/SmoothScroll.min.js')}}"></script><script type="text/javascript">    /* init Jarallax */    $('.jarallax').jarallax({        speed: 0.5,        imgWidth: 1366,        imgHeight: 768    })</script><script src="{{asset('js/bootstrap.js')}}"></script><!-- //for bootstrap working --><!-- here stars scrolling icon --><script type="text/javascript">    $(document).ready(function() {        /*            var defaults = {            containerID: 'toTop', // fading element id            containerHoverID: 'toTopHover', // fading element hover id            scrollSpeed: 1200,            easingType: 'linear'            };        */        $().UItoTop({ easingType: 'easeOutQuart' });    });</script><!-- //here ends scrolling icon --></body></html>