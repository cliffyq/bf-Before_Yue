$('.incentive_user_purchase_confirm').click(function() {
 
 event.preventDefault(); //disable default action of <a> element
  var href = $(this).attr('href');
  $.post(href,function(current_points){ 
	  if(current_points != false) 
	  {
	    $('#incentive_user_information_current_points').load('ajax/user_information/get_current_points');
		alert('Thank you for your online purchase.                       Your current points is '+current_points);
	  }
	  else
	  alert('Sorry you do not have enough points.');
	  });
 
 
  return false;
});
 
$('.incentive_user_purchase_confirm').confirm({
   dialogSpeed:'slow',
   buttons: {
    wrapper:'<button></button>',
    separator:'  '
  }
	
});
