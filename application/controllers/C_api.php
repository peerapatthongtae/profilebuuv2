<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_api extends CI_Controller {
	

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
		} else if($this->session->userdata('actor') == 'Teacher') {
			redirect('teacher/c_teacher/menu_teacher');
			die();
		}
		
		
    }
    
		public function index() {
			$this->load->library('curl');
			$result = $this->curl->simple_get('http://google.co.th');
			
			echo $result;
			//  Calling cURL Library
			//$this->load->library('Curl');
		

			//  Setting URL To Fetch Data From
			//$this->curl->get('https://localhost:9991/api/token');

			/*//  To Temporarily Store Data Received From Server
			$this->curl->option('USERPWD', "buu_profile:profile_999");
			$this->curl->option('HTTPAUTH',CURLAUTH_BASIC)
			//  To Receive Data Returned From Server
			$this->curl->option('returntransfer', 1);
			$this->curl->option('connecttimeout', 5);

			

			//  To Execute 'option' Array Into cURL Library & Store Returned Data Into $data
			$data = $this->curl->execute();

			//  To Display Returned Data
			echo $data;
			*/
//$this->template->view("admin/call_api");
		
			
		
		}

	}
?>