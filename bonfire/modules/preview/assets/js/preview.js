

$(document).keydown(function(event) {
  var LEFT_ARROW = 39; var RIGHT_ARROW = 37;
	//alert(event.keyCode);
 
    if (event.keyCode === RIGHT_ARROW) {
      $('a.carousel-control.left').trigger('click');
//	  alert("right");
    }

    if (event.keyCode === LEFT_ARROW) {
      $('a.carousel-control.right').trigger('click');
    }
  
  return true;
});


