<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView($item = 15, $page = 0) {
		$params['item'] = intval($item) <= 0 ? 15 : $item;
		$params['page'] = intval($page) <= 0 ? 0 : $page - 1;
		
		$output = array();
		$output['hover'] = 'student';
		
		$this->load->model('manage/Student_M');
		$output['students'] = $this->Student_M->listStudents($params);
		foreach ($output['students'] as &$one) {
			$one['purchase_time_formatted'] = date('Y-m-d H:i:s', $one['purchase_time']);
		}
		
		$output['total_num'] = $this->Student_M->countStudents();
		$output['pagination'] = gen_pagination(base_url("console/student/view/lists/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/student_lists.php', $output);
	}
	
	public function accountsView($item = 15, $page = 0) {
		$params['item'] = intval($item) <= 0 ? 15 : $item;
		$params['page'] = intval($page) <= 0 ? 0 : $page - 1;
		
		$output = array();
		$output['hover'] = 'student';
		
		$this->load->model('manage/Student_M');
		$output['accounts'] = $this->Student_M->listAccounts($params);
		
		foreach ($output['accounts'] as &$one) {
			$one['purchase_time_formatted'] = date('Y-m-d H:i:s', $one['purchase_time']);
		}
		
		$output['total_num'] = $this->Student_M->countAccounts();
		$output['pagination'] = gen_pagination(base_url("console/student/view/accounts/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/student_accounts.php', $output);
	}
	
	
	public function createView() {
		$output = array();
		$output['hover'] = 'student';
		$this->load->view('manage/student_create.php', $output);
	}
	
	public function searchView() {
		
	}
	
	public function lists() {
		
	}
	
	public function create() {
		$params['course'] = trim($this->input->post('course', TRUE));
		$params['amount'] = intval($this->input->post('amount', TRUE));
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('manage/Student_M');
		$result = $this->Student_M->doRegistration($params);
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
		}
		
		echo json_encode($ret);
	}
	
	public function update() {
		
	}
	
	public function delete() {
		
	}
	
	public function search() {
		
	}
}
/* End of file */