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
		$query = $this->db_conn->select('student_id, user_id, username, password, course, status')
						->from('students')->where("username = '{$username}'")->limit(1)->get();
		
		if ($query->num_rows() > 0) {
			$student = $query->row_array();
		}
		
		$query->free_result();
		
		return $student;
	}
	
	public function doLogin($params) {
		
	}
	
	public function doRegistration($params) {
		$students = array();
		
		require APPPATH .'third_party/pass/PasswordHash.php';
		
		for ($i = 1; $i <= $params['amount']; $i++) {
			$tmp = array();
			$tmp['course'] = $params['course'];		
			$tmp['init_pswd'] = gen_random_password(8);
			$init_pswd_md5 = md5($tmp['init_pswd']);
			$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
			$tmp['password'] = $hasher->HashPassword($init_pswd_md5);
			$tmp['purchase_time'] = $_SERVER['REQUEST_TIME'];
			$tmp['status'] = $this->UNAVAILABLE;
			
			$students[] = $tmp;
		}
		
		if ($this->db_conn->insert_batch('students', $students)) {
			$query = $this->db_conn->select('student_id')->from('students')->where('status = ' .$this->UNAVAILABLE)->get();
			if ($query->num_rows() > 0) {
				$usernames = array();
				$rows = $query->result_array();
				foreach ($rows as $one) {
					$tmp = array();
					$tmp['student_id'] = $one['student_id'];
					$tmp['username'] = gen_student_serial($one['student_id']);
					$tmp['status'] = $this->INITIALIZED;
					$usernames[] = $tmp;
				}
			}
			$this->db_conn->update_batch('students', $usernames, 'student_id');
			
			return TRUE;
		}
		
		return FALSE;
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
		
		// Exams
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
}
/* End of file */