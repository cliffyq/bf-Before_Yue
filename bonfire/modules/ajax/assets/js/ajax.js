//var cct = $.cookie('ci_csrf_token');
function get_record_id(record_id) {
	$.ajax({
		type: "POST",
		url: "ajax/echos",
		data: {'a':'b'},
	});
}	

$("#abc").click(function(){
	get_record_id('111');
    alert("ccc");
});	

