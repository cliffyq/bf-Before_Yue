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

$('#incentive_image').change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#incentive_preview_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });