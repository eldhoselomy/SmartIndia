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
                        Edit
                    </li>
                </ol>
                <div class="page-header">
                    <h1>Edit User</h1>
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
                                                {!! Form::hidden('id',$user->id,['class'=>'form-control']) !!}
                                                <label class="control-label"> Name </label>

                                                {!! Form::text('name',$user->name,['id'=>'name','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="control-label">Email </label>

                                                {!! Form::text('email',$user->email,['id'=>'email','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                               
                                                <label class="control-label"> Phone </label>

                                                {!! Form::text('phone',$user->phone,['id'=>'phone','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="control-label">Affiliated Id </label>

                                                {!! Form::text('affiliate_id',$user->affiliate_id,['id'=>'affiliate_id','class'=>'form-control','placeholder'=>'']) !!}

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
            window.location.href = "{{asset('users/list')}}";
        });
</script>

@endpush
