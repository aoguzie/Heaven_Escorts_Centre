(function($){
	$.fn.loadScrollData = function(start,options) {
		var settings	=	$.extend({
			limit			:	30,
			listingId		:	'',
			loadMsgId		:	'',
			ajaxUrl			:	'',
			cat_id		    :	'',
			catsub_id		:	'',
			loadingMsg		:	'<div style:"text-align:center;">Please Wait...!</div>'
		},options);
		
		action	=	"inactive";
		
		$.ajax({
			method	:	"POST",
			data	:	{'getData':'ok','limit':settings.limit,'start':start,'cat_id':settings.cat_id,'catsub_id':settings.catsub_id},
			url		:	settings.ajaxUrl,
			success	:	function(data){
				$(settings.listingId).append(data);
				if(data == ''){
					$(settings.loadMsgId).html('');
					action = 'active';
				}else{
					$(settings.loadMsgId).html(settings.loadingMsg);
					action = "inactive";
				}
			}
		});
	
		if(action == 'inactive'){
			action = 'active';
		}
		
		$(window).scroll(function(){
			if($(window).scrollTop() + $(window).height() > $(settings.listingId).height() && action == 'inactive'){
				action  	=   'active';
				start	  	=   parseInt(start)+parseInt(settings.limit);
				setTimeout(function(){
					$.fn.loadScrollData(start,options);
				},1000);
			}
		});
					
	};
}(jQuery));