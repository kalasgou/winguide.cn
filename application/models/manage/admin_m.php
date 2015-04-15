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
	
	public function listAdmins($params) {
		$admins = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$query = $this->db_conn->select('*')->from('administrators')->order_by('create_time DESC')/*->limit($item, $offset)*/->get();
		if ($query->num_rows() > 0) {
			$admins = $query->result_array();
		}
		
		return $admins;
	}
	
	public function getAdminByEmail($email) {
		$admin = array();
		$query = $this->db_conn->select('admin_id, username, email, password, status')
						->from('administrators')->where("email = '{$email}'")->limit(1)->get();
		
		if ($query->num_rows() > 0) {
			$admin = $query->row_array();
		}
		
		$query->free_result();
		
		return $admin;
	}
	
	public function doRegistration($params) {
		$this->db_conn->insert('administrators', $params);
		return $this->db_conn->insert_id();
	}
}
/* End of file */