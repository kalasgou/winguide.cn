<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function form() {
		$this->load->view('manage/application_form');
	}
}
/* End of File */