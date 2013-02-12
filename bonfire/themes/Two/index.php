<?php echo theme_view('parts/_header'); ?>

<div class="container-fluid body"> <!-- Start of Main Container -->
	<div class="row-fluid">
		<div class="span2">
			<?php echo Template::block('header', 'parts/sidebar'); ?>		
		</div><!--/span2-->
		
		<div class="span10">
			<?php
				
				echo Template::message();
				echo isset($content) ? $content : Template::yield();
			?>
			
		</div><!--/span10-->
	</div><!--/row-fluid-->
</div><!--/container-->

<?php echo theme_view('parts/_footer'); ?>