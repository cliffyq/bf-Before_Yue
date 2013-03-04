function allow_submit(s) { allow_submit.allow = allow_submit.allow ||
false; if(s == true) allow_submit.allow = true; else if(s == false)
allow_submit.allow = false; else return allow_submit.allow; }

if($('#reviews_user_review_panel_score').val()!='' &&
typeof(allow_comment) !== 'undefined' && $.isFunction(allow_comment)) {
allow_comment(true); }; if (!allow_comment()) {
$("#reviews_user_review_panel_toggle").css("display","block");
$('#reviews_user_review_panel_stars').raty({ score :
$('#reviews_user_review_panel_score').val(), }); } else {
$("#reviews_user_review_panel_toggle input").attr('disabled',true);
$('#reviews_user_review_panel_stars').raty({ score :
$('#reviews_user_review_panel_score').val(), readOnly: true }); }

$("#reviews_user_review_panel_flip").click(function(){
$("#reviews_user_review_panel_toggle").slideToggle("slow"); });
$('#reviews_user_review_panel_content').collapse({ toggle: false })




$("#reviews_user_review_panel_ajax").submit(function(e) {
/*if($('#reviews_user_review_panel_submit_button').hasClass('disabled')){
alert("Must finish the video."); e.preventDefault(); }*/
if(!allow_submit()){ alert("Must finish the video.");
e.preventDefault(); } else { var json_review = new Object(); var score =
$("#reviews_user_review_panel_stars").raty('score'); var vid =
$("#reviews_user_review_panel_review_video_id").val(); json_review.score
= score; json_review.vid = vid; json_review.ans = new Object();
$('#reviews_user_review_panel_question_section li').each(function(index)
{ var q_num = index+1+""; var ans = $("input[name='question_"+ q_num
+"']:checked").val(); var qid = $("input[name='question_"+ q_num
+"']").parent().attr("qid"); json_review.ans[qid] = ans;
//alert(JSON.stringify(json_review)); });
$.post("ajax/reviews/reviews_user/review_submit", { 'review':
json_review, 'comment':'' }, function(result) { if(result == true) {
alert("Thank you! Your review is submitted. "); if
(typeof(allow_comment) !== 'undefined' && $.isFunction(allow_comment)) {
allow_comment(true); } } else alert("Please complete all fields."); })
/* $.post("ajax/reviews/user/review_submit", { 'score': score, 'vid':
vid, 'ans' : json_review }, function(result) { if(result == true)
alert("Thank you! Your review is submitted. "); else alert("Please
complete all fields."); })*/ //.success(function() { alert("second
success"); }) .error(function() { alert("Submit failed."); })
//.complete(function() { alert("complete"); });

//$('#comment_control').load('ajax/reviews/submit',{'score':score,'video_id':vid});
//aler("rating successfully"); e.preventDefault(); } });

