<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
	}
	
	public function register() {
		
	}
	
	public function login() {
		$params['username'] = trim($this->input->get('username'));
		$params['password'] = trim($this->input->get('password'));
	}
}
/* End of file */