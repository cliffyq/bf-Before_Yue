 function allow_comment(s) { allow_comment.allow = allow_comment.allow
|| false; if(s == true) allow_comment.allow = true; else if(s == false)
allow_comment.allow = false; else return allow_comment.allow; }


//-------------reply button effects--------------
$('.comment_reply_effct').live('mouseover',function(){
$(this).find('#comment_action').removeClass('hidden'); //
$(this).children('#comment_body').addClass('well'); //
alert($(this).children('#comment_action').prop('tagName'));//.removeClass('hidden');
}); $('.comment_reply_effct').live('mouseout',function(){
$(this).find('#comment_action').addClass('hidden'); //
$(this).children('#comment_body').removeClass('well'); });

$("#comment_content_pagination_view_ajax_paging
a").live('click',function(event){ event.preventDefault(); //disable
default action of
<a> element // alert($(this).attr('href')); var pag_href =
	$(this).attr('href'); /* var href_values= pag_href.split("/");
	href_values.reverse(); // alert(href_values[0]); var video_id =
	href_values[2]; var per_page = href_values[1]; var offset =
	href_values[0]; // alert(video_id+per_page+offset);

	$("#comment_panel").load( 'ajax/comment/comment_views',
	{"video_id":href_values[2], "per_page":href_values[1],
	"offset":href_values[0]}, function() { alert("success"); }); */ //
	alert(pag_href); // applyPagination(pag_href); //
	alert('#reviews_user_review_panel_submit_button').attr('class'); });

	function applyPagination(pag_href,clear_textarea) { var comment_content
	= $('#video_comment textarea').val(); $("#comment_panel").load(
	pag_href, { "ajax" : 1, // "video_id" : href_values[2], // "per_page" :
	href_values[1], // "offset" : href_values[0], }, function() {
	if(clear_textarea !== true) $('#video_comment
	textarea').val(comment_content); var nav_height = 0;
	$('.navbar-fixed-top').each(function() { nav_height +=
	$(this).height(); }); var pos =
	$('#comment_panel').offset().top-nav_height - 5;
	$("html,body").scrollTop(pos); }); }

	$(".reply_action").live('click',function(){
	//alert($(this).prop('tagName')); $reply_li =
	$(this).parents('.comment_reply_effct');
	//alert($reply_li.prop('tagName')); $reply_part =
	$reply_li.children('#reply_part'); // alert($reply_part.attr('id')); //
	alert($reply_part.prop('tagName')); if($reply_part.hasClass('hidden')){
	$reply_part.removeClass('hidden'); } else{
	$reply_part.addClass('hidden');
	$reply_li.children('.alert-block').remove(); } });

	$(".reply_post").live('click',function(){
	id_values=$(this).attr('id').split("/"); var reply_to = id_values[0];
	var video_id = id_values[1]; var parent_user = id_values[2]; var
	reply_input = $(this).siblings('textarea').attr('value'); //
	alert(reply_input+' '+video_id+' '+reply_to); //
	alert(reply_input.prop('tagName')); post_comment(reply_input, reply_to,
	video_id, parent_user, $(this)); }); function post_comment(input_value,
	reply_to, video_id, parent_user, caller) { // alert(reply_to); var
	pag_href = 'ajax/comment/comment_panel'; pag_href += '/'+video_id; if
	(input_value == ''){ //alert("please type in your comments");
	caller.parent("div").before( "
	<div class='alert alert-block alert-error fade in span5'>
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
		<p>Please write a comment!</p>
		<div>
			"); } else{ $.post( 'ajax/comment/com_insert', { 'comment_content' :
			input_value, 'video_id' : video_id, 'reply_to' : reply_to,
			'parent_user' : parent_user }, function(result){ if(result == true) {
			applyPagination(pag_href, true); //refresh the page after post action
			caller.siblings('textarea').attr('value',''); alert('Thank you for
			your comment!'); } else { alert(result); } } ); } };

			$(".video_comment_post").live('click',function(){ //comment post
			button on click if(allow_comment() == false) { alert('You must review
			the video first.'); return; } var reply_to = 0; var video_id =
			$(this).attr('id'); // alert(video_id); var comment_input =
			$(this).siblings('textarea').attr('value'); var parent_user = 0;
			//var comment_input = $(".video_comment_content").attr("value");
			post_comment(comment_input, reply_to, video_id, parent_user,
			$(this)); // $(".video_comment_content").attr("value",""); }); //post
			button effect $(".video_comment_content").live('focus',function(){
			$(this).siblings('.video_comment_post').removeClass('hidden'); });
			$(".video_comment_content").live('blur',function(){ if
			($(this).attr('value') == ''){
			$(this).siblings('.video_comment_post').addClass('hidden'); } });


			$(".show_parent").live("click",function(){ parent_content =
			$(this).parents('#content'); parent_content.removeClass('span5');
			parent_content.addClass('span4 offset1'); child_comment =
			$(this).parents('.comment_reply_effct').addClass('child');
			child_comment.attr('style','color:gray'); //change style for
			temproray use, need to be deleted child_comment.before("
			<li class='comment_reply_effct load_parent'></li>"); //
			alert($(this).parents('#comment_panel').prop('tagName')); comment_id
			= $(this).attr('parent_id'); video_id = $(this).attr('video_id');
			load_href = 'ajax/comment/load_parent_ajax/'+video_id+'/'+comment_id;

			$('.load_parent').load( load_href, { }, function() {
			$('.load_parent').removeClass('load_parent'); }); $(this).empty();
			});