var App = {


	populateFavicon : function(){
		var domain      =   location.origin;

		if(domain == "http://wf.testbedbox.com/" || domain == "http://preprod.wf.testbedbox.com/" ){
			var baseCDNURL  =   "https://cdn.testbedbox.com/";

		}else if(domain == "http://wanderfirst.info/" || domain == "http://preprod.wanderfirst.info/"){
			   var baseCDNURL  =   "https://cdn.wanderfirst.info/";

		}else if(domain == "http://wanderfirst.com/" || domain == "http://preprod.wanderfirst.com/"){
			   var baseCDNURL  =   "https://cdn.wanderfirst.com/";

		}else{
			   var baseCDNURL= "https://cdn.wanderfirst.info/";
		}

		console.log(baseCDNURL);


		var div_data ='<link rel="apple-touch-icon-precomposed" sizes="57x57" href="'+baseCDNURL+'/favicons/apple-touch-icon-57x57.png" />\
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'+baseCDNURL+'/favicons/apple-touch-icon-114x114.png" />\
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'+baseCDNURL+'/favicons/apple-touch-icon-72x72.png" />\
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'+baseCDNURL+'/favicons/apple-touch-icon-144x144.png" />\
		<link rel="apple-touch-icon-precomposed" sizes="60x60" href="'+baseCDNURL+'/favicons/apple-touch-icon-60x60.png" />\
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="'+baseCDNURL+'/favicons/apple-touch-icon-120x120.png" />\
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="'+baseCDNURL+'/favicons/apple-touch-icon-76x76.png" />\
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="'+baseCDNURL+'/favicons/apple-touch-icon-152x152.png" />\
		<link rel="icon" type="image/png" href="'+baseCDNURL+'/favicons/favicon-196x196.png" sizes="196x196" />\
		<link rel="icon" type="image/png" href="'+baseCDNURL+'/favicons/favicon-96x96.png" sizes="96x96" />\
		<link rel="icon" type="image/png" href="'+baseCDNURL+'/favicons/favicon-32x32.png" sizes="32x32" />\
		<link rel="icon" type="image/png" href="'+baseCDNURL+'/favicons/favicon-16x16.png" sizes="16x16" />\
		<link rel="icon" type="image/png" href="'+baseCDNURL+'/favicons/favicon-128.png" sizes="128x128" />\
		<meta name="application-name" content="&nbsp;"/>\
		<meta name="msapplication-TileColor" content="#FFFFFF" />\
		<meta name="msapplication-TileImage" content="'+baseCDNURL+'/favicons/mstile-144x144.png" />\
		<meta name="msapplication-square70x70logo" content="'+baseCDNURL+'/favicons/mstile-70x70.png" />\
		<meta name="msapplication-square150x150logo" content="'+baseCDNURL+'/favicons/mstile-150x150.png" />\
		<meta name="msapplication-wide310x150logo" content="'+baseCDNURL+'/favicons/mstile-310x150.png" />\
		<meta name="msapplication-square310x310logo" content="'+baseCDNURL+'/favicons/mstile-310x310.png" /> ';
		$('head').append(div_data);

	},
   loadqaBanner : function(){
		var domain = document.location.hostname;
		if(domain == "bo-qa01.wanderfirst.com") {
		     $(window).load(function () {

			if($(".navbar").hasClass(".qa_banner_top")){
				console.log("do Nothing");
			}else{
				 var top_div =  '<div class="qa_banner_top">\
						        	 <marquee> ! ! ! CAUTION : STAGING ENVIRONMENT ! ! !  </marquee>\
						        </div>';
		           $('.navbar').prepend(top_div);
			}

		     
		    });
	
		}
	},


	
	/*/////////////////////////////////////////////REGISTER COUNTRY STATE /////////////////////////////*/
	
	registerCountryChange : function(url) {
		$('#scountry').on('change', function() {
			console.log("inside script");
			var id = $(this).val();
			console.log(id);
			
			App.getRegCountryChange(url, id);

		});
	},
	getRegCountryChange: function(url, id, callback){
			$.ajax({
				url : url,
				type : "get",
				data : {
					'country_id' : id
				},
				success : function(data) {
					//console.log("success function");

					var subcat = $('#sstate').empty();
					$.each(data, function(k, v) {
						$("#sstate").append($("<option></option>").attr("value", k).text(v));
					});
					//console.log("Success");
					if(null != callback){
						callback();
					}
					

				}
			});
	},
	
	registerStateChange : function(url) {
		$('#sstate').on('change', function() {
			console.log("inside script");
			var id = $(this).val();
			console.log(id);
			
			App.getRegStateChange(url, id);

		});
	},
	getRegStateChange: function(url, id, callback){
			$.ajax({
				url : url,
				type : "get",
				data : {
					'state_id' : id
				},
				success : function(data) {
					//console.log("success function");

					var subcat = $('#scity').empty();
					$.each(data, function(k, v) {
						$("#scity").append($("<option></option>").attr("value", k).text(v));
					});
					$("#scity").append($("<option value='0'>Other city</option>"));
					
					if($('#scity option:selected').val() == "0"){
						$('.other_city').show();
						}else{
							$('.other_city').hide();
						}
					
					//console.log("Success");
					if(null != callback){
						callback();
					}

				}
			});
	},
	/*///////////////////////////////////////ONCHANGE COUNTRY STATE/////////////////////////////////////////////////*/
	getCountryChange : function(url) {
		$('#country').on('change', function() {
			console.log("inside script");
			var id = $(this).val();
			console.log(id);

			$.ajax({
				url : url,
				type : "get",
				data : {
					'country_id' : id
				},
				success : function(data) {
					//console.log("success function");

					var subcat = $('#state').empty();
					$.each(data, function(k, v) {
						$("#state").append($("<option></option>").attr("value", k).text(v));
					});
                    return 'a';
				}
			});
		});
	},

	getStateChange : function(url) {
		var state = $('#state').on('change', function() {
			console.log("aaaaaaa");
			var id = $(this).val();
			console.log(id);

			$.ajax({
				url : url,
				type : "GET",
				data : {
					'state_id' : id
				},
				dataType : 'JSON',
				success : function(data) {
					var subcity = $('#city').empty();
					$.each(data, function(k, v) {
						$("#city").append($("<option></option>").attr("value", k).text(v));
					});
					$("#city").append($("<option value='0'>Other city</option>"));
					
					if($('#scity option:selected').val() == "0"){
						$('.other_city').show();
						}else{
						$('.other_city').hide();
						}

				}
			});
		});

	},
	
	getLocationChange : function(url) {
		$('.location').on('change', function() {		
			$("#sublocation").select2("val", "");
			var sublocation = $("#sublocation").empty();
				var result = $('#location').val();
			//	var loc_text = $("#location option:selected").text();
				$.ajax({
				url : url,
				type : "get",
				data : {
					'location_id' : result
				},
				success : function(data) {
					var sublocation = $("#sublocation").empty();
					$("#sublocation").append($("<option value='0'>Add the parent location</option>"));
					$.each(data, function(k, v) {
						$("#sublocation").append($("<option ></option>").attr("value", k).text(v));
					});
				}
			});								
		});
		
		
	},
	getPackageLocationChange : function(url) {
		$('.location').on('change', function() {
			
			var id = $(this).attr('id');

			if(id){
				var newid = id.substring('package_location_'.length - 1 );
				var locationid = "#pickup_location_"+newid;
				var result = $(locationid).val();
				$.ajax({
				url : url,
				type : "get",
				data : {
					'location_id' : result
				},
				success : function(data) {
					var sublocationid = "#pickup_sublocation_"+newid;
					var sublocation = $(sublocationid).empty();

					$.each(data, function(k, v) {
						$(sublocationid).append($("<option></option>").attr("value", k).text(v));
					});
				}
			});						
		 }			
		});
	},
		
	
	/*/////////////////////////////////////MULTIPLE IMAGE UPLOAD///////////////////////////////////////////////////*/
	

	uploadImage : function(url,token,delImageurl,type) {
		Dropzone.autoDiscover = false;
		var imagename = [];
		var imageurl = [];
		var height = [];
		var width = [];

		var myDropzone = new Dropzone("div#dropzoneFileUpload", {
			paramName : "file", // The name that will be used to transfer the file
			maxFilesize : 5, // MB
			addRemoveLinks : true,
			url : url,
			params : {
				_token : token,
				type   : type
			},
			success : function(file, response) {
				console.log(file.previewElement);
				if(response.failure =="true")
				{
					var message = "Please input images with correct aspect ratio";
					$('#ImageMessage').removeClass().addClass('alert alert-warning').html(message);
					$('#submit').attr('disabled','disabled');
					$(file.previewElement).addClass('error');	
					return false;
				}			
				
				imagename.push(response.file_name);

				console.log(imagename);
				 $('.imagenames').val(imagename);
				 
				 imageurl.push(response.file_url);
				 $('.imageurls').val(imageurl);

				 width.push(response.width1);
				 $('.width').val(width);

				 height.push(response.height1);
				 $('.height').val(height);
				 
				$(".dz-progress").remove();

				//console.log(response.file_name);

				/*
				$('.dz-remove').click(function(event) {
									
								});*/
				
			},	
			removedfile: function(file) {
				console.log(file.fid.file_name);
				console.log(file);
				if(file.fid.failure !='true')
				{
					console.log("inside remove file");
					var imagenames = $('.imagenames').val();
					imagename = imagenames.split(',');
					var removedfilename = file.fid.file_name;
					imagename.splice( $.inArray(removedfilename,imagename) ,1 );
					$('.imagenames').val(imagename);
					
					//console.log('aaaa'+array);
					//var url = location.protocol + "//" + location.host + "/imagestore/280/" + removedfilename ;
					var url = file.fid.file_url;
					var imageurls = $('.imageurls').val();
					imageurl = imageurls.split(',');
					imageurl.splice( $.inArray(url,imageurl) ,1 );
					$('.imageurls').val(imageurl);

					var imgheight = file.fid.height1;
					console.log(imgheight);
					var imageheight = $('.height').val();
					height = imageheight.split(',');
					height.splice( $.inArray(imgheight,height) ,1 );
					$('.height').val(height);

					var imgwidth = file.fid.width1;
					var imagewidth = $('.width').val();
					width = imagewidth.split(',');
					width.splice( $.inArray(imgwidth,width) ,1 );
					$('.width').val(width);
				}

				 var _ref;
			        if ((_ref = file.previewElement) != null) {
			          _ref.parentNode.removeChild(file.previewElement);
			        }
        			if (!$(file.previewElement).hasClass('error')) 
        			{
						deletefile(file.fid.file_name,delImageurl,type);
					}
					console.log(file.previewElement);
			        if ( $('.dropzone').children().hasClass('error'))
			        {
			          var message = "Please input images with correct aspect ratio.";
			          $('#ImageMessage').removeClass().addClass('alert alert-warning').html(message);
			        }
			        else
			        {
			          var message = "Images have correct aspect ratio.";
			          $('#ImageMessage').removeClass().addClass('alert alert-warning').html(message);
			          $('#submit').removeAttr('disabled');
			        }
			}	
		});
window.dropzone = myDropzone;
	},
	selectAll : function(){
		 $('#selecctall').click(function(event) {  //on click
                    if (this.checked) { // check select status
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = true;  //select all checkboxes with class "checkbox1"              
                        });
                    } else {
                        $('.checkbox1').each(function() { //loop through each checkbox
                            this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                        });
                    }
                });		
	},
	deleteImage : function(url){
                    $("#del_all").on('click', function(e) {
                    e.preventDefault();
                    var checkValues = $('.checkbox1:checked').map(function()
                    {
                        return $(this).val();
                    }).get();
                    console.log(checkValues);
                    
                    $.each( checkValues, function( i, val ) {
                        $("#"+val).remove();
                        });
//                    return  false;
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: 'ids=' + checkValues
                    }).done(function(data) {
                        $("#respose").html(data);
                        $("#checkboxlist").load(location.href + " #checkboxlist");
                        $('#selecctall').attr('checked', false);
                    });
                }); 
          		
          		
	},
	resetcheckbox : function(){
		$('input:checkbox').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                   });
	},
	/*////////////////////////////////////////MULTIPLE CONTACT DETAILS ADD///////////////////////////*/
	

	getMultipleContactDiv : function(counter){
		$("#multiaddButton").click(function() {

			$('.btnDel').show();
			var counter = $('#counter').val();

			if (counter == 10) {
				alert("Only 10 textboxes allow");
				return false;
		}
			counter = parseInt(counter) +1;
			$("#counter").val(counter);
	var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter).attr("class",'contact_delete');
	newTextBoxDiv.after().html('<div class="row">\
									<div class="col-md-4">\
										<div class="form-group">\
											<label class="control-label">Contact Name</label>\
									<input type="text" name="contact_name[' + counter + ']" id="name" class="name form-control" value="">\
									</div>\
									</div>\
									<div class="col-md-3">\
										<div class="form-group">\
											<label class="control-label">Phone number</label>\
											<input type="text" name="contact_phone[' + counter + ']" id="phone" class="phone form-control" value="">\
										</div>\
									</div>\
									<div class="col-md-4">\
										<div class="form-group">\
											<label class="control-label">Email address </label>\
	<input type="text" name="contact_email[' + counter + ']" id="email" class="email form-control" value="">\
										</div>\
									</div>\
									<div class="col-md-1">\
									<div class="rowdel form-group" style="padding-top: 28px;">\
										<label class="control-label">&nbsp; </label>\
										<a id="remScnt" class="remScnt"> <span class="glyphicon glyphicon-trash" title="Delete" aria-hidden="true"></span></a>\
									</div>\
								</div>\
									</div>');
	newTextBoxDiv.appendTo("#TextBoxesGroup");
	});
			
			
			
	},
	RemoveMultipleContactDiv : function(){

		$("#multiremovebutton").click(function() {
			var counter = $('#counter').val();
		
		if (counter == 1) {
			alert("No more textbox to remove");
			return false;
		}
			$("#TextBoxDiv" + counter).remove();
			$('.btnDel').attr('disabled', (counter < 2));
		
		counter = parseInt(counter) -1;
		$("#counter").val(counter);
		
			if(counter ==1){
			$('.btnDel').hide();
			}
		
		});
	
	
},

deleteContactRow : function(){
	
		$("#TextBoxesGroup").on("click", ".remScnt", function(e){
			var counter = $('#counter').val();
			 $(this).closest(".contact_delete").remove();
			 counter = parseInt(counter) -1;

			$("#counter").val(counter);
			var contact_id = $('#contact_id').val();
			console.log(contact_id);
			
			
	});
	
},
validatename : function(){
	
	$("#TextBoxesGroup").on("blur", ".name", function(e) {

			var inputname = $(this).val();
			if(inputname.length == ""){
			$('.sucmessage').show();
				var message = "Name field could not empty";
				$('#successmessage').html(message); 
				$(this).focus();
				return false;  
		}
			
			
	});
	
	
},
validatephone : function(){
	
	
		$("#TextBoxesGroup").on("blur", ".phone", function(e) {

			var inputphone = $(this).val();
			inputphone = inputphone.replace(/[^\d]/g, "");

			// var phoneno = /^(\+?0-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/;
			if (inputphone.length == 0 || inputphone.length > 9 ) {
				$('.sucmessage').hide();
				console.log("correct");
				return true;
			} else {
				$('.sucmessage').show();
				var message = "Not a valid phone number";
				$('#successmessage').html(message);
				//$(this).focus();
				return false;

			}

		}); 

	
},

validateemail : function(){
	
	$("#TextBoxesGroup").on("blur", ".email", function(e) {
		
		var inputemail = $(this).val();
		// if(inputemail.length == ""){
		// 	$('.sucmessage').show();
		// 		var message = "Please enter email address";
		// 		$('#successmessage').html(message); 
		// 		$(this).focus();
		// 		return false;  
		// }
		
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		if(inputemail.length == 0 || inputemail.match(mailformat))  
		{  
				$('.sucmessage').hide();
				console.log("correct");
				return true;
		}  
		else  
		{ 
				$('.sucmessage').show();
				var message = "Invalid email address";
				$('#successmessage').html(message); 
				$(this).focus();
				return false;  
		}  
		
	
		
		
	});	
},

calculateSRP : function(cost_price,wfc){
	var wfpercent = cost_price*wfc/100;
	var srp = parseFloat(cost_price) + parseFloat(wfpercent);
	return srp;

},
nextdayset : function(indt,interval){

		var parts = indt.split("-");
		var stdate = new Date(parts[2] + '-' + parts[1] + '-' + parts[0]);		 					
		var enddt = new Date(stdate);
		
		enddt.setDate(enddt.getDate() + interval);
		var end_date = moment(enddt).format("DD-MM-YYYY");
		console.log("inside nextdayset  end date ======"+end_date);
		return end_date;
				
}






	
	
	
};
