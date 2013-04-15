function allow_submit(s) {
	allow_submit.allow = allow_submit.allow || false; 
	if(s == true) allow_submit.allow = true;
	else if(s == false) allow_submit.allow = false;
	else return allow_submit.allow;
}  
$('#reviews_user_review_panel_stars').raty({
	score : $('#reviews_user_review_panel_score').val(),
	readOnly: $('#reviews_user_review_panel_comment_section textarea').attr('readonly')? true : false
});
if($('#reviews_user_review_panel_score').val()!=0 && typeof(allow_comment) !== 'undefined' && $.isFunction(allow_comment))
{
	allow_comment(true); 
};

$("#reviews_user_review_panel_ajax").submit(function(e)
{
	if(!allow_submit()){
		alert("Must finish the video.");	
		e.preventDefault(); 
	}
	else
	{
		var json_review = new Object();
		var score = $("#reviews_user_review_panel_stars").raty('score');
		var vid   = $("#reviews_user_review_panel_review_video_id").val();
		json_review.score = score;
		json_review.vid = vid;
		json_review.ans = new Object();
		$('#reviews_user_review_panel_question_section li').each(function(index) {
			var q_num = index+1+"";
			var ans = $("input[name='question_"+ q_num +"']:checked").val();
			var qid = $("input[name='question_"+ q_num +"']").parent().attr("qid");
			json_review.ans[qid] = ans;
		});
		$.post("<?php echo site_url('reviews/reviews_user/review_submit')?>", { 'review': json_review, 'comment':'' }, function(result) {
			if(result == true)
			{
				alert("Thank you! Your review is submitted. and you  got  the points of this video");
				if (typeof(allow_comment) !== 'undefined' && $.isFunction(allow_comment))
				{
					allow_comment(true);
				}
			}
			
			else
			alert("Please complete all fields.");
		})
		.error(function() { alert("Submit failed."); })
		e.preventDefault(); 
	}
});

