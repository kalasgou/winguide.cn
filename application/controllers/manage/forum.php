<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$visibility = trim($this->input->get('visibility', TRUE));
		$this->listsView($visibility);
	}
	
	/*
	 * View
	 */
	public function listsView($item = 15, $page = 0, $visibility = '') {
		$params['item'] = intval($item) <= 0 ? 15 : $item;
		$params['page'] = intval($page) <= 0 ? 0 : $page - 1;
		$params['course'] = trim($this->input->get('course', TRUE));
		$params['admin_id'] = trim($this->input->get('admin_id', TRUE));
		$params['start_date'] = trim($this->input->get('start_date', TRUE));
		$params['end_date'] = trim($this->input->get('end_date', TRUE));
		
		$params['visibility'] = trim($this->input->get('visibility', TRUE));
		if ($visibility !== '') {
			$params['visibility'] = $visibility;
		}
		
		$output = array();
		$output['hover'] = 'forum_'.$params['visibility'];
		$output['args'] = $params;
		
		$this->load->model('manage/Forum_M');
		$output['topics'] = $this->Forum_M->listTopics($params);
		
		foreach ($output['topics'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
			$one['update_time_formatted'] = $one['update_time'] === '0' ? '-' : date('Y-m-d H:i:s', $one['update_time']);
		}
		
		$this->load->model('manage/Admin_M');
		$output['employees'] = $this->Admin_M->listEmployees();
		
		$output['total_num'] = $this->Forum_M->countTopics($params);
		$output['pagination'] = gen_pagination(base_url("console/forum/view/lists/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view("manage/forum_{$params['visibility']}_lists", $output);
	}
	
	public function createView() {
		$params['visibility'] = trim($this->input->get('visibility', TRUE));
		
		$output = array();
		$output['hover'] = 'forum_'.$params['visibility'];
		
		$this->load->model('manage/Admin_M');
		$output['employees'] = $this->Admin_M->listEmployees();
		
		$this->load->view("manage/forum_{$params['visibility']}_create", $output);
	}
	
	public function searchView() {
		
	}
	
	public function detailView() {
		$params['topic_id'] = trim($this->input->get('topic_id', TRUE));
		
		$this->load->model('manage/Forum_M');
		$detail = $this->Forum_M->viewTopic($params);
		
		$output = array();
		$output['hover'] = 'forum_'.$detail['visibility'];
		$output['visibility'] = $detail['visibility'];
		$output['detail'] = $detail;
		
		$this->load->view("manage/topic_{$detail['visibility']}_detail", $output);
	}
	
	public function commentsView($item = 15, $page = 0) {
		$params['item'] = intval($item) <= 0 ? 15 : $item;
		$params['page'] = intval($page) <= 0 ? 0 : $page - 1;
		$params['topic_id'] = trim($this->input->get('topic_id', TRUE));
		$params['visibility'] = trim($this->input->get('visibility', TRUE));
		
		$output = array();
		$output['hover'] = 'forum_'.$params['visibility'];
		$output['args'] = $params;
		
		$this->load->model('manage/Forum_M');
		$output['comments'] = $this->Forum_M->loadComments($params);
		
		foreach ($output['comments'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
			//$one['update_time_formatted'] = $one['update_time'] === '0' ? '-' : date('Y-m-d H:i:s', $one['update_time']);
		}
		
		$output['topic'] = $this->Forum_M->viewTopic($params);
		
		$output['total_num'] = $this->Forum_M->countComments($params);
		$output['pagination'] = gen_pagination(base_url("console/forum/view/comments/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view("manage/forum_comments_lists", $output);
	}
	
	public function create() {
		$params['admin_id'] = $_SESSION['admin']['id'];
		$params['uuid'] = hex16to64(uuid());
		$params['status'] = 1;
		$params['module'] = trim($this->input->post('module', TRUE));
		$params['visibility'] = trim($this->input->post('visibility', TRUE));
		$params['topic'] = trim($this->input->post('topic', TRUE));
		$params['thread'] = trim($this->input->post('thread'));
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		if (!check_parameters($params)) {
			exit('Parameters not enough');
		}
		
		if ($params['visibility'] === 'course') {
			$params['assignment'] = trim($this->input->post('assignment', TRUE));
			$params['exercise_id'] = $this->input->post('exercise_id');
			$params['subject_en'] = $this->input->post('subject_en');
			$params['subject_cn'] = $this->input->post('subject_cn');
			$params['create_date'] = $this->input->post('create_date');
			$params['amount'] = $this->input->post('amount');
		}
		
		//var_dump($params);exit();
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('manage/Forum_M');
		$result = $this->Forum_M->createTopic($params);
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
		}
		
		echo json_encode($ret);
	}
	
	public function update() {
		$params['topic_id'] = intval($this->input->post('topic_id', TRUE));
		$params['module'] = trim($this->input->post('module', TRUE));
		$params['visibility'] = trim($this->input->post('visibility', TRUE));
		$params['topic'] = trim($this->input->post('topic', TRUE));
		$params['thread'] = trim($this->input->post('thread'));
		$params['update_time'] = $_SERVER['REQUEST_TIME'];
		
		if (!check_parameters($params)) {
			exit('Parameters not enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('manage/Forum_M');
		$result = $this->Forum_M->modifyTopic($params);
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
		}
		
		echo json_encode($ret);
	}
	
	public function delete() {
		
	}
	
	public function search() {
		
	}
	
	/*public function comments() {
		$params['topic_id'] = intval($this->input->get('topic_id', TRUE));
		$params['item'] = intval($this->input->get('item', TRUE));
		$params['page'] = intval($this->input->get('page', TRUE));
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 0;
		$ret['msg'] = 'success';
		
		$this->load->model('manage/Forum_M');
		$comments = $this->Forum_M->loadComments($params);
		
		foreach ($comments as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
		}
		
		$ret['comments'] = $comments;
		$ret['is_finish'] = count($comments) < $params['item'] ? TRUE : FALSE;
		
		echo json_encode($ret);
	}*/
}
/* End of file */