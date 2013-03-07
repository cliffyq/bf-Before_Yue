<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends BF_Model {

	protected $table		= "comment";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= true;
	protected $set_modified = true;
	protected $created_field = "created_on";
	protected $modified_field = "modified_on";
	/*
		public function get_comment($video_id = false, $order_col = 'created_on', $order = 'desc'){
	if($video_id !== false){
	$this->comment_model->where('comment_video_id ',$video_id);
	$this->comment_model->order_by($order_col, $order);
	}
	return $this->comment_model->find_all();
	}

	public function get_comment_arr($video_id = false, $order_col = 'created_on', $order = 'desc'){
	if($video_id !== false){
	$this->comment_model->where('comment_video_id ',$video_id);
	$this->comment_model->order_by($order_col, $order);
	}
	return $this->comment_model->find_all(1);
	}
	*/

	public function has_reviewed($video_id,$user_id)
	{
		$this->load->model('reviews/reviews_model');
		return $this->reviews_model->find_by(array('reviews_video_id ' => $video_id, 'reviews_user_id' => $user_id))===false?false:true;
			
	}




	public function get_comment_pag($video_id = false, $limit = 0, $offset = 0) {
		$return = array('rows'=>array(),'row_count'=>0);
		if($video_id !== false){
			$this->db->select("SQL_CALC_FOUND_ROWS id, comment_user, comment_reply_to, comment_parent_user, comment_content, created_on",false);
			$this->db->order_by("created_on", "desc");
			$query = $this->db->get_where($this->table, array('comment_video_id' => $video_id), $limit, $offset);
			$return['rows'] = $query->result_array();
			$count_query = $this->db->query('SELECT FOUND_ROWS() AS row_count');
			$return['row_count'] = $count_query->row()->row_count;
			//				$return['offset'] = $offset;
		}
		return $return;
	}


	public function get_parent_comment($comment_id) {
		$return = array('rows'=>array());
		$this->db->select("id, comment_user, comment_reply_to, comment_parent_user, comment_content, created_on",false);
		$query = $this->db->get_where($this->table, array('id' => $comment_id));
		$return['rows'] = $query->result_array();
		return $return;
	}
}
