
$('#my_submit').on('click', function(e){
		$('.QnA').each(function(event){
			if($(this).val()== false){
				e.preventDefault();
				alert("wtf");
			}
		});
});


