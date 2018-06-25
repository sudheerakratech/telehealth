@extends('FrontEnd.layouts.master')

@section('content')
    <title>Create Meeting | Akra Health</title>


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


      <hr>





        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Create Meeting URL</h4>

                <form method="post" action="{{route('createMeeting')}}">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="topic" class="form-control" placeholder="Enter your topic" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="start_time" class="form-control" placeholder="Enter your start time" type="time">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="duration" class="form-control" placeholder="Enter your Duration time" type="number">
                    </div> <!-- form-group// -->


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Create url </button>
                    </div> <!-- form-group// -->
                </form>
                <a href="{{route('createMeeting')}}" type="submit" class="btn btn-lg">Create url</a>
            </article>
        </div> <!-- card.// -->

    </div>
    <!--container end.//-->

<div class="table response-info table-responsive">
{{$meet}}
</div>
    @endsection