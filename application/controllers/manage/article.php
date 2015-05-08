<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	/*
	 * View
	 */
	public function listsView($item = DEFAULT_PER_PAGE, $page = DEFAULT_START_PAGE) {
		$params['item'] = intval($item) <= 0 ? DEFAULT_PER_PAGE : $item;
		$params['page'] = intval($page) <= 0 ? DEFAULT_START_PAGE : $page - 1;
		$params['course_id'] = intval($this->input->get('course_id', TRUE));
		$params['module_id'] = intval($this->input->get('module_id', TRUE));
		$params['status'] = 1;
		
		$output = array();
		$output['hover'] = 'article';
		
		$this->load->model('manage/Article_M');
		
		$output['module'] = $this->Article_M->listModules(0);
		
		$output['articles'] = $this->Article_M->listArticles($params);
		
		foreach ($output['articles'] as &$one) {
			list($one['course'], $one['module']) = explode('|', $one['category']);
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
		}
		
		$output['total_num'] = $this->Article_M->countArticles($params);
		$output['pagination'] = gen_pagination(base_url("console/article/view/lists/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/article_lists.php', $output);
	}
	
	public function createView() {
		$output = array();
		$output['hover'] = 'article';
		
		$this->load->model('manage/Article_M');
		$output['module'] = $this->Article_M->listModules(0);
		
		$this->load->view('manage/article_create.php', $output);
	}
	
	public function searchView() {
		$output = array();
		$output['hover'] = 'article';
		
		$this->load->model('manage/Article_M');
		
		
		$this->load->view('manage/article_search.php', $output);
	}
	
	public function detailView() {
		$params['article_id'] = intval($this->input->get('article_id', TRUE));
		
		$output = array();
		$output['hover'] = 'article';
		
		$this->load->model('manage/Article_M');
		
		$detail = $this->Article_M->viewArticle($params);
		$output['courses'] = $this->Article_M->listModules(0);
		$output['modules'] = $this->Article_M->listModules($detail['course_id']);
		$output['detail'] = $detail;
		
		$this->load->view('manage/article_detail.php', $output);
	}
	
	/*
	 * View
	 */
	public function lists() {
		
	}
	
	public function create() {
		$params['admin_id'] = 1;
		$params['uuid'] = hex16to64(uuid());
		$params['course_id'] = intval($this->input->post('course_id', TRUE));
		$params['module_id'] = intval($this->input->post('module_id', TRUE));
		$course = trim($this->input->post('course', TRUE));
		$module = trim($this->input->post('module', TRUE));
		$params['category'] = "$course|$module";
		$params['title'] = trim($this->input->post('title', TRUE));
		//$params['keywords'] = $this->input->post('keywords', TRUE);
		$params['content'] = $this->input->post('content');
		//$params['summary'] = $this->input->post('summary', TRUE);
		$params['multimedia_url'] = trim($this->input->post('multimedia_url', TRUE));
		//$params['link'] = $this->input->post('link', TRUE);
		//$params['attachment'] = $this->input->post('attachment', TRUE);
		$params['status'] = 1;
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('manage/Article_M');
		$result = $this->Article_M->createArticle($params);
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
		}
		
		echo json_encode($ret);
	}
	
	public function update() {
		$params['article_id'] = $this->input->post('article_id', TRUE);;
		$params['course_id'] = $this->input->post('course_id', TRUE);
		$params['module_id'] = $this->input->post('module_id', TRUE);
		$course = trim($this->input->post('course', TRUE));
		$module = trim($this->input->post('module', TRUE));
		$params['category'] = "$course|$module";
		$params['title'] = trim($this->input->post('title', TRUE));
		//$params['keywords'] = $this->input->post('keywords', TRUE);
		$params['content'] = $this->input->post('content');
		//$params['summary'] = $this->input->post('summary', TRUE);
		$params['multimedia_url'] = trim($this->input->post('multimedia_url', TRUE));
		//$params['link'] = $this->input->post('link', TRUE);
		//$params['attachment'] = $this->input->post('attachment', TRUE);
		//$params['status'] = 1;
		$params['update_time'] = $_SERVER['REQUEST_TIME'];
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('manage/Article_M');
		$result = $this->Article_M->modifyArticle($params);
		
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
	
	public function getModules() {
		$upper = trim($this->input->get('upper', TRUE));
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 0;
		$ret['msg'] = 'success';
		
		$this->load->model('manage/Article_M');
		$ret['modules'] = $this->Article_M->listModules($upper);
		
		echo json_encode($ret);
	}
}
/* End of file */