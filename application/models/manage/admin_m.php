<?php
class Admin_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function isLegal() {
		return FALSE;
	}
	
	public function getAdminByUname($username) {
		$admin = array();
		$query = $this->db_conn->select('admin_id, username, password, status')
						->from('administrators')->where("username = '{$username}'")->limit(1)->get();
		
		if ($query->num_rows() > 0) {
			$admin = $query->row_array();
		}
		
		$query->free_result();
		
		return $admin;
	}
}
/* End of file */