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
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">Schedule</h4>
                        </div>
                        <div class="panel-body">
                            <div id="datetimepicker"></div>
                            <form class="form-horizontal" role="form">
                                 <div class="form-group">
                                     <label for="provider_list" class="col-md-4 control-label">Provider</label>
                                     <div class="col-md-8">
                                         <select id="provider_list" class="form-control" name="provider_list" 
                                             {!! $provider_list !!}
                                         </select>
                                     </div>
                                 </div>
                            </form>
                            @if (isset($colorlegend))
                                <div style="margin:5px;"><i style="color:green;" class="fa fa-square-o fa-lg"></i> Attended</div>
                                <div style="margin:5px;"><i style="color:black;" class="fa fa-square-o fa-lg"></i> DNKA</div>
                                <div style="margin:5px;"><i style="color:red;" class="fa fa-square-o fa-lg"></i> LMC</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <ul class="nav nav-tabs" class="appointment-periods-tabs">
                      <li style="width: 33%">
                        <a href="javascript:;" data-period='past' class="change-appointment-period">
                            Past Appointments
                        </a>
                        </li>
                      <li style="width: 33%" class="active">
                        <a href="javascript:;" data-period='today' class="change-appointment-period">
                            Today Appointments
                        </a>
                      </li>
                      <li style="width: 33%">
                            <a href="javascript:;" data-period='future' class="change-appointment-period">
                            Future Appointments
                            </a>
                      </li>
                    </ul>
                    <br>
                    <div id="all-appointments">
                        
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

        $(function () {
            $('#datetimepicker').datetimepicker({
                inline: true,
                keepOpen: true,
                showTodayButton: true,
                format: 'MM/dd/YYYY'
            });

            $.get('patient-schedule',{},function(response){
                 $('#all-appointments').html(response);
            })

            $('#datetimepicker').on('dp.change', function (e) {
                $.get('patient-schedule',{
                     date : e.date.toString()          
                },function(response) {
                    $('#all-appointments').html(response);
                });
            });

          

            $(document).on('change','#provider_list',function(e) {
                var id = $('#provider_list').val();
                $.get('patient-schedule',{
                    provider_id : id
                },function(response){
                     $('#all-appointments').html(response);
                });
            });

            $(document).on('click','.change-appointment-period',function(e){
                e.preventDefault();
                let period = $(this).data('period');
                let parent = $(this).parent();
                parent.siblings().removeClass('active');
                parent.addClass('active'); 

                $.get('patient-schedule',{
                    period
                },function(response){
                     $('#all-appointments').html(response);
                });
            })
        });

       

    </script>

@endsection