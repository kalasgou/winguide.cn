<?php
class User_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function getUserByCell($cellphone) {
		$user = array();
		
		$query = $this->db_conn->select('*')->from('users')->where("cellphone = '{$cellphone}'")->limit(1)->get();
		if ($query->num_rows() > 0) {
			$user = $query->row_array();
		}
		
		$query->free_result();
		
		return $user;
	}
	
	public function doRegistration($params) {
		$this->db_conn->insert('users', $params);
		return $this->db_conn->insert_id();
	}
	
	public function retrieveUserinfo($params) {
		$user_info = array();
		
		if (!empty($_SESSION['user'])) {
			$user_info['basic']['id'] = $_SESSION['user']['id'];
			$user_info['basic']['nickname'] = $_SESSION['user']['nickname'];
			$user_info['basic']['realname'] = $_SESSION['user']['realname'];
			$user_info['basic']['is_student'] = $_SESSION['user']['is_student'];
			$user_info['courses'] = $_SESSION['user']['course_detail'];
			
			return $user_info;
		}
		
		if (empty($params)) {
			return $user_info;
		}
		
		$user_info['basic']['id'] = $params['user_id'];
		
		if (!empty($params['cellphone'])) {
			$user_info['basic']['nickname'] = $params['cellphone'];
		}
		if (!empty($params['username'])) {
			$user_info['basic']['nickname'] = $params['username'];
		}
		
		if (!empty($params['real_name'])) {
			$user_info['basic']['realname'] = $params['real_name'];
		} else {
			$query = $this->db_conn->select('real_name')->where('user_id = '.$params['user_id'])->limit(1)->get('users');
			if ($query->num_rows() > 0) {
				$row = $query->row_array();
				$user_info['basic']['realname'] = $row['real_name'];
			}
		}
		
		$user_info['basic']['is_student'] = FALSE;
		$user_info['courses'] = array();
		
		$query = $this->db_conn->select('student_id, username, course')->where('user_id = '.$params['user_id'])->get('students');
		if ($query->num_rows() > 0) {
			$user_info['basic']['is_student'] = TRUE;
			$user_info['courses'] = $query->result_array();
		}
		
		$_SESSION['userid'] = $user_info['basic']['id'];
		
		$_SESSION['user']['id'] = $user_info['basic']['id'];
		$_SESSION['user']['nickname'] = $user_info['basic']['nickname'];
		$_SESSION['user']['realname'] = $user_info['basic']['realname'];
		$_SESSION['user']['is_student'] = $user_info['basic']['is_student'];
		$_SESSION['user']['course_detail'] = $user_info['courses'];
		$_SESSION['user']['course_arr'] = array_map(function($one) {
			return $one['course'];
		}, $user_info['courses']);
		
		return $user_info;
	}
}
/* End of file */