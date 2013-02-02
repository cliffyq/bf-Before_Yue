<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class test extends Front_Controller {
		
		//--------------------------------------------------------------------
		
		
		public function __construct()
		{
			parent::__construct();
			$this->load->module('comment');
			
		}
		
		//--------------------------------------------------------------------
		
		
		
		/*
			Method: index()
			
			Displays a list of form data.
		*/
		public function index()
		{
			//$this->session->set_userdata('count',1);
			//$this->video_stats->update('aaa');
			//print_r($this->video_stats->get_stats());
			Template::set_theme('main','junk');
			Template::render();
			/*
				$viewed=$this->session->userdata['reviewed'];
				if ($this->load->module('reviews')->has_reviewed(47))
				{ echo  "Yes";}
			*/
		}
		
		public function send_data()
		{
			$data= 'Got you';
			return  $data ;			
		}
		
		public function back($id)
		{
			$this->load->view('back',$id);
		}
		// Test for  comment
		public function comment_test()
		{
		    Assets:: add_js($this->load->view('ajax/comment_function',null,TRUE),'inline');
			
			Template:: set('id','47');
			Template:: render();
		}
		
		public function com_reload()
		{
		    $id=$this->input->post('id');
			$data = array();
			$data['comment_user']        = $this->auth->identity();
			$data['comment_content']        = $this->input->post('comment_content');
			$data['comment_ip']        = $_SERVER["REMOTE_ADDR"];
			//$data['comment_reply_to']        = $this->input->post('comment_reply_to');
			$data['comment_reply_to']        = '1';
			$data['comment_video_id']        = $id;
			
			
			//$this->load->module('comment');
			$this->comment_model->insert($data);
			$records['records'] = $this->comment_model->find_all_by('comment_video_id ='.$id);
			
			$this->load->view('ajax/com_reload',$records);
			
		}
		// Test for ajax submit
		public function  submit()
		{
		    Assets:: add_js($this->load->view('submitjs.php',null,True),'inline');
			Template::render();
			
		}
		
		public function  ajax_submit()
		{
			$data=array();
			//  $data['val']= "wow";
			$data['val']=$this->input->post('val');
			
			$this->load->view('ajax_submit',$data);
			
		}
		public function review_test($vid = 46)
		{	
			$review_panel = $this->load->module('reviews')->_review_panel($vid);
			Template::set('review_panel', $review_panel);
			Template::render();
		}
		
		public function test_pag($vid=0, $per_page=5, $offset=0)
		{
			$comment_view = $this->load->module('comment/content')->comment_view($vid, $per_page, $offset);
			Template::set('comment_view', $comment_view);
			Template::render();
		}
		
		
		public function test_theme()
		{
			Assets::add_js($this->load->module('reviews')->rating_ajax(),'inline');
			Template::render();
		}
		
		public function test_foreach()
		{
			$test= array(0,1,'b2'=>2);
			console:: log('orginal='.print_r($test,true));
			foreach ($test as $k=>$t)
			{
				if ( $t==2)
				{$test[$k]=20;}
			}
			console::log('new='.print_r($t,true));
			console::log ('now='.print_r($test,true));
			
		}
		public function dropdown_test()
		{
			template::render();
		}
		public function clear_session()
		{
			$this->session->set_userdata('reviewed','{"new":{},"previous":{}}');
		}
		public function switch_session()
		{
			$u = $this->session->userdata('reviewed');
			Console::log(print_r($u,true));
			if(is_array($u)) $u = json_encode($u);
			else $u = json_decode($u,true);
			Console::log(print_r($u,true));
			$this->session->set_userdata('reviewed',$u);
		}
		public function loadconfig1()
		{
			$modules = module_config('video_question');
			print_r($modules['default_questions']);
		}
		public function loadconfig2()
		{
			$this->load->config('video/upload');
			print_r($this->config->item('allowed_types'));
		}
		public function get_questions($vid)
		{
			print_r($this->load->model('video_question/video_question_model')->get_video_questions($vid));
		}
		
		public function sessiontest()
		{
			$this->session->foo();
		}
		public function ts()
		{
			$this->load->helper('date');
			echo now();
			echo '   ,time:'.time();
		}
		public function re()
		{
			$rev = $this->load->model('reviews/reviews_model')->get_reviews(1);
			print_r($rev);
			$rev[0]['ans'] = json_decode($rev[0]['ans'],true);
			//print_r($ans_json);
			$rev_json = json_encode($rev);
			print_r($rev_json);
		}
		public function obj()
		{
			$a = 3;
			$data = array('a'=>isset($a)?$a:999);
			print_r($data);
		}
		public function update()
		{
			$data = array('reviews_video_id'=>46,'reviews_comment_id'=>4);
			$index = 'reviews_video_id';
			$where = array('reviews_video_id'=>46);
			$this->load->model('reviews/reviews_model')->update_where($where, $data);
			//$this->reviews_model->db->where($where)->update($this->reviews_model->table,$data);
		}
		public function test_unset()
		{
			$a=array(1,2,3,4,5);
			console:: log(print_r($a,true));
			unset($a[2]);
			console:: log(print_r($a,true));
		}
		public function ud()
		{
			print_r($this->session->userdata('reviewed'));
		}
		public function store()
		{
			$this->session->session_store_reviews();
		}
		public function csvtest()
		{
			$fileName = 'report.csv';
			$this->output->set_header('Content-Type: text/csv; charset=utf-8');
			$this->output->set_header("Cache-Control: no-store, no-cache");  
			$this->output->set_header("Content-Disposition: attachment; filename={$fileName}");
			$this->load->model('reviews/reviews_model', null, true);
			$results = $this->reviews_model->find_all_by('reviews_video_id', 47, 'and', 1);
			$fh = fopen( 'php://output', 'w' );
			$headerDisplayed = false;
			foreach ( $results as $data ) {
				// Add a header row if it hasn't been added yet
				if ( !$headerDisplayed ) {
					// Use the keys from $data as the titles
					fputcsv($fh, array_keys($data));
					$headerDisplayed = true;
				}
				// Put the data into the stream
				fputcsv($fh, $data);
			}
			// Close the file
			fclose($fh);
			// Make sure nothing else is sent, our file is done
			//exit;
		}
		public function csvtest2()
		{
			$fileName = 'report.csv';		
			// $this->output->set_header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			// $this->output->set_header('Content-Description: File Transfer');
			// $this->output->set_header("Content-type: text/csv");
			// $this->output->set_header("Content-Disposition: attachment; filename={$fileName}");
			// $this->output->set_header("Expires: 0");
			// $this->output->set_header("Pragma: public");
			$this->output->set_header('Content-Type: text/csv; charset=utf-8');
			$this->output->set_header("Content-Disposition: attachment; filename={$fileName}");
			$fh = @fopen( 'php://output', 'w' );
			$list = array (
			array('aaa', 'bbb', 'ccc', 'dddd'),
			array('123', '456', '789'),
			array('"aaa"', '"bbb"')
			);
			foreach ($list as $fields) {
				fputcsv($fh, $fields);
			}
			fclose($fh);
			//exit;
		}
		public function dl()
		{
			$list = array (
			array('aaa', 'bbb', 'ccc', 'dddd'),
			array('123', '456', '789'),
			array('"aaa"', '"bbb"')
			);
			$this->load->helper('download');
			$csv;
			foreach ($list as $record)  
			{  
				$csv.=$this->echocsv($stream, $record);  
			}  
			//	$data = 'Here is some text!';
			$name = 'mytext.csv';
			
			force_download($name, $csv);
		}
		function exportCSV($data, $col_headers = array(), $return_string = false)  
		{  
			$stream = ($return_string) ? fopen ('php://temp/maxmemory', 'w+') : fopen ('php://output', 'w');  
			
			if (!empty($col_headers))  
			{  
				fputcsv($stream, $col_headers);  
			}  
			
			foreach ($data as $record)  
			{  
				fputcsv($stream, $record);  
			}  
			
			if ($return_string)  
			{  
				rewind($stream);  
				$retVal = stream_get_contents($stream);  
				fclose($stream);  
				return $retVal;  
			}  
			else  
			{  
				fclose($stream);  
			}  
		} 
		
		function csv()
		{
			/*
				* send response headers to the browser
				* following headers instruct the browser to treat the data as a csv file called export.csv
			*/
			
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment;filename=export.csv');
			
			/*
				* output header row (if atleast one row exists)
			*/
			
			$row = mysql_fetch_assoc($result);
			if ($row) {
				echocsv(array_keys($row));
			}
			
			/*
				* output data rows (if atleast one row exists)
			*/
			
			while ($row) {
				echocsv($row);
				$row = mysql_fetch_assoc($result);
			}
			
			/*
				* echo the input array as csv data maintaining consistency with most CSV implementations
				* - uses double-quotes as enclosure when necessary
				* - uses double double-quotes to escape double-quotes 
				* - uses CRLF as a line separator
			*/
			
			
		}
		function echocsv($fields)
		{
			$separator = '';
			foreach ($fields as $field) {
				if (preg_match('/\\r|\\n|,|"/', $field)) {
					$field = '"' . str_replace('"', '""', $field) . '"';
				}
				echo $separator . $field;
				$separator = ',';
			}
			echo "\r\n";
		}
		//--------------------------------------------------------------------
	}
	
