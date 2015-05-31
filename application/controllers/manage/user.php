<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
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
		$output['hover'] = 'user';
		
		$this->load->model('manage/User_M');
		$output['users'] = $this->User_M->listUsers($params);
		
		foreach ($output['users'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
			$one['update_time_formatted'] = date('Y-m-d H:i:s', $one['update_time']);
		}
		
		$output['total_num'] = $this->User_M->countUsers();
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
}
/* End of file */
	