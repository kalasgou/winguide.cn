<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function login() {
		$params['username'] = trim($this->input->get('username', TRUE));
		$params['password'] = trim($this->input->get('password', TRUE));
		
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
			if ($student['status'] > 0) {
				require APPPATH .'third_party/pass/PasswordHash.php';
				$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
				$chk_lower = $hasher->CheckPassword(strtolower($params['password']), $student['password']);
				$chk_upper = $hasher->CheckPassword(strtoupper($params['password']), $student['password']);
				
				if ($chk_lower || $chk_upper) {
					$ret['code'] = 0;
					$ret['msg'] = 'success';
					
					session_unset();
					
					$this->load->model('User_M');
					$this->User_M->retrieveUserinfo($student);
				} else {
					$ret['code'] = 2;
					$ret['msg'] = 'password error';
				}
			} else {
				$ret['code'] = 7;
				$ret['msg'] = 'account not activated or cancelled or expired';
			}
		} else {
			$ret['code'] = 3;
			$ret['msg'] = 'no this student';
		}
		
		echo json_encode($ret);
	}
	
}
/* End of file */