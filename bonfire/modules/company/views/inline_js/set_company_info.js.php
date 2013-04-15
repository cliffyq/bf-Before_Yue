
$('#company_logo').change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#company_logo_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
			
			$('#company_logo').ajaxSubmit();
			
});