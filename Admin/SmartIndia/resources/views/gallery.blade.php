@extends('master')
@section('head')
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <b>Team Gallery</b>
        </div>
        <div class="panel-body">
            <div class="panel panel-heading">
                {{ Form::open() }}
                    {{ Form::select('team',array('default'=>$selectedTeam)+$teams,null,array('id'=>'teamSelected')) }}
                {{ Form::close() }}
            </div>

        @if (count($imageList)>0)
            <div class="row">
            @foreach($imageList as $image)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p class="lead indent">
                                <div class="">
                                    {{ HTML::image('Media/'.$image["image"],'alt',array('width' => 280))}}
                                </div>
                            </p>
                        </div>
                    </div>
                </div>
    		@endforeach
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    	@else
        <b>No Images Found</b>
            </div>
    	@endif
    </div>
@stop

@push('scripts')
        <script>
        $(document).ready(function() {
            
            $('#teamSelected').change(function() {
                
                var data = $(this).val();
                console.log(data);
                window.location.href = "{{asset('gallery/listImages')}}/"+data;
            });
        });

        </script>
@endpush