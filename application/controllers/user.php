<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
	}
	
	public function register() {
		$params['cellphone'] = trim($this->input->post('cellphone', TRUE));
		$params['nickname'] = trim($this->input->post('nickname', TRUE));
		$params['password'] = trim($this->input->post('password', TRUE));		
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		$code = trim($this->input->post('code', TRUE));
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		// 
		if (strcasecmp($code, '123456') !== 0) {
			$ret['code'] = 1;
			$ret['msg'] = 'fail';
		}
		
		require APPPATH .'third_party/pass/PasswordHash.php';
		$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
		$params['password'] = $hasher->HashPassword($params['password']);
		
		$this->load->model('User_M');
		$user_id = $this->User_M->doRegistration($params);
		
		if ($user_id > 0) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
		}
		
		echo json_encode($ret);
	}
	
	public function login() {
		$params['cellphone'] = trim($this->input->get('cellphone'));
		$params['password'] = trim($this->input->get('password'));
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('User_M');
		$user = $this->User_M->getUserByCell($params['cellphone']);
		
		if (!empty($user)) {
			require APPPATH .'third_party/pass/PasswordHash.php';
			$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
			$chk_lower = $hasher->CheckPassword(strtolower($params['password']), $user['password']);
			$chk_upper = $hasher->CheckPassword(strtoupper($params['password']), $user['password']);
			
			if ($chk_lower || $chk_upper) {
				$ret['code'] = 0;
				$ret['msg'] = 'success';
			} else {
				$ret['code'] = 2;
				$ret['msg'] = 'password error';
			}
		} else {
			$ret['code'] = 3;
			$ret['msg'] = 'no this user';
		}
		
		echo json_encode($ret);
	}
	
	public function logout() {
		
	}
	
	public function userinfo() {
		
	}
	
	
}
/* End of file */