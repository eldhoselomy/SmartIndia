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
            {!!Form::open(['url'=>'topic/update','method'=>'post','class'=>'form form-register','id'=>'editContent'])!!}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="" id="AccoMessage"></div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::hidden('id',$topic->id,['class'=>'form-control']) !!}
                                            <label class="control-label"> Name </label>

                                            {!! Form::text('name',$topic->name,['id'=>'title','class'=>'form-control','placeholder'=>'']) !!}

                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                            <label class="control-label"> Subject </label>

                                            {!! Form::text('subject',$topic->subject,['id'=>'subject','class'=>'form-control','placeholder'=>'']) !!}

                                        </div>
                                        </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="panel-group accordion-custom accordion-teal" id="accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h2 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> <i class="icon-arrow"></i>Description</a></h2>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse in">

                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                <textarea name="description" class="ckeditor form-control" cols="10" rows="10" id="textediter">{{$topic->description}}</textarea>
                                                            </div>

                                                        </div>
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
            window.location.href = "{{asset('topics/list')}}";
        });
        
        $("#editContent").validate({
            rules : {
                subject:{
                    required: true
                },

                name : {
                    required : true,
                    minlength: 4

                },
                texteditor : {
                    required : true,
                    minlength: 10

                },
            },
            messages : {
                name : "Please enter valid name!",
                subject:"Please enter a valid subject",

            }
        });
    });
</script>

@endpush
