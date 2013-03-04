<?php if (isset($records) && is_array($records) && count($records)) : ?>
<?php foreach($records as $record):?>
<div>
	<a
		href="<?php echo base_url()?>company/company_company/company_admin/<?php echo $record->id ?>"><?php echo $record->company_name?>
	</a> <img
		src="<?php echo modules::run('company/content/get_logo', $record->company_logo)?>"
		alt="Company logo" height="30" class="logo" />
</div>
<?php endforeach?>
<?php else: ?>
No company
<?php endif; ?>