<?php
class Student_M extends CI_Model {
	
	private $STUDENT_TYPE = 123;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function isStudent() {
		return $this->STUDENT_TYPE;
	}
	
	public function add() {
		
	}
}
/* End of file */