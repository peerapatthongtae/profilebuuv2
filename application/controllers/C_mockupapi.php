<?php
    class C_mockupapi extends CI_Controller { 
    public function mockup_api()
    {
        $this->load->model('mockup_api');
        $data['data_table'] = $this->mockup_api->getTeachers();
        print_r($data);
    }
 }
    ?>