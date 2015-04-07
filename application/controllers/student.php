<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->model('Student_M');
		echo $this->Student_M->isStudent();
	}
	
	public function addStudent() {
		$params['course'] = trim($this->input->post('course', TRUE));
		$params['amount'] = intval($this->input->post('amount', TRUE));
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('Student_M');
		$result = $this->Student_M->doRegistration($params);
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
		}
		
		echo json_encode($ret);
	}
	
	public function activateAccount() {
		$params = array();
		$post_arr = $this->input->post();
		foreach ($post_arr as $key => $val) {
			$val = trim($val);
			list($table, $blank) = explode(':', $key);
			if (strpos($blank, '-') !== FALSE) {
				list($option, $blank) = explode('-', $blank);
				$params[$table][$option][$blank] = $val !== '' ? $val : NULL;
			} else {
				$params[$table][$blank] = $val !== '' ? $val : NULL;
			}
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('Student_M');
		$student = $this->Student_M->getStudentByUname($params['student']['username']);
		
		if (!empty($student)) {
			require APPPATH .'third_party/pass/PasswordHash.php';
			$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
			$chk_lower = $hasher->CheckPassword(strtolower($params['student']['password']), $student['password']);
			$chk_upper = $hasher->CheckPassword(strtoupper($params['student']['password']), $student['password']);
			
			if ($chk_lower || $chk_upper) {
				
				$params['student'] = $student;
				$result = $this->Student_M->doActivation($params);
				
				if ($result) {
					$ret['code'] = 0;
					$ret['msg'] = 'success';
				}
			} else {
				$ret['code'] = 2;
				$ret['msg'] = 'password error';
			}
		} else {
			$ret['code'] = 3;
			$ret['msg'] = 'no this student';
		}
		
		
		
		
		echo json_encode($ret);
	}
	
	public function login() {
		$params['username'] = trim($this->input->get('username'));
		$params['password'] = trim($this->input->get('password'));
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('Student_M');
		$student = $this->Student_M->getStudentByUname($params['username']);
		
		if (!empty($student)) {
			require APPPATH .'third_party/pass/PasswordHash.php';
			$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
			$chk_lower = $hasher->CheckPassword(strtolower($params['password']), $student['password']);
			$chk_upper = $hasher->CheckPassword(strtoupper($params['password']), $student['password']);
			
			if ($chk_lower || $chk_upper) {
				$ret['code'] = 0;
				$ret['msg'] = 'success';
			} else {
				$ret['code'] = 2;
				$ret['msg'] = 'password error';
			}
		} else {
			$ret['code'] = 3;
			$ret['msg'] = 'no this student';
		}
		
		echo json_encode($ret);
	}
	
	public function logout() {
		
	}
}
/* End of file */