<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView($item = DEFAULT_PER_PAGE, $page = DEFAULT_START_PAGE) {
		$params['item'] = intval($item) <= 0 ? DEFAULT_PER_PAGE : $item;
		$params['page'] = intval($page) <= 0 ? DEFAULT_START_PAGE : $page - 1;
		
		$output = array();
		$output['hover'] = 'admin';
		
		$this->load->model('manage/Admin_M');
		$output['admins'] = $this->Admin_M->listAdmins($params);
		
		foreach ($output['admins'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
		}
		
		$output['total_num'] = $this->Admin_M->countAdmins($params);
		$output['pagination'] = gen_pagination(base_url("console/admin/view/lists/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/admin_lists', $output);
	}
	
	public function createView() {
		$output = array();
		$output['hover'] = 'admin';
		
		$this->load->view('manage/admin_create', $output);
	}
	
	public function searchView() {
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
				
				header('Location: '.base_url('console/article'));
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
	
	public function register() {
		$params['email'] = trim($this->input->post('email', TRUE));
		$params['password'] = trim($this->input->post('password', TRUE));
		$params['username'] = trim($this->input->post('username', TRUE));
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('manage/Admin_M');
		$admin = $this->Admin_M->getAdminByEmail($params['email']);
		
		if (empty($admin)) {
			require APPPATH .'third_party/pass/PasswordHash.php';
			$hasher = new PasswordHash(HASH_COST_LOG2, HASH_PORTABLE);
			$params['password'] = $hasher->HashPassword($params['password']);
			
			$admin_id = $this->Admin_M->doRegistration($params);
			if ($admin_id > 0) {
				$ret['code'] = 0;
				$ret['msg'] = 'success';
			}
		} else {
			$ret['code'] = 4;
			$ret['msg'] = 'this email already registered';
		}
		
		echo json_encode($ret);
	}
	
	public function update() {
		
	}
}
/* End of file */