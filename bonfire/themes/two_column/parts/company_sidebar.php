<div class="well sidebar-nav">
	<ul class="nav nav-list">
		<li class="nav-header">HOME</li>
		<li
		<?php echo substr_compare($this->uri->uri_string(),'/company/company_company/video_charts',0) ? 'class="active"' : '' ?>>
			<a
			href="<?php echo site_url('/company/company_company/video_charts') ?>"
			id="sidebar-charts">Charts</a>
		</li>


		<li class="nav-header">MEDIA</li>

		<li <?php echo   $this->uri->uri_string() == site_url('company/company_company/video_uploading') ? 'class="active"' : '' ?>>
			<a href="<?php echo site_url('company/company_company/video_uploading') ?>" id="sidebar-new-meida">Upload New Video</a>
		</li>
		
		<li <?php echo   $this->uri->uri_string() == site_url('company/company_company/video_manager') ? 'class="active"' : '' ?>>
			<a href="<?php echo site_url('/company/company_company/video_manager') ?>" id="sidebar-video-manager">Video Manager</a>
		</li>

		<li class="nav-header">INCENTIVES</li>
		<li
		<?php echo $this->uri->uri_string()== 'company' ? 'class="active"' : '' ?>>
			<a href="<?php echo site_url(SITE_AREA .'/content/company') ?>"
			id="sidebar-new-incentive">Upload New Incentives</a>
		</li>
		<li
		<?php echo $this->uri->uri_string() == 'company' ? 'class="active"' : '' ?>>
			<a href="<?php echo site_url(SITE_AREA .'/content/company') ?>"
			id="sidebar-current-incentive">View Current Incentives</a>
		</li>

		<li class="nav-header">REPORTS</li>
		<li
		<?php echo $this->uri->uri_string() == 'company_company' ? 'class="active"' : '' ?>>
			<a
			href="<?php echo site_url('company/company_company/company_list/') ?>"
			id="sidebar-report">Report</a>
		</li>

		<li class="nav-header">COMPANY</li>
		<li
		<?php echo $this->uri->uri_string() == 'company_company' ? 'class="active"' : '' ?>>
			<a
			href="<?php echo site_url('company/company_company/company_list/') ?>"
			id="sidebar-edit">Eidt Company Information</a>
		</li>
	</ul>
</div>
<!--/.well -->
