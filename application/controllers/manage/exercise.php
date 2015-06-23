<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exercise extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView($item = 15, $page = 0) {
		$params['item'] = intval($item) <= 0 ? 15 : $item;
		$params['page'] = intval($page) <= 0 ? 0 : $page - 1;
		$params['admin_id'] = trim($this->input->get('admin_id', TRUE));
		$params['course'] = trim($this->input->get('course', TRUE));
		$params['topic'] = trim($this->input->get('topic', TRUE));
		$params['start_date'] = trim($this->input->get('start_date', TRUE));
		$params['end_date'] = trim($this->input->get('end_date', TRUE));
		
		$output = array();
		$output['hover'] = 'student';
		$output['args'] = $params;
		
		$this->load->model('manage/Exercise_M');
		$output['exercises'] = $this->Exercise_M->listExercises($params);
		
		foreach ($output['exercises'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['create_time']);
			$one['update_time_formatted'] = $one['update_time'] === '0' ? '-' : date('Y-m-d H:i:s', $one['update_time']);
		}
		
		$this->load->model('manage/Admin_M');
		$output['employees'] = $this->Admin_M->listEmployees();
		
		$output['total_num'] = $this->Exercise_M->countExercises($params);
		$output['pagination'] = gen_pagination(base_url("console/exercise/view/lists/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/exercise_lists.php', $output);
	}
	
	public function createView() {
		$output = array();
		$output['hover'] = 'forum_course';
		
		$this->load->view("manage/exercise_create", $output);
	}
	
	public function searchView() {
		
	}
	
	public function detailView() {
		$params['exercise_id'] = intval($this->input->get('exercise_id', TRUE));
		
		$output = array();
		$output['hover'] = 'forum_course';
		$output['args'] = $params;
		
		$this->load->model('manage/Exercise_M');
		$output['detail'] = $this->Exercise_M->getExerciseDetail($params['exercise_id']);
		//var_dump($output['detail']);
		$this->load->view('manage/exercise_detail', $output);
	}
	
	public function lists() {
		$params['item'] = intval($this->input->get('item', TRUE));
		$params['page'] = intval($this->input->get('page', TRUE));
		$params['course'] = trim($this->input->get('course', TRUE));
		$params['admin_id'] = trim($this->input->get('admin_id', TRUE));
		$params['topic'] = trim($this->input->get('topic', TRUE));
		$params['start_date'] = trim($this->input->get('start_date', TRUE));
		$params['end_date'] = trim($this->input->get('end_date', TRUE));
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 0;
		$ret['msg'] = 'success';
		
		$this->load->model('manage/Exercise_M');
		$exercises = $this->Exercise_M->listExercises($params);
		
		foreach ($exercises as &$one) {
			$one['create_time_formatted'] = date('Y-m-d', $one['create_time']);
		}
		
		$ret['total_sets'] = $this->Exercise_M->countExercises($params);
		$ret['exercises'] = $exercises;
		
		echo json_encode($ret);
	}
	
	public function create() {
		$params['admin_id'] = $_SESSION['admin']['id'];
		$params['course'] = trim($this->input->post('course', TRUE));
		$params['subject'] = trim($this->input->post('exercise_action', TRUE));
		$params['topic'] = trim($this->input->post('exercise_type', TRUE));
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		$numbers_arr = array();
		$exercise_ids = trim($this->input->post('exercise_ids', TRUE));
		$tmp_arr = explode(',', $exercise_ids);
		foreach ($tmp_arr as $one) {
			if (ctype_digit($one)) {
				$numbers_arr[] = intval($one);
			} elseif (strpos($one, '-') !== FALSE) {
				list($start, $end) = explode('-', $one);
				$numbers_arr = array_merge($numbers_arr, range($start, $end));
			}
		}
		
		$params['numbers'] = implode(',', $numbers_arr);
		$params['amount'] = count($numbers_arr);
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		//header('Content-Type: application/json, charset=utf-8');
		//header('Content-Type: text/html, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		$ret['msg_cn'] = '系统错误，请联系技术人员';
		
		$this->load->model('manage/Exercise_M');
		$result = $this->Exercise_M->createExerciseSet($params);
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
			$ret['msg_cn'] = '新建题库成功';
			
			header('Location: '.base_url('console/exercise'));
			exit();
		}
		
		//echo json_encode($ret);
		
		/*echo 	'<script type="text/javascript">
					alert("'.$ret['msg'].'");
					location.href = "'.base_url('console/exercise').'"
				</script>';*/
		
		$msg = array();
		$msg['tips'] = $ret['msg_cn'];
		$link = 'javascript:history.go(-1);';
		$location = '返回上一页';
		$msg['target'] = '<a href="'.$link.'">'.$location.'</a>';
		show_error($msg, 403, $ret['msg']);
	}
	
	public function update() {
		$params['admin_id'] = $_SESSION['admin']['id'];
		$params['exercise_id'] = trim($this->input->post('exercise_id', TRUE));
		/*$params['course'] = trim($this->input->post('course', TRUE));
		$params['subject'] = trim($this->input->post('exercise_action', TRUE));
		$params['topic'] = trim($this->input->post('exercise_type', TRUE));*/
		$params['create_time'] = $_SERVER['REQUEST_TIME'];
		
		$numbers_arr = array();
		$exercise_ids = trim($this->input->post('exercise_ids', TRUE));
		$tmp_arr = explode(',', $exercise_ids);
		foreach ($tmp_arr as $one) {
			if (ctype_digit($one)) {
				$numbers_arr[] = intval($one);
			} elseif (strpos($one, '-') !== FALSE) {
				list($start, $end) = explode('-', $one);
				$numbers_arr = array_merge($numbers_arr, range($start, $end));
			}
		}
		
		$params['numbers'] = implode(',', $numbers_arr);
		$params['amount'] = count($numbers_arr);
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		//header('Content-Type: application/json, charset=utf-8');
		//header('Content-Type: text/html, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		$ret['msg_cn'] = '系统错误，请联系技术人员';
		
		$this->load->model('manage/Exercise_M');
		$result = $this->Exercise_M->updateExerciseSet($params);
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
			$ret['msg_cn'] = '更新题库成功';
			
			header('Location: '.base_url('console/exercise/view/detail?exercise_id='.$params['exercise_id']));
			exit();
		}
		
		//echo json_encode($ret);
		
		/*echo 	'<script type="text/javascript">
					alert("'.$ret['msg'].'");
					location.href = "'.base_url('console/exercise').'"
				</script>';*/
		
		$msg = array();
		$msg['tips'] = $ret['msg_cn'];
		$link = 'javascript:history.go(-1);';
		$location = '返回上一页';
		$msg['target'] = '<a href="'.$link.'">'.$location.'</a>';
		show_error($msg, 403, $ret['msg']);
	}
	
	public function delete() {
		
	}
	
	public function search() {
		
	}
	
	public function getExerciseTypes() {
		$course = trim($this->input->get('course', TRUE));
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		
		if (in_array($course, array('gmat', 'gre', 'gaokao', 'ielts', 'sat', 'toefl'))) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
			
			$exercise_types = array();
			
			$exercise_tags = $this->config->item('exercises');
			foreach ($exercise_tags[$course] as $one) {
				if (!empty($one['subject'])) {
					foreach ($one['subject'] as $action => $detail) {
						$tmp = array();
						$tmp['action'] = $action;
						$tmp['table'] = $detail['0'];
						$tmp['topic'] = $detail['1'];
						
						$exercise_types[] = $tmp;
					}
				}
			}
			
			$ret['exercise_types'] = $exercise_types;
		}		
		
		echo json_encode($ret);
	}
}
/* End of file */