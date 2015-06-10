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
		$params['privilege'] = trim($this->input->get('privilege', TRUE));
		$params['status'] = 1;
		
		$output = array();
		$output['hover'] = 'admin';
		$output['args'] = $params;
		
		$this->load->model('manage/Admin_M');
		$output['admins'] = $this->Admin_M->listAdmins($params);
		
		foreach ($output['admins'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
			$one['update_time_formatted'] = $one['update_time'] === '0' ? '-' : date('Y-m-d H:i:s', $one['update_time']);
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
	
	public function detailView() {
		
	}
	
	public function searchView() {
		
	}
	
	public function resetPswdView() {
		
	}
	
	public function login() {
		$params['email'] = trim($this->input->get('email'));
		$params['password'] = trim($this->input->get('password'));
		
		header('Content-Type: text/html, charset=utf-8');
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
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
				
				if (!empty($_SESSION['admin'])) {
					unset($_SESSION['admin']);
				}
				
				$_SESSION['admin']['id'] = $admin['admin_id'];
				$_SESSION['admin']['username'] = $admin['username'];
				
				if ($admin['privilege'] == ADMIN || $admin['privilege'] == TEACHER) {
					exit( '	<script type="text/javascript">
								alert("'.$ret['msg'].'");
								location.href = "'.base_url('console/article').'";
							</script>');
				} elseif ($admin['privilege'] == AGENCY) {
					exit( '	<script type="text/javascript">
								alert("'.$ret['msg'].'");
								location.href = "'.base_url('manage/application/form').'";
							</script>');
				}
			} else {
				$ret['code'] = 2;
				$ret['msg'] = 'password error';
			}
		} else {
			$ret['code'] = 3;
			$ret['msg'] = 'no this administrator';
		}
		
		//header('Content-Type: application/json, charset=utf-8');
		
		//echo json_encode($ret);
		exit( '	<script type="text/javascript">
					alert("'.$ret['msg'].'");
					location.href = "'.base_url('manage/login').'";
				</script>');
	}
	
	public function logout() {
		//session_unset();
		if (!empty($_SESSION['admin'])) {
			unset($_SESSION['admin']);
		}
		
		header('Content-Type: text/html, charset=utf-8');
		
		echo 	'<script type="text/javascript">
					alert("帐号已登出");
					location.href = "'.base_url('manage/login').'"
				</script>';
	}
	
	public function register() {
		$params['email'] = trim($this->input->post('email', TRUE));
		$params['password'] = trim($this->input->post('password', TRUE));
		$params['username'] = trim($this->input->post('username', TRUE));
		$params['privilege'] = intval($this->input->post('privilege', TRUE));
		$params['status'] = 1;
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		//header('Content-Type: application/json, charset=utf-8');
		header('Content-Type: text/html, charset=utf-8');
		
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
		
		//echo json_encode($ret);
		
		echo 	'<script type="text/javascript">
					alert("'.$reg['msg'].'");
					location.href = "'.base_url('console/admin').'"
				</script>';
	}
	
	public function update() {
		$type = trim($this->input->post('type', TRUE));
		$params['admin_id'] = trim($this->input->post('admin_id', TRUE));
		$params['email'] = trim($this->input->post('email', TRUE));
		$params['username'] = trim($this->input->post('username', TRUE));
		$params['old_pswd'] = trim($this->input->post('old_pswd', TRUE));
		$params['new_pswd'] = trim($this->input->post('new_pswd', TRUE));
		$params['status'] = trim($this->input->post('status', TRUE));
		$params['update_time'] = $_SERVER['REQUEST_TIME'];
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$result = FALSE;
		$this->load->model('manage/Admin_M');
		switch ($type) {
			case 'update': 
			case 'trash': 
					$result = $this->Admin_M->updateAccount($params);
					break;
			case 'reset': 
					$result = $this->Admin_M->resetPassword($params);
					break;
			default : 
					$ret['code'] = 2;
					$ret['msg'] = 'Illeagal Operation';
		}
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
		}
		
		echo json_encode($ret);
	}
}
/* End of file */