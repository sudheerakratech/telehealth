<form method="POST" id="find-provider-frm" data-action="{{ route('app_find_doctors') }}">    {{ csrf_field() }}    <div class="row">        <div class="col-md-6">            <div class="form-group">                <label>Speciality</label>                <select name="specialist" class="form-control">                    <option selected value="">Choose Speciality</option>                    @foreach($specialist as $specialist)                        <option value="{{$specialist}}" {{$request->get('specialist') == $specialist ? 'selected' : ''}}>{{$specialist}}</option>                     @endforeach                </select>                                                            </div>        </div>        <div class="col-md-6">            <div class="form-group">                <label>Location</label>                <select name="location" class="form-control">                    <option selected value="">Select Location</option>                    @foreach($locations as $location)                        <option value="{{$location->city}}" {{$request->get('location') == $location->city ? 'selected' : ''}}>{{$location->city}}</option>                     @endforeach                </select>            </div>        </div>    </div>    <div class="row">        <div class="col-md-6">            <div class="form-group">                                <label style="cursor: pointer;"><input type="checkbox" name="is_online" value="1" {{$request->get('is_online') == 1 ? 'checked' : ''}}> Online Doctors</label>            </div>        </div>        <div class="col-md-6">            <div class="form-group pull-right">                                <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i> Search</button>            </div>        </div>    </div></form><div class="col-md-12" id="app_doctors_list" style="float: left;width:100%;overflow-y: auto;max-height: 375px;">    @if($doctors->count() > 0)        @foreach($doctors as $doctor)                    <div class="col-md-12">                <div class="row box_shadow">                    <div class="col-md-3">                        @if($doctor->photo != '' && file_exists(public_path('uploads/profile/'.$doctor->photo)))                            <img src="{{asset('uploads/profile/'.$doctor->photo)}}" alt="{{$doctor->firstname}}" class="img-responsive img-circle img_border">                        @else                            <img src="{{asset('images/no_mdoctor.png')}}" alt="{{$doctor->firstname}}" class="img-responsive img-circle img_border">                        @endif                    </div>                    <div class="col-md-9">                        <h4>Dr. {{ucfirst($doctor->firstname)}} {{$doctor->lastname}}</h4>                                                    <span class="font15">{{str_replace(',',' / ',$doctor->specialty)}}</span><br>                                   @if($doctor->description != '')                            <span class="font15 small">                                <i class="fa fa-thumbs-up font20 text-primary"></i>                                <span class="font15"> {{$doctor->description}}</span>                            </span><br>                        @endif                        @if($doctor->city != '')                            <span class="font15">                                <i class="fa fa-home font20 text-primary"></i>                                <span class="font15"> {{$doctor->city}}</span>                            </span><br>                        @endif                        @if($doctor->language != '')                            <span class="font15">                                <i class="fa fa-money font20 text-primary"></i>                                <span class=" font15"> {{$doctor->language}}</span>                            </span><br>                        @endif                        @if($doctor->active == 0)                            <span class="font15">                                <i class="fa font20 fa-clock-o m-b-15 m-r-15 text-primary"></i>                                <span class=" font15">Working Hours</span>                            </span><br>                             @if($doctor->mon_o != "" && $doctor->mon_o != "")                                                                <span class="text-left">({{$doctor->mon_o}} - {{$doctor->mon_c}}) </span>                                <span class="text-left"> - Mon</span><br>                            @endif                            @if($doctor->tue_o != "" && $doctor->tue_o != "")                                                                <span class="text-left">({{$doctor->tue_o}} - {{$doctor->tue_c}})</span>                                <span class="text-left"> - Tue</span><br>                            @endif                            @if($doctor->wed_o != "" && $doctor->wed_o != "")                                                                <span class="text-left">({{$doctor->wed_o}} - {{$doctor->wed_c}})</span>                                <span class="text-left"> - Wed</span><br>                            @endif                            @if($doctor->thu_o != "" && $doctor->thu_o != "")                                                                <span class="text-left">({{$doctor->thu_o}} - {{$doctor->thu_c}})</span>                                <span class="text-left"> - Thu</span><br>                            @endif                            @if($doctor->fri_o != "" && $doctor->fri_o != "")                                                                <span class="text-left">({{$doctor->fri_o}} - {{$doctor->fri_c}})</span>                                <span class="text-left"> - Fri</span><br>                            @endif                            @if($doctor->sat_o != "" && $doctor->sat_o != "")                                                                <span class="text-left">({{$doctor->sat_o}} - {{$doctor->sat_c}})</span>                                <span class="text-left"> - Sat</span><br>                            @endif                            @if($doctor->sun_o != "" && $doctor->sun_o != "")                                                                <span class="text-left">({{$doctor->sun_o}} - {{$doctor->sun_c}})</span>                                <span class="text-left"> - Sun</span><br>                            @endif                                                    @endif                    </div>                      </div>                                      </div>                <div class="col-md-12 text-center" style="margin: 10px 0px;">                <a href="javascript:void(0);" data-provider_id="{{$doctor->id}}" class="btn btn-primary request_app_doc">Request</a>                @if($doctor->active == 1)                    <a href="{{route('call_conference',['room' => 12345,'unam' => Auth::user()->firstname,'pname' => $doctor->firstname])}}" class="btn btn-success" target="_blank">Call</a>                @endif            </div>                <hr>        @endforeach    @else            <div class="col-md-12 text-center">            <div class="alert alert-info fade in alert-dismissible">                            <strong>Oops!</strong> There no any doctors available.            </div>                </div>    @endif</div>