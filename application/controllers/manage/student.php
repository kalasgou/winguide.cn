<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
	
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
		$data['hover'] = 'student';
		
		$this->load->model('manage/Student_M');
		$data['students'] = $this->Student_M->listStudents($params);
		
		foreach ($data['students'] as &$one) {
			$one['purchase_time_formatted'] = date('Y-m-d H:i:s', $one['purchase_time']);
		}
		
		$this->load->view('manage/student_lists.php', $data);
	}
	
	public function accountsView() {
		$params['item'] = intval($this->input->get('item', TRUE));
		$params['page'] = intval($this->input->get('page', TRUE));
		
		$data = array();
		$data['hover'] = 'student';
		
		$this->load->model('manage/Student_M');
		$data['accounts'] = $this->Student_M->listAccounts($params);
		
		foreach ($data['accounts'] as &$one) {
			$one['purchase_time_formatted'] = date('Y-m-d H:i:s', $one['purchase_time']);
		}
		
		$this->load->view('manage/student_accounts.php', $data);
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