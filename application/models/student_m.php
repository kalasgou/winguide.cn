<?php
class Student_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function getStudentByUname($username) {
		$student = array();
		$query = $this->db_conn->select('student_id, user_id, username, password, course, purchase_time, start_time, end_time, duration, status')
						->from('students')->where("username = '{$username}'")->limit(1)->get();
		
		if ($query->num_rows() > 0) {
			$student = $query->row_array();
		}
		
		$query->free_result();
		
		return $student;
	}
	
}
/* End of file */