<?php

class Article_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function getArticlesByCategory() {
		$query = $this->db_conn->get('articles');
		return $query->result_array();
	}
}
/* End of file */