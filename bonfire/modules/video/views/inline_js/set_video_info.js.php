//alert('bbb');
$('#submit').on ('click', function(e){
	//e.preventDefault();
	
	

	
	
	submit_button = $(this);
	$('.choose_question').each(function(c){
		//alert($(this).find("select").val());
		question_id = $(this).find("select").attr('id');
		if($(this).find('.question_type').val()){
			
			//question_id = $(this).find("select").attr('id');
			//alert(question_id);
			$('.'+question_id).each(function(t){
				if(!$(this).val()){
					
					e.preventDefault();
					$('.alert_question').remove();
					submit_button.parents('.control-group').before("<div class='alert alert-error span8 offset2 alert_question' class='aaa' style='text-align:center; margin-right:100px;'><button type='button' class='close' data-dismiss='alert' >×</button><h4 >Video "+question_id+" or answers cannot be blank!</h4>Please choose a question from lists or type your own QUESTION and ANSWERS!</div>");
					return false;
				}
			});
			
		}else{ 
			if(!$(this).find("select").val()){
				e.preventDefault();
				
				$('.alert_question').remove();
				//alert("wtf");
				submit_button.parents('.control-group').before("<div class='alert alert-error span8 offset2 alert_question' class='aaa' style='text-align:center; margin-right:100px;'><button type='button' class='close' data-dismiss='alert' >×</button><h4 >Video "+question_id+" or answers cannot be blank!</h4>Please choose a question from lists or type your own QUESTION and ANSWERS!</div>");
				return false;
			}		
		}
		

	});
	if($(".question1").val() &&  $(".question2").val() && $(".question1").val()==$(".question2").val()){
					e.preventDefault();
					$('.alert_question').remove();
					submit_button.parents('.control-group').before("<div class='alert alert-error span8 offset2 alert_question' class='aaa' style='text-align:center; margin-right:100px;'><button type='button' class='close' data-dismiss='alert' >×</button><h4 >Video questions cannot be the same!</h4>Please choose or type another question!</div>");		
					return false;
				}
				if($(".question1").val()==false && $(".question2").val()==false && $("#question1").val()==$("#question2").val()){
					e.preventDefault();
					$('.alert_question').remove();
					submit_button.parents('.control-group').before("<div class='alert alert-error span8 offset2 alert_question' class='aaa' style='text-align:center; margin-right:100px;'><button type='button' class='close' data-dismiss='alert' >×</button><h4 >Video questions cannot be the same!</h4>Please choose or type another question!</div>");		
					return false;
				}

	
});


$('.question_type').on('keyup',function(){
	if($(this).val()){
		$(this).parents('.choose_question').find("select").prop("disabled", true);
		$(this).parents('.choose_question').find(".answers_type").removeAttr("hidden");
	}else{
		$(this).parents('.choose_question').find("select").removeAttr("disabled");
		$(this).parents('.choose_question').find(".answers_type").prop("hidden", true);
	}
});

$('#video_thumbnail').change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#video_thumbnail_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
});
