<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$visibility = $this->input->get('v', TRUE);
		$this->listsView($visibility);
	}
	
	/*
	 * View
	 */
	public function listsView($visibility = '') {
		$params['item'] = intval($this->input->get('item', TRUE));
		$params['page'] = intval($this->input->get('page', TRUE));
		$params['course'] = trim($this->input->get('course', TRUE));
		$params['visibility'] = trim($this->input->get('visibility', TRUE));
		if ($visibility !== '') {
			$params['visibility'] = $visibility;
		}
		
		$data = array();
		$data['hover'] = 'forum_'.$params['visibility'];
		
		$this->load->model('manage/Forum_M');
		$data['topics'] = $this->Forum_M->listTopics($params);
		
		foreach ($data['topics'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
			$one['update_time_formatted'] = date('Y-m-d H:i:s', $one['update_time']);
		}
		
		$this->load->view('manage/forum_lists', $data);
	}
	
	public function createView() {
		
	}
	
	public function searchView() {
		
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