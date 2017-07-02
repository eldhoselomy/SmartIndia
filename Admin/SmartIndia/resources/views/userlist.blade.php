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
                    <h1 style="float:left">Smart India Users </h1>
                                        
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
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>

<!-- =============================================================================================================== -->

                                    @include('teamdatatable');

    <!-- ================================================================================================================ -->
    
        @stop

        @push('scripts')
        <script>
         $('.errorHandler').delay(3200).fadeOut(300);
            var table;
            $(document).ready(function(){
                $('.team_table').hide();
                  $('.member_table').hide();
              table =  $('#users-table').DataTable( {
                retrieve: true,
                ajax: "{{asset('users/data')}}",
                columns: [
                    { data: "id"},
                    { data: "name"},
                    { data: "email"},                   
                    {
                        data: null,render: function ( data, type, row ) {
                            var editurl = "{{asset('users/edit')}}/"+data.id
							var editfield = '<a id="edit" href="'+editurl+'" class="editor_edit btn btn-sm btn-teal"><i class="fa fa-edit"></i></a>';

							var deletefield = '<button class="editor_remove btn btn-sm btn-danger" alt="Delete" title="Delete" data-id=' + data.id + '><i class="icon-remove icon-white"></i></button>';
                            var teams = '<button class="list_teams btn btn-sm btn-purple" data-name="'+data.name+'" alt="Teams" title="Teams" data-id=' + data.id + '><i class="fa fa-arrow-circle-right"></i></button>';


                                if (data.status == 1) {
                                     var verified = ' ';
                                 } 
                                 else {
                                     var verified = '<button id="verified"  alt="Deactivate" title="Activate" data-status="'+data.status+'"  data-id="'+data.id+'" class="publish btn btn-sm btn-success"><i class="fa fa-unlock"></i></button>';
                                 } 
						return editfield + ' ' + deletefield +' '+teams +' '+verified;
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

                $('#users-table').on('click', 'button.editor_remove', function (e) {
                    var id = $(this).attr('data-id');
                    console.log(id);
                    var result = confirm("Are you sure you want to delete?");
                    if (result) {
                        $.ajax({
                            

                            type:'GET',
                            url:"{{asset('users/delete')}}/"+id,
                            dataType:'json',
                            success: function(data) {
                                console.log(data);                                
                                if(data ==1){
                                	 var message = "User deleted successfully";
                                	 $('#msg').show();
                                	$('#msg').removeClass().addClass('alert alert-success').html(message);
                                }                        
                                $('html,body').animate({
                                    scrollTop: $(".page-header").offset().top},
                                    500);
                                $('#msg').delay(3200).fadeOut(300);
                                table.ajax.reload();
                            }

                        })
                    }
                });

                $('#users-table').on('click', 'button.publish', function (e) {
                    var id = $(this).attr('data-id');
                    console.log(id);
                    var result = confirm("Are you sure you want to activate user?");
                    if (result) {
                        $.ajax({
                            

                            type:'GET',
                            url:"{{asset('users/activate')}}/"+id,
                            dataType:'json',
                            success: function(data) {
                                console.log(data);                                
                                if(data ==1){
                                     var message = "User activated successfully";
                                     $('#msg').show();
                                    $('#msg').removeClass().addClass('alert alert-success').html(message);
                                }                                                           
                                $('html,body').animate({
                                    scrollTop: $(".page-header").offset().top},
                                    500);
                                $('#msg').delay(3200).fadeOut(300);
                                table.ajax.reload();
                            }

                        })
                    }
                });

            });

        </script>
    @endpush