<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
	}
	
	public function listArticles() {
		$this->load->model('Article_M');
		$articles = $this->Article_M->getArticlesByCategory();
		
		foreach ($articles as $one) {
			foreach ($one as $key => $val) {
				if ($val === NULL) {
					echo $key,"\n";
				}
			}
		}
	}
}
/* End of file */