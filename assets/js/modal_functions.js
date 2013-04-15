function show_error(msg){
	var modal_div = prepare_model_div('Error',msg);
	$(modal_div).modal('show')
}
function prepare_model_div(title,body){
	var modal_html = '<div class="modal modal-error hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
	+'<div class="modal-header">'
	+'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'
	+'<h3 class="modal-title">'
	+title
	+'</h3></div>'
	+'<div class="modal-body">'
	+body
	+'</div>'
	+'<div class="modal-footer">'
	+'<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>'
	+'</div></div>';
	return modal_html;
}
