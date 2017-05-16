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
                        Feedback
                    </li>


                </ol>
                <div class="page-header">
                    <h1 style="float:left">User Feedback list</h1>
                                  
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
        <table class="table table-bordered" id="userfeedback-table">
            <thead>
            <tr>
                <th>Sl No</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Feedback Title</th>
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

              table =  $('#userfeedback-table').DataTable( {
                ajax: "{{asset('userfeedback/data')}}",
                columns: [
                    { data: "id"},
                    { data: "name"},
                    { data: "email"}, 
                    { data: "title"},                   
                    {
                        data: null,render: function ( data, type, row ) {
                            var editurl = "{{asset('feedback/view')}}/"+data.id
							var editfield = '<a id="edit" href="'+editurl+'" class="editor_edit btn btn-sm btn-teal"  alt="View" title="View"><i class="fa fa-edit"></i></a>';

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

                $('#userfeedback-table').on('click', 'button.editor_remove', function (e) {
                    var id = $(this).attr('data-id');
                    console.log(id);
                    var result = confirm("Are you sure you want to delete the feedback?");
                    if (result) {
                        $.ajax({
                            

                            type:'GET',
                            url:"{{asset('feedback/delete')}}/"+id,
                            dataType:'json',
                            success: function(data) {
                                console.log(data);
                                table.ajax.reload();
                                if(data ==1){
                                	 var message = "User Feedback deleted successfully";
                                	 $('#msg').show();
                                	$('#msg').removeClass().addClass('alert alert-success').html(message);
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