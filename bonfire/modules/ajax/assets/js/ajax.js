//var cct = $.cookie('ci_csrf_token');
function get_record_id(record_id) {
	//var p = {};
	//p['record_id'] = record_id;
	/* $.post(
                'ajax/echos',
                {'p': '123456' },
                'json'
               );
	*/
	//$("#content").load('ajax/echos',{'a':'b'});
	//$("#content").load('ajax/echos');

	//$("#content").load('ajax/echos',p);
	
	//$.post('ajax/echos',{record_id:'11'});
	
	$.ajax({
		type: "POST",
		url: "ajax/echos",
		data: {'a':'b'},
	});
}	
//;

$("#abc").click(function(){
	get_record_id('111');
    alert("ccc");
});	

