<?= $id ?>

<p>Ajax should be displayed below</p>
<div id="content"></div>
<button id="abc">click1</button>


<p>New test</p>


<video id="video_3" class="video-js vjs-default-skin" controls
	preload="none" width="1" height="1">
	<source src="media/intro.mp4" type='video/mp4' />

</video>
<div id='aaa'>here</div>
<button id='test'>click</button>

<script type="text/javascript">
	
	
	
	$("#test").click(function(){
		
		$.post('../ajax/reload',{url:$("video source").attr("src")},function(result){
			alert($("video source").attr("src"));
			$("#video_3").html(result);
		});
		
		/*
			$("#video_3").load('../ajax/reload',{url:$("video source").attr("src")},function(){
		alert($("video source").attr("src"));
		});
		*/
		//	alert($("video").attr("src"));
	});
</script>
