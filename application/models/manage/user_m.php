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
		
		$search = array();
		$search['account_type'] = $params['account_type'];
		$search['status'] = $params['status'];
		if ($params['start_date'] !== '') {
			$start_time = strtotime($params['start_date']);
			$search['create_time >= '] = $start_time;
		}
		if ($params['end_date'] !== '') {
			$end_time = strtotime($params['end_date']);
			$search['create_time <= '] = $end_time;
		}
		
		$query = $this->db_conn->select('user_id, nickname, cellphone, create_time, update_time, account_type, status')
					->from('users')->where($search)->order_by('create_time DESC')->limit($item, $offset)->get();
		
		if ($query->num_rows() > 0) {
			$users = $query->result_array();
		}
		
		return $users;
	}
	
	public function countUsers($params) {
		$search = array();
		$search['account_type'] = $params['account_type'];
		$search['status'] = $params['status'];
		if ($params['start_date'] !== '') {
			$start_time = strtotime($params['start_date']);
			$search['create_time >= '] = $start_time;
		}
		if ($params['end_date'] !== '') {
			$end_time = strtotime($params['end_date']);
			$search['create_time <= '] = $end_time;
		}
		
		return $this->db_conn->from('users')->where($search)->count_all_results();
	}
}
/* End of file */
	