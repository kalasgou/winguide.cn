<?php

class Article_M extends CI_Model {
	
	private $db_conn;
	
	public function __construct() {
		parent::__construct();
		$this->db_conn = $this->load->database('default', TRUE);
	}
	
	public function getArticleLists($params) {
		$articles = array();
		
		$item = $params['item'];
		$offset = $params['item'] * $params['page'];
		
		$search = array();
		$search['category'] = $params['course'].'|'.$params['module'];
		
		$query = $this->db_conn->select('article_id, uuid, title, create_time')
								->from('articles')
								->where($search)
								->order_by('create_time DESC')
								->limit($item, $offset)
								->get();
		
		if ($query->num_rows() > 0) {
			$articles = $query->result_array();
		}
		 
		 return $articles;
	}
	
	public function countArticles($params) {
		$search = array();
		$search['category'] = $params['course'].'|'.$params['module'];
		
		return intval($this->db_conn->where($search)->count_all_results('articles'));
	}
	
	public function getNewsLists($params) {
		$articles = array();
		
		$query = $this->db_conn->select('article_id, uuid, title, create_time')
								->from('articles')
								->like('category', $params['course'], 'after')
								->order_by('create_time DESC')
								->limit(10)
								->get();
		
		if ($query->num_rows() > 0) {
			$articles = $query->result_array();
		}
		 
		 return $articles;
	}
	
	public function getArticleDetail($params) {
		$detail = array();
		
		$search = array();
		$search['uuid'] = $params['uuid'];
		
		$query = $this->db_conn->select('article_id, uuid, cover, title, keywords, content, summary, multimedia_url, link, attachment, create_time')
								->from('articles')
								->where($search)
								->limit(1)
								->get();
		
		if ($query->num_rows() > 0) {
			$detail = $query->row_array();
			$detail['create_time_formatted'] = date('Y-m-d H:i:s', $detail['create_time']);
		}
		 
		 return $detail;
	}
}
/* End of file */