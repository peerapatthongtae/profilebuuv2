<?php 

    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template {
    function view($file, $data = array()) {

        error_reporting(E_ALL ^ E_NOTICE);
        $CI =& get_instance();
        
        
        $CI->load->view('template/header.php', $data);

        if($CI->session->userdata('actor') == 'Student') {
            $CI->load->view('student_menu/menu_student.php', $data);

        } else if($CI->session->userdata('actor') == 'Teacher') {
            $CI->load->view('teacher_menu/menu_teacher.php', $data);

        } else if($CI->session->userdata('actor') == 'Admin') {
            $CI->load->view('admin_menu/menu_admin.php', $data);
            
        } else {
            $CI->load->view('user_menu/menu_user.php', $data);
        }
        $CI->load->view($file, $data);
        $CI->load->view('template/footer.php', $data);

    }
}

?>