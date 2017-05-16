
	<div class="team_table">
		<div class="page-header">
			<div class="user_name"></div>
		</div>
		<div id="succMsg"></div>
	 <div class="row">
        <div class="col-md-12">
        	<div class="" id="LocationMessage"></div>
            <!-- start: DYNAMIC TABLE PANEL -->
            <div class="panel panel-default">
            	<div class="" id="newroom"></div>
                <div class="panel-body">
                 
                 <table class="table table-bordered" id="team-table">
										<thead>
											<tr>
												<th>Sl No</th>
												<th>Name</th>
												<th>Team Name</th>
												<th>Actions</th>
											</tr>
										</thead>
									</table>
                </div>
            </div>
        </div>
    </div>
   
	</div>

		
	<!-- =====================================Member list==================================================== -->
	
		
	<div class="member_table">

		<div class="page-header">
			<div class="member_name"></div>
		</div>
			
	 <div class="row">
        <div class="col-md-12">
            <!-- start: DYNAMIC TABLE PANEL -->
            <div class="panel panel-default">

            	<div class="" id="roomprice"></div>
                <div class="panel-body">
                 
               	<table class="table table-bordered" id="member-table">
						<thead>
							<tr>
								<th>Sl No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Department</th>
								<th>Actions</th>

							</tr>
						</thead>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- =========================================================================================== -->
	
	<script type="text/javascript">
	  var table;
	  var teamtable;
      var membertable;

      $(document).ready(function(){
      	$('.member_table').hide();
      	console.log("ajoooo");
		     	$('#users-table').on('click', 'button.list_teams', function (e) {
		     		console.log("ajoooo");
			 		$('#users-table').find('tr').css('background-color', "");
			 		 $(this).closest('tr').css('background-color', "#f0f0f0");
		                	$('#team-table').dataTable().fnDestroy();
		                    var id = $(this).attr('data-id');
		                    console.log(id);
		                     var attrname = $(this).attr('data-name');  
		                     $('.member_table').hide();               
		                    $(".team_table").show();
		                    $('.user_name').html('<h2>Team list of '+attrname+'</h2>');
		               
		                     $('html,body').animate({
					        scrollTop: $(".team_table").offset().top},
					        'slow');

		                     roomDT(id);

		         });

		     	$('#team-table').on('click', 'button.editor_remove', function(e) {
			var id = $(this).attr('data-id');
		//	console.log(id);
		 var result = confirm("Are you sure you want to delete this?");
                 if (result) {
			$.ajax({
				type : 'GET',
				url : '{{asset("team/delete")}}/' + id,
				dataType : 'json',
				success : function(data) {
					if (data ==1){
						var message = "Team deleted successfully";
                    	$('#succMsg').show();
                    	$('#succMsg').removeClass().addClass('alert alert-success').html(message);
                                                                               
                    	$('html,body').animate({
                        scrollTop: $(".page-header").offset().top},
                        500);
                    	$('#succMsg').delay(3200).fadeOut(300);
					}
					teamtable.ajax.reload();
				}
			})
		}
		});


      });

      

    

	 function roomDT(id){
	 	teamtable = $('#team-table').DataTable({
	 		retrieve: true,
			ajax : {
				"url": '{{asset("listTeamDetails")}}/'+id,
				"type" : 'GET'
			},			
			columns : [{
				data : "id"
			}, {
				data : "name"
			}, {
				data : "team_name"
			}, 
			
			{
				data : null,
				render : function(data, type, row) {
					
						var editurl = '{{asset("team/view")}}/' + data.id;

						var editfield = '<a class="btn btn-sm btn-teal" href="'+editurl+'" id="edit" data-id="roomid=' + data.id + '" data-placement="top" data-toggle="modal"><i class="fa fa-edit"></i></a>';
					
                   
						var deletefield = '<button class="editor_remove btn btn-sm btn-danger" alt="Delete" title="Delete" data-id=' + data.id + '><i class="icon-remove icon-white"></i></button>';
					
                    
						var memberlist = '<button class="member_list btn btn-sm btn-primary" alt="Members" title="Members" data-name="'+data.team_name+'"  data-id='+data.id+'><i class="clip-user"></button>';
					
                         
						return editfield + ' ' + deletefield + ' '+ memberlist;

				}
			}
			
			],
			"order" : [[1, 'asc']]

		});
		teamtable.on('order.dt', function() {
			teamtable.column(0, {
				order : 'applied'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1;
			});
		}).draw();
	 }
                   
			      
		
	

				 $('#team-table').on('click', 'button.member_list', function (e) {
				 		$('#team-table').find('tr').css('background-color', "");
				 		 $(this).closest('tr').css('background-color', "#f0f0f0");
				 
			                	$('#member-table').dataTable().fnDestroy();
			                    var id = $(this).attr('data-id');
			                    console.log(id);
			                     var attrname = $(this).attr('data-name');                 
			                    $(".member_table").show();
			                    $('.member_name').html('<h2>Member list of '+attrname+'</h2>');
			               
			                     $('html,body').animate({
						        scrollTop: $(".member_table").offset().top},
						        'slow');

			                    memberDT(id);

			 	});



          function memberDT(id){
            membertable = $('#member-table').DataTable({
			ajax : {
				"url" : '{{asset("listmembers")}}/' + id,
				"type" : 'Get'
			},
			columns : [{
				data : "id"
			}, {
				data : "name"
			}, {
				data : "email"
			}, {
				data : "department"
			},
			{
				data : null,
				render : function(data, type, row) {
					//console.log(data.id);

					var editurl = '{{asset("members/view")}}/' + data.id;

						
							var editfield = '<a class="member_view btn btn-sm btn-teal" alt="view" title="view" id="edit" data-id="' + data.id + '" data-placement="top" data-toggle="modal" href="'+editurl+'" ><i class="fa fa-edit"></i></a>';
				
					return editfield ;

				}
			}
			
			],
			"order" : [[1, 'asc']]

			});
			membertable.on('order.dt', function() {
				membertable.column(0, {
					order : 'applied'
				}).nodes().each(function(cell, i) {
					cell.innerHTML = i + 1;
				});
			}).draw();

        }
                        
	
	function reloadTable() {
		//table.ajax.reload();
		teamtable.ajax.reload();
	}

	
	function reloadpriceTable() {
		membertable.ajax.reload();
	}



	</script>
