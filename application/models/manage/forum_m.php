<?php

class Forum_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function listTopics($params) {
		$topics = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$search = array();
		$search['visibility'] = $params['visibility'];
		
		$query = $this->db_conn->select('*')->from('forum_topic')->where($search)->order_by('create_time DESC')->limit($item, $offset)->get();
		if ($query->num_rows() > 0) {
			$topics = $query->result_array();
		}
		
		return $topics;
	}
	
	public function countTopics($params) {
		$search = array();
		$search['visibility'] = $params['visibility'];
		
		return $this->db_conn->from('forum_topic')->where($search)->count_all_results();
	}
	
	public function createTopic($params) {
		$this->db_conn->set($params)->insert('forum_topic');
		return $this->db_conn->insert_id();
	}
}
/* End of file */