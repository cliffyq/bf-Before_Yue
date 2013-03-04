$(".export_form").on("click",function(){ var video_id =
$("h2").attr("video_id"); var export_type = $(this).attr("export_type");
rev_href =
'ajax/company/company_company/export_csv/'+export_type+'/'+video_id; //
alert(rev_href); $('#csv').load( rev_href, { }, function(result){ //
alert(result); }); });

