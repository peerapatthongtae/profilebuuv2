<?php
class M_data_student extends CI_Model
{
        public function get_all(){
            $this->db->order_by('Student_ID','DESC');
            $query = $this->db->get('Student');
            return $query->result_array();
        }
//ไว้แก้ไข
        public function get_by_id(){
            $this->db->where('Student_ID','$id');
            $query = $this->db->get('Student');
            return $query->result_array();
        }
//1
// ส่วนของเพิ่มข้อมูล ข้อมูลนิสิตน่าจะไม่มี
//        public function insert(){
//            $data = array(
//                'facebook' => $this->input->post('facebook')
//            );
//            $this->db->insert('Student','$data');
//            return true;
//      }
//2
        public function update($id){
            $data = array(
                'facebook' => $this->input->post('facebook')
            );
            $this->db->where('Student_ID','$id');
            $this->db->update('Student','$data');
            return true;
        }


}

?>