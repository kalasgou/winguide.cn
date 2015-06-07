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
		if ($params['course'] !== '') {
			$search['module'] = $params['course'];
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
		
		$query = $this->db_conn->select('*')->from('forum_topic')->where($search)->order_by('create_time DESC')->limit($item, $offset)->get();
		if ($query->num_rows() > 0) {
			$topics = $query->result_array();
		}
		
		return $topics;
	}
	
	public function countTopics($params) {
		$search = array();
		$search['visibility'] = $params['visibility'];
		if ($params['course'] !== '') {
			$search['module'] = $params['course'];
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
		
		return $this->db_conn->from('forum_topic')->where($search)->count_all_results();
	}
	
	public function createTopic($params) {
		$result = FALSE;
		
		if ($params['visibility'] === 'public') {
			$this->db_conn->set($params)->insert('forum_topic');
			$result = $this->db_conn->insert_id();
		} elseif ($params['visibility'] === 'course') {
			$homework = array();
			$homework['uuid'] = $params['uuid'];
			$homework['admin_id'] = $params['admin_id'];
			$homework['topic'] = $params['topic'];
			$homework['thread'] = $params['thread'];
			$homework['module'] = $params['module'];
			$homework['visibility'] = $params['visibility'];
			$homework['create_time'] = $params['create_time'];
			
			$exercises = $this->remarkExercises($params);
			$homework['remark'] = serialize($exercises);
			
			$this->db_conn->set($homework)->insert('forum_topic');
			$result = $this->db_conn->insert_id();
			
			$this->doAssignments($params, $result);
		}
		
		return $result;
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
	
	private function remarkExercises($params) {
		$exercises = array();
		
		$length = count($params['exercise_id']);
		for ($i = 0; $i < $length; $i++) {
			$tmp = array();
			$tmp['exercise_id'] = $params['exercise_id'][$i];
			$tmp['subject_en'] = $params['subject_en'][$i];
			$tmp['subject_cn'] = $params['subject_cn'][$i];
			$tmp['amount'] = $params['amount'][$i];
			
			$exercises[] = $tmp;
		}
		
		return $exercises;
	}
	
	private function doAssignments($params, $topic_id) {
		$assignments = array();
		$username_arr = explode(',', $params['assignment']);
		
		$query = $this->db_conn->select('user_id')->where('status = 1')->where_in('username', $username_arr)->get('students');
		if ($query->num_rows() > 0) {
			$rows = $query->result_array();
			foreach ($rows as $one) {
				$tmp = array();
				$tmp['user_id'] = $one['user_id'];
				$tmp['admin_id'] = $params['admin_id'];
				$tmp['topic_id'] = $topic_id;
				$tmp['status'] = 1;
				$tmp['create_time'] = $params['create_time'];
				
				$assignments[] = $tmp;
			}
		}
		
		return $this->db_conn->insert_batch('assignment', $assignments); 
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
	
	public function loadComments($params) {
		$comments = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$search = array();
		$search['topic_id'] = $params['topic_id'];
		
		$query = $this->db_conn->select('R.reply_id, U.user_id, U.real_name, R.reply, R.create_time')
								->from('forum_reply AS R')->join('users AS U', 'U.user_id = R.user_id')
								->where($search)
								->order_by('R.create_time DESC')
								->limit($item, $offset)
								->get();
								
		if ($query->num_rows() > 0) {
			$comments = $query->result_array();
		}
		
		return $comments;
	}
	
	public function countComments($params) {
		$search = array();
		$search['topic_id'] = $params['topic_id'];
		$search['status'] = 1;
		
		return $this->db_conn->from('forum_reply')->where($search)->count_all_results();
	}
}
/* End of file */