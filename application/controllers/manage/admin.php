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
		$params['status'] = ACTIVATED;
		
		$output = array();
		$output['hover'] = 'admin';
		$output['args'] = $params;
		
		$this->load->model('manage/Admin_M');
		$output['admins'] = $this->Admin_M->listAdmins($params);
		
		$account_types = array(ADMIN => '管理员', TEACHER => '老师', AGENCY => '中介');
		
		foreach ($output['admins'] as &$one) {
			$one['account_type'] = $account_types[$one['privilege']];
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
		
		//header('Content-Type: text/html, charset=utf-8');
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		$ret['msg_cn'] = '系统错误，请联系技术人员';
		
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
				$ret['msg_cn'] = '登录成功';
				
				if (!empty($_SESSION['admin'])) {
					unset($_SESSION['admin']);
				}
				
				$_SESSION['admin']['id'] = $admin['admin_id'];
				$_SESSION['admin']['username'] = $admin['username'];
				
				if ($admin['privilege'] == ADMIN || $admin['privilege'] == TEACHER) {
					/*echo( '	<script type="text/javascript">
								alert("'.$ret['msg'].'");
								location.href = "'.base_url('console/article').'";
							</script>');*/
					header('Location: '.base_url('console/article'));
				} elseif ($admin['privilege'] == AGENCY) {
					/*echo( '	<script type="text/javascript">
								alert("'.$ret['msg'].'");
								location.href = "'.base_url('manage/application/form').'";
							</script>');*/
					header('Location: '.base_url('manage/application/form'));
				}
				exit();
			} else {
				$ret['code'] = 2;
				$ret['msg'] = 'password error';
				$ret['msg_cn'] = '登录密码错误';
			}
		} else {
			$ret['code'] = 3;
			$ret['msg'] = 'no this administrator';
			$ret['msg_cn'] = '帐号不存在';
		}
		
		//header('Content-Type: application/json, charset=utf-8');
		
		//echo json_encode($ret);
		/*echo( '	<!DOCTYPE html><html><head><script type="text/javascript">
					alert("'.$ret['msg'].'");
					location.href = "'.base_url('manage/login').'";
				</script></head><body></body></html>');
		exit();*/
		
		$msg = array();
		$msg['tips'] = $ret['msg_cn'];
		$link = 'javascript:history.go(-1);';
		$location = '返回上一页';
		$msg['target'] = '<a href="'.$link.'">'.$location.'</a>';
		show_error($msg, 403, $ret['msg']);
	}
	
	public function logout() {
		//session_unset();
		if (!empty($_SESSION['admin'])) {
			unset($_SESSION['admin']);
		}
		
		//header('Content-Type: text/html, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 0;
		$ret['msg'] = 'success';
		$ret['msg_cn'] = '成功登出系统';
		
		/*echo 	'<script type="text/javascript">
					alert("帐号已登出");
					location.href = "'.base_url('manage/login').'"
				</script>';*/
		
		$msg = array();
		$msg['tips'] = $ret['msg_cn'];
		$link = base_url('manage/login');
		$location = '返回登录页';
		$msg['target'] = '<a href="'.$link.'">'.$location.'</a>';
		show_error($msg, 200, $ret['msg']);
	}
	
	public function register() {
		$params['email'] = trim($this->input->post('email', TRUE));
		$params['password'] = trim($this->input->post('password', TRUE));
		$params['username'] = trim($this->input->post('username', TRUE));
		$params['privilege'] = intval($this->input->post('privilege', TRUE));
		$params['status'] = ACTIVATED;
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		//header('Content-Type: application/json, charset=utf-8');
		//header('Content-Type: text/html, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		$ret['msg_cn'] = '系统错误，请联系技术人员';
		
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
				$ret['msg_cn'] = '已成功新建帐号';
				
				header('Location: '.base_url('console/admin'));
			}
			exit();
		} else {
			$ret['code'] = 4;
			$ret['msg'] = 'this email already registered';
			$ret['msg_cn'] = '此电子邮箱地址已被使用，请选择另一个';
		}
		
		//echo json_encode($ret);
		
		/*echo 	'<script type="text/javascript">
					alert("'.$reg['msg'].'");
					location.href = "'.base_url('console/admin').'"
				</script>';*/
		
		$msg = array();
		$msg['tips'] = $ret['msg_cn'];
		$link = 'javascript:history.go(-1);';
		$location = '返回上一页';
		$msg['target'] = '<a href="'.$link.'">'.$location.'</a>';
		show_error($msg, 403, $ret['msg']);
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
		
		//header('Content-Type: application/json, charset=utf-8');
		//header('Content-Type: text/html, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		$ret['msg_cn'] = '系统错误，请联系技术人员';
		
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
					$ret['msg_cn'] = '非法操作';
		}
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
			$ret['msg_cn'] = '更新帐号成功';
		}
		
		echo json_encode($ret);
	}
}
/* End of file */