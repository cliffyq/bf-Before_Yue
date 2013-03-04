_V_("video_show").ready(function(){ var myPlayer = this;
if($('#'+$(myPlayer).attr('id')).hasClass('scrollable')){ if
(typeof(allow_submit) !== 'undefined' && $.isFunction(allow_submit)) {
allow_submit(true); } } var com_status = function(){
if(!$('#'+$(myPlayer).attr('id')).hasClass('scrollable')){
myPlayer.addClass('scrollable'); }

$.get("ajax/video_view_history/add_viewed_video",
{'vid':$('#'+$(myPlayer).attr('id') + ' video').attr("vid")}); /* if
($("#post").hasClass('disabled')){ $("#post").removeClass('disabled'); }

*/ if (typeof(allow_submit) !== 'undefined' &&
$.isFunction(allow_submit)) { allow_submit(true);
//alert(allow_submit()); } }; myPlayer.addEvent("ended", com_status);
});
