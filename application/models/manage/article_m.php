<?php

class Article_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$db_conn = $this->load->database('default', TRUE);
	}
	
	public function listArticles($params) {
		$articles = array();
		
		$query = $this->db_conn->select()->from('articles')->where()->limit(10)->get();
		if ($query->num_rows() > 0) {
			$articles = $query->result_array();
		}
		
		return $articles;
	}
	
	public function createArticle($params) {
		$this->db_conn->set($params)->insert('articles');
		return $this->db_conn->insert_id();
	}
	
	public function updateArticle($params) {
		
	}
	
	public function deleteArticle($params) {
		
	}
	
	public function searchArticle($params) {
		
	}
}
/* End of file */