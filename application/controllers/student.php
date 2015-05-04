<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
	}
	
	public function activateAccount() {
		$params = array();
		$post_arr = $this->input->post();
		//var_dump($post_arr);exit();
		//echo json_encode($post_arr); exit();
		foreach ($post_arr as $key => $val) {
			list($table, $blank) = explode(':', $key);
			if (is_string($val)) {
				$actual = trim($val);
				if (strpos($blank, '-') !== FALSE) {
					list($option, $sub_blank) = explode('-', $blank);
					$params[$table][$option][$sub_blank] = $actual !== '' ? $actual : NULL;
				} else {
					$params[$table][$blank] = $actual !== '' ? $actual : NULL;
				}
			} elseif (is_array($val)) {
				$index = 1;
				foreach ($val as $one) {
					$actual = trim($one);
					if (strpos($blank, '-') !== FALSE) {
						list($option, $sub_blank) = explode('-', $blank);
						$params[$table][$option][$sub_blank."_$index"] = $actual !== '' ? $actual : NULL;
					} else {
						$params[$table][$blank."_$index"] = $actual !== '' ? $actual : NULL;
					}
					++$index;
				}
			}
		}
		//var_dump($params);exit();
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('Student_M');
		$student = $this->Student_M->getStudentByUname($params['student']['username']);
		
		if (!empty($student)) {
			if ($student['status'] === '0') {
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
				$ret['code'] = 4;
				$ret['msg'] = 'already activated';
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
	
	
}
/* End of file */