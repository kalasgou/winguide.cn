<?php
class Student_M extends CI_Model {
	
	private $STUDENT_TYPE = 123;
	
	private $UNAVAILABLE = -1;
	private $INITIALIZED = 0;
	private $ACTIVATED = 1;
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function isStudent() {
		return $this->STUDENT_TYPE;
	}
	
	public function getStudentByUname($username) {
		$student = array();
		$query = $this->db_conn->select('student_id, user_id, username, password, course, duration, status')
						->from('students')->where("username = '{$username}'")->limit(1)->get();
		
		if ($query->num_rows() > 0) {
			$student = $query->row_array();
		}
		
		$query->free_result();
		
		return $student;
	}
	
	public function doActivation($params) {
		$user_id = 0;
		$student_id = $params['student']['student_id'];
		$query = $this->db_conn->select('user_id')->from('users')->where("cellphone = '{$params['basic']['cellphone']}'")->limit(1)->get();
		if ($query->num_rows() > 0) {
			$user = $query->row_array();
			$params['basic']['update_time'] = $_SERVER['REQUEST_TIME'];
			$params['basic']['account_type'] = $this->STUDENT_TYPE;
			$params['basic']['status'] = $this->ACTIVATED;
			
			$this->db_conn->where("user_id = {$user['user_id']}")->update('users', $params['basic']);
			$user_id = $user['user_id'];
		} else {
			$params['basic']['create_time'] = $_SERVER['REQUEST_TIME'];
			$params['basic']['account_type'] = $this->STUDENT_TYPE;
			$params['basic']['status'] = $this->ACTIVATED;
			
			$this->db_conn->set($params['basic'])->insert('users');
			$user_id = $this->db_conn->insert_id();
		}
		
		$this->db_conn->where("student_id = {$student_id}")
					->update('students', array('user_id' => $user_id, 'status' => $this->ACTIVATED));
		
		// Standard Exams
		$exams = array();
		foreach ($params['exam'] as $subject => $profiles) {
			foreach ($profiles as $key => $val) {
				$tmp = array();
				$tmp['student_id'] = $student_id;
				$tmp['subject'] = $subject;
				$tmp['profile'] = $key;
				$tmp['quality'] = $val;
				
				$exams[] = $tmp;
			}
		}
		
		$this->db_conn->insert_batch('student_standardization', $exams);
		
		// Family
		$family = array();
		foreach ($params['family'] as $parent => $profiles) {
			$tmp = array();
			$tmp['student_id'] = $student_id;
			$tmp['parent'] = $parent;
			$tmp = array_merge($tmp, $profiles);
			$family[] = $tmp;
		}
		
		$this->db_conn->insert_batch('student_family', $family);
		
		// Education
		$education = array();
		foreach ($params['edu'] as $degree => $profiles) {
			foreach ($profiles as $key => $val) {
				$tmp = array();
				$tmp['student_id'] = $student_id;
				$tmp['degree'] = $degree;
				$tmp['profile'] = $key;
				$tmp['quality'] = $val;
				
				$education[] = $tmp;
			}
		}
		
		$this->db_conn->insert_batch('student_education', $education);
		
		// Application
		$application = array();
		$application['student_id'] = $student_id;
		foreach ($params['application'] as $key => $val) {
			$application[$key] = $val;
		}
		
		$this->db_conn->insert('student_application', $application);
		
		// Referee
		$referee = array();
		$referee['student_id'] = $student_id;
		foreach ($params['referee'] as $key => $val) {
			$referee[$key] = $val;
		}
		
		$this->db_conn->insert('student_referee', $referee);
		
		return TRUE;
	}
	
	public function retrieveScores() {
		return FALSE;
	}
}
/* End of file */