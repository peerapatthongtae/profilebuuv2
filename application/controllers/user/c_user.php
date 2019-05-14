<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_user extends CI_Controller {
	
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

	public function menu_user()
	{
		$this->template->view('template/main_view');
		
	}

// ดูรางวัลการแข่งขัน
	public function award()
	{
		$this->load->model('m_award');
		$data['result'] = $this->m_award->get_all_award(); //ดึงข้อมูลรางวัลทั้งหมด เก็บใน array
		$data['result1'] = $this->m_award->get_by_id_award_has_student($data['result']); //ดึงข้อมูลตาม id ของรางวัลนั้นๆ
		// print_r($data);
		$this->template->view('user/award',$data);
	}
	// รายชื่อนิสิตในรางวัลนั้นๆ
	public function award_detail_user($id)
	{
		$data['award_id'] = $id;
		// print_r($id);
		$this->load->model('m_award');
		$data['result1'] = $this->m_award->get_Award_by_id($id);
		$data['Award_name'] = $this->m_award->get_Award_by_name($id);
		// print_r($data);
		$this->template->view('user/award_detail_user',$data);
	}
	// รายชื่อทุนการศึกษา
	public function scholarship_student_user()
	{
		$this->load->model('m_scholarship');
		$data['result'] = $this->m_scholarship->get_all_scholarship();
		$data['result1'] = $this->m_scholarship->get_by_id_scholarship_has_student($data['result']);
		// print_r($data);
		$this->template->view('user/scholarship_student_user',$data);
	}
	// รายชื่อนิสิตในทุนการศึกษา
	public function scholarship_detail_user($id)
	{
	$data['scholarship_id'] = $id;
	// print_r($id);
	$this->load->model('m_scholarship');
	$data['result1'] = $this->m_scholarship->get_Scholarship_by_id($id);
	$data['scholarship_name'] = $this->m_scholarship->get_Scholarship_by_name($id);
	// print_r($data);
	$this->template->view('user/scholarship_detail_user',$data);
	}

	public function student_activity_detail($id) {
		$data['student_id'] = $id;
		// print_r($id);
		$this->load->model('m_student');
		$data['result'] = $this->m_student->get_student($id);
		// print_r($data);
		$this->template->view('user/student_activity_detail',$data);
	}
	public function manipulator() {
		$this->template->view('user/manipulator');
	}
	
}
