 function allow_submit(s) { allow_submit.allow = allow_submit.allow ||
false; if(s == true) allow_submit.allow = true; else if(s == false)
allow_submit.allow = false; else return allow_submit.allow; }

allow_submit(true); if (!allow_submit()) {
$("#toggle").css("display","block"); } else $("#togform
input").attr('disabled',true); $("#flip").click(function(){
$("#toggle").slideToggle("slow"); });
