<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_teacher extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

		if($this->session->userdata('user_id') == ''){
			redirect('c_login/login');
			die();
		}
		
		if($this->session->userdata('actor') == 'Student') {
			redirect('student/c_student/menu_student');
			die();

		} else if($this->session->userdata('actor') == 'Admin') {
			redirect('admin/c_admin/menu_admin');
			die();
		}
	}
  
    public function index()
    {
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$this->template->view('template/main_view',$data);
    }

    public function menu_teacher()
	{
		// print_r($this->session->userdata());
		$data['user_id'] = $this->session->userdata('user_id');
		// print_r($data);
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$this->template->view('template/main_view',$data);
		
	}

	public function data_teacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$this->template->view('teacher/data_teacher',$data);
	}
	
	public function coop_student_teacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$this->template->view('teacher/coop_student_teacher',$data);
	}

	public function activity_student_teacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$data['student_code'] = $this->input->get('textfield');
		if($data['student_code']) {
			$this->load->model('m_activity');
			$data['result'] = $this->m_activity->search_activity($data['student_code']);
			
		} else {
			$data['result'] = array();
		}
		
		$this->template->view('teacher/activity_student_teacher',$data);
	}
	public function award_student_teacher()
	{
		$this->load->model('m_award');
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$data['result'] = $this->m_award->get_all_award();
		$data['result1'] = $this->m_award->get_by_id_award_has_student($data['result']);
		// print_r($data);
		$this->template->view('teacher/award_student_teacher',$data);
	}
	// รายชื่อนิสิตในรางวัลนั้นๆ
	public function award_detail_student($id)
	{
		$data['award_id'] = $id;
		// print_r($id);
		$this->load->model('m_award');
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$data['result1'] = $this->m_award->get_Award_by_id($id);
		$data['Award_name'] = $this->m_award->get_Award_by_name($id);
		// print_r($data);
		$this->template->view('teacher/award_detail_student',$data);
	}

	public function graduate_actorteacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$this->template->view('teacher/graduate_actorteacher',$data);
	}

	public function statistics_student_teacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$this->template->view('teacher/statistics_student_teacher',$data);
	}

	public function graduate_student_teacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$this->template->view('teacher/graduate_student_teacher',$data);
	}

	public function search_data_student_teacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$data['Student_Text'] = $this->input->get('textfield');
		if($data['Student_Text']) {
			$data['Student_Text'] = str_replace("*", "%", $data['Student_Text']);
			$this->load->model('m_student');
			$data['result'] = $this->m_student->search_student($data['Student_Text']);
		} else {
			$data['result'] = array();
		}
		$this->template->view('teacher/search_data_student_teacher', $data);
	}

	//ส่วนการค้นหาข้อมูล
	public function data_student_detail_teacher($id)
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$data['student_id'] = $id;
		$data['result'] = $this->m_student->get_student($id);
		$data['scholarship'] = $this->m_scholarship->get_Scholarship_by_student($data['student_id']);
		$data['activity'] = $this->m_activity->get_by_student_id($data['student_id']);
		$data['award'] = $this->m_award->get_Award_by_student($data['student_id']);
		$data['status'] = $this->m_admin->search_student_status($data['student_id']);
		$data['GPA_Year'] = $this->m_student->get_GPA_Year($data['student_id']);
		$data['GPA'] = $this->m_student->get_GPA($data['student_id']);
		$data['CA'] = $this->m_student->ca_student($data['student_id']);
		$data['Adviser'] = $this->m_student->get_Adviser($data['student_id']);
		$this->template->view('teacher/data_student_detail_teacher',$data);
	}

	public function transcript_student_teacher($student_code)
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$this->load->model('m_student');
		$data['result'] = $this->m_student->get_student($student_code);
		$data['transcript'] = $this->m_student->get_transcript($student_code);
		$data['GPA'] = $this->m_student->get_GPA($student_code);
		$data['status'] = $this->m_admin->search_student_status($student_code);
		$data['transcript_rows'] = $this->m_student->get_year_transcript($student_code);
		$data['CA'] = $this->m_student->ca_student($student_code);
		$this->template->view('teacher/transcript_student_teacher',$data);
	}

	public function editdata_student_teacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$this->template->view('teacher/editdata_student_teacher',$data);
		
	}


	// รายชื่อทุนการศึกษา
	public function scholarship_student_teacher()
	{
		$this->load->model('m_scholarship');
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$data['result'] = $this->m_scholarship->get_all_scholarship();
		$data['result1'] = $this->m_scholarship->get_by_id_scholarship_has_student($data['result']);
		// print_r($data);
		$this->template->view('teacher/scholarship_student_teacher',$data);
	}
	// รายชื่อนิสิตในทุนการศึกษา
	public function scholarship_detail_teacher($id)
	{
	$data['scholarship_id'] = $id;
	// print_r($id);
	$this->load->model('m_scholarship');
	$data['user_id'] = $this->session->userdata('user_id');
	$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
	$data['result1'] = $this->m_scholarship->get_Scholarship_by_id($id);
	$data['scholarship_name'] = $this->m_scholarship->get_Scholarship_by_name($id);
	// print_r($data);
	$this->template->view('teacher/scholarship_detail_teacher',$data);
	}

	public function statistics_teacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$data['static'] = $this->m_admin->static_years();
		
		$this->template->view('teacher/statistics_teacher',$data);
	}

	public function statistics_detail()
	{
		//print_r($_POST);
		$Stat_Years = $this->input->post('Stat_Years');
		$Stat_Course = $this->input->post('Stat_Course');

		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		$data['static'] = $this->m_admin->static_data($Stat_Years, $Stat_Course);
		
		
		// print_r($data);
		$this->template->view('teacher/statistics_detail',$data);
	}

	public function statistics_ajax($static_years)
	{
		
		$data['course'] = [];
		foreach( $this->m_admin->static_years_course($static_years) as $row ) {
			$row['button'] = '<form action="'.site_url('teacher/c_teacher/statistics_detail/').'" method="post">
									<input type="hidden" name="Stat_Years" value="'.$row['Stat_Years'].'"> 
									<input type="hidden" name="Stat_Course" value="'.$row['Stat_Course'].'"> 
									<button type="submit" class="btn btn-primary">รายละเอียด</button>
							</form>';
			$data['course'][] = $row;
		}

		echo json_encode($data);
	}

	// นิสิตรอพินิจ
	public function consider_student_teacher()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['teacher'] = $this->m_teacher->get_teacher($data['user_id']);
		if($this->input->post('consider')) { 
			if($this->input->post('consider') == 'high'){
			// โปรสูง
				$data['student'] = $this->m_teacher->search_student_between_gpax(1.80, 1.99);
			} else {
				// โปรต่ำ
				$data['student'] = $this->m_teacher->search_student_between_gpax(1.75, 1.79);
			}
		} else {
			$data['student'] = array();
		}
		// print_r($data);
		$this->template->view('teacher/consider_student_teacher',$data);
	}


}

?>