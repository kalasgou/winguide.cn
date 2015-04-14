<?php

class Article_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function listArticles($params) {
		$articles = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$query = $this->db_conn->select('*')->from('articles')->order_by('create_time DESC')->limit($item, $offset)->get();
		if ($query->num_rows() > 0) {
			$articles = $query->result_array();
		}
		
		return $articles;
	}
	
	public function createArticle($params) {
		$this->db_conn->set($params)->insert('articles');
		return $this->db_conn->insert_id();
	}
	
	public function viewArticle($params) {
		$detail = array();
		
		$search = array();
		$search['article_id'] = $params['article_id'];
		
		$query = $this->db_conn->select('*')->from('articles')->where($search)->limit(1)->get();
		if ($query->num_rows() > 0) {
			$detail = $query->row_array();
		}
		
		return $detail;
	}
	
	public function updateArticle($params) {
		
	}
	
	public function deleteArticle($params) {
		
	}
	
	public function searchArticle($params) {
		
	}
	
	public function listModules($upper) {
		$modules = array();
		
		$query = $this->db_conn->select('*')->from('article_module')->where('upper = '.$upper)->get();
		if ($query->num_rows() > 0) {
			$modules = $query->result_array();
		}
		
		return $modules;
	}
}
/* End of file */