<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_data_student extends CI_Controller {

    public function index()
	{
        $this->load->model('m_data_student');
		$data['query'] = $this->m_data_student->get_all();
		$this->load->view('student/data_student', $data);

    }

/* ส่วนแก้ไขข้อมูล
   public function insert()
	{
		$this->load->model('Customer_Model');
		$this->Customer_Model->insert();
		redirect('Customer');
    }
*/

	public function update(){
		if($this->input->post('submit') != null){
			$id = $this->input->post('Student_ID');
			$this->load->model('m_data_student');
			$this->m_data_student->update($id);
			redirect('Student');
		}else{
			$id = $this->uri->segment(3);
			$this->load->model("m_data_student");
			$data['query'] = $this->m_data_student->get_by_id($id);
			$this->load->view('student/edit_student',$data);
		}
    }
/* 
	public function delete(){
		$id = $this->uri->segment(3);
		$this->load->model('Customer_Model');
		$this->Customer_Model->delete($id);
		redirect('Customer');
    }
*/
}
?>