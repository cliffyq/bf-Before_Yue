 _V_("example_video_1").ready(function(){ var myPlayer = this; var
com_status = function(){ $("#post").attr("class", "btn btn-primary"); };

myPlayer.addEvent("ended", com_status); }) $("#post").click(function(){
if ($(this).attr("class")=="no"){ alert("You must fully watch the video
first!"); } else { alert("posted successfully!"); } }); function
get_record_id() { //var p = {}; //p['abc'] = record_id;
$("#content").load( '../save_data'); alert("load successfully!"); };
function upload(){ // loading_show(); var $username =
$("#username").val(); var $comment = $("#comment").val();
$("#username").val(""); $("#comment").val(""); //$("#content").load(
'content/save_data'); $.ajax ({ type: "post", url: "../save_data", data:
"username="+$username+"&comment="+$comment, success: function(msg){
alert("posted successfully!"); /* if(msg==1){ var str = "
<p>
	<strong>"+username+"</strong>??"+comment+"<span>just</span>
</p>
"; comments.append(str); $("#message").show().html("posted
successfully!").fadeOut(1000); $("#comment").attr("value",""); }else{
$("#message").show().html(msg);//.fadeOut(1000); } */ } }); }

$(".btn").live('click',function(){ //post a comment
//alert($username+$comment); alert('111'); //upload(); get_record_id();
})




