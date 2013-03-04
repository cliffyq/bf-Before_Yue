
var video_id;
var options = { 
        target:        '',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        uploadProgress: showProgress,
        
        success:       showResponse  // post-submit callback 
 		
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 

function showRequest(){
	$('.progress_bar').removeClass('hidden');
	$('.alert').remove();
	$('.video_choosing').fadeOut('slow');
	$('.loading_div').removeClass('hidden');
}

function showResponse(result){
//	console.log(result);
	if(result == 'error'){
		result = false;
	}
	video_id = result;
	
	console.log(video_id);
	$('.video_choosing').remove();
	$('.video_info_setting').load('video_info_setting/'+video_id);

}

var bar = $('.bar'); 
var percent = $('.percent'); 

function showProgress(event, position, total, percentComplete) { 
    var percentVal = percentComplete + '%'; //get progress
    bar.width(percentVal); // change progress percentage
   	percent.html(percentVal); //show progress 
}





$("#video_upload").change(function(e){
 	e.preventDefault();
    
    var file = $('input[type="file"]').val();
    var get_ext = file.split('.');    
    get_ext = get_ext.reverse();
    //alert(get_ext[0]);
    var exts = ['mp4', 'ogv', 'wma', 'avi', 'webm'];
    if(file != false){
		if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
	        $('#video_upload').ajaxSubmit(options);
	    } else {
	    	if(!$('.alert-error').length){
	        	$(this).before("<div class='alert alert-error span8 offset2' style='text-align: center'><button type='button' class='close' data-dismiss='alert' >×</button><h4 >Wrong type!</h4>Please choose those videos of types allowed.</div>")
	    	}
	    }
   }
    
    return false;
});
        

