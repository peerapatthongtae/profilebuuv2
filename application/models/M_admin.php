<?php
class M_admin extends CI_Model
{
        public function get_admin($id){
            $this->db->from('Staff');
            $this->db->where('Staff_ID',$id);
            $query = $this->db->get();
            return $query->result_array()[0];
            
        }

        public function stat_student($insert_array){
            return $this->db->replace('Static_Student', $insert_array);
            
        }
       

        // หลักสูตร
        public function insert_course($array) {
            return $this->db->insert('Course', $array);
           
        }
        public function set_consider(){
            $sql = "Select *
            from Course";
            $query = $this->db->query($sql);            
            return $query->result();
        }

        public function get_allCourse(){
            $sql = "Select *
            from Course";
            $query = $this->db->query($sql);            
            return $query->result();
        }

        public function search_course($course_id) {
            $this->db->where('Course_ID', $course_id);
            $this->db->from('Course');
            $query = $this->db->get();
            return $query->result_array();
        }
        public function update_course($course_id, $data) {
            $this->db->where('Course_ID', $course_id);
            return $this->db->update('Course', $data);
        }

        public function search_student($Student_Code){
            $sql = "Select *
            from Student
            WHERE Student.Student_ID = '".$Student_Code."' ";
            $query = $this->db->query($sql);            
            return $query->result();
        }

        public function search_student_status($Student_id)
        {
            $sql = "SELECT Status.Status_Name 
            FROM Student 
            INNER JOIN Status ON Student.Status_ID = Status.Status_ID
            WHERE Student.Student_ID = '".$Student_id."' ";
            $query = $this->db->query($sql);            
            return $query->result();
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
        // สถิติจำนวนนิสิต(เอาปีการศึกษาออกมา)
        public function static_years()
        {
            $sql = "SELECT Stat_Years 
            FROM `Static_Student` 
            group by Stat_Years
            order by Stat_Years DESC";
            $query = $this->db->query($sql);            
            return $query->result_array();
        }
        public function get_GPA_Years() {
            $sql = "SELECT Gpa_Year
            FROM `GPA` 
            group by Gpa_Year
            order by Gpa_Year DESC";
            $query = $this->db->query($sql);            
            return $query->result();
        }

        // สถิติจำนวนนิสิต(เอาปีการศึกษากับหลักสูตรออกมา)
        public function static_years_course($years)
        {
            $sql = "SELECT Stat_Years,Stat_Course 
            FROM `Static_Student` 
            WHERE `Stat_Years` = '".$years."'  
            group by Stat_Years,Stat_Course";
            $query = $this->db->query($sql);            
            return $query->result_array();
        }

        // สถิติจำนวนนิสิต(เอาข้อมูลออกมา)
        public function static_data($years, $course)
        {
            $sql = "SELECT *  
            FROM `Static_Student` 
            JOIN `Status`
            ON Static_Student.Stat_Status = Status.Status_ID
            WHERE `Stat_Years` =  '".$years."'
            AND `Stat_Course` = '".$course."'";
            $query = $this->db->query($sql);            
            return $query->result_array();
        }


}
?>