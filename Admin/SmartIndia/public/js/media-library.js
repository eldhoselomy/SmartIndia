//var imageUrl = "http://localhost/backoffice/public/assets/imagestore/280/"
var domain = location.origin;
var loaderUrl = domain+"/Wanderfirstadmin/public/assets/images/loading1.gif";

media = (function () {
	// private properties
	var gElement = null,
	fld="",
	surl ="",
	dataId=null,
	search_input="",
	rcount=0,
	curpage=-1,
	featured=null,
	ops = Object.prototype.toString;
	var target=null;
	var typ="multiple";
	var imageType = "tour",
	// private methods
	 /***
	  * Add a Single Image
	  */
	 insertImage = function (data){	
		var a = $("<div>", {class: "col-md-3 col-sm-4 gallery-img"});
		if(null != dataId && contains.call(dataId,data.id) ){
			var b = $("<div>", {class: "wrap-image selected"});
			b.append("<a class='group1 cboxElement' href='#' title='Clip-One "+data.name+"'>\
				<img src='"+encodeURI(data.url)+"' alt='' class='img-responsive selected' data-id='"+data.id+"' >\
			</a>");
		}else{
			var b = $("<div>", {class: "wrap-image"});
			b.append("<a class='group1 cboxElement' href='#' title='Clip-One "+data.name+"'>\
				<img src='"+encodeURI(data.url)+"' alt='' class='img-responsive' data-id='"+data.id+"' >\
			</a>");
		}
		

		a.append(b);
		/*b.append("<a class='group1 cboxElement' href='"+ data.url +"' title='Clip-One "+data.name+"'>\
				<img src='"+encodeURI(data.url)+"' alt='' class='img-responsive' data-id='"+data.id+"' >\
			</a>");*/
		
		var cBox = $("<div class='chkbox'></div>");
		var fnm = data.file_name;
		fnm = fnm.substr(fnm.indexOf('_')+1,35);
		var mediaName = $("<div class='mediaTitle' > <div>" +data.name + "(" + data.height +"X" +data.width + ")</div> <div>"+ fnm+"</div></div>");
		
		var c = $("<div>", {class: "tools tools-bottom"});
		//b.append(c);
		var l1 = $("<a href='#'>\
					<i class='clip-link-4'></i>\
				</a>");
		var l2 = $("<a href='#'>\
					<i class='clip-pencil-3 '></i>\
				</a>");
		var l3 = $("<a href='#'>\
					<i class='clip-close-2'></i>\
				</a>");	
		c.append(l1);	
		c.append(l2);	
		c.append(l3);
		gElement.append(a);
		if( dataId != null && contains.call(dataId,data.id))
		 	cBox.parent().addClass('selected').children('a').children('img').addClass('selected');
		b.append(cBox);
		b.append(mediaName);
		
	};
	 var runColorBox = function () {
        $(".group1").colorbox({
            rel: 'group1',
            transition: "none",
            width: "100%",
            height: "100%",
            retinaImage: true
        });
    };

    //function to Image Picker
    var runImagePicker = function () {
    	console.log('typ' + typ)
    	if(typ == 'multiple'){
        $('.wrap-image .chkbox').bind('click', function () {
            if ($(this).parent().hasClass('selected')) {
                dataId = jQuery.grep(dataId, function(value) {
  					return value != $(this).parent().children('a').children('img').attr('data-id');
				});
                $(this).parent().removeClass('selected').children('a').children('img').removeClass('selected');
            } else {
            	if(dataId == null) dataId = Array();
            	dataId.push($(this).parent().children('a').children('img').attr('data-id'));
                $(this).parent().addClass('selected').children('a').children('img').addClass('selected');
            }
        });
    	}else if (typ == 'single'){
    		 $('.wrap-image .chkbox').bind('click', function () {
    		 	
            	if ($(this).parent().hasClass('selected')) {
            		dataId == null;
                	$(this).parent().removeClass('selected').children('a').children('img').removeClass('selected');
            	} else {
            		gElement.find('.selected').each(function(){
    					$(this).removeClass('selected');
    				});
            		if(dataId == null) dataId = Array();
            		dataId[0] = $(this).parent().children('a').children('img').attr('data-id');
                	$(this).parent().addClass('selected').children('a').children('img').addClass('selected');
            	}
        	});
    	}
    };
	createGallery = function (data){
		console.log(data);
		for(i=0;i<data.length;i++){
			insertImage(data[i]);
		}
	};
	getFromUrl = function(filter){
		console.log(filter);
		$.ajax({
  			type: "POST",
  			 url: surl,
  			 data: filter,
  			 success: function(data){
  			 	if(rcount != data.count || curpage != data.page){
  			 		gElement.empty();
  			 		createGallery(data.images);
  			 		if( data.count > 12 ){
  			 			paginate(data.count,data.page);
  			 		}
  			 		runImagePicker();
  			 		$('#galCount').html(data.count + " Image Found");
  			 		console.log(data);

  			 	}
  			 	rcount = data.count;
  			 	curpage = data.page;
  			 	
  			 },
  			 dataType: 'json'
		});
	};
	//Get Imagepost for CK editor
	getImageFrmUrl = function(filter){
		console.log(search_input);
		$.ajax({
  			type: "POST",
  			 url: surl,
  			 data: filter,
  			 success: function(data){
  			 	if(rcount != data.count || curpage != data.page){
  			 		gElement.empty();
  			 		addCkImages(data.images);
  			 		if( data.count > 12 ){
  			 			ckPaginate(data.count,data.page);
  			 		}
  			 		runImagePicker();
  			 		$('#galCount').html(data.count + " Image Found");

  			 	}
  			 	rcount = data.count;
  			 	curpage = data.page;
  			 },
  			 dataType: 'json'
		});
	};
	ckPageClick = function(){
		page = $(this).attr('data-id');
		console.log(page);
		var filter = { "q": search_input.val(),"page":page };
		getImageFrmUrl(filter);
		
	};
		ckPaginate = function(count,page){
			var i = Math.ceil(count/page);
			if(i>1){  
		var ul = $('#ckPaginate'),prev,nxt;
		page = parseInt(page);
		ul.empty();
		if(page ==0 ){
			prev = $("<input class='disabled' type='button' value='&laquo; Back'/>");
		}else{
			prev = $("<input data-id='"+(page-1)+"' type='button' value='&laquo; Back'/>");
			prev.click(ckPageClick);
		}
		ul.append(prev);
		ul.append("<span>&nbsp;&nbsp; | &nbsp;&nbsp;</span>");
		var i = Math.ceil(count/page);  
		if( page == i ){
			console.log(i)
			nxt = $("<input class='disabled' type='button' value='Next &raquo;'/>");
							
		}else{
			nxt = $("<input data-id='"+(page+1)+"' type='button' value='Next &raquo;'/>");
			nxt.click(ckPageClick);
		}
		ul.append(nxt);
	}


	};
	pageClick = function(){
		page = $(this).attr('data-id');
		console.log(page);
		var filter = { "q": search_input.val(),"page":page, "imageType":imageType };
		getFromUrl(filter);
		
	};
	paginate = function(count,page){
		var ul = $('#galPaginate'),prev,nxt;
		page = parseInt(page);
		ul.empty();
		if(page ==0 ){
			prev = $("<li class='disabled'>\
							<a href='#'' aria-label='Previous'>\
								<span aria-hidden='true'>&laquo;</span>\
							</a>\
						</li>");
		}else{
			prev = $("<li data-id='"+(page-1)+"'>\
							<a href='#' aria-label='Previous'>\
								<span aria-hidden='true'>&laquo;</span>\
							</a>\
						</li>");
			prev.click(pageClick);
		}
		ul.append(prev);
		var max = Math.ceil(count/12),i,j=0;
		if(max >20 && page > 19 ){
			i = page - 19;
		}else{
			i=0;
		}
		for(;i<max;i++,j++){
			
			var li;
			if(i == page){
				li = $("<li data-id='"+i+"' class='active'><a href='#'>"+(i+1)+"</a></li>");

			}else{
				li = $("<li data-id='"+i+"'><a href='#'>"+(i+1)+"</a></li>");
			}
			li.click(pageClick);
			ul.append(li);
			if(j==19)break;
			
		}
		console.log(page)
		if( page == (max-1) ){
			console.log(i)
			nxt = $("<li class='disabled'>\
							<a href='#'' aria-label='next'>\
								<span aria-hidden='true'>&raquo;</span>\
							</a>\
						</li>");
		}else{
			nxt = $("<li data-id='"+(page+1)+"'>\
							<a href='#'' aria-label='next'>\
								<span aria-hidden='true'>&raquo;</span>\
							</a>\
						</li>");
			nxt.click(pageClick);
		}
		ul.append(nxt);


	};
	addCkImages = function (data){
		console.log(data);
		for(i=0;i<data.length;i++){
			var a = $("<div>", {class: "col-md-3 col-sm-4 gallery-img ck-img"});
			var b = $("<div>", {class: "wrap-image"});
			a.append(b);
			b.append("<a class='group1 cboxElement' href='"+ encodeURI(data.url) +"' title='Clip-One "+data[i].name+"'>\
				<img src='"+encodeURI(data.url)+"' alt='' class='img-responsive' >\
			</a>");
			var cBox = $("<div class='chkbox' style='vertical-align: middle;'></div>");
			b.append(cBox);
			gElement.append(a);
		}
	};
	deleteImage = function(node){
		var galImg = node.parents('.gallery-img');
		if(galImg.find('.star.selected').length){
			alert('You will not be able to delete a featured image.');
			return false;
		}
		if( typeof(galImg) != undefined){
			var list = fld.val();
			fld.val(removeValue(list,galImg.find('img').attr('data-id')));
			galImg.remove();
		}
	};
	removeValue = function(list, value, separator) {
  		separator = separator || ",";
  		console.log("value1:" + value);
  		var values = list.split(separator);
  		for(var i = 0 ; i < values.length ; i++) {
    		if(values[i] == value) {
    			 values.splice(i, 1);
     			 console.log(values.join(separator));
     			 return values.join(separator);
   			}
  }
  return list;
};

	searchImage = function(){
 		var filter = { "q": search_input.val(),"imageType":imageType };
 		getFromUrl(filter);
 		return true;
	};
	searchCkImage = function(){
		var filter = { "q": search_input.val() };
 		getImageFrmUrl(filter)
 		return true;
	};
	createDialog = function(){
		bd = $("<div class='dialog-body'></div>");
		srw = $("<div class='row' style='width:100%' ></div>")
		ss = $("<div class='col-sm-12' style='width:100%'></div>");
		sb = $("<div class='search-box'></div>");
		sb.append("<span>Search:</span>");
		sr = $("<input type='text' class='' />");
		sr.on('keyup', searchCkImage);
		search_input = sr;
		sb.append(sr);
		ss.append(sb);
		srw.append(ss);

		bd.append(srw);
		bd.append("<div class='row ckGallery' style='width:100%'>\
					</div>")
		return bd;
	};
	createModal = function(){
		var a = $('html body');
		b = $("<div class='modal fade medialb' style='display: none;'></div>");
		bd = $("<div class='modal-body'></div>");
		srw = $("<div class='row'></div>")
		ss = $("<div class='col-sm-12'></div>");
		sb = $("<div class='search-box'></div>");
		sb.append("<span>Search:</span>");
		sr = $("<input type='test' class='' />");
		sr.on('keyup', searchImage);
		search_input = sr;
		sb.append(sr);
		ss.append(sb);
		srw.append(ss);
		bd.append(srw);
		bd.append("<div class='row wanderGallery'><img src='"+loaderUrl+"' style='margin-left: 450px;''>\
					</div>");
		b.append(bd);

		c = $("<div class='modal-footer'></div>");
		var cl = $("<button type='button' data-dismiss='modal' class='btn btn-default'>Cancel</button>");
		var sbt = $("<button type='button' data-dismiss='modal' class='btn btn-primary' id='act_delete'>\
			    Insert</button>");
		var pagination = $("<ul class='pagination' id='galPaginate'></ul>");
		var results = $("<div class='results-count' id='galCount'></div>");
		c.append(results);
		c.append(pagination);
		sbt.click(insertBtnClk);
		c.append(cl);
		c.append(sbt);
		b.append(c);
		a.append(b);
		gElement = $('.wanderGallery');
	};
	var contains = function(needle) {
    	// Per spec, the way to identify NaN is that it is not equal to itself
   	 	var findNaN = needle !== needle;
    	var indexOf;
    	if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        	indexOf = Array.prototype.indexOf;
    	} else {
        	indexOf = function(needle) {
            	var i = -1, index = -1;
            	for(i = 0; i < this.length; i++) {
                	var item = this[i];
                	if((findNaN && item !== item) || item === needle) {
                    	index = i;
                    	break;
                	}
            	}
            	return index;
        	};
    	}
		return indexOf.call(this, needle) > -1;
	};
	imgSelNode = function(node){
		var url = node.attr('src');
		var id = node.attr('data-id');
		if(typ=='multiple')
			return $("<div class='col-md-3 col-sm-4 gallery-img'>\
						<div class='wrap-image selected'>\
							<a title='Clip-One test4' href='#' class='group1 cboxElement'>\
								<img class='img-responsive' src='"+ url+"' data-id='"+ id +"'>\
							</a>\
							<div class='delBox'><i class='clip-cancel-circle-2'></i></div>\
							<div class='star'><i class='glyphicon glyphicon-star'></i></div>\
							<div class='fet-back'></div>\
						</div>\
					</div>");
	    else
	    	return $("<div class='col-md-3 col-sm-4 gallery-img'>\
						<div class='wrap-image selected'>\
							<a title='Clip-One test4' href='#' class='group1 cboxElement'>\
								<img class='img-responsive' src='"+ url+"' data-id='"+ id +"'>\
							</a>\
							<div class='delBox'><i class='clip-cancel-circle-2'></i></div>\
						</div>\
					</div>");
	};
	//click of the modal insert button
	insertBtnClk = function(){
		var v = fld.val().split(',');
		console.log('Fld:' + fld.val() );
		gElement.find('img.selected').each(function(){
			var dId= $(this).attr('data-id');
			if( fld.val() != "" && v.length > 0 ){
				if(!contains.call(v,dId)){
					var nNode = imgSelNode($(this));
					if(typ == 'single'){
						fld.val(dId);
						target.empty();	
					}else{
						fld.val(fld.val()+ ',' + dId );
						nNode.find('.star').click(selectFeatured);
						if(!target.find('.star.selected').length){
							nNode.find('.star').addClass('selected');
							featured.val(dId);
						}
					}
						
						nNode.find('.delBox').click(function(){
							deleteImage($(this))
						});
						target.append(nNode);	
				}
			}else{
				var nNode = imgSelNode($(this));
				nNode.find('.delBox').click(function(){
							deleteImage($(this))
						});
				nNode.find('.star').click(selectFeatured);
				if(!target.find('.star.selected').length){
					nNode.find('.star').addClass('selected');
					featured.val(dId);
				}
				target.append(nNode);
				fld.val(dId);
			}
			
		});
		rcount =0;
	};
	selectFeatured = function(){
		target.find('.star').removeClass('selected');
		$(this).addClass('selected');
		featured.val($(this).parents('.gallery-img').find('img').attr('data-id'));
	},
	selectFeatured = function(){
		$('.gallery_images').find('.star').removeClass('selected');
		$(this).addClass('selected');
		$('#featured_image').val($(this).parents('.gallery-img').find('img').attr('data-id'));
	},

	init = function(data){
		console.log(data);
		if(hasProp(data,"target"))target=data.target;
		if(hasProp(data,"imgList"))fld=data.imgList;
		if(hasProp(data,"url"))surl=data.url;
		if(hasProp(data,"type"))typ=data.type;
		if(hasProp(data,"imageType"))imageType=data.imageType;
		if(hasProp(data,"featured"))featured=data.featured;
		if (gElement == null)
			createModal();
		if( fld.val() != ""){
			dataId= fld.val().split(',');	
		}
		searchImage();
	
	};
	initCk = function(p,url){
		//createModal();
		var page =0;
		gElement = p;
		surl = url;
		var filter = { "q": search_input.val(),"page":page, "imageType":imageType };
		getImageFrmUrl(filter);
	};
	//Check if a object has a property
	hasProp = function (obj, prop) {
    	var proto = obj.__proto__ || obj.constructor.prototype;
   	 	return (prop in obj) &&
        (!(prop in proto) || proto[prop] !== obj[prop]);
	};
return {
	init:init,
	insertImage: insertImage,
	createGallery:createGallery,
	getFromUrl:getFromUrl,
	createModal:createModal,
	createDialog:createDialog,
	deleteImage:deleteImage,
	
	initCk:initCk
};
}());


