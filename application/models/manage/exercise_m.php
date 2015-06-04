<?php

class Exercise_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function listExercises($params) {
		$exercises = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$search = array();
		if ($params['course'] !== '') {
			$search['course'] = $params['course'];
		}
		if ($params['admin_id'] !== 0) {
			$search['admin_id'] = $params['admin_id'];
		}
		if ($params['start_date'] !== '') {
			$start_time = strtotime($params['start_date']);
			$search['create_time >= '] = $start_time;
		}
		if ($params['end_date'] !== '') {
			$end_time = strtotime($params['end_date']);
			$search['create_time <= '] = $end_time;
		}
		
		$query = $this->db_conn->select('*')->from('exercises')->where($search)->order_by('create_time DESC')->limit($item, $offset)->get();
		if ($query->num_rows() > 0) {
			$exercises = $query->result_array();
		}
		
		return $exercises;
	}
	
	public function countExercises($params) {
		$search = array();
		if ($params['course'] !== '') {
			$search['course'] = $params['course'];
		}
		if ($params['admin_id'] !== '') {
			$search['admin_id'] = $params['admin_id'];
		}
		if ($params['start_date'] !== '') {
			$start_time = strtotime($params['start_date']);
			$search['create_time >= '] = $start_time;
		}
		if ($params['end_date'] !== '') {
			$end_time = strtotime($params['end_date']);
			$search['create_time <= '] = $end_time;
		}
		
		return $this->db_conn->from('exercises')->where($search)->count_all_results();
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