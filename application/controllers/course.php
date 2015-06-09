<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function homework() {
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		
		if (empty($_SESSION['user']) || !$_SESSION['user']['is_student']) {
			$ret['code'] = 12;
			$ret['msg'] = 'only students can have homework';
			
			exit(json_encode($ret));
		}
		
		$params['user_id'] = $_SESSION['user']['id'];
		$params['page'] = intval($this->input->get('page', TRUE));
		$params['item'] = intval($this->input->get('item', TRUE));
		$params['module'] = trim($this->input->get('course', TRUE));
		$params['visibility'] = 'course';
		$ret['code'] = 0;
		$ret['msg'] = 'success';
		
		$this->load->model('Course_M');
		$homework = $this->Course_M->loadHomework($params);
		$ret['homework'] = $homework;
		
		$total = $this->Course_M->countTopicReplies($homework['topic_id']);
		$pages = intval($total / $params['item']);
		$ret['homework']['total_page'] = ($total % $params['item']) === 0 ? $pages : $pages + 1;
		$ret['homework']['total_replies'] = $total;
		
		echo json_encode($ret);
	}
	
	public function exercises() {
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		
		if (empty($_SESSION['user']) || !$_SESSION['user']['is_student']) {
			$ret['code'] = 13;
			$ret['msg'] = 'only students can do exercises';
			
			exit(json_encode($ret));
		}
		
		$params['user_id'] = $_SESSION['user']['id'];
		$params['exercise_id'] = trim($this->input->get('exercise_id', TRUE));
		
		$ret['code'] = 0;
		$ret['msg'] = 'success';
		
		$this->load->model('Course_M');
		$ret['exercises'] = $this->Course_M->loadExercises($params);
		
		echo json_encode($ret);
	}
	
	public function scores() {
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		
		if (empty($_SESSION['user']) || !$_SESSION['user']['is_student']) {
			$ret['code'] = 14;
			$ret['msg'] = 'only students can obtain scores';
			
			exit(json_encode($ret));
		}
		
		$params['user_id'] = $_SESSION['user']['id'];
		$params['course'] = trim($this->input->get('course', TRUE));
		
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$bought_courses = $_SESSION['user']['course_arr'];
		if (in_array($params['course'], $bought_courses)) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
			$ret['realname'] = $_SESSION['user']['realname'];
			$ret['nickname'] = $_SESSION['user']['nickname'];
			
			if (count($_SESSION['user']['course_detail']) > 1) {
				foreach ($_SESSION['user']['course_detail'] as $one) {
					if ($one['course'] === $params['course']) {
						$ret['nickname'] = $one['username'];
					}
				}
			}
			
			$this->load->model('Course_M');
			$ret['scores'] = $this->Course_M->calculateScore($params);
		}
		
		echo json_encode($ret);
	}
}
/* End of file */