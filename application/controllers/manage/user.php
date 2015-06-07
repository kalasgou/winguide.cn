<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView($item = DEFAULT_PER_PAGE, $page = DEFAULT_START_PAGE) {
		$params['item'] = intval($item) <= 0 ? DEFAULT_PER_PAGE : $item;
		$params['page'] = intval($page) <= 0 ? DEFAULT_START_PAGE : $page - 1;
		$params['start_date'] = trim($this->input->get('start_date', TRUE));
		$params['end_date'] = trim($this->input->get('end_date', TRUE));
		$params['account_type'] = CELLPHONE;
		$params['status'] = 1;
		
		$output = array();
		$output['hover'] = 'user';
		$output['args'] = $params;
		
		$this->load->model('manage/User_M');
		$output['users'] = $this->User_M->listUsers($params);
		
		foreach ($output['users'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
			$one['update_time_formatted'] = $one['update_time'] === '0' ? '-' : date('Y-m-d H:i:s', $one['update_time']);
		}
		
		$output['total_num'] = $this->User_M->countUsers($params);
		$output['pagination'] = gen_pagination(base_url("console/user/view/lists/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/user_lists', $output);
	}
	
	public function createView() {
	}
	
	public function searchView() {
	}
	
	public function lists() {
		
	}
	
	public function create() {
		
	}
	
	public function update() {
		
	}
	
	public function delete() {
		
	}
	
	public function search() {
		
	}
	
	public function usersExcel() {
		
	}
}
/* End of file */
	