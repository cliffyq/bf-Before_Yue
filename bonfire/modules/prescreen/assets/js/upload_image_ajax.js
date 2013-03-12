//alert('test_image');

/*
$('#incentive_image').change(function(e){
	e.preventDefault();
	
	alert($('#incentive_image').val());
	  $('#incentive_form').ajaxSubmit({
	  url: './upload_incentive',
	  success:function(events){
	  	console.log(events);
	  }
	  });

});
*/

   function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }