@php
    $video = true;
    if(array_key_exists('period', $data) && in_array($data['period'], ['past','future'])){
        $video = false;
    }
@endphp
@if(is_array($appointments) && count($appointments))
    @foreach($appointments as $appointment)
        @php 
        $enable = false;
        try{
            $enable = ((time() + 1500) > $appointment['timestamp_time']) && ((time() - 10000) < $appointment['timestamp_time']) ;
        }catch(\Exception $e){

        }
        @endphp
        <div class="row">
            <div class="col-md-offset-1 col-md-7 col-sm-7 doctors" style="margin-right: 5px;">
                <div class="row">
                    <div class="col-md-12 m-r-30">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location2" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar fa fa-info-circle text-primary">&nbsp;MORE</span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-xs-3 m-t-20">
                        @if($appointment['photo'] != '' && file_exists(public_path('uploads/profile/'.$appointment['photo'])))
                            @php  $url =  'uploads/profile/'. "${appointment['photo']}" @endphp 
                            <img src="{{asset($url)}}" alt="{{$appointment['name']}}" class="img-responsive img-circle img_border">
                        @else
                            <img src="{{asset('images/no_mdoctor.png')}}" alt="{{$appointment['name']}}" class="img-responsive img-circle img_border">
                        @endif
                    </div>
                    <div class="col-md-9 col-xs-9">
                        @if(\Auth::user()->group_id == 100)
                               <h4>Dr. {{ucfirst($appointment['name'])}} </h4>
                                <p>{{str_replace(',',' / ',$appointment['specialty'])}}</p>
                        @elseif(\Auth::user()->group_id == 2 )
                               <h4>Patient : {{ucfirst($appointment['patient_name'])}} </h4>
                                <p>{{str_replace(',',' / ',$appointment['specialty'])}}</p>
                        @endif
                        <p class="text-justify"><i class="fa fa-hospital-o font20 text-primary"></i>
                        <strong> Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong> {{ $appointment['visit_type'] }}</p>
                        @if($appointment['notes'] != '')
                            <p class="text-justify">
                                <i class="fa fa-sticky-note font20 text-primary"></i>
                                <strong> Notes &nbsp;&nbsp;&nbsp;:   </strong>
                                {{$appointment['notes']}}
                            </p>
                            {{-- <p class="small m-t-n15"><i class="fa fa-" {{$doctor['description']}}</p> --}}
                        @endif
                        @if($appointment['reason'] != '')
                            <p class="text-justify">
                                <i class="fa fa-tasks font20 text-primary"></i>
                                <strong> Reason : </strong>
                                {{$appointment['reason']}}
                            </p>
                            {{-- <p class="small m-t-n15"><i class="fa fa-" {{$doctor['description']}}</p> --}}
                        @endif
                        {{-- <div class="row doctors_links">
                            <ul>
                                <li>Zerconia Crown</li>
                                <li>Cosmetic Dentestry</li>
                                <li><a href="#">Veiw All Services</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-5 doc_feedback collapse navbar-collapse" id="location2" style="margin-left: 5px;">
                <ul class="m-t-10 appointment-info-list">
                    @if($appointment['city'] != '')
                        <li title="City">
                            <i class="fa font20 fa-home m-b-15 m-r-15 text-primary"></i>
                            <span class="font15"> {{$appointment['city']}}</span>
                        </li>
                    @endif

                    @if($appointment['language'] != '')
                        <li title="Language">
                            <i class="fa font20 fa fa-language m-b-15 m-r-15 text-primary"></i>
                            <span class=" font15"> {{$appointment['language']}}</span>
                        </li>
                    @endif
                    @if($appointment['time'] != '')
                        <li title="Appointment Time">
                            <i class="fa font20 fa-calendar-o m-b-15 m-r-15 text-primary"></i>
                            <span class=" font15"> {{$appointment['time']}} {{$appointment['timezone']}}</span>
                        </li>
                    @endif
                    @if($appointment['duration'] != '')
                        <li title="Duration">
                            <i class="fa font20 fa-clock-o m-b-15 m-r-15 text-primary"></i>
                            <span class=" font15"> {{$appointment['duration']}} Minutes</span>
                        </li>
                    @endif
                    @if($appointment['date'] != '')
                        <li title="Appointment Created On">
                            <i class="fa font20 fa-calendar m-b-15 m-r-15 text-primary"></i>
                            <span class=" font15"> {{$appointment['date']}}</span>
                        </li>
                    @endif

                </ul>
            </div>
            <div class="col-md-12 text-center" style="margin-top: 10px;">
                @if(Auth::check())
                    @if($video)

                        <a href="{{route('call_conference',['room' => $appointment['room_id'],'uname' => Auth::user()['username'],'pname' => $appointment['d_username']])}}" class="btn btn-success" target="_blank"
                            {{ $enable ? '' : 'disabled' }} >
                            Video Call
                        </a>
                    @else
                    @endif
                    <a href="{{route('core_form',['table'=>'messaging','index'=>'message_id','id'=>'0','subtype'=> '','info' => [ 'provider_id'=> $appointment['doctor_id']]
                    ])}}" data-provider_id="{{ $appointment['doctor_id'] }}" class="btn btn-primary"><i class="fa fa-commenting"></i> Message</a>

                @else
                    <a href="{{route('login')}}" class="btn btn-primary" disabled>Video Call</a>
                    <a href="{{route('login')}}" class="btn btn-primary" disabled>Message</a>
                @endif
            </div>
        </div>
        <hr>
    @endforeach

    {{--<div class="row">--}}
        {{--<div class="col-md-12 text-center">{{ $doctors['links']() }}</div>--}}
    {{--</div>--}}

@else
    <div class="row">
        <div class="col-md-12 m-b-10 text-center">
            <div class="alert alert-info fade in alert-dismissible">
                <strong>Oops!</strong> There no Appointments
            </div>
        </div>
    </div>
@endif