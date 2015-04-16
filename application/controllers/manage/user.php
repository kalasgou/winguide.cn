<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView() {
		$params['item'] = intval($this->input->get('item', TRUE));
		$params['page'] = intval($this->input->get('page', TRUE));
		
		$data = array();
		$data['hover'] = 'user';
		
		$this->load->model('manage/User_M');
		$data['users'] = $this->User_M->listUsers($params);
		
		foreach ($data['users'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
		}
		
		$this->load->view('manage/user_lists', $data);
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
	