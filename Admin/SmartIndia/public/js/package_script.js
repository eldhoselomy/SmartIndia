var PackageApp = {
	
	showPackageMainContent : function(tour_master_id,url){
					$.ajax({
							url : url+tour_master_id,
							type : "get",							
							success : function(data) {
								console.log(data);
								$('.pack_main_content').show();
								$('.pack_title').html("<strong>Title  :</strong> "+data.packages.title);
								$('.no_of_days').html("<strong>No of days  :</strong> "+data.packages.no_of_days);
								$('.holiday_type').html("<strong>Holiday Type  : </strong>"+data.packages.type.capitalize());
								$('.pack_locations').html("<strong>Locations  : </strong>"+data.packages.locname);
								$('.holiday_category').html("<strong>Holiday Category  : </strong>"+data.category.category.capitalize());	
							}
						});
		
	},
	
	PackageMasterLocationChange : function(loc_val,url,sublocdiv,callback){
					$.ajax({
							url : url,
							type : "get",
							data : {
								'location_id' : loc_val
							},
							success : function(data) {
								console.log(data);
								var sublocation = $(sublocdiv).empty();
								$.each(data, function(k, v) {
									$(sublocdiv).append($("<option></option>").attr("value", k).text(v));
								});
									if(null != callback){
										callback();
									}
								
							}
						});	
	},
	
	PackageDetailVehiclePopulate : function(pickup_subloc_val,url,vehiclediv){	
						$.ajax({
							url : url,
							type : "get",
							data : {
								'pickup_sublocation' : pickup_subloc_val
							},
							success : function(data) {
								var vehicle = $(vehiclediv).empty();

								$.each(data, function(k, v) {
									$(vehiclediv).append($("<option></option>").attr("value", k).text(v));
								});
							}
						});	
	},
	// PackageLocAttractionPopulate : function(halt_location_id,url,attractionsid){	
	// 		var tour_master_id =	$('#detail_tour_master_id').val();	
	// 		$.ajax({
	// 			url : url,
	// 			type : "get",
	// 			data : {
	// 				'package_location_id' : halt_location_id,
	// 				'tour_master_id'	  : tour_master_id
	// 			},
	// 			success : function(data) {
	// 				var attractions = $(attractionsid).empty();
	// 				$(attractionsid).select2("val", "");
	
	// 				$.each(data['packageAttr'], function(k, v) {
	// 					$(attractionsid).append($("<option></option>").attr("value", k).text(v));
	// 				});
	// 			}
	// 		}); 	
	// },


	PackageLocAttractionPopulate : function(halt_location_id,url,attractionsid){	
			var tour_master_id =	$('#detail_tour_master_id').val();	
			$.ajax({
				url : url,
				type : "get",
				data : {
					'package_location_id' : halt_location_id,
					'tour_master_id'	  : tour_master_id
				},
				success : function(data) {
					console.log("data in attraction==="+data);
					console.log($(attractionsid).select2("data"));
					$(attractionsid).empty();
					//$(attractionsid).select2("val", "");
					console.log($(attractionsid));
					$.each(data, function(k, v) {
						//console.log(k);
						//console.log(v);
						$(attractionsid).append($("<option></option>").attr("value", k).text(v));
					});
					console.log($(attractionsid).select2("val"));
				}
			}); 	
	},

	PackageLocMiscPopulate : function(halt_location_id,url,miscsid){
		console.log("inside PackageLocMiscPopulate");
		var tour_master_id =	$('#detail_tour_master_id').val();	
			$.ajax({
				url : url,
				type : "get",
				data : {
					'package_location_id' : halt_location_id,
					'tour_master_id'	  : tour_master_id
				},
				success : function(data) {
					console.log("data in misc==="+data);
					console.log($(miscsid).select2("data"));
					$(miscsid).empty();
					//$(attractionsid).select2("val", "");
					console.log($(miscsid));
					$.each(data, function(k, v) {
						console.log(k);
						console.log(v);
						$(miscsid).append($("<option></option>").attr("value", k).text(v));
					});
					console.log($(miscsid).select2("val"));
				}
			}); 

	},
	
	PackageAccomodationDelete : function(){
			$('.TourAccoDelete').click(function(e){
				 $(this).closest('.LocAccos').remove();		
				});		
	},
	PackageAccomodationAdd :function(get_acco_info_url,get_room_info_url,get_room_detail_info_url){
		$('.addMore').click(function(e){	
			e.preventDefault();		
				var id = $(this).attr('id');
				var locid = id.substring('addMore'.length - 0);	
			
			var newTextBoxDiv = $(document.createElement('div')).attr("class", 'accos');
			newTextBoxDiv.after().html('\
			<div class="col-md-12 LocAccos">\
			  	<div class="col-md-4">\
					<div class="col-md-12">\
						<div class="form-group">\
					   		<label class="control-label"> Accomodation <span class="symbol required"></span></label>\
					   		<input type="text" name="accomodation_id[]" id="accomodations_'+i+'" class="locaccomodation" tabindex="1" style="width:100%" >\
						</div>\
					 </div>\
				</div>\
				<div class="col-md-3">\
					<div class="col-md-12">\
						<div class="form-group">\
							<label class="control-label">Rooms <span class="symbol required"></span></label>\
							<select name="room_id[]" class="rooms form-control " id="rooms_'+i+'"></select>\
						</div>\
					</div>\
				</div>\
				<div class="col-sm-2">\
					<label class="control-label">Max no of People</label>\
					<input type="text" name="no_of_people" id="no_of_people_'+i+'" class="form-control no_of_people" readonly="readonly" >\
				</div>\
				<div class="col-sm-2">\
					<label class="control-label">Food Plan</label>\
					<input type="text" name="food_plan" id="food_plan_'+i+'" class="form-control food_plan" readonly="readonly" >\
				</div>\
				<div class="col-md-1">\
					<div class="rowTourAccodel form-group" style="padding-top: 28px;">\
						<label class="control-label">&nbsp; </label>\
						<a id="TourAccoDelete" class="TourAccoDelete"> <span class="glyphicon glyphicon-trash" title="Delete" aria-hidden="true"></span></a>\
					</div>\
				</div>\
			</div>');
														
			var appended_div = $("#TextBoxesGrouploc"+locid);
			newTextBoxDiv.appendTo(appended_div);
						
					
			var newaccomodationsid = $(newTextBoxDiv).find('.locaccomodation');
			$(newaccomodationsid).select2("val", "");
			PackageApp.PackageAccomodationPopulate(newaccomodationsid,'',get_acco_info_url,get_room_info_url,get_room_detail_info_url);

			$("div#TextBoxesGrouploc" + locid + " > div.accos").find('.rooms').on('change', function() {
				var id = $(this).attr('id');
				var val = $(this).val();
				if (id) {
					PackageApp.PackageFoodplanPopulate(get_room_detail_info_url,val,$(this));
				}
			});
			PackageApp.PackageAccomodationDelete(); 
											
			});
		
		
	},
	PackageAccomodationPopulate : function(accoid,initvalue,get_acco_info_url,get_room_info_url,get_room_detail_info_url){
		var tmi = $('.acco_tour_master_id').val();
			$(accoid).select2(
			{
			placeholder: "Select an Accomodation",
			initSelection: function (element, callback) {
			callback(initvalue);
			},
			minimumInputLength: 0,
			//multiple:true,
			
			ajax: { 
						url: function(){ 
							console.log($(this));
							return get_acco_info_url +$(this).parents('.locationAcco').find('.locid').val()+'/'+tmi 
							},
						dataType: 'json',
						quietMillis: 250,
						data: function(term, page) {
							return {
								name : term, // search term
							};
						}, results: function (data, page) {
							//console.log(data);
							return {
								results : data.items
							};
						}, cache:true
					},
		formatResult: repoFormatResult,
		formatSelection: repoFormatSelection, 
		dropdownCssClass: "bigdrop", 
		escapeMarkup: function(m) {
			return m;
		}, 
		maximumSelectionLength: 2,
		}).on('change', function() {	
			var id = $(this).attr('id');
			var acco_id = $(this).val();
			if (id) {
				PackageApp.PackageRoomPopulate(get_room_info_url,$(this),acco_id,get_room_detail_info_url);				
			}
		});
	},
	
	PackageRoomPopulate : function(get_room_info_url,sel,accoresult,get_room_detail_info_url){
		$.ajax({
				url : get_room_info_url + accoresult,
				type : "get",
				success : function(data) {
					
					var roomsid = $(sel).parents("div.accos").find('.rooms');
					$(roomsid).empty();	
					
					$(roomsid).append($("<option value='0'>Select Rooms</option>"));								
					$.each(data, function(k, v) {	
						$(roomsid).append($("<option></option>").attr("value", k).text(v));						
					});

					$(roomsid).on('change', function() {			
						var id = $(this).attr('id');
						var val = $(this).val();
						if (id) {		
							PackageApp.PackageFoodplanPopulate(get_room_detail_info_url,val,$(this));
						}
					});
				}
			});
		
	},
	PackageFoodplanPopulate : function(get_room_detail_info_url,roomresult,sel){
		
		$.ajax({
				url : get_room_detail_info_url+roomresult,
				type : "get",
				success : function(data) {
					console.log(sel.parents('.accos').find('.food_plan'));					
					var foodplanid =sel.parents("div.accos").find('.food_plan').val(data.business_value);					
					var no_of_peopleid = sel.parents("div.accos").find('.no_of_people').val(data.max_occupancy);	
				}
			});
		
	},
	
	PackageItineraryLoad : function(data,page) {
		console.log("inside PackageItineraryLoad");
		console.log(data);
		$('.pack_add_four').show();
		
	
		compactCallHandlebars("#Itinerarydiv", "Itinerarytemplate", [], data);
		
		CKEDITOR.disableAutoInline = true;
        $('textarea.ckeditor').ckeditor();

		FormWizard.init($('#wizard'), $('#form'));
		FormValidator.init();
		$('select.search-select').select2();
		$('.time-picker').timepicker();

		$('#itinerary_tour_master_id').val(data.tour_master_id);
		$('#no_of_days').val(data.no_of_days);

		var pickup_locationid = $('.daysteps').find('#itinerary_pickup_location');
		$(pickup_locationid).select2("val", data.pick_up_location);

		var sublocationid = $('.daysteps').find('#itinerary_pickup_sublocation');
		PackageApp.PackageMasterLocationChange(data.pick_up_location, master_loc_url, sublocationid, function() {
				console.log("data.pickup_sublocation === "+data.pickup_sublocation);
				$(sublocationid).select2("val", data.pickup_sublocation);
			});
		
		var halt_location_id = $('.daysteps').find('#halt_location');
		$(halt_location_id).empty();
		$(halt_location_id).append($("<option value='0'>Select location</option>"));
		$.each(data.drop_locations, function(k, v) {
			$(halt_location_id).append($("<option></option>").attr("value", k).text(v));
		});

		$('.itinerary_pickup_location').on('change', function() {
			
			var loc_value = $(this).val();
			var sublocationid = $('.daysteps').find('#itinerary_pickup_sublocation');
			PackageApp.PackageMasterLocationChange(loc_value, master_loc_url, sublocationid);

		});

		$('.halt_location').on('change', function() {
			var locArray 	=	$('#locations_id').val();
			console.log(locArray);

			var parentdiv = $(this).parents('.daysteps');
			var attractionsid = parentdiv.find('#attractions');
			var miscsid = parentdiv.find('#miscs');
			//var halt_location_id = $(this).parents('.daysteps').find('#halt_location').val();
			PackageApp.PackageLocAttractionPopulate(locArray, get_attraction_url, attractionsid);
			PackageApp.PackageLocMiscPopulate(locArray, get_misc_url, miscsid);

		});

		$(".daysteps").on("click", ".next-step", function() {
			console.log("next clicked");
			var flag = 0;
			var last_day = data.no_of_days;
			var day =$(this);
			var next_day = day.parents('.daysteps').find('#itinerary_per_day').val();
			var next_day = parseInt(next_day)+1;
			var attractionsid = $('.daysteps').find('#attractions');
			var locArray 	=	$('#locations_id').val();
			console.log(locArray);
			//$('.daysteps').find('#itinerary_pickup_sublocation').select2("val"," ");		
			
			PackageApp.PackageItinerarySubmission(day,itinerary_url, flag, master_loc_url,'add',function(){
				
			});
				CKEDITOR.disableAutoInline = true;
        		$('textarea.ckeditor').ckeditor();
			if(next_day == last_day){		
					console.log("inside if == "+last_day);
				var halt_location_id = $('.daysteps').find('#halt_location');
				$(halt_location_id).empty();
				$(halt_location_id).append($("<option value='0'>Select location</option>"));
				$.each(data.locationlist, function(k, v) {
					$(halt_location_id).append($("<option></option>").attr("value", k).text(v));
				});	
				var halt_locationid = $('.daysteps').find('#halt_location');
				$(halt_locationid).select2("val", data.drop_location);
				PackageApp.PackageLocAttractionPopulate(locArray, get_attraction_url, attractionsid);
				PackageApp.PackageLocMiscPopulate(locArray, get_misc_url, miscsid);
			}
			

		});
		$("#finish-step").click(function(e) {
			e.preventDefault();
			var flag = 1;
			var day =$(this);		
			console.log("finish clicked");
			PackageApp.PackageItinerarySubmission(day,itinerary_url, flag, master_loc_url,'add');
		});
		
		
		$("#itinerary_cancel").click(function(e) {
				var tour_master_id = $('#tour_master_id').val();
				$('#Itinerarycollapse').removeClass('collapse in').addClass('collapse');
				if ($('.pack_add_five').css('display') == 'none') {

					$('.pack_add_five').show();
					$('#price_tour_master_id').val(tour_master_id);
					$('.tourprice').attr('data-id', 'tourmasterid=' + tour_master_id);
					price_table_fn(tour_master_id);
				}
			});
	},

	
	
	ValidateMasterPackage : function(master_url,main_content_url,vehicle_url,page){
		
		$("#addPackage").validate({
			rules : {
				title : {
					required : true,
				},
				no_of_days : {
					required : true,
					range: [1, 50],
				},
				holiday_category_id : {
					required : true,
					valueNotEquals : "0",
				},
				holiday_type_id : {
					required : true,
					valueNotEquals : "0",
				},

				pickup_location : {
					required : true,
					valueNotEquals : "0",
				},
				pickup_sublocation : {
					required : true,
					valueNotEquals : "0",
				},
				drop_location : {
					required : true,
					valueNotEquals : "0",
				},
				drop_sublocation : {
					required : true,
					valueNotEquals : "0",
				},
				'locations_id[]' : {
					required : true,
					valueNotEquals : "0",
				},
			},

			messages : {
				title : "Please enter holiday title!",
				no_of_days : 
					{ 
	                    required:"Please enter no of days!",
	                    range:"Please enter valid no of days"
	               	},            
				holiday_category_id : "Please select holiday category",
				holiday_type_id : "Please select holiday type ",
				pickup_location : "Please select pick up location",
				pickup_sublocation : "Please select pick up sublocation",
				drop_location : "Please select drop location",
				drop_sublocation : "Please select drop sublocation",
				'locations_id[]': "Please select package locations ",
				},
				submitHandler : function(form) {
             
               var formData = $("#addPackage").serialize();
               console.log(formData);
                
                request = $.ajax({
                    type : 'POST',
                    url : master_url,
                    data : formData,
                    dataType : "JSON",
                    success : function(data) {
                    	console.log(data);
                    	if(data == -1){                   		
                    		PackageApp.PackageFieldRemoveConfirm("#LocationRemoveConfirm");                 		
                    		return false;
                    	}
                    	else if(data == -2){
                    		PackageApp.PackageFieldRemoveConfirm("#DaysRemoveConfirm");         		                                 		                  		
                    		return false;
                    	}
                    	else if(data == -4){
                    		var msg = "Cant delete the locations";
                        	var div = '#PackageMessage'; 
                        	PackageApp.PackageErrorMessage(msg,div);
                        	
                        	   $('html,body').animate({
						        scrollTop: $('.pack_add_one').offset().top},
						        'slow'); 

                        	   alert('Cant delete the locations');
						        window.location.reload(); 
                    	}
                    	else if(data == -5){
                    		PackageApp.PackageFieldRemoveConfirm("#LocAddDaysRemoveConfirm");         		                                 		                  		
                    		return false;
                    	}
                    	else if(data == -6){
                    	     
                    		var msg = "Cant delete the locations";
                        	var div = '#PackageMessage'; 
                        	PackageApp.PackageErrorMessage(msg,div);
                        	
                        	   $('html,body').animate({
						        scrollTop: $('.pack_add_one').offset().top},
						        'slow'); 

                        	   alert('Cant delete the locations');
                        	   PackageApp.PackageFieldRemoveConfirm("#DaysRemoveConfirm");  

                    			return false;
                    	}
                        else if(data ==0){
                        	
                        	var msg = "Tour already exists";
                        	var div = '#PackageMessage';
                        	PackageApp.PackageErrorMessage(msg,div);
                 
                        }else{ 

                        	var msg = "Tour added succesfully";
                        	var div = '#PackageMessage'; 
                        	
                        	   $('html,body').animate({
						        scrollTop: $('.pack_add_one').offset().top},
						        'slow');                              
                         
                        	PackageApp.PackageSuccessMessage(msg,div); 
                        	if(page == 'add'){
                               
							$('#Maincollapse').removeClass('collapse in').addClass('collapse');
															
							PackageApp.showPackageMainContent(data,main_content_url);	
								
							$('.pack_main_content').show();
							$('.pack_add_two').show();
							
							$('#tour_master_id').val(data);
							$('#detail_tour_master_id').val(data);
							
							var pickup_subloc_val = $('#pickup_sublocation').val();
							var vehiclediv = "#transportation_pricing_id";
						
							PackageApp.PackageDetailVehiclePopulate(pickup_subloc_val,vehicle_url,vehiclediv);
						}

                        }
                
                      },
                    });
                }
		});
		
		
	},
	ValidateDetailPackage : function(url,acco_url,get_acco_info_url,get_room_info_url,get_room_detail_info_url,page){
			$("#TourdetailSubmit").validate({
			rules : {
				no_of_adults : {
					required : true
				},			
				food_plan :{
					required : true,
					valueNotEquals : "0",
				}
			},
			messages : {
				no_of_adults : "Please enter no of adults",
				food_plan : "Please select foodplan",				
				},
			submitHandler : function(form) {

				 var formData = $("#TourdetailSubmit").serialize();
	
				request = $.ajax({
					type : 'POST',
					url : url,
					data : formData,
					dataType : 'json',
					timeout : 3000
				});
				request.done(function(data) {
					console.log(data);
					if(data == -3){						
						var msg = "Total people greater than max occupancy of  vehicle";
                        var div = '#PackageDetailMessage';
                        PackageApp.PackageErrorMessage(msg,div);				
                        $('#transportation_pricing_id').select2("val", "");
                        return false;
					}
					
						var msg = "Details added succesfully";
                        var div = '#PackageDetailMessage';
                        PackageApp.PackageSuccessMessage(msg,div); 
                         $('html,body').animate({
						        	scrollTop: $(".pack_add_two").offset().top},
						        'slow');
                        if(page == 'add'){
					
							$('#Detailcollapse').removeClass('collapse in').addClass('collapse');								
							$('.pack_main_content').show();
							$('.pack_add_three').show();							
							$('#acco_tour_master_id').val(data.tour_master_id);				
												
			   					
						 compactCallHandlebars("#Accoaccordian", "Accoaccordiantemplate", [], data);
												
					     var newaccomodationsid = $("div.Txtboxgroup > div.accos").find('.locaccomodation');
						 $(newaccomodationsid).select2("val", "");						 
						 PackageApp.PackageAccomodationPopulate(newaccomodationsid,'',get_acco_info_url,get_room_info_url,get_room_detail_info_url);
			
						 PackageApp.PackageAccomodationAdd(get_acco_info_url,get_room_info_url,get_room_detail_info_url);				
						 PackageApp.ValidatePackageAccomodation(acco_url,'add');	
						 }	
									
				});
				return false;
			}		
		});	
		
	},
	
	ValidatePackageAccomodation : function(url,page){
		$("#TourAccoSubmit").validate({
				rules : {
					accomodation_id : {
						required : true
					},
				},

				messages : {
					accomodation_id : "Please select accomodation"
				},
				submitHandler : function(form) {

					var formData = $("#TourAccoSubmit").serialize();
					console.log(formData);

					request = $.ajax({
						type : 'POST',
						url : url,
						data : formData,
						dataType : "JSON",
						success : function(data) {
							if(data == -1){
								
								var msg = "Please select accomodation and rooms for each locations";
		                        var div = '#PackageAccoMessage';
		                        PackageApp.PackageErrorMessage(msg,div);		
								return false;
							}							
							if(data == -2){
								var msg = "Duplicate accomodation and rooms";
		                        var div = '#PackageAccoMessage';
		                        PackageApp.PackageErrorMessage(msg,div);		
								return false;
							}	
							
							  $('html,body').animate({
						        scrollTop: $('.pack_add_three').offset().top},
						        'slow');      
						        
							var msg = "Tour Accomodations added succesfully";
	                        var div = '#PackageAccoMessage';
	                        PackageApp.PackageSuccessMessage(msg,div); 
	                        if(page == 'add'){						
							$('#LocAccocollapse').removeClass('collapse in').addClass('collapse');
							$('.pack_main_content').show();
						
							PackageApp.PackageItineraryLoad(data,page);
							
							
						}else if(page =='edit'){

							var msg = "Tour Accomodations updated succesfully";
	                        var div = '#PackageAccoMessage';
	                        PackageApp.PackageSuccessMessage(msg,div); 	
					     	$('html,body').animate({
						        	scrollTop: $(".pack_add_three").offset().top},
						    'slow');

						}
							
						}
					});
				}
			});	
		},
		
		PackageItinerarySubmission : function(day,url,flag,master_loc_url,page,callback){
			console.log("inside package itinerary submission");
			
			console.log(day);
			
				var form = day.parents('form:first');
				var data = form.serializeFormJSON();
				
				console.log("formdata");
				console.log(form);
		
			 $.ajax({
					type : "POST",
					url : url,
					data : data,
					dataType : 'json'
				})
				.done(function(data) {
					console.log(data);
					
					if(flag==0){
						$('.daysteps').find('#itinerary_tour_master_id').val(data.tour_master_id);
						var pickup_locationid = $('.daysteps').find('#itinerary_pickup_location');
						console.log("flag o,add");
						console.log( data['halt_location']);
						if(page == 'add'){
							$('#wizard').smartWizard("goForward");	
						var msg = "Tour Itinerary updated succesfully";
					    var div = '#PackageItineraryMessage';
					    PackageApp.PackageSuccessMessage(msg,div); 	
					     $('html,body').animate({
						        	scrollTop: $(".pack_add_four").offset().top},
						        'slow');
					    	
												
						$(pickup_locationid).select2("val", data['halt_location']);
						$('.daysteps').find('#itinerary_pickup_sublocation').select2("val"," ");		
						
						var master_pickup_subloc_div = $('.daysteps').find('#itinerary_pickup_sublocation');
						var value = data['halt_location'];
						
						PackageApp.PackageMasterLocationChange(value,master_loc_url,master_pickup_subloc_div);
						}
						
						else if(page =='edit'){
							$('#wizard').smartWizard("goForward");
						var msg = "Tour Itinerary updated succesfully";
					    var div = '#PackageItineraryMessage';
					    PackageApp.PackageSuccessMessage(msg,div); 	
					     $('html,body').animate({
						        	scrollTop: $(".pack_add_four").offset().top},
						        'slow');
					     
					     $(pickup_locationid).select2("val", data['halt_location']);
						$('.daysteps').find('#itinerary_pickup_sublocation').select2("val"," ");		
						
						var master_pickup_subloc_div = $('.daysteps').find('#itinerary_pickup_sublocation');
						var value = data['halt_location'];
						
						PackageApp.PackageMasterLocationChange(value,master_loc_url,master_pickup_subloc_div);
					    	
						// var db_itinerary_pickup_loc = 	$('#itinerary_pickup_location').val();						
						// 	if(db_itinerary_pickup_loc != data['halt_location'])
						// 	{	
						// 		var pickup_sublocationid = $('.daysteps').find('#itinerary_pickup_sublocation');
						// 		PackageApp.PackageMasterLocationChange(data['halt_location'],master_loc_url,pickup_sublocationid);				
						// 	}
						// 	if(db_itinerary_pickup_loc == ""){
						// 		$(pickup_locationid).select2("val", data['halt_location']);
						// 		var pickup_sublocationid = $('.daysteps').find('#itinerary_pickup_sublocation');
						// 		PackageApp.PackageMasterLocationChange(data['halt_location'],master_loc_url,pickup_sublocationid);		
						// 	}
							
						}
						
					}else if(flag==1){
						if(page=='add'){
							$(pickup_locationid).select2("val", data['halt_location']);
							$('.daysteps').find('#itinerary_pickup_sublocation').select2("val"," ");		

							var msg = "Tour Itinerary completed succesfully";
							    var div = '#completed_messages';
							    PackageApp.PackageSuccessMessage(msg,div); 
								  $('html,body').animate({
						        	scrollTop: $("#finish-step").offset().top-80},
						        'slow');
							console.log("finish flag = add");
							$('#Itinerarycollapse').removeClass('collapse in').addClass('collapse');
							if ($('.pack_add_five').css('display') == 'none') {
								$('.pack_add_five').show();
								$('#price_tour_master_id').val(data.tour_master_id);
								$('.tourprice').attr('data-id', 'tourmasterid=' + data.tour_master_id);
								price_table_fn(data.tour_master_id);
							}
						}else if(page =='edit'){
								var msg = "Tour Itinerary completed succesfully";
							    var div = '#completed_messages';
							    PackageApp.PackageSuccessMessage(msg,div); 
								  $('html,body').animate({
						        	scrollTop: $("#finish-step").offset().top-80},
						        'slow');
							
						}
					}
					if (null != callback) {
						callback();
					};
					
					
				});
			
			
		},
	
	PackageFieldRemoveConfirm : function(confirmdiv){
		
		 			$(confirmdiv).modal('show');
		
	},
	PackageLocationRemoveConfirmTrue : function(loc_ids,url,tour_master_id,main_content_url,page,edit_package_url){		
					$.ajax({
								type : 'GET',
								url : url + tour_master_id,
								data : {
									locations_id : loc_ids
								},
								dataType : 'json',
								success : function(data) {
									if(page=='add'){
																				
								 $('#TourdetailSubmit').trigger("reset");
								 $('#TourAccoSubmit').trigger("reset"); 
								 $('#form').trigger("reset");
								 
			                      PackageApp.showPackageMainContent(tour_master_id,main_content_url);
			                      
			                     $("#pack_add_three").load(location.href + " #pack_add_three");
			                     $(".pack_add_four").load(location.href + " .pack_add_four");
			                     $(".pack_add_five").load(location.href + " .pack_add_five");		                        
									
									
								 $(".pack_add_three").hide();
						         $(".pack_add_four").hide();
						         $(".pack_add_five").hide();
						          //  addAccoValidation();
						          
						         }else if (page =='edit'){
						         		window.location.href = edit_package_url+tour_master_id;
						         }
						                           								
								}
							});
		
	},
	PackageDaysRemoveConfirmTrue : function(noofdays,url,tour_master_id,main_content_url,page,edit_package_url){
		
				$.ajax({
						type : 'GET',
						url : url + tour_master_id,
						data : {
							no_of_days : noofdays
						},
						dataType : 'json',
						success : function(data) {
									if(page == 'add'){
							
                          			PackageApp.showPackageMainContent(tour_master_id,main_content_url);

									  $('#form').trigger("reset");
		                              $(".pack_add_four").load(location.href + " .pack_add_four");
									  $('#Itinerarycollapse').removeClass('collapse').addClass('collapse in');
		                            
		                              $('html,body').animate({
		                                scrollTop: $(".pack_add_three").offset().top},
		                              500);		
		                              			
		                           PackageApp.PackageItineraryLoad(data,page);
		                           }else if(page == 'edit'){

		                           		console.log("in edit package days ..."+data);

		                           	window.location.href = edit_package_url+tour_master_id;
		                           }

						
						}
					});
		
	},
	PackageLocAddDaysRemoveConfirmTrue : function(loc_ids,noofdays,url,tour_master_id,main_content_url,page,edit_package_url){
		
				$.ajax({
						type : 'GET',
						url : url + tour_master_id,
						data : {
							no_of_days : noofdays,
							locations_id : loc_ids
						},
						dataType : 'json',
						success : function(result) {

								console.log(result);
								console.log(page);
									if(page == 'add'){
							
                          			PackageApp.showPackageMainContent(tour_master_id,main_content_url);

		                         $('#form').trigger("reset");  
		                         $('#TourdetailSubmit').trigger("reset");
								 $('#TourAccoSubmit').trigger("reset"); 
								 
			                      
			                     $("#pack_add_three").load(location.href + " #pack_add_three");
			                     $(".pack_add_four").load(location.href + " .pack_add_four");
			                     $(".pack_add_five").load(location.href + " .pack_add_five");		                        
									
									
								 $(".pack_add_three").hide();
						         $(".pack_add_four").hide();
						         $(".pack_add_five").hide();

						          $('#Itinerarycollapse').removeClass('collapse').addClass('collapse in');
		                            
		                              $('html,body').animate({
		                                scrollTop: $(".pack_add_three").offset().top},
		                              500);		
		                              			
		                           PackageApp.PackageItineraryLoad(result,page);


		                           }else if(page == 'edit'){

		                           		console.log("in edit package days ..."+result);

		                           	window.location.href = edit_package_url+tour_master_id;
		                           }

						
						}
					});
		
	},




	GetWanderfirstRate : function(original_selling_price,service_tax,wanderfirst_commission,service_charge,discount){
				var price_before_tax = 0.0;
				var wanderRate = 0.0;	

				console.log("1:: st: "+ service_tax + ", wc: " + wanderfirst_commission +", sc: "+service_charge +", dis: " + discount);
				service_tax 			= typeof (service_tax !== 'undefined')  && service_tax !== '' ? parseFloat(service_tax) : 0.0;
				wanderfirst_commission  = typeof (wanderfirst_commission !== 'undefined')  && wanderfirst_commission !== "" ? parseFloat(wanderfirst_commission) : 0.0;
				service_charge 			= typeof (service_charge !== 'undefined')  && service_charge !== ''  ? parseFloat(service_charge) : 0.0;
				discount 				= typeof (discount !== 'undefined') && discount !== '' ? parseFloat(discount) : 0.0;

				console.log("2:: st: "+ service_tax + ", wc: " + wanderfirst_commission +", sc: "+service_charge +", dis: " + discount);
				price_before_tax += (original_selling_price*(1 + (wanderfirst_commission/100))) ;
				price_before_tax +=  service_charge; 
				price_before_tax -=  discount;
				console.log("price_before_tax :" + price_before_tax + ", service_tax: "+service_tax);
				wanderRate += price_before_tax * (1 + (service_tax/100));


				// var price_before_tax = original_selling_price/(1 + (service_tax/100));
				// wanderRate = price_before_tax/(1 + (wanderfirst_commission/100));
			
				$('#wanderfirst_rate').val(wanderRate);	

	},

	PackageErrorMessage:function(error_message,error_div){
		 $(error_div).show();
		 $(error_div).removeClass().addClass('alert alert-error').html(error_message);
         $(error_div).delay(3200).fadeOut(300);		
         
	},
	
	PackageSuccessMessage:function(success_message,success_div){
		 $(success_div).show();
		 $(success_div).removeClass().addClass('alert alert-success').html(success_message);
         $(success_div).delay(3200).fadeOut(300);
			
	}
	
	
	
	
	
};