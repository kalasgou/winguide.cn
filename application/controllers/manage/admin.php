<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
	}
	
	public function register() {
		
	}
	
	public function login() {
		$params['username'] = trim($this->input->get('username'));
		$params['mobile'] = trim($this->input->get('mobile'));
		$params['password'] = trim($this->input->get('password'));
	}
}
/* End of file */