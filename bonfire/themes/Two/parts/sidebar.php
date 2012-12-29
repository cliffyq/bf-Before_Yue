<div class="well sidebar-nav">
	<ul class="nav nav-list">
		<li class="nav-header">Video</li>
				<li <?php echo $this->uri->segment(3) == 'general_page' ? 'class="active"' : '' ?>>
				<a href="<?php echo site_url('/prescreen/bootstrap/general_page') ?>" id="sidebar-feature">Feature</a>
				</li>

		<li><a href="#">Top</a></li>
		<li <?php echo   $this->uri->segment(3) == 'video_view_history' ? 'class="active"' : '' ?>>
			<a href="<?php echo site_url(SITE_AREA .'/user/video_view_history/view') ?>" id="sidebar-history">History</a>
		</li>
		<li class="nav-header">Incentive</li>
		<li <?php echo   $this->uri->segment(3) == 'purchase_history' ? 'class="active"' : '' ?>>
			<a href="<?php echo site_url(SITE_AREA .'/user/purchase_history') ?>" id="sidebar-myBank">My Bank</a>
		</li>
		<li <?php echo   $this->uri->segment(4) == 'index' ? 'class="active"' : '' ?>>
			<a href="<?php echo site_url(SITE_AREA .'/user/incentive/index') ?>" id="sidebar-shop">Shop</a>
		</li>
		<li <?php echo $this->uri->segment(4) == 'charity' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/user/incentive/charity') ?>" id="sidebar-charity">Charity</a>
		</li>
		
		<li class="nav-header">Company</li>
		<li <?php echo $this->uri->segment(3) == 'company' ? 'class="active"' : '' ?> >
			<a href="<?php echo site_url(SITE_AREA .'/content/company') ?>" id="sidebar-list">List</a>
		</li>
	
		<li <?php echo $this->uri->segment(2) == 'company_company' ? 'class="active"' : '' ?>><a href="<?php echo site_url('company/company_company/company_list/') ?>" id="sidebar-report">Report</a></li>
		<li><a href="#">Link</a></li>
		</ul>
	</div><!--/.well -->	