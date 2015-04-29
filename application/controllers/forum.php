<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getThreads() {
		$params['item'] = intval($this->input->get('item', TRUE));
		$params['page'] = intval($this->input->get('page', TRUE));
		$params['module'] = trim($this->input->get('course', TRUE));
		$params['visibility'] = trim($this->input->get('module', TRUE));
		
		if (!check_parameters($params)) {
			exit('Parameters not enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 0;
		$ret['msg'] = 'success';
		
		$this->load->model('Forum_M');
		$topic = $this->Forum_M->getTopicByVisibility($params);
		$ret['topic'] = $topic;
		
		$total = $this->Forum_M->countTopicReplies($topic['topic_id']);
		$pages = intval($total / $params['item']);
		$ret['total_page'] = ($total % $params['item']) === 0 ? $pages : $pages + 1;
		
		echo json_encode($ret);
	}
	
	public function postReply() {
		$params['user_id'] = 1;
		$params['topic_id'] = trim($this->input->post('topic_id', TRUE));
		$params['reply'] = trim($this->input->post('reply', TRUE));
		$params['ip_addr'] = ip2long($this->input->ip_address());
		$params['user_agent'] = $this->input->user_agent();
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		if (!check_parameters($params)) {
			exit('Parameters not enough');
		}
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		$this->load->model('Forum_M');
		$result = $this->Forum_M->saveTopicReply($params);
		
		if ($result > 0) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
			$ret['reply_id'] = $result;
		}
		
		echo json_encode($ret);
	}
}
/* End of file */