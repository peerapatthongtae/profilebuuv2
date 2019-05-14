<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_student extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

		if($this->session->userdata('user_id') == ''){
			redirect('c_login/login');
			die();
		}
	
		if($this->session->userdata('actor') == 'Teacher') {
			redirect('teacher/c_teacher/menu_teacher');
			die();

		} else if($this->session->userdata('actor') == 'Admin') {
			redirect('admin/c_admin/menu_admin');
			die();
		}
		
	}

    public function index()
    {
		$data['user_id'] = $this->session->userdata('user_id');
		$data['student'] = $this->m_student->get_student($data['user_id']);
		$this->template->view('template/main_view',$data);

    }
    
    public function menu_student()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['student'] = $this->m_student->get_student($data['user_id']);
		$this->template->view('template/main_view',$data);

	}

	public function data_student()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['student'] = $this->m_student->get_student($data['user_id']);
		$data['scholarship'] = $this->m_scholarship->get_Scholarship_by_student($data['user_id']);
		$data['activity'] = $this->m_activity->get_by_student_id($data['user_id']);
		$data['award'] = $this->m_award->get_Award_by_student($data['user_id']);
		$data['status'] = $this->m_student->status($data['user_id']);
		$data['GPA_Year'] = $this->m_student->get_GPA_Year($data['user_id']);
		$data['GPA'] = $this->m_student->get_GPA($data['user_id']);
		$data['CA'] = $this->m_student->ca_student($data['user_id']);
		$data['Adviser'] = $this->m_student->get_Adviser($data['user_id']);
		

		$this->template->view('student/data_student',$data);
	}

	public function edit_datastudent()
	{
		
		$data['user_id'] = $this->session->userdata('user_id');
		$data['student'] = $this->m_student->get_student($data['user_id']);
		$this->template->view('student/edit_datastudent',$data);
		
	}

	public function post_edit_student()
	{
		/*$this->form_validation->set_rules('Student_Name_Eng', 'ชื่อภาษาอังกฤษ', 'required|alpha');
		$this->form_validation->set_rules('Student_Lname_Eng', 'นามสกุลภาษาอังกฤษ', 'required|alpha');
		$this->form_validation->set_rules('Student_Nickname', 'ชื่อเล่น', 'required|thai_en_character');
		$this->form_validation->set_rules('Student_Phone', 'เบอร์โทรศัพท์นิสิต', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('Student_Email', 'อีเมลนิสิต', 'required|valid_email');
		$this->form_validation->set_rules('Blood', 'กรุ๊ปเลือด', 'required');
		$this->form_validation->set_rules('Facebook', 'Facebook', 'required');
		$this->form_validation->set_rules('Line', 'Line', 'required');

		$this->form_validation->set_rules('Address_Number', 'นิสิต : บ้านเลขที่', 'required');
		$this->form_validation->set_rules('Address_Moo', 'นิสิต : หมู่', 'required');
		$this->form_validation->set_rules('Address_Soi', 'นิสิต : ซอย', 'required');
		$this->form_validation->set_rules('Address_Tumbon', 'นิสิต : ตำบล', 'required|thai_en_character');
		$this->form_validation->set_rules('Address_Aumper', 'นิสิต : อำเภอ', 'required|thai_en_character');
		$this->form_validation->set_rules('Address_Province', 'นิสิต : จังหวัด', 'required|thai_en_character');
		$this->form_validation->set_rules('Address_Postcode', 'นิสิต : รหัสไปรษณีย์', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('Student_Phone', 'เบอร์โทรศัพท์นิสิต', 'required');
		$this->form_validation->set_rules('Student_Email', 'อีเมลนิสิต', 'valid_email');

		$this->form_validation->set_rules('Father_Name', 'ชื่อ-นามสกุลบิดา', 'required');
		$this->form_validation->set_rules('Father_Career', 'อาชีพบิดา', 'required');
		$this->form_validation->set_rules('Father_Status', 'ความสัมพันธ์บิดา', 'required');
		$this->form_validation->set_rules('Father_Address_Number', 'บิดา : บ้านเลขที่', 'required');
		$this->form_validation->set_rules('Father_Address_Moo', 'บิดา : หมู่', 'required');
		$this->form_validation->set_rules('Father_Address_Soi', 'บิดา : ซอย', 'required');
		$this->form_validation->set_rules('Father_Address_Tumbon', 'บิดา : ตำบล', 'required|thai_en_character');
		$this->form_validation->set_rules('Father_Address_Aumper', 'บิดา : อำเภอ', 'required|thai_en_character');
		$this->form_validation->set_rules('Father_Address_Province', 'บิดา : จังหวัด', 'required|thai_en_character');
		$this->form_validation->set_rules('Father_Address_Postcode', 'บิดา : รหัสไปรณีย์', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('Father_Phone', 'บิดา : เบอร์โทรศัพท์', 'required');
		$this->form_validation->set_rules('Father_Email', 'บิดา : อีเมล', 'valid_email');

		$this->form_validation->set_rules('Mother_Name', 'ชื่อ-นามสกุลมารดา', 'required');
		$this->form_validation->set_rules('Mother_Career', 'อาชีพมารดา', 'required');
		$this->form_validation->set_rules('Mother_Status', 'ความสัมพันธ์มารดา', 'required');
		$this->form_validation->set_rules('Mother_Address_Number', 'มารดา : บ้านเลขที่', 'required');
		$this->form_validation->set_rules('Mother_Address_Moo', 'มารดา : หมู่', 'required');
		$this->form_validation->set_rules('Mother_Address_Soi', 'มารดา : ซอย', 'required');
		$this->form_validation->set_rules('Mother_Address_Tumbon', 'มารดา : ตำบล', 'required|thai_en_character');
		$this->form_validation->set_rules('Mother_Address_Aumper', 'มารดา : อำเภอ', 'required|thai_en_character');
		$this->form_validation->set_rules('Mother_Address_Province', 'มารดา : จังหวัด', 'required|thai_en_character');
		$this->form_validation->set_rules('Mother_Address_Postcode', 'มารดา : รหัสไปรษณีย์', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('Mother_Phone', 'มารดา : เบอร์โทรศัพท์', 'required');
		$this->form_validation->set_rules('Mother_Email', 'มารดา : อีเมล', 'valid_email');

		$this->form_validation->set_rules('Parent_Name', 'ชื่อ-นามสกุลผู้ปกครอง', 'required');
		$this->form_validation->set_rules('Parent_Career', 'อาชีพผู้ปกครอง', 'required');
		$this->form_validation->set_rules('Parent_Status', 'ความสัมพันธ์ผู้ปกครอง', 'required');
		$this->form_validation->set_rules('Parent_Address_Number', 'ผู้ปกครอง : บ้านเลขที่', 'required');
		$this->form_validation->set_rules('Parent_Address_Moo', 'ผู้ปกครอง : หมู่', 'required');
		$this->form_validation->set_rules('Parent_Address_Soi', 'ผู้ปกครอง : ซอย', 'required');
		$this->form_validation->set_rules('Parent_Address_Tumbon', 'ผู้ปกครอง : ตำบล', 'required|thai_en_character');
		$this->form_validation->set_rules('Parent_Address_Aumper', 'ผู้ปกครอง : อำเภอ', 'required|thai_en_character');
		$this->form_validation->set_rules('Parent_Address_Province', 'ผู้ปกครอง : จังหวัด', 'required|thai_en_character');
		$this->form_validation->set_rules('Parent_Address_Postcode', 'ผู้ปกครอง : รหัสไปรษณีย์', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('Parent_Phone', 'ผู้ปกครอง : เบอร์โทรศัพท์', 'required');
		$this->form_validation->set_rules('Parent_Email', 'ผู้ปกครอง : อีเมล', 'valid_email');

		$this->form_validation->set_rules('Contact_Name', 'ชื่อ-นามสกุลผู้ที่ติดต่อได้', 'required');
		$this->form_validation->set_rules('Contact_Status', 'ความสัมพันธ์ผู้ที่ติดต่อได้', 'required');
		$this->form_validation->set_rules('Contact_Email', 'ผู้ที่ติดต่อได้ : อีเมล', 'valid_email');
		$this->form_validation->set_rules('Contact_Address_Number', 'ผู้ที่ติดต่อได้ : บ้านเลขที่', 'required');
		$this->form_validation->set_rules('Parent_Address_Tumbon', 'ผู้ที่ติดต่อได้ : ตำบล', 'required|thai_en_character');
		$this->form_validation->set_rules('Contact_Address_Aumper', 'ผู้ที่ติดต่อได้ : อำเภอ', 'required|thai_en_character');
		$this->form_validation->set_rules('Contact_Address_Province', 'ผู้ที่ติดต่อได้ : จังหวัด', 'required|thai_en_character');
		$this->form_validation->set_rules('Contact_Address_Postcode', 'ผู้ที่ติดต่อได้ : รหัสไปรษณีย์', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('Contact_Phone', 'ผู้ที่ติดต่อได้ : เบอร์โทรศัพท์', 'required');


		$this->form_validation->set_rules('Work_Status', 'นิสิต : สถานะการทำงาน', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->edit_datastudent() ;
		}
		else
		{*/
		$data['Student_Name_Eng'] = $this->input->post('Student_Name_Eng');
		$data['Student_Lname_Eng'] = $this->input->post('Student_Lname_Eng');
		$data['Student_Nickname'] = $this->input->post('Student_Nickname');
		$data['Student_Phone'] = $this->input->post('Student_Phone');
		$data['Student_Email'] = $this->input->post('Student_Email');
		$data['Blood'] = $this->input->post('Blood');
		$data['Facebook'] = $this->input->post('Facebook');
		$data['Line'] = $this->input->post('Line');
		$data['Address_Number'] = $this->input->post('Address_Number');
		$data['Address_Moo'] = $this->input->post('Address_Moo');
		$data['Address_Soi'] = $this->input->post('Address_Soi');
		$data['Address_Tumbon'] = $this->input->post('Address_Tumbon');
		$data['Address_Aumper'] = $this->input->post('Address_Aumper');
		$data['Address_Province'] = $this->input->post('Address_Province');
		$data['Address_Postcode'] = $this->input->post('Address_Postcode');
		$data['Address_Phone'] = $this->input->post('Address_Phone');
		$data['Address_Email'] = $this->input->post('Address_Email');
		
		$data['Father_Name'] = $this->input->post('Father_Name');
		$data['Father_Career'] = $this->input->post('Father_Career');
		$data['Father_Status'] = $this->input->post('Father_Status');
		$data['Father_Address_Number'] = $this->input->post('Father_Address_Number');
		$data['Father_Address_Moo'] = $this->input->post('Father_Address_Moo');
		$data['Father_Address_Soi'] = $this->input->post('Father_Address_Soi');
		$data['Father_Address_Tumbon'] = $this->input->post('Father_Address_Tumbon');
		$data['Father_Address_Aumper'] = $this->input->post('Father_Address_Aumper');
		$data['Father_Address_Province'] = $this->input->post('Father_Address_Province');
		$data['Father_Address_Postcode'] = $this->input->post('Father_Address_Postcode');
		$data['Father_Phone'] = $this->input->post('Father_Phone');
		$data['Father_Email'] = $this->input->post('Father_Email');

		$data['Mother_Name'] = $this->input->post('Mother_Name');
		$data['Mother_Career'] = $this->input->post('Mother_Career');
		$data['Mother_Status'] = $this->input->post('Mother_Status');
		$data['Mother_Address_Number'] = $this->input->post('Mother_Address_Number');
		$data['Mother_Address_Moo'] = $this->input->post('Mother_Address_Moo');
		$data['Mother_Address_Soi'] = $this->input->post('Mother_Address_Soi');
		$data['Mother_Address_Tumbon'] = $this->input->post('Mother_Address_Tumbon');
		$data['Mother_Address_Aumper'] = $this->input->post('Mother_Address_Aumper');
		$data['Mother_Address_Province'] = $this->input->post('Mother_Address_Province');
		$data['Mother_Address_Postcode'] = $this->input->post('Mother_Address_Postcode');
		$data['Mother_Phone'] = $this->input->post('Mother_Phone');
		$data['Mother_Email'] = $this->input->post('Mother_Email');

		$data['Parent_Name'] = $this->input->post('Parent_Name');
		$data['Parent_Career'] = $this->input->post('Parent_Career');
		$data['Parent_Status'] = $this->input->post('Parent_Status');
		$data['Parent_Address_Number'] = $this->input->post('Parent_Address_Number');
		$data['Parent_Address_Moo'] = $this->input->post('Parent_Address_Moo');
		$data['Parent_Address_Soi'] = $this->input->post('Parent_Address_Soi');
		$data['Parent_Address_Tumbon'] = $this->input->post('Parent_Address_Tumbon');
		$data['Parent_Address_Aumper'] = $this->input->post('Parent_Address_Aumper');
		$data['Parent_Address_Province'] = $this->input->post('Parent_Address_Province');
		$data['Parent_Address_Postcode'] = $this->input->post('Parent_Address_Postcode');
		$data['Parent_Phone'] = $this->input->post('Parent_Phone');
		$data['Parent_Email'] = $this->input->post('Parent_Email');

		$data['Contact_Name'] = $this->input->post('Contact_Name');
		$data['Contact_Status'] = $this->input->post('Contact_Status');
		$data['Contact_Email'] = $this->input->post('Contact_Email');
		$data['Contact_Address_Number'] = $this->input->post('Contact_Address_Number');
		$data['Contact_Address_Tumbon'] = $this->input->post('Contact_Address_Tumbon');
		$data['Contact_Address_Aumper'] = $this->input->post('Contact_Address_Aumper');
		$data['Contact_Address_Province'] = $this->input->post('Contact_Address_Province');
		$data['Contact_Address_Postcode'] = $this->input->post('Contact_Address_Postcode');
		$data['Contact_Phone'] = $this->input->post('Contact_Phone');

		$data['Work_Status'] = $this->input->post('Work_Status');
		$data['Work_Position'] = $this->input->post('Work_Position');
		$data['Workplace_Company'] = $this->input->post('Workplace_Company');
		$data['Workplace_Address'] = $this->input->post('Workplace_Address');

		$this->m_student->update_datastudent($data, $this->session->userdata('user_id'));
		redirect('student/c_student/data_student', 'refresh');
		//}
		
	}
	
	public function transcript_student()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['student'] = $this->m_student->get_student($data['user_id']);
		$data['transcript'] = $this->m_student->get_transcript($data['user_id']);
		$data['GPA'] = $this->m_student->get_GPA($data['user_id']);
		$data['status'] = $this->m_student->status($data['user_id']);
		$data['transcript_rows'] = $this->m_student->get_year_transcript($data['user_id']);
		$data['CA'] = $this->m_student->ca_student($data['user_id']);
		$this->template->view('student/transcript_student',$data);
	}
	
	//หน้าไว้ทดสอบงานปลอมๆ
	public function coop_student()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['student'] = $this->m_student->get_student($data['user_id']);
		$data['scholarship'] = $this->m_scholarship->get_Scholarship_by_student($data['user_id']);
		$data['activity'] = $this->m_activity->get_by_student_id($data['user_id']);
		$data['award'] = $this->m_award->get_Award_by_student($data['user_id']);
		$data['status'] = $this->m_student->status($data['user_id']);
		$data['GPA_Year'] = $this->m_student->get_GPA_Year($data['user_id']);
		$data['GPA'] = $this->m_student->get_GPA($data['user_id']);
		$this->template->view('student/coop_student',$data);
	}

	
	public function graduate_actorstudent()
	{
		$data['user_id'] = $this->session->userdata('user_id');
		$data['student'] = $this->m_student->get_student($data['user_id']);
		$this->template->view('student/graduate_actorstudent',$data);
	}

}
	
?>