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
                    <a href="{{asset('notification/list')}}">Notification</a>
                </li>
                <li>
                    Add
                </li>
            </ol>
            <div class="page-header">
                <h1>Add Notification</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>

    <div class="row acco_add_one">
        <div class="col-md-12">
            <!-- start: FORM VALIDATION 1 PANEL -->
            {!!Form::open(['url'=>'notification/save','method'=>'post','class'=>'form form-register','id'=>'addNotification','files'=>true])!!}
            <div class="panel panel-default">
                <div class="panel-body">

                    <fieldset>
                        <div class="row">

                            <div class="" id="AccoMessage"></div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="control-label"> Title <span class="required">*</span> </label>

                                        {!! Form::text('title',null,['id'=>'title','class'=>'form-control','placeholder'=>'title']) !!}

                                    </div>
                                    </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label class="control-label"> Notification Type <span class="required">*</span> </label>

                                        {!! Form::select('notification_type',$type,null,['class' => 'form-control','id' => 'notification_type']) !!}
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">

                                        <label class="control-label">Notification Url </label>

                                        {!! Form::text('notification_url',null,['id'=>'notification_url','class'=>'form-control','placeholder'=>'Notification Url']) !!}

                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">

                                        <label class="control-label">Notification send to</label>
                                        <div class="control-label">College
                                            {{ Form::checkbox('College', 1, null, ['class' => '']) }}
                                        </div>
                                        <div class="control-label">Member
                                            {{ Form::checkbox('member', 1, null, ['class' => '']) }}
                                        </div>

                                    </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Notification Description<span class="required">*</span> </label>

                                            <textarea name="description" class="form-control" cols="10" rows="10" id="textediter"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-2" >
                                        {!!Form::submit('Submit',['class'=>'btn btn-yellow btn-block submit_button'])!!}

                                    </div>
                                    <div class="col-md-4" >
                                        <a id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            {!!Form::close()!!}

        </div>
    </div>
</div>
@stop

@push('scripts')

<script type="text/javascript">
    $(document).ready(function() {
       
        $("#cancel").click(function() {
            window.location.href = "{{asset('notification/list')}}";
        });

        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg != value;
        }, "Value must not equal arg.");

        $("#addNotification").validate({
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



            submitHandler : function(e) {

                var formData = $("#addNotification").serialize();

                console.log(formData);

                $.ajax({
                    type : "POST",
                    url : "{{asset('notification/save')}}",
                    data : formData,
                    dataType : "JSON",

                    success : function(data) {
                        if (data == 1) {
                            
                            var success_message = "Notification added succesfully";
                            $('#AccoMessage').show();
                            $('#AccoMessage').removeClass().addClass('alert alert-success').html(success_message);
                            $('#AccoMessage').delay(3200).fadeOut(300);
                            $('#collapseOne').removeClass('collapse in').addClass('collapse');
                            $('html,body').animate({
                                    scrollTop: $(".page-header").offset().top},
                                500);
                            $('.acco_submit').hide();
                            window.location.href = "{{asset('notification/list')}}";


                        }
                    }
                });
            }
        });



    });
</script>

@endpush