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
                        <a href="{{asset('feedback/userfeedbacklist')}}">Feedback</a>
                    </li>
                    <li>
                        View
                    </li>
                </ol>
                <div class="page-header">
                    <h1>View Feedback</h1>
                </div>
                <!-- end: PAGE TITLE & BREADCRUMB -->
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <fieldset>
                            {!!Form::open(['url'=>'','method'=>'post','class'=>'form form-register','id'=>'feedback'])!!}
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="" id="AccoMessage"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::hidden('id',$feedback->id,['class'=>'form-control']) !!}

                                                @if(!empty($feedback->user_id) )
                                                <label class="control-label">User Name </label>

                                                {!! Form::text('name',$feedback->name,['id'=>'name','class'=>'form-control','placeholder'=>'']) !!}
                                                @else
                                                <label class="control-label">Name </label>

                                                {!! Form::text('name',$feedback->name,['id'=>'name','class'=>'form-control','placeholder'=>'']) !!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                @if(!empty($feedback->user_id))
                                                <label class="control-label">Email</label>

                                                {!! Form::text('email',$feedback->email,['id'=>'email','class'=>'form-control','placeholder'=>'']) !!}
                                                @else
                                                <label class="control-label">Team Name </label>

                                                {!! Form::text('team_name',$feedback->team_name,['id'=>'team_name','class'=>'form-control','placeholder'=>'']) !!}
                                                @endif
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Feedback Title</label>

                                                {!! Form::text('title',$feedback->title,['id'=>'title','class'=>'form-control','placeholder'=>'']) !!}
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                           
                                                <label class="control-label">Comments </label>
                                                <div class="form-group">
                                                    <textarea name="description" class="form-control" cols="10" rows="10" id="textediter">{{$feedback->comments}}</textarea>
                                                </div>
                                            
                                        </div>
                                    </div>

                        </div>
                                </div>
                                 {!!Form::close()!!}
                        </fieldset>
                    </div>
                </div>

            </div>
        </div>
        </div>
@stop

@push('scripts')

@endpush
