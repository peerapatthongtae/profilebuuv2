<?php
class M_teacher extends CI_Model
{
        public function get_teacher($id){
            $this->db->from('Academic_Adviser');
            $this->db->where('Teacher_ID',$id);
            $query = $this->db->get();
            return $query->result_array()[0];
            // echo $this->db->last_query(); ไว้ดูดีบัพนะ
        }

        // โปรสูง โปรต่ำ
        public function search_student_between_gpax($gpax_low, $gpax_high){
            $this->db->where('Status_ID', 10);
            $this->db->where('GPAX >= ', $gpax_low);
            $this->db->where('GPAX <= ', $gpax_high);
            $this->db->from('Student');
            $query = $this->db->get();
            return $query->result_array();
        }
        
}

?>