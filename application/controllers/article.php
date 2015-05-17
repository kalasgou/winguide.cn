<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
	}
	
	public function lists() {
		$params['item'] = intval($this->input->get('item', TRUE));
		$params['page'] = intval($this->input->get('page', TRUE));
		$params['course'] = trim($this->input->get('course', TRUE));
		$params['module'] = trim($this->input->get('module', TRUE));
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 0;
		$ret['msg'] = 'success';
		
		$this->load->model('Article_M');
		$articles = $this->Article_M->getArticleLists($params);
		
		foreach ($articles as &$one) {
			$one['create_time_formatted'] = date('Y-m-d', $one['create_time']);
		}
		
		$ret['articles'] = $articles;
		
		$total = $this->Article_M->countArticles($params);
		$pages = intval($total / $params['item']);
		$ret['total_page'] = ($total % $params['item']) === 0 ? $pages : $pages + 1;
		
		echo json_encode($ret);
	}
	
	public function detail() {
		$params['article_id'] = intval($this->input->get('article_id', TRUE));
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 0;
		$ret['msg'] = 'success';
		
		$this->load->model('Article_M');
		$detail = $this->Article_M->getArticleDetail($params);
		
		$ret['detail'] = $detail;
		
		echo json_encode($ret);
	}
}
/* End of file */