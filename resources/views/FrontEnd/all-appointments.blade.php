@if($appointments->count() > 0)
    @foreach($appointments as $key => $appointment)
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
                        @if($appointment->photo != '' && file_exists(public_path('uploads/profile/'.$appointment->photo)))
                            <img src="{{asset('uploads/profile/'.$appointment->photo)}}" alt="{{$appointment->name}}" class="img-responsive img-circle img_border">
                        @else
                            <img src="{{asset('images/no_mdoctor.png')}}" alt="{{$appointment->name}}" class="img-responsive img-circle img_border">
                        @endif
                    </div>
                    <div class="col-md-9 col-xs-9">
                        <h4>Dr. {{ucfirst($appointment->name)}} </h4>
                        <p>{{str_replace(',',' / ',$appointment->specialty)}}</p>
                        @if($appointment->notes != '')
                            <p class="text-justify small">
                                <i class="fa fa-thumbs-up font20 text-primary"></i>
                                <span>Notes : </span>
                                {{$appointment->notes}}
                            </p>
                            {{-- <p class="small m-t-n15"><i class="fa fa-" {{$doctor->description}}</p> --}}
                        @endif
                        @if($appointment->reason != '')
                            <p class="text-justify small">
                                <i class="fa fa-thumbs-up font20 text-primary"></i>
                                <span>Reason : </span>
                                {{$appointment->reason}}
                            </p>
                            {{-- <p class="small m-t-n15"><i class="fa fa-" {{$doctor->description}}</p> --}}
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
                    @if($appointment->city != '')
                        <li>
                            <i class="fa font20 fa-home m-b-15 m-r-15 text-primary"></i>
                            <span class="font15"> {{$appointment->city}}</span>
                        </li>
                    @endif

                    @if($appointment->language != '')
                        <li>
                            <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i>
                            <span class=" font15"> {{$appointment->language}}</span>
                        </li>
                    @endif
                    @if($appointment->time != '')
                        <li>
                            <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i>
                            <span class=" font15"> {{$appointment->time}}</span>
                        </li>
                    @endif
                    @if($appointment->duration != '')
                        <li>
                            <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i>
                            <span class=" font15"> {{$appointment->duration}}</span>
                        </li>
                    @endif
                    @if($appointment->date != '')
                        <li>
                            <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i>
                            <span class=" font15"> {{$appointment->date}}</span>
                        </li>
                    @endif

                </ul>
            </div>
            <div class="col-md-12 text-center" style="margin-top: 10px;">
                @if(Auth::check())
                    <a href="{{route('call_conference',['room' => mt_rand(00000000,99999999),'uname' => Auth::user()->firstname,'pname' => $appointment->name])}}" class="btn btn-success" target="_blank">
                        Video Call
                    </a>
                    <a href="{{route('core_form',['table'=>'messaging','index'=>'message_id','id'=>'0'])}}" data-provider_id="{{ $appointment->doctor_id }}" class="btn btn-primary"><i class="fa fa-commenting"></i> Message</a>

                @else
                    <a href="{{route('login')}}" class="btn btn-primary" disabled>Video Call</a>
                    <a href="{{route('login')}}" class="btn btn-primary" disabled>Message</a>
                @endif
            </div>
        </div>
        <hr>
    @endforeach

    {{--<div class="row">--}}
        {{--<div class="col-md-12 text-center">{{ $doctors->links() }}</div>--}}
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