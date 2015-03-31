<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		echo 'index';
	}
	
	public function _remap($method) {
		switch ($method) {
			case 'unit123': $this->unit(); break;
			case 'question321': $this->question(); break;
			case 'answer234': $this->answer(); break;
			default : $this->index();
		}
	}
	
	public function unit() {
		echo 'unit';
	}
	
	public function question() {
		echo 'question';
	}
	
	public function answer() {
		echo 'answer';
	}
}
/* End of file */