<?php echo theme_view('parts/_header'); ?>

<div class="container-fluid body"> <!-- Start of Main Container -->
	<div class="row-fluid">
		<div class="span3">
			<?php echo Template::block('company_sidebar', 'parts/company_sidebar'); ?>		
		</div><!--/span2-->
		
		<div class="span9">
			<div class='container-fluid main_content'>
			<?php
				echo Template::message();
				echo isset($page_title)?"<div class='page_title'>{$page_title}</div>":'';
				echo isset($page_subtitle)?"<div class='page_subtitle'>{$page_title}</div>":'';
				echo isset($content) ? $content : Template::yield();
			?>
			</div>
			
		</div><!--/span10-->
	</div><!--/row-fluid-->
</div><!--/container-->

<?php echo theme_view('parts/_footer'); ?>