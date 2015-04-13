<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView() {
		$data = array();
		$data['hover'] = 'user';
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
	