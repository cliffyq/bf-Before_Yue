 $('#post').live('click',function(){
$('#comment_display').load('ajax/test/com_reload',{'comment_content':$('#comment').val()
, 'id':$('#id1').attr('value')}); });
