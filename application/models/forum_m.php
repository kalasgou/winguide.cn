<?php

class Forum_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function getTopicByVisibility($params) {
		$topic = array();
		
		$search = array();
		$search['module'] = $params['module'];
		$search['visibility'] = $params['visibility'];
		
		$query = $this->db_conn->from('forum_topic')->where($search)->order_by('create_time DESC')->limit(1)->get();
		
		if ($query->num_rows() > 0) {
			$topic = $query->row_array();
			
			$query = $this->db_conn->select('username')->where('admin_id = '.$topic['admin_id'])->get('administrators');
			$admin = $query->row_array();
			$topic['admin_name'] = $admin['username'];
			
			$item = $params['item'];
			$offset = $params['item'] * $params['page'];
			
			$topic['replies'] = array();
			
			$query = $this->db_conn->select('R.reply_id, R.topic_id, R.user_id, U.cellphone AS nickname, R.reply, R.create_time')
									->from('forum_reply AS R')->join('users AS U', 'U.user_id = R.user_id', 'LEFT')
									->where('R.topic_id = '.$topic['topic_id'])->order_by('R.create_time DESC')->limit($item, $offset)->get();
			
			if ($query->num_rows() > 0) {
				$replies = $query->result_array();
				
				foreach ($replies as &$one) {
					$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
				}
				
				$topic['replies'] = $replies;
			}
		}
		
		return $topic;
	}
	
	public function countTopicReplies($topic_id) {
		$search = array();
		$search['topic_id'] = $topic_id;
		
		return $this->db_conn->where($search)->count_all_results('forum_reply');
	}
	
	public function saveTopicReply($params) {
		$this->db_conn->insert('forum_reply', $params);
		
		return $this->db_conn->insert_id();
	}
}
/* End of file */