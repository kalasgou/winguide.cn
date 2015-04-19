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
	public function listsView() {
		$params['module_id'] = intval($this->input->get('module_id', TRUE));
		$params['item'] = intval($this->input->get('item', TRUE));
		$params['page'] = intval($this->input->get('page', TRUE));
		
		$output = array();
		$output['hover'] = 'article';
		
		$this->load->model('manage/Article_M');
		$output['articles'] = $this->Article_M->listArticles($params);
		
		foreach ($output['articles'] as &$one) {
			list($one['course'], $one['module']) = explode('|', $one['category']);
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
		}
		
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
		$output['detail'] = $this->Article_M->viewArticle($params);
		
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
		$params['admin_id'] = 123;
		$params['module_id'] = $this->input->post('module_id', TRUE);
		$course = $this->input->post('course', TRUE);
		$module = $this->input->post('module', TRUE);
		$params['category'] = "$course|$module";
		$params['title'] = $this->input->post('title', TRUE);
		$params['keywords'] = $this->input->post('keywords', TRUE);
		$params['content'] = $this->input->post('content');
		$params['summary'] = $this->input->post('summary', TRUE);
		$params['multimedia_url'] = $this->input->post('multimedia_url', TRUE);
		$params['link'] = $this->input->post('link', TRUE);
		$params['attachment'] = $this->input->post('attachment', TRUE);
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
		$ret['modules'] = $this->Article_M->getArticleModules($upper);
		
		echo json_encode($ret);
	}
}
/* End of file */