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
                    Add
                </li>
            </ol>
            <div class="page-header">
                <h1>Add Topic</h1>
            </div>
            <!-- end: PAGE TITLE & BREADCRUMB -->
        </div>
    </div>

    <div class="row acco_add_one">
        <div class="col-md-12">
            <!-- start: FORM VALIDATION 1 PANEL -->
            {!!Form::open(['url'=>'topic/save','method'=>'post','class'=>'form form-register','id'=>'addContent','files'=>true])!!}
            <div class="panel panel-default">
                <div class="panel-body">

                    <fieldset>
                        <div class="row">
                            <div class="" id="AccoMessage"></div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label class="control-label"> Name <span class="required">*</span> </label>

                                    {!! Form::text('name',null,['id'=>'title_name','class'=>'form-control','placeholder'=>'name']) !!}

                                </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <label class="control-label"> Subject <span class="required">*</span> </label>

                                    {!! Form::text('subject',null,['id'=>'subject','class'=>'form-control','placeholder'=>'subject']) !!}

                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="panel-group accordion-custom accordion-teal" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h2 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> <i class="icon-arrow"></i>Description<span class="required">*</span></a></h2>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">

                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <textarea name="description" class="ckeditor form-control" cols="10" rows="10" id="textediter"></textarea>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> </div>
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
                    </fieldset>
                </div>
            </div>
            {!!Form::close()!!}

        </div>
    </div>
</div>
@stop

@push('scripts')

{!! HTML::script('assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js') !!}
{!! HTML::script('assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js') !!}

<script type="text/javascript">
    $(document).ready(function() {

        $('textarea.ckeditor').ckeditor();
       
        $("#cancel").click(function() {
            window.location.href = "{{asset('topics/list')}}";
        });

        $.validator.addMethod("valueNotEquals", function(value, element, arg) {
            return arg != value;
        }, "Value must not equal arg.");

        $("#addContent").validate({
            rules : {
                subject:{
                    required : true
                },
                name : {
                    required : true,
                    minlength: 2
                },
                texteditor : {
                    required : true,
                    minlength: 5

                },

                // othercity : {
                // 	required : true,
                // },
            },
            messages : {
                name : "Please enter a name of the topic",
                texteditor :"Enter description",
                subject:"Please add a subject"
                // othercity : "Please enter a city name!"
            },



            submitHandler : function(e) {

                var formData = $("#addContent").serialize();

                console.log(formData);

                $.ajax({
                    type : "POST",
                    url : "{{asset('topic/save')}}",
                    data : formData,
                    dataType : "JSON",

                    success : function(data) {
                        if (data == 1) {
                            
                            var success_message = "Topic added succesfully";
                            $('#AccoMessage').show();
                            $('#AccoMessage').removeClass().addClass('alert alert-success').html(success_message);
                            $('#AccoMessage').delay(3200).fadeOut(300);
                            $('#collapseOne').removeClass('collapse in').addClass('collapse');
                            $('html,body').animate({
                                    scrollTop: $(".page-header").offset().top},
                                500);
                            $('.acco_submit').hide();
                            window.location.href = "{{asset('topics/list')}}";


                        }
                    }
                });
            }
        });



    });
</script>

@endpush