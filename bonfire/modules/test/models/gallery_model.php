<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Gallery_model extends BF_Model {


	public function video_saving()
	{
		$path = $this->set_video_path();
		$this->config->load('upload_video');
		$preference = read_config('upload_video', TRUE, 'company');
		$preference['upload_path'] = './'.VIDEO_UPLOAD_PATH.$path;
		//console::log($preference['upload_path']);
		$preference['allowed_types'] = $this->config->item('allowed_types');
		$preference['file_name'] = $this->config->item('file_name');
		if(!is_dir($preference['upload_path']))
		{
			mkdir($preference['upload_path'],0777,true);
		}
		$this->load->library('upload',$preference);
		$this->error='';
		//$file=$this->input->post('video_name');
		console::log('preference:'.print_r($preference,true));
		//console::log($video_file);
		//console::log($data);
		//if ( ! $this->upload->do_upload('video_file'))
		if ( ! $this->upload->do_upload())

		{
			$data = $this->upload->display_errors();
			//$status = 'error';
			//$error = $this->upload->display_errors('', '');
			rmdir($preference['upload_path']);
			//console::log($data);
			return $data;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $path;
		}
	}

	private function set_video_path()
	{
		$this->load->model('company/company_model');
		$this->load->helper('base64');
		$user_id = $this->auth->user_id();
		$company_dir = $this->company_model->find_by('company_userid',$user_id)->company_name;
		$time = new DateTime();
		$timestamp = $time->getTimestamp();
		$video_dir = urlsafe_b64encode(hash('crc32b',$timestamp));
		$path = $company_dir.'/'.$video_dir.'/';
		return $path;
		//$this->video_setting_info

	}
}