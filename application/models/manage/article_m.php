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
		
		$search = array();
		$search['N.status'] = $params['status'];
		if ($params['course_id'] !== 0) {
			$search['course_id'] = $params['course_id'];
		}
		if ($params['module_id'] !== 0) {
			$search['module_id'] = $params['module_id'];
		}
		
		$query = $this->db_conn->select('article_id, uuid, admin_id, course_id, module_id, module_desc, recommend, N.status, category, title, content, multimedia_url, create_time, update_time')
								->from('articles AS N')->join('article_module AS M', 'M.id = N.module_id')
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
		$search['status'] = $params['status'];
		if ($params['course_id'] !== 0) {
			$search['course_id'] = $params['course_id'];
		}
		if ($params['module_id'] !== 0) {
			$search['module_id'] = $params['module_id'];
		}
		
		return $this->db_conn->where($search)->count_all_results('articles');
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
	
	public function modifyArticle($params) {
		$search = array();
		$search['article_id'] = $params['article_id'];
		
		$refresh = array();
		foreach ($params as $key => $val) {
			if ($key !== 'article_id' && $val !== '') {
				$refresh[$key] = $val;
			}
		}
		
		return $this->db_conn->where($search)->update('articles', $refresh);
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