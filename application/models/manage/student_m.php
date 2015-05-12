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
	
	public function listStudents($params) {
		$students = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$query = $this->db_conn->select('S.student_id, S.username, S.course, S.purchase_time, S.start_time, S.end_time, S.status, U.user_id, U.real_name, U.cellphone')
					->from('students AS S')->join('users AS U', 'U.user_id = S.user_id')
					->order_by('start_time DESC, student_id DESC')->limit($item, $offset)->get();
		
		if ($query->num_rows() > 0) {
			$students = $query->result_array();
		}
		
		return $students;
	}
	
	public function listAccounts($params) {
		$accounts = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$query = $this->db_conn->select('student_id, username, course, purchase_time, init_pswd, status')
					->from('students')->order_by('purchase_time DESC, student_id DESC')->limit($item, $offset)->get();
		
		if ($query->num_rows() > 0) {
			$accounts = $query->result_array();
		}
		
		return $accounts;
	}
	
	public function countAccounts() {
		$total_num = $this->db_conn->from('students')/*->where()*/->count_all_results();
		
		return intval($total_num);
	}
	
	public function countStudents() {
		$total_num = $this->db_conn->from('students')/*->where()*/->count_all_results();
		
		return intval($total_num);
	}
	
	public function getAccountDetail($student_id) {
		$detail = array();
		
		$search = array();
		$search['student_id'] = $student_id;
		
		$query = $this->db_conn->select('user_id, username, course, purchase_time')->from('students')->where('student_id = '.$student_id)->limit(1)->get();
		if ($query->num_rows() > 0) {
			$detail['student'] = array();
			$row = $query->row_array();
			$detail['student'] = $row;
			
			if ($row['user_id'] > 0) {
				// Basic
				$query = $this->db_conn->select('real_name, used_name, birthday, sex, marriage, born_city, family_addr, family_zip_code, contact_addr, contact_zip_code, email, telephone, cellphone')
									->from('users')->where('user_id = '.$row['user_id'])->limit(1)->get();
				
				$detail['basic'] = array();
				if ($query->num_rows() > 0) {
					$detail['basic'] = $query->row_array();
				}
				
				// Standard Exams
				$query = $this->db_conn->select('*')->from('student_standardization')->where('student_id = '.$student_id)->get();
				
				$detail['exam'] = array();
				if ($query->num_rows() > 0) {
					$exams = $query->result_array();
					foreach ($exams as $one) {
						$key = strtolower($one['subject'].'-'.$one['profile']);
						$detail['exam'][$key] = $one['quality'];
					}
				}
				
				// Family
				$query = $this->db_conn->select('*')->from('student_family')->where('student_id = '.$student_id)->get();
				
				$detail['family'] = array();
				if ($query->num_rows() > 0) {
					$family = $query->result_array();
					foreach ($family as $one) {
						$detail['family'][$one['parent']] = $one;
					}
				}
				
				// Education
				$query = $this->db_conn->select('*')->from('student_education')->where('student_id = '.$student_id)->get();
				
				$detail['edu'] = array();
				if ($query->num_rows() > 0) {
					$education = $query->result_array();
					foreach ($education as $one) {
						$detail['edu'][$one['degree'].'-'.$one['profile']] = $one['quality'];
					}
				}
				
				// Application
				$query = $this->db_conn->select('*')->from('student_application')->where('student_id = '.$student_id)->limit(1)->get();
				
				$detail['application'] = array();
				if ($query->num_rows() > 0) {
					$detail['application'] = $query->row_array();
				}
				
				// Referee
				$query = $this->db_conn->select('*')->from('student_referee')->where('student_id = '.$student_id)->limit(1)->get();
				
				$detail['referee'] = array();
				if ($query->num_rows() > 0) {
					$detail['referee'] = $query->row_array();
				}
				
			}
		}
		
		return $detail;
	}
	
	public function getMaxStudentID() {
		$query = $this->db_conn->select_max('student_id')->get('students');
		$row = $query->row_array();
		
		return intval($row['student_id']);
	}
}
/* End of file */