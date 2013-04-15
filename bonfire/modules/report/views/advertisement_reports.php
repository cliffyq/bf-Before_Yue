<div class="report-table span8">
	<table class="table table-bordered table-hover">
		<caption class="report-table-caption">
				<span class="report-table-header">Advertisement Reports</span> <span
					class="report-table-subheader">- Run reports to generate csv file</span>
		</caption>
		<tbody>
			<tr>
				<td>Generate report on advertisement published this month</td>
				<td style="text-align: center"><button class="btn btn-info generte_report" data-filter="THIS_MONTH" data-item_type="video" data-export_type="review" type="button">run</button></td>
			</tr>
			<tr>
				<td>Generate report on advertisement published last month</td>
				<td style="text-align: center"><button class="btn btn-info generte_report" data-filter="LAST_MONTH" data-item_type="video" data-export_type="review" type="button">run</button></td>
			</tr>
			<tr>
				<td>Generate report on all advertisement</td>
				<td style="text-align: center"><button class="btn btn-info generte_report" data-filter="ALL_TIME" data-item_type="video" data-export_type="review" type="button">run</button></td>
			</tr>
			<tr class="report_datepick">
				<td>Generate report on advertisement published between
					<div class='date_input_form'>
						Start Date: <input class="required datepicker input-small start_date" type="text"
							value="" /> End Date: <input class="required datepicker input-small end_date"
							type="text" />
					</div>
				</td>
				<td style="text-align: center"><button class="btn btn-info generte_report btn-datepick" data-placement="top" data-item_type="video" data-export_type="review" type="button">run</button></td>
			</tr>
		</tbody>
	</table>
</div>
