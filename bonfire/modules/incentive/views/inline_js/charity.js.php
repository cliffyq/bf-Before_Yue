$('.incentive_user_charity_submit').click(function() {
event.preventDefault(); //disable default action of
<a> element var href = $(this).attr('href'); var points=
	$('#incentive_user_charity_amount').attr('value'); if
	(points.match(/^[0-9]*[1-9][0-9]*$/) == null) // ?? != null &&
	??.trim().equalsIgnoreCase()!= "" {alert('Please type in your donate
	amount.');} else {
	$.post(href,{'points':points},function(current_points){
	if(current_points != false) {
	$('#incentive_user_information_current_points').load('ajax/user_information/get_current_points');
	alert('Thank you for your donation.Your current points is
	'+current_points); } else alert('Sorry you do not have enough
	points.'); }); } return false; });


	$('.incentive_user_charity_submit').confirm({ dialogSpeed:'slow',
	buttons: { wrapper:'
	<button></button>', separator:' ' } }); 