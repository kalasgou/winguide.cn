<?php
class User_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function listUsers($params) {
		$users = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$query = $this->db_conn->select('user_id, nickname, cellphone, create_time, status')
					->from('users')->order_by('create_time DESC')->limit($item, $offset)->get();
		
		if ($query->num_rows() > 0) {
			$users = $query->result_array();
		}
		
		return $users;
	}
	
	public function countUsers() {
		return $this->db_conn->count_all('users');
	}
}
/* End of file */
	