<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->listsView();
	}
	
	public function listsView($item = 15, $page = 0) {
		$params['item'] = intval($item) <= 0 ? 15 : $item;
		$params['page'] = intval($page) <= 0 ? 0 : $page - 1;
		$params['course'] = trim($this->input->get('course', TRUE));
		$params['start_date'] = trim($this->input->get('start_date', TRUE));
		$params['end_date'] = trim($this->input->get('end_date', TRUE));
		
		$output = array();
		$output['hover'] = 'student';
		$output['args'] = $params;
		
		$this->load->model('manage/Student_M');
		$output['students'] = $this->Student_M->listStudents($params);
		foreach ($output['students'] as &$one) {
			//$one['purchase_time_formatted'] = date('Y-m-d H:i:s', $one['purchase_time']);
			$one['start_time_formatted'] = date('Y-m-d', $one['start_time']);
			$one['end_time_formatted'] = date('Y-m-d', $one['end_time']);
		}
		
		$output['total_num'] = $this->Student_M->countStudents($params);
		$output['pagination'] = gen_pagination(base_url("console/student/view/lists/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/student_lists.php', $output);
	}
	
	public function accountsView($item = 15, $page = 0) {
		$params['item'] = intval($item) <= 0 ? 15 : $item;
		$params['page'] = intval($page) <= 0 ? 0 : $page - 1;
		$params['course'] = trim($this->input->get('course', TRUE));
		$params['start_date'] = trim($this->input->get('start_date', TRUE));
		$params['end_date'] = trim($this->input->get('end_date', TRUE));
		
		$output = array();
		$output['hover'] = 'student';
		$output['args'] = $params;
		
		$this->load->model('manage/Student_M');
		$output['accounts'] = $this->Student_M->listAccounts($params);
		
		foreach ($output['accounts'] as &$one) {
			$one['create_time_formatted'] = date('Y-m-d H:i:s', $one['purchase_time']);
			$one['update_time_formatted'] = $one['start_time'] === '0' ? '-' : date('Y-m-d H:i:s', $one['start_time']);
		}
		
		$output['total_num'] = $this->Student_M->countAccounts($params);
		$output['pagination'] = gen_pagination(base_url("console/student/view/accounts/item/{$params['item']}/page/"), 8, $output['total_num'], $params['item']);
		
		$this->load->view('manage/student_accounts.php', $output);
	}
	
	
	public function createView() {
		$output = array();
		$output['hover'] = 'student';
		
		$this->load->view('manage/student_create.php', $output);
	}
	
	public function searchView() {
		$output = array();
		$output['hover'] = 'student';
		
		$this->load->view('manage/student_create.php', $output);
	}
	
	public function detailView() {
		$student_id = intval($this->input->get('student_id', TRUE));
		
		$output = array();
		$output['hover'] = 'student';
		
		$this->load->model('manage/Student_M');
		$output['detail'] = $this->Student_M->getAccountDetail($student_id);
		//var_dump($output['detail']);
		$this->load->view('manage/student_detail', $output);
	}
	
	public function lists() {
		
	}
	
	public function create() {
		$params['course'] = trim($this->input->post('course', TRUE));
		$params['duration_day'] = intval($this->input->post('duration_day', TRUE));
		$params['amount'] = intval($this->input->post('amount', TRUE));
		
		if (!check_parameters($params)) {
			exit('Parameters Not Enough');
		}
		
		//header('Content-Type: application/json, charset=utf-8');
		//header('Content-Type: text/html, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		$ret['msg_cn'] = '系统错误，请联系技术人员';
		
		$this->load->model('manage/Student_M');
		$result = $this->Student_M->doRegistration($params);
		
		if ($result) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
			$ret['msg_cn'] = '新建付费帐号成功';
			
			header('Location: '.base_url('console/student/view/accounts'));
			exit();
		}
		
		//echo json_encode($ret);
		
		/*echo 	'<script type="text/javascript">
					alert("'.$ret['msg'].'");
					location.href = "'.base_url('console/student/view/accounts').'"
				</script>';*/
		
		$msg = array();
		$msg['tips'] = $ret['msg_cn'];
		$link = 'javascript:history.go(-1);';
		$location = '返回上一页';
		$msg['target'] = '<a href="'.$link.'">'.$location.'</a>';
		show_error($msg, 403, $ret['msg']);
	}
	
	public function update() {
		
	}
	
	public function delete() {
		
	}
	
	public function search() {
		
	}
	
	public function estimateAccount() {
		$amount = intval($this->input->get('amount', TRUE));
		
		header('Content-Type: application/json, charset=utf-8');
		
		$ret = array();
		$ret['code'] = 1;
		$ret['msg'] = 'fail';
		$ret['start_serial'] = NULL;
		$ret['end_serial'] = NULL;
		
		$this->load->model('manage/Student_M');
		$max_id = $this->Student_M->getMaxStudentID();
		
		if ($amount > 0 && $max_id >= 0) {
			$ret['code'] = 0;
			$ret['msg'] = 'success';
			$ret['start_serial'] = substr(gen_student_serial($max_id + 1), 0, 6);
			$ret['end_serial'] = substr(gen_student_serial($max_id + $amount), 0, 6);
		}
		
		echo json_encode($ret);
	}
	
	public function accountsExcel() {
		$params['item'] = 9999;
		$params['page'] = 0;
		$params['course'] = trim($this->input->get('course', TRUE));
		$params['start_date'] = trim($this->input->get('start_date', TRUE));
		$params['end_date'] = trim($this->input->get('end_date', TRUE));
		
		require APPPATH .'third_party/office/PHPExcel.php';
		
		$objExcel = new PHPExcel();
		$objExcel->getProperties()->setCreator('WinGuide赢凯')
								->setTitle('帐号购买记录')
								->setSubject('学生帐号')
								->setDescription('Document generated using PHPExcel by KALASGOU');
		
		$objExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(24);
		
		$objExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(8)->setName('微软雅黑');
		
		$objExcel->getActiveSheet()->getColumnDimension('A')->setWidth(16);
		$objExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objExcel->getActiveSheet()->getColumnDimension('D')->setWidth(24);
		$objExcel->getActiveSheet()->getColumnDimension('E')->setWidth(24);
		$objExcel->getActiveSheet()->getColumnDimension('F')->setWidth(24);
		$objExcel->getActiveSheet()->getColumnDimension('G')->setWidth(24);
		
		$objExcel->setActiveSheetIndex(0)
					->setCellValue('A1', 'Course')
					->setCellValue('B1', "Username")
					->setCellValue('C1', "Password")
					->setCellValue('D1', "Validity (Days)")
					->setCellValue('E1', "Purchased At")
					->setCellValue('F1', 'Registered At')
					->setCellValue('G1', "Expired At");
		
		$objExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setWrapText(TRUE);
		$objExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(TRUE)->getColor()->setRGB('FFFFFF');
		$objExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objExcel->getActiveSheet()->getStyle('A1:G1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->getStartColor()->setRGB('666699');
		
		$row_index = 1;
		
		$this->load->model('manage/Student_M');
		$accounts = $this->Student_M->listAccounts($params);
		//var_dump($accounts);exit();
		foreach ($accounts as $one) {
			++$row_index;
			
			$objExcel->setActiveSheetIndex(0)
						->setCellValue("A$row_index", $one['course'])
						->setCellValue("B$row_index", $one['username'])
						->setCellValue("C$row_index", $one['init_pswd'])
						->setCellValue("D$row_index", $one['duration'])
						->setCellValue("E$row_index", date('Y-m-d', $one['purchase_time']))
						->setCellValue("F$row_index", ($one['start_time'] === '0' ? '-' : date('Y-m-d', $one['start_time'])))
						->setCellValue("G$row_index", ($one['end_time'] === '0' ? '-' : date('Y-m-d', $one['end_time'])));
		}
		
		$objExcel->getActiveSheet()->setAutoFilter($objExcel->getActiveSheet()->calculateWorksheetDimension());
		
		/*******************************************************************************************/
		
		$filename = "赢凯会员帐号列表-{$params['course']}";
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment;filename={$filename}.xlsx");
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
		$objWriter->save('php://output');
	}
}
/* End of file */