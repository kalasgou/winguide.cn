<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView() {
		$data = array();
		$data['hover'] = 'student';
		$this->load->view('manage/student_lists.php', $data);
	}
	
	public function createView() {
		$data = array();
		$data['hover'] = 'student';
		$this->load->view('manage/student_create.php', $data);
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