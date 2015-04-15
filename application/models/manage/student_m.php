<?php

class Student_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function listStudents($params) {
		$students = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$query = $this->db_conn->select('S.student_id, S.username, S.course, S.purchase_time, S.start_time, S.end_time, S.status, U.user_id, U.real_name, U.cellphone')
					->from('students AS S')->join('users AS U', 'U.user_id = S.user_id')
					/*->order_by('start_time DESC')->limit($item, $offset)*/->get();
		
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
					->from('students')/*->order_by('purchase_time DESC')->limit($item, $offset)*/->get();
		
		if ($query->num_rows() > 0) {
			$accounts = $query->result_array();
		}
		
		return $accounts;
	}
}
/* End of file */