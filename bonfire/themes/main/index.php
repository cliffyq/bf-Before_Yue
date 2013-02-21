<?php echo theme_view('parts/_header'); ?>


<?php

	echo Template::message();
	echo isset($content) ? $content : Template::yield();
?>

<?php echo theme_view('parts/_footer'); ?>