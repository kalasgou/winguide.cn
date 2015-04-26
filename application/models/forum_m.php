<?php

class Forum_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function getTopicByVisibility($params) {
		$topic = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$search = array();
		$search['module'] = $params['module'];
		$search['visibility'] = $params['visibility'];
		
		$query = $this->db_conn->from('forum_topic')->where($search)->order_by('create_time DESC')->limit(1)->get();
		
		if ($query->num_rows() > 0) {
			$topic = $query->row_array();
			$query = $this->db_conn->from('forum_reply')->where('topic_id = '.$topic['topic_id'])->order_by('create_time DESC')->limit($item, $offset)->get();
			
			$topic['replies'] = array();
			if ($query->num_rows() > 0) {
				$topic['replies'] = $query->result_array();
			}
		}
		
		return $topic;
	}
	
	public function saveTopicReply($params) {
		$this->db_conn->insert('forum_reply', $params);
		
		return $this->db_conn->insert_id();
	}
}
/* End of file */