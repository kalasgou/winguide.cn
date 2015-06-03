<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exercise extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView($item = 15, $page = 0) {
		$params['item'] = intval($item) <= 0 ? 15 : $item;
		$params['page'] = intval($page) <= 0 ? 0 : $page - 1;
		$params['course'] = trim($this->input->get('course', TRUE));
		$params['start_date'] = trim($this->input->get('start_date', TRUE));
		$params['end_date'] = trim($this->input->get('end_date', TRUE));
		
		$output = array();
		$output['hover'] = 'student';
		$output['args'] = $params;
		
		$this->load->model('manage/Student_M');
		$output['students'] = $this->Student_M->listStudents($params);
		foreach ($output['students'] as &$one) {
			//$one['purchase_time_formatted'] = date('Y-m-d H:i:s', $one['purchase_time']);
			$one['start_time_formatted'] = date('Y-m-d', $one['start_time']);
			$one['end_time_formatted'] = date('Y-m-d', $one['end_time']);
		}
		
		$output['total_num'] = $this->Student_M->countStudents($params);
		$output['pagination'] = gen_pagination(base_url("console/student/view/lists/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/student_lists.php', $output);
	}
	
	public function createView() {
		$output = array();
		$output['hover'] = 'student';
		
		$this->load->view('manage/student_create.php', $output);
	}
	
	public function searchView() {
		$output = array();
		$output['hover'] = 'student';
		
		$this->load->view('manage/student_create.php', $output);
	}
	
	public function detailView() {
		$student_id = intval($this->input->get('student_id', TRUE));
		
		$output = array();
		$output['hover'] = 'student';
		
		$this->load->model('manage/Student_M');
		$output['detail'] = $this->Student_M->getAccountDetail($student_id);
		//var_dump($output['detail']);
		$this->load->view('manage/student_detail', $output);
	}
	
	public function lists() {
		
	}
	
	public function create() {
		$params['course'] = trim($this->input->post('course', TRUE));
		$params['duration_day'] = intval($this->input->post('duration_day', TRUE));
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