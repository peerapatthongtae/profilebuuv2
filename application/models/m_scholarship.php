<?php
class M_scholarship extends CI_Model
{
    public function get_all(){
        $sql = "Select Scholarship.Scholarship_ID,Scholarship.Scholarship_Name, Scholarship.Scholarship_Year, Scholarship.Scholarship_Giver, Scholarship.Scholarship_Amount, Scholarship_has_Student.Student_ID, Student.Student_Prefix, Student.Student_Name_Th, Student.Student_Lname_Th, Student.Course
        from Scholarship 
        INNER JOIN Scholarship_has_Student ON Scholarship.Scholarship_ID = Scholarship_has_Student.Scholarship_ID 
        INNER JOIN Student ON Scholarship_has_Student.Student_ID = Student.Student_ID";
        $query = $this->db->query($sql);            
        return $query->result();
    }
    public function get_all_scholarship(){
        $this->db->from('Scholarship');
        $query = $this->db->get();           
        return $query->result_array();
    }
    public function get_by_id_scholarship_has_student(){
       
        $this->db->from('Scholarship_has_Student');
        $query = $this->db->get();           
        return $query->result_array();
    }

    public function get_Scholarship_by_id($id){
        $sql = "Select Scholarship.Scholarship_ID,Scholarship.Scholarship_Name, Scholarship.Scholarship_Year, Scholarship.Scholarship_Giver, Scholarship.Scholarship_Amount, Scholarship_has_Student.Student_ID, Student.Student_Prefix, Student.Student_Name_Th, Student.Student_Lname_Th, Student.Course
        from Scholarship 
        INNER JOIN Scholarship_has_Student ON Scholarship.Scholarship_ID = Scholarship_has_Student.Scholarship_ID 
        INNER JOIN Student ON Scholarship_has_Student.Student_ID = Student.Student_ID
        WHERE Scholarship.Scholarship_ID= '".$id."' ";
        $query = $this->db->query($sql);           
        return $query->result();
    }

    public function get_Scholarship_by_name($id){
        $sql = "Select Scholarship.Scholarship_Name
        from Scholarship 
        WHERE Scholarship.Scholarship_ID = '".$id."' ";
        $query = $this->db->query($sql);           
        return $query->result();
    }

    // ส่วนไปแสดงข้อมูลในนิสิต
    public function get_Scholarship_by_student($id){
        $sql = "Select Scholarship.Scholarship_ID,Scholarship.Scholarship_Name, Scholarship.Scholarship_Giver, Scholarship.Scholarship_Amount, Scholarship.Scholarship_Year
        from Scholarship 
        INNER JOIN Scholarship_has_Student ON Scholarship.Scholarship_ID = Scholarship_has_Student.Scholarship_ID 
        INNER JOIN Student ON Scholarship_has_Student.Student_ID = Student.Student_ID
        WHERE Scholarship_has_Student.Student_ID = '".$id."' ";
        $query = $this->db->query($sql);           
        return $query->result();
    }
    
    // แก้ไขข้อมูลทุนการศึกษา
    public function update_scholarship($data, $scholarship_id){
        $this->db->where('Scholarship_ID', $scholarship_id);
        return $this->db->update('Scholarship',$data);
    }
    // ลบทุนการศึกษา
    public function delete_scholarship_has_student($id){
        $this->db->where('Student_ID',$id);
        $this->db->delete('Scholarship_has_Student');
        return true;
    }

    public function get_by_id($id){
            $this->db->where('Scholarship_ID',$id);
            $query = $this->db->get('Scholarship');
            return $query->result_array();
        }
    
        public function insert_scholarship($data){
            return $this->db->insert('Scholarship',$data);
        }

        public function insert_student_scholarship($data){
            $db_debug = $this->db->db_debug; //save setting
            $this->db->db_debug = FALSE;
            $return = $this->db->insert('Scholarship_has_Student',$data);
            $this->db->db_debug = $db_debug;
            return $return;
        }

        public function insert_batch_student_scholarship($data){
            $sql = 'replace into Scholarship_has_Student values ';

            foreach($data as $row) {
                $sql .= "('".$row['Scholarship_ID']."', '".$row['Student_ID']."'), ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= ';';

            return $this->db->query($sql);

        }

        public function count_scholarship($id){

        $sql = "SELECT Scholarship.Scholarship_Count, COUNT(Scholarship_has_Student.Student_ID) as count
                FROM Scholarship
                INNER JOIN Scholarship_has_Student ON Scholarship.Scholarship_ID = Scholarship_has_Student.Scholarship_ID
                WHERE Scholarship_has_Student.Scholarship_ID = '".$id."' ";
        $query = $this->db->query($sql);           
        return $query->result_array();

        }

        public function check_student_in_scholarship($student_id, $scholarship_id) {
            $this->db->where('Student_ID', $student_id);
            $this->db->where('Scholarship_ID', $scholarship_id);
            $this->db->from('Scholarship_has_Student');
            $query = $this->db->get();
            return count($query->result_array());
        }
}
?>