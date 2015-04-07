<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->view('manage/login');
	}
	
	public function board() {
		$this->load->view('manage/board');
	}
}
/* End of file */
	