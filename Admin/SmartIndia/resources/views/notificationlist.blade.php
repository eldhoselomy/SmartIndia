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
                        Notification
                    </li>


                </ol>
                <div class="page-header">
                    <h1 style="float:left">Notification</h1>
                    <div align="right">
                        <a href="{{asset('notification/add')}}" class="btn button_color"> Add Notification</a>
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
        <table class="table table-bordered" id="notification-table">
            <thead>
            <tr>
                <th>Sl No</th>
                <th>Title</th>
                <th>Notification Type</th>
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

              table =  $('#notification-table').DataTable( {
                ajax: "{{asset('notification/data')}}",
                columns: [
                    { data: "id"},
                    { data: "title"},
                    { data: "notification_type"},                   
                    {
                        data: null,render: function ( data, type, row ) {
                            var editurl = "{{asset('notification/edit')}}/"+data.id
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

                $('#notification-table').on('click', 'button.editor_remove', function (e) {
                    var id = $(this).attr('data-id');
                    console.log(id);
                    var result = confirm("Are you sure you want to delete the Notification?");
                    if (result) {
                        $.ajax({
                            

                            type:'GET',
                            url:"{{asset('notification/delete')}}/"+id,
                            dataType:'json',
                            success: function(data) {
                                console.log(data);
                                table.ajax.reload();
                                if(data ==1){
                                	 var message = "Notification deleted successfully";
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