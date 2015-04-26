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
		$params['visibility'] = trim($this->input->get('visibility', TRUE));
		if ($visibility !== '') {
			$params['visibility'] = $visibility;
		}
		
		$output = array();
		$output['hover'] = 'forum_'.$params['visibility'];
		
		$this->load->model('manage/Forum_M');
		$output['topics'] = $this->Forum_M->listTopics($params);
		
		foreach ($output['topics'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
			$one['update_time_formatted'] = date('Y-m-d H:i:s', $one['update_time']);
		}
		
		$output['total_num'] = $this->Forum_M->countTopics($params);
		$output['pagination'] = gen_pagination(base_url("console/forum/view/lists/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/forum_lists', $output);
	}
	
	public function createView() {
		$params['visibility'] = trim($this->input->get('visibility', TRUE));
		
		$output = array();
		$output['hover'] = 'forum_'.$params['visibility'];
		
		$this->load->view('manage/forum_create', $output);
	}
	
	public function searchView() {
		
	}
	
	public function create() {
		$params['admin_id'] = 1;
		$params['uuid'] = hex16to64(uuid());
		$params['module'] = trim($this->input->post('module', TRUE));
		$params['visibility'] = trim($this->input->post('visibility', TRUE));
		$params['topic'] = trim($this->input->post('topic', TRUE));
		$params['thread'] = trim($this->input->post('thread'));
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		if (!check_parameters($params)) {
			exit('Parameters not enough');
		}
		
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
		
	}
	
	public function delete() {
		
	}
	
	public function search() {
		
	}
}
/* End of file */