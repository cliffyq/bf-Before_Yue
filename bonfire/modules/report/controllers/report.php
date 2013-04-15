<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class report extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		//$this->load->model('report_model', null, true);
		$this->lang->load('report');
		Template::set_theme('two_column');
		$this->load->model('company/company_model');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

	Displays a list of form data.
	*/
	public function index()
	{

		// 		$records = $this->question_model->find_all();

		// 		Template::set('records', $records);
		$advertisement_reports = $this->load->view('advertisement_reports',null,true);
		$incentive_reports = $this->load->view('incentive_reports',null,true);
		Assets::add_js('modal_functions.js');
		Assets::add_module_js('report', 'datepicker.js');
		Assets::add_module_css('report', 'datepicker.css');
		Assets:: add_js($this->load->view('inline_js/datepicker.js.php',null,True),'inline');
		Template::set('advertisement_reports',$advertisement_reports);
		Template::set('incentive_reports',$incentive_reports);
		Template::set('page_title','Reports');
		Template::render();
	}

	private function get_company_for_user($uid=false){
		if($uid===false) $uid = $this -> auth -> user_id();
		$company = $this-> company_model -> find_by('company_userid', $uid);
		if($company===false) return false;
		return $company;
	}

	//$filter:str or array(starttime,endtime)
	private function get_time_period($filter){
		$start_time;
		$end_time = date( 'Y-m-d H:i:s', time() );
		if(is_string($filter)){
			switch (strtoupper($filter)) {
				case "THIS_MONTH":
					$start_time = date( 'Y-m' );
					break;
				case "LAST_MONTH":
					$start_time = date('Y-m',strtotime('last month'));
					$end_time = date('Y-m');
					break;
				case "ALL_TIME":
					$start_time = date('Y-m',0);
					break;
				default:
					return false;
					break;
			}
		}
		if(is_array($filter))
		{
			if(count($filter)<2 || $filter[0]=='NaN' || $filter[1]=='NaN'){
				throw new Exception( 'invalid dates');
				return false;
			}
			$start_time = gmdate ('Y-m-d',$filter[0]);
			$end_time = gmdate ('Y-m-d',$filter[1]);
		}
		return array('start_time'=>$start_time,'end_time'=>$end_time);
	}
	private function get_video_list($cid, $filter,$check = false){
		if($cid===false) return false;
		$period = $this->get_time_period($filter);
		if($period===false) return false;
		$field = array("video_company_id"=>$cid,"created_on >="=>"{$period['start_time']}","created_on <"=>"{$period['end_time']}");
		return $check?$this->load->model('video/video_model')->find_by($field):$this->load->model('video/video_model')->find_all_by($field);
	}
	private function get_incentive_list($cid, $filter,$check = false){
		if($cid===false) return false;
		$period = $this->get_time_period($filter);
		if($period===false) return false;
		// 		$field = array("incentive_company_id"=>$cid,"created_on >="=>"{$period['start_time']}","created_on <"=>"{$period['end_time']}");
		return $check?$this->load->model('incentive/incentive_model')->find_by('incentive_company_id',$cid):$this->load->model('incentive/incentive_model')->find_all_by('incentive_company_id',$cid);
	}
	public function check_generate_report(){
		$filter =  $this->input->post('filter');
		$item_type = $this->input->post('item_type');
		$export_type = $this->input->post('export_type');
		$company = $this->get_company_for_user();
		if($company === false)
			exit('Unauthorized request.');
		try {
			if($item_type=='video')
				$items = $this->get_video_list($company->id,$filter,true);
			elseif ($item_type=='incentive')
			$items=$this->get_incentive_list($company->id,$filter,true);
		}
		catch (Exception $e){
			exit('Invalid time period');
		}
		if($items===false)
			exit(lang('report_no_record'));
		exit('1');
	}
	public function generate_report($item_type,$export_type,$start_date=false,$end_date=false)
	{
		$company = $this->get_company_for_user();
		if($company === false) return false;

		if($start_date === false)
			$filter = 'ALL_TIME';
		elseif ($end_date===false)
		$filter = $start_date;
		else
			$filter = array($start_date,$end_date);

		if($item_type=='video')
			$items = $this->get_video_list($company->id,$filter);
		elseif ($item_type=='incentive')
		$items=$this->get_incentive_list($company->id,$filter);
		if($items===false){
			//$this->show_error('NO_RECORD');
			exit();
		}
		$csv = $this->export_csv($item_type,$export_type,$items);
		$this -> load -> helper('download');
		$name = $item_type.'_'.$export_type . '_report_' . date("m-d-Y_His") . '.csv';
		//echo $csv;
		force_download($name, $csv);
	}
	// 	public function generate_video_report($export_type,$start_date=false,$end_date=false){
	// 		$company = $this->get_company_for_user();
	// 		if($company === false) return false;
	// 		if($start_date === false)
	// 			$filter = 'ALL_TIME';
	// 		elseif ($end_date===false)
	// 		$filter = $start_date;
	// 		else
	// 			$filter = array($start_date,$end_date);
	// 		$videos = $this->get_video_list($company->id,$filter);
	// 		if($videos===false) return false;
	// 		$csv = $this->export_csv('video',$export_type,$videos);
	// 		$this -> load -> helper('download');
	// 		$name = $export_type . '_report_' . date("m-d-Y_His") . '.csv';
	// 		//echo $csv;
	// 		force_download($name, $csv);
	// 	}
	public function show_error($error){
		if($error == 'NO_RECORD'){
			Template::set_message(lang('report_no_record'), 'error');
		}
		Template::set_theme('two_colum');
		Template::set_view('report_error');
		Template::render();
	}
	// 	public function generate_incentive_report($export_type,$filter){

	// 		$company = $this->get_company_for_user();
	// 		if($company === false) return false;
	// 		$incentives = $this->get_incentive_list($company->id,$filter);
	// 		if($incentives===false) return false;
	// 		$csv = $this->export_csv('incentive',$export_type,$incentives);
	// 		$this -> load -> helper('download');
	// 		$name = $export_type . '_report_' . date("m-d-Y_His") . '.csv';
	// 		//echo $csv;
	// 		force_download($name, $csv);
	// 	}

	public function export_csv($item_type,$export_type, $items) {
		//$this -> load -> helper('download');
		$csv = '';
		if(is_array($items))
		{
			foreach ($items as $item){
				$newcsv =  $this->write_csv($item_type,$export_type, $item);
				if($newcsv===false) continue;
				$csv .= $newcsv;
			}
		}
		else{
			$newcsv =  $this->write_csv($item_type,$export_type, $items);
			if($newcsv===false) {
				//console::log("error");
				return $csv;
			}
			$csv .= $newcsv;
		}
		return $csv;
		//$name = $export_type . '_report_' . date("m-d-Y_His") . '.csv';
		//force_download($name, $csv);
	}
	private function write_csv($item_type,$export_type, $item) {
		//$this -> load -> helper('download');
		//Console::log($video);
		if($item_type=='incentive')
			$info = $this -> get_incentive_info($item);
		if($item_type=='video')
			$info = $this -> get_video_info($item);
		if($info === false){
			Console::log('no info');
			throw new Exception( 'no info');
			return false;
		}
		//Console::log($info);
		if($item_type=='video'){
			if ($export_type == 'view')
				$results = $this -> company_model -> get_view_history($item->id);
			if ($export_type == 'review'){
				$results = $this -> company_model -> get_review_history($item->id);
				//Console::log($results);
			}
		}
		if($item_type=='incentive'){
			if ($export_type == 'purchase')
				$results = $this->load->model('purchase_history/purchase_history_model')-> get_purchase_history($item->id);
		}
		return $this->write_csv_for_item($info,$results);
		// 		$name = $export_type . '_report_' . date("m-d-Y_His") . '.csv';
		// 		force_download($name, $csv);
	}
	private function write_csv_for_item($info,$result_set){
		$csv = '';
		//$infoheaderDisplayed = false;
		//$csv .= $this -> echocsv(array_keys($info));
		//$csv .= $this -> echocsv($info);
		$headerDisplayed = false;
		//no result found
		if($result_set===false){
			$info['Data'] = lang('report_no_data');
			$csv .= $this -> echocsv(array_keys($info));
			$csv .= $this -> echocsv($info);
		}
		else{
			foreach ($result_set as $data) {
				$data = array_merge($info,$data);
				// Add a header row if it hasn't been added yet
				if (!$headerDisplayed) {
						
					// Use the keys from $data as the titles
					$csv .= $this -> echocsv(array_keys($data));
					$headerDisplayed = true;
				}
				// Put the data into the stream
				$csv .= $this -> echocsv($data);
			}
		}
		return $csv;
	}
	private function get_video_info($video){
		if(!is_object($video)) return false;
		return array('Video Title'=>$video->video_title,'Video Published Date'=>$video->created_on);
	}
	private function get_incentive_info($incentive){
		if(!is_object($incentive)) return false;
		return array('Incentive Name'=>$incentive->incentive_name,'Incentive Price'=>$incentive->incentive_price);
	}
	private function echocsv($fields) {
		$return = '';
		$separator = '';
		foreach ($fields as $field) {
			if (preg_match('/\\r|\\n|,|"/', $field)) {
				$field = '"' . str_replace('"', '""', $field) . '"';
			}
			$return .= $separator . $field;
			$separator = ',';
		}
		$return .= "\r\n";
		return $return;
	}
}