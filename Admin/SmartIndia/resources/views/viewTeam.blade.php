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
                    <h1>View team</h1>
                </div>
                <!-- end: PAGE TITLE & BREADCRUMB -->
            </div>
        </div>


        <div class="row">
            {!!Form::open(['url'=>'','method'=>'post','class'=>'form form-register','id'=>'viewTeam'])!!}
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
                                                {!! Form::hidden('id',$team->id,['class'=>'form-control']) !!}
                                                <label class="control-label">Name </label>

                                                {!! Form::text('name',$team->name,['id'=>'name','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="control-label">Team Name </label>

                                                {!! Form::text('team_name',$team->team_name,['id'=>'team_name','class'=>'form-control','placeholder'=>'']) !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Team Topic </label>

                                                {{ Form::button($team->team_topic, array('class' => 'btn btn-purple team_topic','data-id' => $team->topic_id)) }}
                                                
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
$(".team_topic").click(function(){
    var id = $(this).attr('data-id'); 
    window.location.href = "{{asset('topic/view')}}/" + id;
});

</script>
@endpush
