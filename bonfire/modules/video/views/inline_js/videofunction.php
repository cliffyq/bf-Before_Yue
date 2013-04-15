_V_("video_show").ready(function(){ var myPlayer = this;
	if($('#'+$(myPlayer).attr('id')).hasClass('scrollable')){
		if(typeof(allow_submit) !== 'undefined' && $.isFunction(allow_submit)) {
		allow_submit(true); }
	}

		if(!$('#'+$(myPlayer).attr('id')).hasClass('scrollable')){
			myPlayer.addClass('scrollable'); 
		}
		
		$.get("ajax/video_view_history/add_viewed_video",{'vid':$('#'+$(myPlayer).attr('id') + ' video').attr("vid")}); 
		if (typeof(allow_submit) !== 'undefined' && $.isFunction(allow_submit)) { 
			allow_submit(true);
		}
		});
		