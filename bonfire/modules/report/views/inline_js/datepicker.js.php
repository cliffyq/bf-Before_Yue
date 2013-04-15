$('.datepicker').datepicker();
$('.datepicker').focus(function(){
	var btn = $(this).closest('tr').find('.generte_report').tooltip('destroy');
})
function get_picked_dates(control){	
	sdate = control.closest('.report_datepick').find('.start_date').val();
	edate = control.closest('.report_datepick').find('.end_date').val();
	var start_date = new Date(sdate);
	var end_date = new Date(edate);
	if(end_date-start_date <= 0)
		return false;
	return [start_date.getTime()/1000,end_date.getTime()/1000];
}
$('.generte_report').click(function(){
	if($(this).hasClass('btn-datepick')){
		var required = $(this).closest('.report_datepick').find('.required');
		if(required[0].value==''||required[1].value==''){
			$(this).tooltip({
				title:'Please select dates',
			});
			$(this).tooltip('show');
			return;
		}
		var filter = get_picked_dates($(this));
		if(filter===false){
			$(this).tooltip({
				title:'Start date should be earlier than end date',
			});
			$(this).tooltip('show');			
			return;
		}
	}
	else
		var filter = $(this).data('filter');
	var item_type = $(this).data('item_type');
	var export_type = $(this).data('export_type');
	try_generate_report(filter,item_type,export_type);
})
function try_generate_report(filter,item_type,export_type){
	$.post('<?php echo site_url('report/check_generate_report')?>',{"item_type":item_type,"export_type":export_type,"filter":filter}, function(data) {
		if(data!='1'){
			show_error(data);
		}
		else{
			if($.isArray(filter))
				window.location = "<?php echo site_url('report/generate_report')?>"+'/'+item_type+'/'+export_type+'/'+filter[0]+'/'+filter[1];
			else
				window.location = "<?php echo site_url('report/generate_report')?>"+'/'+item_type+'/'+export_type+'/'+filter;
		}});
}

$("body").on({
    ajaxStart: function() { 
        $(this).addClass("loading"); 
    },
    ajaxStop: function() { 
    	$(this).removeClass("loading");
    }    
});





