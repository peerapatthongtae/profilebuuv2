<?php
class M_award extends CI_Model
{
        public function get_all(){
            $sql = "Select Award.Award_ID,Award.Award_Name, Award.Award_Term, Award.Award_Year, Award.Award_Date, Award.Award_Course, Award_has_Student.Student_ID, Student.Student_Prefix, Student.Student_Name_Th, Student.Student_Lname_Th, Student.Course, Award.Award_Amount, Award.Award_Giver 
            from Award 
            INNER JOIN Award_has_Student ON Award.Award_ID = Award_has_Student.Award_ID 
            INNER JOIN Student ON Award_has_Student.Student_ID = Student.Student_ID";
            $query = $this->db->query($sql);            
            return $query->result();
        }

        public function get_all_award(){ //ดึงข้อมูลรางวัลทั้งหมด
            $this->db->from('Award');
            $query = $this->db->get();           
            return $query->result_array();
        }

        public function get_by_id_award_has_student(){
           
            $this->db->from('Award_has_Student');
            $query = $this->db->get();           
            return $query->result_array();
        }

        public function get_Award_by_id($id){ //ดึงข้อมูลรางวัลจาก id ของรางวัลนั้นๆ
            $sql = "Select Award.Award_ID,Award.Award_Name, Award.Award_Term, Award.Award_Year, Award.Award_Date, Award.Award_Course, Award_has_Student.Student_ID, Student.Student_Prefix, Student.Student_Name_Th, Student.Student_Lname_Th, Student.Course, Award.Award_Amount, Award.Award_Giver 
            from Award 
            INNER JOIN Award_has_Student ON Award.Award_ID = Award_has_Student.Award_ID 
            INNER JOIN Student ON Award_has_Student.Student_ID = Student.Student_ID
            WHERE Award.Award_ID= '".$id."' ";
            $query = $this->db->query($sql);           
            return $query->result();
        }

        public function get_Award_by_name($id){
            $sql = "Select Award.Award_Name
            FROM Award
            WHERE Award.Award_ID = '".$id."' ";
            $query = $this->db->query($sql);           
            return $query->result();
        }

        public function get_Award_by_student($id){
            $sql = "Select Award.Award_ID,Award.Award_Name, Award.Award_Term, Award.Award_Year, Award.Award_Date, Award.Award_Course,Award.Award_Amount, Award.Award_Giver 
            from Award 
            INNER JOIN Award_has_Student ON Award.Award_ID = Award_has_Student.Award_ID 
            INNER JOIN Student ON Award_has_Student.Student_ID = Student.Student_ID
            WHERE Award_has_Student.Student_ID = '".$id."' ";
            $query = $this->db->query($sql);           
            return $query->result();
        }

        // แก้ไขข้อมูลรางวัลการแข่งขัน
        public function update_award($data, $award_id){
            $this->db->where('Award_ID', $award_id);
            return $this->db->update('Award',$data);
        }

        // ลบรางวัลการแข่งขัน
        public function delete_award_has_student($id){
            $this->db->where('Student_ID',$id);
            $this->db->delete('Award_has_Student');
            return true;
        }

        public function get_by_id($id){
                $this->db->where('Award_ID',$id);
                $query = $this->db->get('Award');
                return $query->result_array();
        }
        
        public function insert_award($data){
                return $this->db->insert('Award',$data);
        }

        // public function insert_student_award($data){
        //         $db_debug = $this->db->db_debug; //save setting
        //         $this->db->db_debug = FALSE;
        //         $return = $this->db->insert('Award_has_Student',$data);
        //         $this->db->db_debug = $db_debug;
        //         return $return;
        // }

        public function insert_batch_student_award($data){
            $sql = 'replace into Award_has_Student values ';

            foreach($data as $row) {
                $sql .= "('".$row['Award_ID']."', '".$row['Student_ID']."'), ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= ';';

            return $this->db->query($sql);

        }
       
        
        
}



?>