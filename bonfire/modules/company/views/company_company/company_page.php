<h1>
	<?= $company_data['company_name'] ?>
</h1>
<img
	src="<?php echo modules::run('company_company/get_logo', $company_data['company_logo'])?>"
	alt="Company logo" height="30" class="logo" />
<div>
	<a href="http://<?= $company_data['company_url'] ?>"><?= $company_data['company_url'] ?>
	</a>
</div>
<h2>
	<a
		href="<?= base_url() ?>company/company_company/video_list/<?= $company_data['id'] ?>">Video
		List</a>
</h2>
<h2>
	<a href="<?= base_url() ?>admin/reports/company/create">Create New
		Video</a>
</h2>
<h2>
	<a href="<?= base_url() ?>admin/reports/incentive/create">Create New
		Incentive</a>
</h2>
