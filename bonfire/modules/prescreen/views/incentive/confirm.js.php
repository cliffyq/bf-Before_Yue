$('.purchase_test').click(function() {
  event.preventDefault(); //disable default action of <a> element
  var href = $(this).attr('href');
  $.post(href,function(){ alert('click');});
  return false;
});
 
// The most simple use.
$('.purchase_test').confirm();
alert($('.purchase_test').attr('href'));