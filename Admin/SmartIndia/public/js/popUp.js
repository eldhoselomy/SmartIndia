$.fn.popSelect = function(){
    this.each(function(){
        pSelect.init($(this));
        console.log('inside pop select')
    });    
};
$.fn.hasAttribute = function(name){
		var attr = $(this).attr(name);
			if (typeof attr !== typeof undefined && attr !== 'false') {
			  return true;
			}
			return false;
	}
$.fn.slideFadeToggle = function(easing, callback) {
  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
};
var pSelect = function () {
	var obj;
	var mSContainer;
	var wrapper;
	var pageSize = 12;
	var currentPage = 0;
	var insertWrapper= function(){
		wrapper = $("<div class='p-select select2-container-multi' style='border: 1px solid #d5d5d5;min-height: 30px;min-width: 100px;'></div>");
		var ul = $('<ul class="select2-choices"></ul>');
		obj.wrap(wrapper);
		obj.parent().append(ul);
		obj.parent().on('click' ,function(){
			$('.pSelect').modal();
			$('.modal').css('top',$(window).scrollTop() + ($(window).height()/4) ); 
			obj = $(this).find('select');
			currentPage=0;
			searchItem(obj);

		} );
		var arr= [];
		obj.find('option').each(function(){
  		if($(this).prop('selected') == true){
 			 arr.push( { id: $(this).val(), name:$(this).text() } );
 			var li = $('<li data-id="'+$(this).val()+'" class="select2-search-choice" ></li>');
 			$("<div>"+ $(this).text()  + "</div>").appendTo(li);
 			var a = $("<a class='select2-search-choice-close' href='#' onClick='return false;'></a>");
			a.click(function(e){
				e.stopPropagation();
				var obj = $(this).parents('.p-select').find('select');
				obj.ckBox = obj.data("values");
				console.log(obj.ckBox);
				var li =$(this).parents('li');
				var vals = [];
				for(var j=0;j<obj.ckBox.length;j++){
  				 		if(li.attr('data-id') == obj.ckBox[j].id){
  				 			obj.ckBox.splice(j, 1);
  				 			li.remove();
  				 		}else{
  				 			vals.push(obj.ckBox[j].id);
  				 		}
  				 	}
  				obj.data("values",obj.ckBox );
  				obj.val(vals)
			}); 
			
            a.appendTo(li);
			li.appendTo(ul);
		}
		});
		obj.data("values",arr ); 
				
		//$('.p-select').trigger('click')
	};

	var searchItem = function(obj){
		var url = obj.attr('select-url');
		var q = $('.select-search').val();
		$.ajax({
  			type: "POST",
  			 url: url,
  			 data: { page: currentPage, pageSize: pageSize, search: q  },
  			 success: function(data){
  			 	processData (data, obj, currentPage);
  			 },
  			 dataType: 'json'
			});
	};
   var processData = function(data, obj, page){
   	var abc = $('.mSContainer');
   	abc.empty();
   	console.log(obj.data("values"));
   	
   	if(obj.data("values") == undefined )
   		obj.ckBox = [];
   	else{
   		obj.ckBox = obj.data("values");
   	}
   	for (var i = 0; i < data.items.length ; i++) {
    	   var container = $("<div class='col-md-3' ></div>");
    	   var ckBox = $('<input />', { type: 'checkbox', id: 'cb'+data.items[i].id, value: data.items[i].name, 'data-id': data.items[i].id }).appendTo(container);
  		   $('<label />', { 'for': 'cb'+data.items[i].id, text: data.items[i].name }).appendTo(container);
  		   for(var j=0;j<obj.ckBox.length;j++){
  		   		if(data.items[i].id == obj.ckBox[j].id){
  		   			ckBox.prop("checked", true );
  		   			break;
  		   		}
  		   }
		   ckBox.click(function(){
		   		 if ($(this).is(':checked')) {
    				obj.ckBox.push({ id : $(this).attr('data-id'), name: $(this).val()});
  				 }else{
  				 	for(var j=0;j<obj.ckBox.length;j++){
  				 		if($(this).attr('data-id') == obj.ckBox[j].id){
  				 			console.log("Found:" + j);
  				 			obj.ckBox.splice(j, 1);
  				 			break;
  				 		}
  				 	}
  				 }
  				 obj.data("values",obj.ckBox );
  				 
		   })
		   abc.append(container);
	}
	
	selectPaginate(data.count,page)

	
   };
		
	var selectPaginate = function(count,page){
		$('#selectCount').html(count);
		var ul = $('#selectPaginate'),prev,nxt;
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
			prev.click(selectPageClick);
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
			li.click(selectPageClick);
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
			nxt.click(selectPageClick);
		}
		ul.append(nxt);


	};	
	

	var selectPageClick = function(){
		currentPage = 	parseInt($(this).attr('data-id'));
		console.log(currentPage);
		searchItem(obj);	
	};

	var hideObj = function(){
		obj.hide();
	};

	var createSelectModal = function(){
		var a = $('html body');
		if (! $('.pSelect')[0] ){
			console.log('I am Create');
		b = $("<div class='modal fade pSelect' style='display: none;'></div>");
		bd = $("<div class='modal-body'></div>");
		srw = $("<div class='row'></div>")
		ss = $("<div class='col-sm-12'></div>");
		sb = $("<div class='search-box'></div>");
		sb.append("<span>Search:</span>");
		sr = $("<input class='select-search' />");
		sr.on('keyup', function(){
			currentPage=0;
			searchItem(obj);
		});
		search_input = sr;
		sb.append(sr);
		ss.append(sb);
		srw.append(ss);
		bd.append(srw);
		mSContainer = $("<div class='row mSContainer'></div>");
		bd.append(mSContainer);
		b.append(bd);

		c = $("<div class='modal-footer'></div>");
		var cl = $("<button type='button' data-dismiss='modal' class='btn btn-default'>Cancel</button>");
		var sbt = $("<button type='button' data-dismiss='modal' class='btn btn-primary' id='selInsert'>\
			    Insert</button>");
		var pagination = $("<ul class='pagination' id='selectPaginate'></ul>");
		var results = $("<div class='results-count' id='selectCount'></div>");
		c.append(results);
		c.append(pagination);
		sbt.click(insertSelect);
		c.append(cl);
		c.append(sbt);
		b.append(c);
		a.append(b);
		}
	};

	var insertSelect = function(){
		obj.empty();
		var  ul = obj.parent().find('ul');
		ul.empty();
		for(var j=0;j<obj.ckBox.length;j++){
			$('<option selected="true" >').val(obj.ckBox[j].id).text(obj.ckBox[j].name).appendTo(obj);
			var li = $('<li data-id="'+obj.ckBox[j].id+'" class="select2-search-choice" ></li>');
			$("<div>"+ obj.ckBox[j].name + "</div>").appendTo(li);
			var a = $("<a class='select2-search-choice-close' href='#' onClick='return false;'></a>");
			a.click(function(e){
				e.stopPropagation();
				var obj = $(this).parents('.p-select').find('select');
				obj.ckBox = obj.data("values");
				console.log(obj.ckBox);
				var li =$(this).parents('li');
				var vals = [];
				for(var j=0;j<obj.ckBox.length;j++){
  				 		if(li.attr('data-id') == obj.ckBox[j].id){
  				 			obj.ckBox.splice(j, 1);
  				 			li.remove();
  				 		}else{
  				 			vals.push(obj.ckBox[j].id);
  				 		}
  				 	}
  				obj.data("values",obj.ckBox );
  				obj.val(vals)
			}); 
			
            a.appendTo(li);
			li.appendTo(ul);
		}
	}
	
	var parseSelect= function(){
		obj.children('option').each(function(){
			console.log($(this).html());
		});
	};

return {
			init:function(o){
				obj= o;
				console.log('inside popup');
				o.hide();
				insertWrapper();
				createSelectModal();
				//parseSelect();
				
				
				
				
			}
		}
}();