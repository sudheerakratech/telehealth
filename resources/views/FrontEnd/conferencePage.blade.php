@extends('FrontEnd.layouts.master')
@section('content')
<title>Online Video Conference</title>

	<div id="content">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Online Video Conference with <span id="partnerName"></span></h3>
						</div>
						<div class="panel-body panel-video">
							<div id="subscriber" style="min-height:475px; background-color: #000; width: 100%;">
								{{--<video id="partner" style="min-height:500px; width: 100%;background-color: #000;"></video>--}}
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Me</h3>
						</div>
						<div class="panel-body panel-video">
							<div id="publisher" style="width: 100%;">
								<video id="self" muted="muted" volume="0" style="width: 100%;min-height: 200px;background-color: #000;"></video>
							</div>
							{{-- <div id="publisher" style="min-height: 250px;width: 100%;">
								<video id="self" muted="muted" volume="0" style="width: 100%;min-height: 222px;background-color: #000;"></video>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<button type="button" class="btn btn-success btn-block" id="publishVideo" style="margin-bottom: 10px;">Publish video</button>
								</div>
								<div class="col-md-6 col-sm-6">
									<button type="button" class="btn btn-warning btn-block" id="unpublishVideo" style="margin-bottom: 10px;">Unpublish video</button>
								</div>
								<!--button type="button" class="btn btn-default btn-leave btn-block" id ="disconnectLink">Leave room</button-->
							</div> --}}
						</div>
					</div>

					<div class="clearfix"></div>

					{{-- <div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Notifications</h3>
						</div>
						<div class="panel-body">
							<div id="notification">
								<div id="notice-0" class="alert alert-dismissable alert-danger video-notice">You've restricted audio and video permissions.</div>
							</div>
						</div>
					</div> --}}


					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Chat</h3>
						</div>
						<div class="panel-body">
							<div id="messages" style="overflow-y: scroll;margin-bottom: 15px;min-height: 110px;height: 110px;"></div>
							<div class="input-group has-success">
								<input autocomplete="off" type="text" id="message" name="message" class="form-control">
								<span class="input-group-btn">
									<input type="button" class="btn btn-success" onclick="sendmessage()" id="submit" value="Send">
								</span>
							</div>
						</div>
					</div>

				</div>

			</div>

			{{-- <div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading purple-bg">
							<h3 class="panel-title">Messages</h3>
						</div>
						<div class="panel-body">
							<div id="messages" style="overflow-y: scroll;margin-bottom: 20px;"></div>
							<div class="input-group has-success">
								<input autocomplete="off" type="text" id="message" name="message" class="form-control">
								<span class="input-group-btn">
									<input type="button" class="btn btn-success" onclick="sendmessage()" id="submit" value="Submit">
								</span>
							</div>
						</div>
					</div>
				</div>
			</div> --}}
		</div>
	</div>

	<script type="text/javascript" src="{{asset('js/webrtc/adapter-latest.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/webrtc/simplewebrtc.bundle.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/webrtc/socket.io.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/webrtc/simplertc.js')}}"></script>
@endsection