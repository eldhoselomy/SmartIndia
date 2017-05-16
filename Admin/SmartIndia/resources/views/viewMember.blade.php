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
                        <a href="{{asset('users/list')}}">User</a>
                    </li>
                    <li>
                        View
                    </li>
                </ol>
                <div class="page-header">
                    <h1>View Member</h1>
                </div>
                <!-- end: PAGE TITLE & BREADCRUMB -->
            </div>
        </div>


        <div class="row">
            {!!Form::open(['url'=>'users/update','method'=>'post','class'=>'form form-register','id'=>'viewUser'])!!}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="" id="AccoMessage"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::hidden('id',$member->id,['class'=>'form-control']) !!}
                                                <label class="control-label"> Name </label>

                                                {!! Form::text('name',$member->name,['id'=>'name','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="control-label">Email </label>

                                                {!! Form::text('email',$member->email,['id'=>'email','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label"> Phone </label>

                                                {!! Form::text('phone',$member->phone,['id'=>'phone','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="control-label">Birth Date </label>

                                                {!! Form::text('dob',$member->dob,['id'=>'dob','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                
                                                <label class="control-label"> Sex </label>
                                                @if($member->sex == 1)
                                                {!! Form::text('sex','Male',['id'=>'sex','class'=>'form-control','placeholder'=>'']) !!}
                                                @else
                                                {!! Form::text('sex','Female',['id'=>'sex','class'=>'form-control','placeholder'=>'']) !!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="control-label">Department</label>

                                                {!! Form::text('department',$member->department,['id'=>'department','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Semester </label>

                                                {!! Form::text('semester',$member->semester,['id'=>'semester','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="control-label">Register Number</label>

                                                {!! Form::text('reg_no',$member->reg_no,['id'=>'reg_no','class'=>'form-control','placeholder'=>'']) !!}

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

@endpush
