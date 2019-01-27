@extends('FrontEnd.layouts.master')
@section('content')
    <title>Telemedicine | Appointments</title>
    <!-- banner -->
    <!-- banner1 -->
    <div class="banner1 jarallax physicians-page-banner">
        <div class="container">
        </div>
    </div>
    <div class="services-breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('homepage')}}">Home</a><i>|</i></li>
                <li>Appointments</li>
            </ul>
        </div>
    </div>

    <div class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-r-30">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar fa fa-filter text-primary">&nbsp;Filter</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-4" id="location1">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">Filter Results</h4>
                        </div>
                        <div class="panel-body">

                            <form method="post" id="filter-doctor-frm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group doctors">
                                            <label>Speciality</label>
                                            <select name="specialist" class="form-control select2 dept_select2" style="width: 100%">
                                                <option value="" selected="">Choose</option>
                                                {{--@foreach($specialist as $specialist)--}}
                                                    {{--<option value="{{$specialist}}">{{$specialist}}</option>--}}
                                                {{--@endforeach--}}
                                            </select>
                                        </div>
                                        <div class="form-group doctors">
                                            <label>Location</label>
                                            <select name="location" class="form-control select2 dept_select2" style="width: 100%">
                                                <option value="" selected="">Choose</option>
                                                {{--@foreach($locations as $location)--}}
                                                    {{--<option value="{{$location->city}}">{{$location->city}}</option>--}}
                                                {{--@endforeach--}}
                                            </select>
                                        </div>
                                        <div class="form-group doctors">
                                            <label style="cursor: pointer;"><input type="checkbox" name="is_online" value="1"> Online Doctors</label>
                                        </div>
                                        {{-- <input type="hidden" name="doc_type" value="physicians" id="doc_type"> --}}
                                        <div class="text-center m-t-20">
                                            <button type="submit" class="btn btn-primary m-b-20">Search</button>
                                            <button type="reset" class="btn btn-warning m-b-20" id="clear-filter">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">

                    <div id="doctors_list">
                        @include('FrontEnd.all-appointments')
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="doc_messsage_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Message to Doctor</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" id="send_message_to_doctor_frm" class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" name="provider_id" value="" id="msg_provider_id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Subject</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="subject" placeholder="Subject">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">To</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="to" id="msg_provider_to" placeholder="To" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Cc</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="Cc" placeholder="Cc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Message</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" name="message" placeholder="Enter Message..." rows="8"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-offset-2">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Send </button>
                                    <button type="button" class="btn btn-warning"><i class="fa fa-save"></i> Save as Draft</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Doctor List Section -->
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <script>$('#moble_nav_item_9').addClass('menu__item--current');</script>
    <script type="text/javascript">

        $( document ).ready(function() {

            // Filter Doctor
            $('#filter-doctor-frm').submit(function(){
                $('#loader').fadeIn();
                $.ajax({
                    url: "{{ route('doctors') }}",
                    data: $(this).serialize(),
                    type: 'post',
                    success: function (data) {
                        $('#loader').fadeOut();
                        $("#doctors_list").html(data);
                        makeDirectAppointment();
                    }
                });
                return false;
            });

            // Clear filtering
            $('#clear-filter').click(function(){
                window.location.href= "{{route('doctors')}}";
            });

            function makeDirectAppointment() {
                $('.make-direct-appointment').click(function() {
                    $('#create_appointment_frm')[0].reset();
                    $('#find_provider_block').html('');
                    $('#app_provider_id').val($(this).data('provider_id'));
                    $('#find_doctor_btn').hide();
                    $('#create_appointment_btn').show();
                    $('#app-modal-image').show();
                    $('#appointment').modal('show');
                });
            }
            makeDirectAppointment();

            $('.send-doc-message').click(function() {
                $('#send_message_to_doctor_frm')[0].reset();
                $('#msg_provider_id').val($(this).data('provider_id'));
                $('#msg_provider_to').val($(this).data('provider_name'));
                $('#doc_messsage_modal').modal('show');
            });

        });

    </script>

@endsection