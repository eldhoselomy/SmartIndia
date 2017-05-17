@extends('master')
@section('head')
@stop
@section('content')
    <div class="container">
        <!-- start: PAGE HEADER -->
        <div class="row">
            <div class="col-sm-12">
                <!-- start: PAGE TITLE & BREADCRUMB -->
                <ol class="breadcrumb">
                    <li>
                        <i class="clip-home-3"></i>
                        <a href="#"> Home </a>
                    </li>
                    <li  class="active">
                        <a href="{{asset('topics/list')}}">Topic</a>
                    </li>
                    <li>
                        Edit
                    </li>
                </ol>
                <div class="page-header">
                    <h1>Edit Topic</h1>
                </div>
                <!-- end: PAGE TITLE & BREADCRUMB -->
            </div>
        </div>


        <div class="row">
            {!!Form::open(['url'=>'notification/update','method'=>'post','class'=>'form form-register','id'=>'editContent'])!!}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="" id="AccoMessage"></div>

                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                {!! Form::hidden('id',$notification->id,['class'=>'form-control']) !!}

                                                <label class="control-label"> Title <span class="required">*</span> </label>

                                                {!! Form::text('title',$notification->title,['id'=>'title','class'=>'form-control','placeholder'=>'title']) !!}

                                            </div>
                                            </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label class="control-label"> Notification Type <span class="required">*</span> </label>

                                                {!! Form::select('notification_type',$type,$notikey,['class' => 'form-control','id' => 'notification_type']) !!}
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <label class="control-label">Notification Url </label>

                                                {!! Form::text('notification_url',$notification->notification_url,['id'=>'notification_url','class'=>'form-control','placeholder'=>'Notification Url']) !!}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Notification Description<span class="required">*</span> </label>

                                            <textarea name="description" class="form-control" cols="10" rows="10" id="textediter">{{$notification->description}}</textarea>
                                        </div>
                                    </div>

                                </div>
                            </div> 
                                        <div class="row">

                                            <div class="col-md-3">
                                                {!!Form::submit('Submit',['class'=>'btn btn-yellow btn-block'])!!}
                                            </div>

                                            <div class="col-md-3">

                                                <a id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
                                            </div>

                                        </div>
</div>

                        </div>
                                </div>
                        </fieldset>
                    </div>
                </div>

            </div>
            {!!Form::close()!!}
        </div>
        </div>
@stop

@push('scripts')

<script>
    $(document).ready(function() {

        $("#cancel").click(function() {
            window.location.href = "{{asset('notification/list')}}";
        });

        $("#editContent").validate({
            rules : {
                title:{
                    required : true
                },
                notification_type : {
                    required : true,
                    valueNotEquals: 0
                },
                description : {
                    required : true,
                },
            },
            messages : {
                name : "Please enter a title of the Notification",
                notification_type :"Please select a notification type",
                description:"Please add a description"
            },
        });
    });
</script>

@endpush
