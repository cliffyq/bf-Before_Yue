<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends BF_Model {

	protected $table		= "company";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;

	//fields:title,description,length,upload_time,view_count,average_rating
	public function get_video_info($video_id)
	{
		$return=array();
		$this->load->model('video/video_model', null, true);
		$this->load->model('video_view_history/video_view_history_model', null, true);
		$this->load->model('reviews/reviews_model', null, true);
		$video_info = $this->video_model->find_by('id', $video_id, 'and', 1);
		if($video_info === false) return false;
		$return['id'] = $video_info['id'];
		$return['title'] = $video_info['video_title'];
		$return['description']= $video_info['video_description'];
		$return['length']= $video_info['video_length'];
		$return['upload_time']= $video_info['created_on'];
		$return['view_count'] = $this->video_view_history_model->get_view_count($video_id);
		$return['average_rating'] = $this->reviews_model->average_rating($video_id)===false?"n/a":$this->reviews_model->average_rating($video_id);
		// Console::log(print_r($return,true));
		return $return;
	}

	//fields:gender,birth_month,birth_year,race,education,zipcode,time,ip
	public function get_view_history($video_id)
	{
		$return = array();
		$this->load->model('video_view_history/video_view_history_model', null, true);
		$this->load->model('user_info/user_info_model', null, true);
		$video_histories = $this->video_view_history_model->find_all_by('video_view_history_video_id', $video_id, 'and', 1);
		if($video_histories === false) return false;
		foreach($video_histories as $k=>$v)
		{
			$user_info = $this->user_info_model->get_user_info($v['video_view_history_user_id']);
			if($user_info!==false)
			{
				$return[$k]['User Gender'] = $user_info['user_info_gender']==1?'M':'F';
				$return[$k]['User DOB'] = $user_info['user_info_birth_month'].'/'.$user_info['user_info_birth_year'];
				$return[$k]['User Race'] = $user_info['user_info_race'];
				$return[$k]['User Education Level'] = $user_info['user_info_education'];
				$return[$k]['User Zipcode'] = (string)$user_info['user_info_zipcode'];
				$return[$k]['User Industry'] = $user_info['user_info_industry_id'];
				$return[$k]['User Veteran'] = $user_info['user_info_veteran'];
			}
			else
			{
				$return[$k]['User Gender'] = '';
				$return[$k]['User DOB'] = '';
				$return[$k]['User Race'] = '';
				$return[$k]['User Education Level'] = '';
				$return[$k]['User Zipcode'] = '';
				$return[$k]['User Industry'] = '';
				$return[$k]['User Veteran'] = '';
			}
			$return[$k]['time'] = date("Y-m-d h:j:s", $v['video_view_history_created_on']);
			$return[$k]['ip'] = $v['video_view_history_ip'];
		}
		// Console::log(print_r($return,true));
		return $return;
	}

	public function get_review_history($video_id)
	{
		$this->load->helper('date');
		$this->load->model('addresses/addresses_model');
		$return = array();
		$this->load->model('reviews/reviews_model', null, true);
		$this->load->model('question/question_model', null, true);
		$this->load->model('answer/answer_model', null, true);
		$this->load->model('user_info/user_info_model', null, true);
		$video_reviews = $this->reviews_model->find_all_by('reviews_video_id', $video_id, 'and', 1);
		if($video_reviews === false) return false;
		$conf = read_config('config',true,'report');
		if(array_key_exists('number_of_questions_on_report',$conf))
			$nr_questions = $conf['number_of_questions_on_report'];
		else
			$nr_questions = false;
		foreach($video_reviews as $k=>$v)
		{
			$user_info = $this->user_info_model->get_user_info($v['reviews_user_id']);
			if($user_info!==false)
			{
				$return[$k]['User Gender'] = $user_info['user_info_gender']==1?'M':'F';
				$return[$k]['User DOB'] = $user_info['user_info_birth_month'].'/'.$user_info['user_info_birth_year'];
				$return[$k]['User Age'] = get_age($user_info['user_info_birth_year'],$user_info['user_info_birth_month']);
				$return[$k]['User Race'] = $user_info['user_info_race'];
				$return[$k]['User Education Level'] = $user_info['user_info_education'];
				$return[$k]['User Zipcode'] = $user_info['user_info_zipcode'];
				$addr = $this->addresses_model->find_by('addresses_zip',$user_info['user_info_zipcode']);
				$return[$k]['User City'] = is_object($addr)?$addr->addresses_city:"";
				$return[$k]['User State'] = is_object($addr)?$addr->addresses_state:"";
				$return[$k]['User Industry'] = $user_info['user_info_industry_id'];
				$return[$k]['User Veteran'] = $user_info['user_info_veteran'];
			}
			else
			{
				$return[$k]['User Gender'] = '';
				$return[$k]['User DOB'] = '';
				$return[$k]['User Age'] = '';
				$return[$k]['User Race'] = '';
				$return[$k]['User Education Level'] = '';
				$return[$k]['User Zipcode'] = '';
				$return[$k]['User City'] = '';
				$return[$k]['User State'] = '';
				$return[$k]['User Industry'] = '';
				$return[$k]['User Veteran'] = '';
			}
			$return[$k]['Review Time'] = date("Y-m-d h:j:s", $v['reviews_last_update']);
			$return[$k]['Rating'] = $v['reviews_rating'];
			//display answers and questions
			$answer_temp = json_decode($v['reviews_answers'], true);
			$answer_keys = array_values ($answer_temp);
			$question_keys = array_keys ($answer_temp);
			if($nr_questions !== false){
				for($i = 0;$i < $nr_questions;$i++){
					if(count($question_keys)<=$i || count($answer_keys)<=$i){
						$return[$k]['Q'.($i+1)] = "";
						$return[$k]['A'.($i+1)] = "";
						continue;
					}
					$question = $this->question_model->find_by('id', $question_keys[$i], 'and', 1);
					if(!$question){
						$return[$k]['Q'.($i+1)] = "";
						$return[$k]['A'.($i+1)] = "";
						continue;
					}
					$question_value = $question['question_content'];
					$answer_id = $question['question_answer_id'];
					$answer = $this->answer_model->find_by('id', $answer_id, 'and', 1);
					if(!$answer){
						$return[$k]['Q'.($i+1)] = "";
						$return[$k]['A'.($i+1)] = "";
						continue;
					}
					$answer_array = json_decode($answer['answer_content'], true);
					if(count($answer_array)<=$i){
						$return[$k]['Q'.($i+1)] = "";
						$return[$k]['A'.($i+1)] = "";
						continue;
					}
					$answer_value = $answer_array[$answer_keys[$i]];
					$return[$k]['Q'.($i+1)] = $question_value;
					$return[$k]['A'.($i+1)] = $answer_value;
				}
			}
			else{
				$return[$k]['Questions & Answers'] = '';
				foreach($question_keys as $j=>$v)
				{
					$question = $this->question_model->find_by('id', $v, 'and', 1);
					$question_value = $question['question_content'];
					$answer_id = $question['question_answer_id'];
					$answer = $this->answer_model->find_by('id', $answer_id, 'and', 1);
					$answer_array = json_decode($answer['answer_content'], true);
					$answer_value = $answer_array[$answer_keys[$j]];
					$q_and_a = 'Q'.($j+1).':"'.$question_value.'",A'.($j+1).':"'.$answer_value.'";';
					$return[$k]['Questions & Answers'] .= $q_and_a;
				}
			}
		}
		return $return;
	}

	public function create_company($data,$logo_fieldname='company_logo')
	{
		if(!is_array($data)||empty($data))
			return false;
		$path = url_title($data['company_name'],'underscore').'/';
		$full_path='./'.LOGO_PATH.$path;
		//$fdata = $this->_upload_logo($logo_fieldname,$path);
		$this->load->helper('upload_helper');
		$fdata=my_upload($logo_fieldname,$full_path,'company','upload_logo');
		if(isset($fdata['error'])||!isset($fdata['upload_data']) || $fdata['upload_data'] == NULL){

			return FALSE;
		}
		$data['company_logo'] = $path;
		$id = $this->insert($data);
		if (!is_numeric($id)) return FALSE;
		return $id;
	}


	//--------------------------------------------------------------------
	//upload logo, $field_name = form input name, $path = path relative to the LOGO_PATH
	public function _upload_logo($field_name,$path){
		$preference = read_config('upload_logo', TRUE, 'company');
		$preference['upload_path'] = './'.LOGO_PATH.$path;
		if(!is_dir($preference['upload_path']))
		{
			mkdir($preference['upload_path'],0777,true);
		}
		$this->load->library('upload',$preference);
		$this->error='';
		if ( ! $this->upload->do_upload($field_name))
		{
			$data['error'] = $this->upload->display_errors();
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
		return $data;
	}




}


