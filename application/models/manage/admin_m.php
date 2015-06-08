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
	
	public function listEmployees() {
		$employees = array();
		
		$query = $this->db_conn->select('*')->from('administrators')
						->where('status = 1')->where_in('privilege', array(ADMIN, TEACHER))
						->order_by('create_time DESC')->get();
		if ($query->num_rows() > 0) {
			$employees = $query->result_array();
		}
		
		return $employees;
	}
	
	public function listAdmins($params) {
		$admins = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$search = array();
		if ($params['privilege'] !== '') {
			$search['privilege'] = $params['privilege'];
		}
		$search['status'] = $params['status'];
		
		$query = $this->db_conn->select('*')->from('administrators')->where($search)->order_by('create_time DESC')->limit($item, $offset)->get();
		if ($query->num_rows() > 0) {
			$admins = $query->result_array();
		}
		
		return $admins;
	}
	
	public function countAdmins($params) {
		$search = array();
		if ($params['privilege'] !== '') {
			$search['privilege'] = $params['privilege'];
		}
		$search['status'] = $params['status'];
		
		return $this->db_conn->from('administrators')->where($search)->count_all_results();
	}
	
	public function getAdminByEmail($email) {
		$admin = array();
		$query = $this->db_conn->select('*')->from('administrators')->where("email = '{$email}'")->limit(1)->get();
		
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
	
	public function updateAccount($params) {
		$search = array();
		$search['admin_id'] = $params['admin_id'];
		
		$refresh = array();
		foreach ($params as $key => $val) {
			if ($key !== 'admin_id' && $val !== '') {
				$refresh[$key] = $val;
			}
		}
		
		return $this->db_conn->where($search)->update('administrators', $refresh);
	}
	
	public function resetPassword($params) {
		$user = array();
		
		$query = $this->db_conn->select('*')->from('administrators')->where("admin_id = {$params['admin_id']}")->limit(1)->get();
		if ($query->num_rows() > 0) {
			$user = $query->row_array();
			$query->free_result();
		} else {
			return FALSE;
		}
		
		require APPPATH .'third_party/pass/PasswordHash.php';
		$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
		$chk_lower = $hasher->CheckPassword(strtolower($params['old_pswd']), $user['password']);
		$chk_upper = $hasher->CheckPassword(strtoupper($params['old_pswd']), $user['password']);
		
		if (strlen($params['new_pswd']) < 6) {
			return FALSE;
		}
		
		if ($chk_lower || $chk_upper) {
			$new_password = $hasher->HashPassword($params['new_pswd']);
			
			return $this->db_conn->where("admin_id = {$params['admin_id']}")->update('administrators', array('password' => $new_password, 'update_time' => $params['update_time']));
		} else {
			return FALSE;
		}
	}
}
/* End of file */