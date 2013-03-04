 $("#video_chart_pagination_view_ajax_paging
a").live('click',function(event){ event.preventDefault(); //disable
default action of
<a> element // alert($(this).attr('href')); var pag_href =
	$(this).attr('href'); //alert(pag_href);

	$(".chart_content_genernal").load(pag_href); }); 