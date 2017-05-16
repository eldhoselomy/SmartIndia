@extends('master')

@section('content')

    <div class="container">
        <!-- start: PAGE HEADER -->
        <div class="row">
            <div class="col-sm-12">
                <!-- start: PAGE TITLE & BREADCRUMB -->
                <ol class="breadcrumb">
                    <li>
                        <i class="clip-home-3"></i>
                        <a href="#">
                            Home
                        </a>
                    </li>
                    <li class="active">
                        Users
                    </li>


                </ol>
                <div class="page-header">
                    <h1 style="float:left">Topics</h1>
                    <div align="right">
                        <a href="{{asset('topics/add')}}" class="btn button_color"> Add Topic</a>
                    </div> 
                                        
                </div>
                <!-- end: PAGE TITLE & BREADCRUMB -->
            </div>
        </div>


			<div class="row">
							<div class="col-md-12">
								@foreach($errors->all() as $error)
								<div class="errorHandler alert alert-danger">
									<i class="icon-remove-sign"></i> {!!$error!!}
								</div>
								@endforeach
							</div>
			</div>
            <div id="msg" class=""></div>
        <table class="table table-bordered" id="topics-table">
            <thead>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>

        @stop

        @push('scripts')
        <script>
         $('.errorHandler').delay(3200).fadeOut(300);
            var table;
            $(document).ready(function(){

              table =  $('#topics-table').DataTable( {
                ajax: "{{asset('topics/data')}}",
                columns: [
                    { data: "id"},
                    { data: "name"},
                    { data: "subject"},                   
                    {
                        data: null,render: function ( data, type, row ) {
                            var editurl = "{{asset('topic/edit')}}/"+data.id
							var editfield = '<a id="edit" href="'+editurl+'" class="editor_edit btn btn-sm btn-teal"><i class="fa fa-edit"></i></a>';

							var deletefield = '<button class="editor_remove btn btn-sm btn-danger" alt="Delete" title="Delete" data-id=' + data.id + '><i class="icon-remove icon-white"></i></button>';
                            return editfield + ' ' + deletefield;
                      }
                    }

                ],
				"order" : [[1, 'asc']]
              });
              table.on('order.dt', function() {
				table.column(0, {
					order : 'applied'
				}).nodes().each(function(cell, i) {
					cell.innerHTML = i + 1;
				});
			}).draw();

                $('#topics-table').on('click', 'button.editor_remove', function (e) {
                    var id = $(this).attr('data-id');
                    console.log(id);
                    var result = confirm("Are you sure you want to delete the topic?");
                    if (result) {
                        $.ajax({
                            

                            type:'GET',
                            url:"{{asset('topic/delete')}}/"+id,
                            dataType:'json',
                            success: function(data) {
                                console.log(data);
                                table.ajax.reload();
                                if(data ==1){
                                	 var message = "Topic deleted successfully";
                                	 $('#msg').show();
                                	$('#msg').removeClass().addClass('alert alert-success').html(message);
                                }else if (data ==0){
                                	var message = "You can't delete yourself";
                                	$('#msg').show();
                               		 $('#msg').removeClass().addClass('alert alert-danger').html(message);
                                }
                                                           
                                $('html,body').animate({
                                    scrollTop: $(".page-header").offset().top},
                                    500);
                                $('#msg').delay(3200).fadeOut(300);
                            }

                        })
                    }
                });

            });

        </script>
    @endpush