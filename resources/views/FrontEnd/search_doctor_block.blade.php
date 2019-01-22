@if($doctors->count() > 0)    @foreach($doctors as $key => $doctor)        <div class="row">            <div class="col-md-offset-1 col-md-7 col-sm-7 doctors" style="margin-right: 5px;">                <div class="row">                    <div class="col-md-12 m-r-30">                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#location2" aria-expanded="false">                            <span class="sr-only">Toggle navigation</span>                            <span class="icon-bar fa fa-info-circle text-primary">&nbsp;MORE</span>                        </button>                    </div>                </div>                <div class="row">                    <div class="col-md-3 col-xs-3 m-t-20">                        @if($doctor->photo != '' && file_exists(public_path('uploads/profile/'.$doctor->photo)))                            <img src="{{asset('uploads/profile/'.$doctor->photo)}}" alt="{{$doctor->firstname}}" class="img-responsive img-circle img_border">                        @else                            <img src="{{asset('images/no_mdoctor.png')}}" alt="{{$doctor->firstname}}" class="img-responsive img-circle img_border">                                            @endif                    </div>                    <div class="col-md-9 col-xs-9">                        <h4>Dr. {{ucfirst($doctor->firstname)}} {{$doctor->lastname}}</h4>                        <p>{{str_replace(',',' / ',$doctor->specialty)}}</p>                        @if($doctor->description != '')                            <p class="text-justify small">                                <i class="fa fa-thumbs-up font20 text-primary"></i>                                {{$doctor->description}}                                                            </p>                            {{-- <p class="small m-t-n15"><i class="fa fa-" {{$doctor->description}}</p> --}}                        @endif                        {{-- <div class="row doctors_links">                            <ul>                                <li>Zerconia Crown</li>                                                        <li>Cosmetic Dentestry</li>                                <li><a href="#">Veiw All Services</a></li>                            </ul>                        </div> --}}                    </div>                </div>            </div>            <div class="col-md-3 col-sm-5 doc_feedback collapse navbar-collapse" id="location2" style="margin-left: 5px;">                <ul class="m-t-10">                               @if($doctor->city != '')                        <li>                            <i class="fa font20 fa-home m-b-15 m-r-15 text-primary"></i>                            <span class="font15"> {{$doctor->city}}</span>                        </li>                    @endif                    @if($doctor->language != '')                        <li>                            <i class="fa font20 fa-money m-b-15 m-r-15 text-primary"></i>                            <span class=" font15"> {{$doctor->language}}</span>                        </li>                    @endif                    @if($doctor->active == 0)                        <li>                             <i class="fa font20 fa-clock-o m-b-15 m-r-15 text-primary"></i>                                                           <span class="text-left">Working Hours</span>                                                    </li>                                               @if($doctor->mon_o != "" && $doctor->mon_o != "")                            <p>                                <span class="text-left">Mon</span>                                <span class="pull-right"> : ({{$doctor->mon_o}} - {{$doctor->mon_c}})</span>                            </p>                        @endif                        @if($doctor->tue_o != "" && $doctor->tue_o != "")                            <p>                                <span class="text-left">Tue</span>                                <span class="pull-right"> : ({{$doctor->tue_o}} - {{$doctor->tue_c}})</span>                            </p>                        @endif                        @if($doctor->wed_o != "" && $doctor->wed_o != "")                            <p><span class="text-left">Wed</span>                                <span class="pull-right"> : ({{$doctor->wed_o}} - {{$doctor->wed_c}})</span>                            </p>                        @endif                        @if($doctor->thu_o != "" && $doctor->thu_o != "")                            <p>                                <span class="text-left">Thu</span>                                <span class="pull-right"> : ({{$doctor->thu_o}} - {{$doctor->thu_c}})</span>                            </p>                        @endif                        @if($doctor->fri_o != "" && $doctor->fri_o != "")                            <p>                                <span class="text-left">Fri</span>                                <span class="pull-right"> : ({{$doctor->fri_o}} - {{$doctor->fri_c}})</span>                            </p>                        @endif                        @if($doctor->sat_o != "" && $doctor->sat_o != "")                            <p>                                <span class="text-left">Sat</span>                                <span class="pull-right"> : ({{$doctor->sat_o}} - {{$doctor->sat_c}})</span>                            </p>                        @endif                        @if($doctor->sun_o != "" && $doctor->sun_o != "")                            <p>                                <span class="text-left">Sun</span>                                <span class="pull-right"> : ({{$doctor->sun_o}} - {{$doctor->sun_c}})</span>                            </p>                        @endif                    @endif                </ul>            </div>            <div class="col-md-12 text-center" style="margin-top: 10px;">                @if(Auth::check())                    <a href="javascript:void(0);" data-provider_id="{{$doctor->id}}" class="btn btn-primary make-direct-appointment">Make An Appointment</a>                    {{-- <a href="javascript:void(0);" data-provider_id="{{$doctor->id}}" data-provider_name="{{ucfirst($doctor->firstname)}} {{$doctor->lastname}}" class="btn btn-primary send-doc-message"><i class="fa fa-commenting"></i> Message</a> --}}                    <a href="{{route('core_form',['table'=>'messaging','index'=>'message_id','id'=>'0'])}}" data-provider_id="{{$doctor->id}}" class="btn btn-primary"><i class="fa fa-commenting"></i> Message</a>                @else                    <a href="{{route('login')}}" class="btn btn-primary" disabled>Make An Appointment</a>                @endif            </div>        </div>        <hr>    @endforeach    <div class="row">        <div class="col-md-12 text-center">{{ $doctors->links() }}</div>    </div>@else    <div class="row">        <div class="col-md-12 m-b-10 text-center">            <div class="alert alert-info fade in alert-dismissible">                            <strong>Oops!</strong> There no any doctors available.            </div>                </div>    </div>@endif