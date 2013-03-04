 $("#ajax_submit").submit(function() { /* var score = $("#score").val();
var vid = $("#video_id").val();
$.load('ajax/review/submit',{'score':score,'video_id':vid}); */ var val
= $('#test1').val(); $.post('ajax/test/ajax_submit',{'val':val}); alert(
val); return false; //stop the actual form post !important! });
