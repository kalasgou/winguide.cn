<?php
class User_M extends CI_Model {
	
	private $STUDENT_TYPE = 123;
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function isStudent() {
		return $this->STUDENT_TYPE;
	}
	
	public function getUserByCell($cellphone) {
		$user = array();
		
		$query = $this->db_conn->select('*')->from('users')->where("cellphone = '{$cellphone}'")->limit(1)->get();
		if ($query->num_rows() > 0) {
			$user = $query->row_array();
		}
		
		return $user;
	}
	
	public function doRegistration($params) {
		$this->db_conn->insert('users', $params);
		return $this->db_conn->insert_id();
	}
}
/* End of file */