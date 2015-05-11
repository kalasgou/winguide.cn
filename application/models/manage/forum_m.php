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
	
	public function modifyTopic($params) {
		$search = array();
		$search['topic_id'] = $params['topic_id'];
		
		$refresh = array();
		foreach ($params as $key => $val) {
			if ($key !== 'topic_id' && $val !== '') {
				$refresh[$key] = $val;
			}
		}
		
		return $this->db_conn->where($search)->update('forum_topic', $refresh);
	}
	
	public function viewTopic($params) {
		$detail = array();
		
		$search = array();
		$search['topic_id'] = $params['topic_id'];
		
		$query = $this->db_conn->select('*')->from('forum_topic')->where($search)->limit(1)->get();
		if ($query->num_rows() > 0) {
			$detail = $query->row_array();
		}
		
		return $detail;
	}
}
/* End of file */