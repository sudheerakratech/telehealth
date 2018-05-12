@extends('FrontEnd.layouts.master')@section('content')    <title>Telemedicine | Payment</title>    <section class="index_bg_image" style="padding-top: 50px; padding-bottom: 10px; background-image: url({{url('images/index1_world.jpg')}}); background-attachment: fixed;">        <div class="container">            <div class='row'>                <div class='col-md-4'></div>                <div class='well col-md-4'>                    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>                    <form accept-charset="UTF-8" action="{{route('stripePay')}}" class="require-validation"                          data-cc-on-file="false"                          data-stripe-publishable-key="pk_test_ZYWJzSSc1gfweQtZZbTM6RqD"                          id="payment-form" method="post">                        {{ csrf_field() }}                        <div class='form-row'>                            <div class='col-xs-12 form-group required'>                                <label class='control-label'>Name on Card</label> <input                                        class='form-control' size='4' type='text'>                            </div>                        </div>                        <div class='form-row'>                            <div class='col-xs-12 form-group card required'>                                <label class='control-label'>Card Number</label> <input                                        autocomplete='off' class='form-control card-number' size='20'                                        type='text'>                            </div>                        </div>                        <div class='form-row'>                            <div class='col-xs-4 form-group cvc required'>                                <label class='control-label'>CVC</label> <input                                        autocomplete='off' class='form-control card-cvc'                                        placeholder='ex. 311' size='4' type='text'>                            </div>                            <div class='col-xs-4 form-group expiration required'>                                <label class='control-label'>Exp/Month</label> <input                                        class='form-control card-expiry-month' placeholder='MM' size='2'                                        type='text'>                            </div>                            <div class='col-xs-4 form-group expiration required'>                                <label class='control-label'>Year</label> <input                                        class='form-control card-expiry-year' placeholder='YYYY'                                        size='4' type='text'>                            </div>                        </div>                        <div class='form-row'>                            <div class='col-md-12'>                                <div class='form-control total btn btn-info'>                                    Total: <span class='amount'>$300</span>                                </div>                            </div>                        </div>                        <div class='form-row'>                            <div class='col-md-12 form-group'>                                <button class='form-control btn btn-primary submit-button'                                        type='submit' style="margin-top: 10px;">Pay »</button>                            </div>                        </div>                        <div class='form-row'>                            <div class='col-md-12 error form-group hide'>                                <div class='alert-danger alert'>Please correct the errors and try                                    again.</div>                            </div>                        </div>                    </form>                    @if ((Session::has('success-message')))                        <div class="alert alert-success col-md-12">{{					Session::get('success-message') }}</div>                    @endif @if ((Session::has('fail-message')))                        <div class="alert alert-danger col-md-12">{{					Session::get('fail-message') }}</div>                    @endif                </div>                <div class='col-md-4'></div>            </div>        </div>        <script src="https://code.jquery.com/jquery-1.12.3.min.js"                integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="                crossorigin="anonymous"></script>        <script                src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"                integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"                crossorigin="anonymous"></script>        <script>            $(function() {                $('form.require-validation').bind('submit', function(e) {                    var $form         = $(e.target).closest('form'),                        inputSelector = ['input[type=email]', 'input[type=password]',                            'input[type=text]', 'input[type=file]',                            'textarea'].join(', '),                        $inputs       = $form.find('.required').find(inputSelector),                        $errorMessage = $form.find('div.error'),                        valid         = true;                    $errorMessage.addClass('hide');                    $('.has-error').removeClass('has-error');                    $inputs.each(function(i, el) {                        var $input = $(el);                        if ($input.val() === '') {                            $input.parent().addClass('has-error');                            $errorMessage.removeClass('hide');                            e.preventDefault(); // cancel on first error                        }                    });                });            });            $(function() {                var $form = $("#payment-form");                $form.on('submit', function(e) {                    if (!$form.data('cc-on-file')) {                        e.preventDefault();                        Stripe.setPublishableKey($form.data('stripe-publishable-key'));                        Stripe.createToken({                            number: $('.card-number').val(),                            cvc: $('.card-cvc').val(),                            exp_month: $('.card-expiry-month').val(),                            exp_year: $('.card-expiry-year').val()                        }, stripeResponseHandler);                    }                });                function stripeResponseHandler(status, response) {                    if (response.error) {                        $('.error')                            .removeClass('hide')                            .find('.alert')                            .text(response.error.message);                    } else {                        // token contains id, last4, and card type                        var token = response['id'];                        // insert the token into the form so it gets submitted to the server                        $form.find('input[type=text]').empty();                        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");                        $form.get(0).submit();                    }                }            })        </script>    </section>    <br>    <div class="container" style="border: 1px solid #1995dc">        <div class="price-heading clearfix">            <h1 style="color: #1995dc;"><b>WE ACCEPT THE FOLLOWING PAYMENT METHODS</b></h1>        </div>        <div class="col-md-12">            <img src="{{url('images/payment-cards_1.png')}}" class="img-responsive center-block"/>        </div>    </div>    <br>@endsection