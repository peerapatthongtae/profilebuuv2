<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public $urlapi = "http://autolab.informatics.buu.ac.th:8005";
	 //ไว้ดักสิทธิ์การเข้าใช้งาน
	public function index()
	{
		if($this->session->userdata('actor') == 'Student') {
			redirect('student/c_student/menu_student');
			die();

		} else if($this->session->userdata('actor') == 'Teacher') {
			redirect('teacher/c_teacher/menu_teacher');
			die();

		} else if($this->session->userdata('actor') == 'Admin') {
			redirect('admin/c_admin/menu_admin');
			die();
		}

		$data['user_id'] = $this->session->userdata('user_id');
		$this->template->view('template/main_view',$data);
	}

	//หน้า login
	public function login()
	{
       redirect('c_login/login');
	}
	
	
	 /*public function student_activity()
	 {
	 	$data['Student_Text'] = $this->input->get('textfield');
	 	if($data['Student_Text']) {
	 		$data['Student_Text'] = str_replace("*", "%", $data['Student_Text']);
	 		$this->load->model('m_activity');
	 		$data['result'] = $this->m_activity->search_student($data['Student_Text']);
	 	} else {
	 		$data['result'] = array();
	 	}
	 	$this->template->view('user/student_activity', $data);
	 }*/

	public function activity()
	{
		/*$data['student_code'] = $this->input->get('textfield');
		if($data['student_code']){
			$this->load->model('m_student');
			$data['student'] = $this->m_student->search_student($data['student_code']);
			//$this->load->model('m_activity');
			//$data['result'] = $this->m_activity->search_activity($data['student_code']); //ค้นหาข้อมูลกิจกรรมจากรหัสนิสิตที่ป้อนเข้ามา
		} else {
			$data['result']  = array();
			
		}
		$this->template->view('user/activity', $data); //ส่งข้อมูลไปแสดงที่หน้า activity*/
		$data['student_code'] = $this->input->get('textfield'); //ดึงค่าจาก field ที่เราป้อนรหัสนิสิต
		if($data['student_code']) { //ถ้าใน field มีการป้อนข้อมูล
			$this->load->model('m_activity');
			$data['student'] = $this->m_activity->search_student($data['student_code']);
			$data['result'] = $this->m_activity->search_activity($data['student_code']); //ค้นหาข้อมูลกิจกรรมจากรหัสนิสิตที่ป้อนเข้ามา
		} else { //ถ้าไม่มีการป้อนข้อมูล
			$data['result'] = array();
		}
		$this->template->view('user/activity', $data); //ส่งข้อมูลไปแสดงที่หน้า activity
		
	}

	public function award()
	{
		$this->load->model('m_award');
		$data['result'] = $this->m_award->get_all();
		$this->template->view('user/award', $data);
	}

	public function graduate() {
		$this->template->view('user/graduate');
	}

	public function statistics()
	{
		$this->template->view('user/statistics');
	}
	public function getAboutStudent_api() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		$student_id=$this->input->post('student_id');
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/student/".$student_id."/about",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		$data['result'] = $data;
		$this->template->view('user/api/getAboutStudent_api',$data);
		}
		

	
	}
	public function getAllStudent_api() {
		
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "8005",
		CURLOPT_URL => $this->urlapi."/api/v1/students",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		//$data['result']['student'] = $data;
		$data['result'] = $data;
		$this->template->view('user/api/getAllStudent_api',$data);
		}
	}
	public function getAmountStudentStatus_api() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		$year=$this->input->post('year');
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/amountstudentstatus/".$year,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		$data['result'] = $data;
		$this->template->view('user/api/getAmountStudentStatus_api',$data);
		}
		

	
	}
	public function getJobStatus_api() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		$student_id=$this->input->post('student_id');
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/job/".$student_id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		$data['result'] = $data;
		$this->template->view('user/api/getJobStatus_api',$data);
		}
		

	
	}
	public function getSubjectStudent_getSubpi() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		$student_id=$this->input->post('student_id');
		$subject_code=$this->input->post('subject_code');
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/student/".$student_id."/subjects?Subject_Code=".$subject_code,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		
		$data['result'] = $data;
		$this->template->view('user/api/getSubjectStudent_api',$data);
		}
		

	
	}
	public function getCreditStudent_api() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		$student_id=$this->input->post('student_id');
		
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/student/".$student_id."/credit",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		
		$data['result'] = $data;
		$this->template->view('user/api/getCreditStudent_api',$data);
		}
		

	
	}
	public function getAllActivity_api() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		
		
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/activities",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		
		$data['result'] = $data;
		$this->template->view('user/api/getAllActivity_api',$data);
		}
		

	
	}
	public function getActivityDetail_api() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		$id=$this->input->post('activity_id');
		
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/activity/".$id."/activity",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		
		$data['result'] = $data;
		$this->template->view('user/api/getActivityDetail_api',$data);
		}
		

	
	}
	public function getActivityStudent_api() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		$id=$this->input->post('activity_id');
		
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/activity/".$id."/student",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		
		$data['result'] = $data;
		$this->template->view('user/api/getActivityStudent_api',$data);
		}
		

	
	}
	public function getStudentActivity_api() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		$student_id=$this->input->post('student_id');
		
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/activity/".$student_id."/activities",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		
		$data['result'] = $data;
		$this->template->view('user/api/getStudentActivity_api',$data);
		}
		

	
	}
	public function getAllAwards_api() {
			
		$this->load->model('m_api');
		
		$token = $this->m_api->get_token();

		
		$curl = curl_init();
		$authorization = "Authorization: Bearer $token";
		curl_setopt_array($curl, array(
		//CURLOPT_PORT => "9991",
		CURLOPT_URL => $this->urlapi."/api/v1/awards",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_POSTFIELDS => "",
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			$authorization,
			"cache-control: no-cache"
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		echo "cURL Error #:" . $err;
		} else {
		$data = json_decode($response,true);
		
		$data['result'] = $data;
		$this->template->view('user/api/getAllAwards_api',$data);
		}
		

	
	}
	
}
