<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView() {
		$data = array();
		$data['hover'] = 'admin';
		$this->load->view('manage/admin_lists', $data);
	}
	
	public function createView() {
	}
	
	public function searchView() {
	}
	
	public function register() {
		$params['username'] = trim($this->input->post('username'));
		$params['email'] = trim($this->input->post('email'));
		$params['password'] = trim($this->input->post('password'));
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		require APPPATH .'third_party/pass/PasswordHash.php';
		$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
		$params['password'] = $hasher->HashPassword($params['password']);
		
		$this->load->model('manage/Admin_M');
		$admin_id = $this->Admin_M->doRegistration($params);
		
		if ($admin_id > 0) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
		}
		
		echo json_encode($ret);
	}
	
	public function login() {
		$params['email'] = trim($this->input->get('email'));
		$params['password'] = trim($this->input->get('password'));
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('manage/Admin_M');
		$admin = $this->Admin_M->getAdminByEmail($params['email']);
		
		if (!empty($admin)) {
			require APPPATH .'third_party/pass/PasswordHash.php';
			$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
			$chk_lower = $hasher->CheckPassword(strtolower($params['password']), $admin['password']);
			$chk_upper = $hasher->CheckPassword(strtoupper($params['password']), $admin['password']);
			
			if ($chk_lower || $chk_upper) {
				$ret['code'] = 0;
				$ret['msg'] = 'success';
			} else {
				$ret['code'] = 2;
				$ret['msg'] = 'password error';
			}
		} else {
			$ret['code'] = 3;
			$ret['msg'] = 'no this administrator';
		}
		
		echo json_encode($ret);
	}
}
/* End of file */