<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_M extends CI_Controller {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function loadHomework($params) {
		$homework = array();
		$homework['replies'] = array();
		
		$search = array();
		$search['T.module'] = $params['module'];
		$search['T.visibility'] = $params['visibility'];
		$search['A.user_id'] = $params['user_id'];
		
		$query = $this->db_conn->select('T.topic_id, T.admin_id, T.uuid, T.topic, T.thread, T.remark, A.create_time')
								->from('assignment AS A')->join('forum_topic AS T', 'T.topic_id = A.topic_id')
								->where($search)->order_by('A.create_time', 'DESC')->limit(1)->get();
		
		if ($query->num_rows() > 0) {
			$homework = $query->row_array();
			$homework['remark'] = unserialize($homework['remark']);
			$homework['create_time_formatted'] = date('Y-m-d H:i:s', $homework['create_time']);
			
			$query = $this->db_conn->select('username')->where('admin_id = '.$homework['admin_id'])->get('administrators');
			$admin = $query->row_array();
			$homework['admin_name'] = $admin['username'];
			
			$item = $params['item'];
			$offset = $params['item'] * $params['page'];
			
			$query = $this->db_conn->select('R.reply_id, R.topic_id, R.user_id, U.cellphone AS nickname, R.reply, R.create_time')
									->from('forum_reply AS R')->join('users AS U', 'U.user_id = R.user_id', 'LEFT')
									->where('R.topic_id = '.$homework['topic_id'])->order_by('R.create_time DESC')->limit($item, $offset)->get();
			
			if ($query->num_rows() > 0) {
				$replies = $query->result_array();
				
				foreach ($replies as &$one) {
					$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
				}
				
				$homework['replies'] = $replies;
			}
		}
		
		return $homework;
	}
	
	public function countTopicReplies($topic_id) {
		$search = array();
		$search['topic_id'] = $topic_id;
		
		return $this->db_conn->where($search)->count_all_results('forum_reply');
	}
	
	public function loadExercises($params) {
		$exercises = array();
		
		$query = $this->db_conn->where('exercise_id = '.$params['exercise_id'])->limit(1)->get('exercises');
		
		if ($query->num_rows() > 0) {
			$exercises = $query->row_array();
			$exercises['numbers_arr'] = explode(',', $exercises['numbers']);
		}
		
		return $exercises;
	}
	
	public function calculateScore($params) {
		$scores = array();
		
		$course = strtoupper($params['course']);
		$function = "my{$course}Scores";
		
		$db_reader = $this->load->database('exercise', TRUE);
		
		return $this->$function($db_reader, $params);
	}
	
	private function myGMATScores($db_conn, $params) {
		
	}
	
	private function myGREScores($db_conn, $params) {
		
	}
	
	private function myIELTSScores($db_conn, $params) {
		
	}
	
	private function mySATScores($db_conn, $params) {
		$scores = array();
		
		$query = $db_conn->select_sum('yes')->where('userid = '.$params['user_id'])->get('sattj_math1');
		$row = $query->row_array();
		$row['yes'] = intval($row['yes']);
		$row['subject'] = '数学';
		
		$scores[] = $row;
		
		$query = $db_conn->select_sum('yes')->where('userid = '.$params['user_id'])->get('sattj_danci');
		$row = $query->row_array();
		$row['yes'] = intval($row['yes']);
		$row['subject'] = '单词';
		
		$scores[] = $row;
		
		$query = $db_conn->select_sum('yes')->where('userid = '.$params['user_id'])->get('sattj_yufa');
		$row = $query->row_array();
		$row['yes'] = intval($row['yes']);
		$row['subject'] = '语法';
		
		$scores[] = $row;
		
		$query = $db_conn->select_sum('yes')->where('userid = '.$params['user_id'])->get('sattj_yufa');
		$row = $query->row_array();
		$row['yes'] = intval($row['yes']);
		$row['subject'] = '阅读';
		
		$scores[] = $row;
		
		$query = $db_conn->select_sum('yes')->where('userid = '.$params['user_id'])->get('sattj_yufa');
		$row = $query->row_array();
		$row['yes'] = intval($row['yes']);
		$row['subject'] = '写作';
		
		$scores[] = $row;
		
		return $scores;
	}
	
	private function myTOEFLScores($db_conn, $params) {
		$yes = 0;
		$no = 0;
		
		$query = $db_conn->select_sum('yes')->where('userid = '.$params['user_id'])->get('tftj_danci');
		$row = $query->row_array();
		$yes += intval($row['yes']);
		
		$query = $db_conn->select_sum('wrong')->where('userid = '.$params['user_id'])->get('tftj_danci');
		$row = $query->row_array();
		$no += intval($row['wrong']);
		
		$tmp = array();
		$tmp['yes'] = $yes;
		$tmp['subject'] = '对';
		$scores[] = $tmp;
		
		$tmp = array();
		$tmp['yes'] = $no;
		$tmp['subject'] = '错';
		$scores[] = $tmp;
		
		return $scores;
	}
	
	private function myGAOKAOScores($db_conn, $params) {
		
	}
}
/* End of File */