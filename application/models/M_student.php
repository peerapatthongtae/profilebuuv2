<?php
class M_student extends CI_Model
{
        public function get_student($id){
            $this->db->from('Student');
            $this->db->where('Student_ID',$id);
            $query = $this->db->get();
            return $query->result_array()[0];
        }
        // *** เพิ่ม
        

        public function update_datastudent($data, $student_id){
            $this->db->where('Student_ID',$student_id);
            return $this->db->update('Student',$data);

            /*$sql = "insert into Student(
            Student_ID,Student_Prefix,Student_Name_Th,Student_Lname_Th,Student_Name_Eng,Student_Lname_Eng,Campus
            ,Course,Level,Entry_Years,Entry_Method,Status_ID,Birthday,GradFromSchool,Highes_Ed,Province_Birth
            ,Nationality,Relidion,Father_Name,Mother_Name,Parent_Name,Contact_Name,Home_Address_Number,Home_Address_Moo
            ,Home_Address_Soi,Home_Address_Tumbon,Home_Address_Aumper,Home_Address_Province,Home_Address_Postcode
            ,Parent_Address_Number,Parent_Address_Moo,Parent_Address_Soi,Parent_Address_Tumbon,Parent_Address_Aumper
            ,Parent_Address_Province,Parent_Address_Postcode,Contact_Address_Number,Contact_Address_Aumper,Contact_Address_Province
            ,Contact_Address_Postcode,Blood,Degree,Teacher_ID,Faculty_ID) 
            values ('$array[Student_ID]',
            '$array[Student_Prefix]', '$array[Student_Name_Th]', '$array[Student_Lname_Th]' , '$array[Student_Name_Eng]', 
            '$array[Student_Lname_Eng]', '$array[Campus]','$array[Course]' ,'$array[Level]' ,'$array[Entry_Years]' ,'$array[Entry_Method]'
             ,'$array[Status_ID]' ,'$array[Birthday]' ,'$array[GradFromSchool]' ,'$array[Highes_Ed]' ,'$array[Province_Birth]' ,'$array[Nationality]' 
             ,'$array[Relidion]' ,'$array[Father_Name]' ,'$array[Mother_Name]' ,'$array[Parent_Name]' ,'$array[Contact_Name]' 
             ,'$array[Home_Address_Number]' ,'$array[Home_Address_Moo]' ,'$array[Home_Address_Soi]' ,'$array[Home_Address_Tumbon]'
             ,'$array[Home_Address_Aumper]' ,'$array[Home_Address_Province]' ,'$array[Home_Address_Postcode]' ,'$array[Parent_Address_Number]' 
             , '$array[Parent_Address_Moo]' ,'$array[Parent_Address_Soi]' ,'$array[Parent_Address_Tumbon]' ,'$array[Parent_Address_Aumper]' 
             ,'$array[Parent_Address_Province]' ,'$array[Parent_Address_Postcode]' ,'$array[Contact_Address_Number]' ,'$array[Contact_Address_Aumper]'
             , '$array[Contact_Address_Province]' , '$array[Contact_Address_Postcode]' , '$array[Blood]'
             , '$array[Degree]' , '$array[Teacher_ID]' , '$array[Faculty_ID]'
             )
             
             //ยังไม่แก้
            ON DUPLICATE KEY UPDATE
            Student_ID = '$array[Student_ID]', GPA_Year = '$array[GPA_Year]',
            GPA_Term = '$array[GPA_Term]', GPAX_Term = '$array[GPAX_Term]' , GPA = '$array[GPA]', Grade_Pro = '$array[Grade_Pro]',
            Status_Term = '$array[Status_Term]'";*/
        }

        public function status($ID_Student){
            $sql = "SELECT Status.Status_Name 
            FROM Student 
            INNER JOIN Status ON Student.Status_ID = Status.Status_ID 
            WHERE Student.Student_ID = $ID_Student";
            $query = $this->db->query($sql);            
            return $query->result_array()[0];
        }

        public function get_transcript($id_student){
            $sql = "Select Subject.Subject_Code, Subject.Subject_Name, Subject_has_Student.Subject_Credit, Subject_has_Student.Grade, Subject_has_Student.Term_Number, Subject_has_Student.Subject_Year
            from Student
            INNER JOIN Subject_has_Student ON Student.Student_ID = Subject_has_Student.Student_ID
            INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
            WHERE Student.Student_ID = '".$id_student."'
            ORDER BY Subject_has_Student.Subject_Year, Subject_has_Student.Term_Number";
            $query = $this->db->query($sql);            
            return $query->result();
        }

        public function get_year_transcript($id_student)
        {
            $sql = "select GPA_Term, GPA_Year FROM GPA where Student_ID = '".$id_student."'order by GPA_Year ASC";
            $query = $this->db->query($sql);            
            return $query->result();
        }

        public function get_GPA_Year($id_student)
        {
            $sql = "SELECT GPA_Year 
            FROM GPA 
            WHERE Student_ID = '".$id_student."' 
            ORDER BY GPA_Year DESC LIMIT 0,1";
            $query = $this->db->query($sql);            
            return $query->result();
        }

        public function get_GPA($student_id){
           $sql = "Select * from GPA
           WHERE GPA.Student_ID = '".$student_id."'";
           $query = $this->db->query($sql);            
           return $query->result();
        }

        public function get_Adviser($student_id){
            $sql = "Select Adviser.Adviser_Prefix, Adviser.Adviser_Name, Adviser.Adviser_Lname from Adviser
            WHERE Adviser.Student_ID = '".$student_id."'";
            $query = $this->db->query($sql);            
            return $query->result();
         }

        public function search_student($Student_Text){
            $sql = "SELECT Student.Student_ID, Student.Student_Prefix, Student.Student_Name_Th, Student.Student_Lname_Th, Student.Course, Student.Status_ID, Status.Status_Name
                    FROM Student
                    INNER JOIN Status ON Student.Status_ID = Status.Status_ID
                    WHERE (Student.Student_ID LIKE '".$Student_Text."')
                    OR (Student.Student_Name_Th LIKE '".$Student_Text."') 
                    OR (Student.Student_Lname_Th LIKE '".$Student_Text."') ";
            $query = $this->db->query($sql);            
            return $query->result();
        }
        public function search_student_by_id($Student_Text){
            $sql = "SELECT Student.Student_ID, Student.Student_Prefix, Student.Student_Name_Th, Student.Student_Lname_Th, Student.Course, Student.Status_ID, Status.Status_Name ,Student.GPAX
                    FROM Student
                    INNER JOIN Status ON Student.Status_ID = Status.Status_ID
                    WHERE (Student.Student_ID LIKE '".$Student_Text."') ";
            $query = $this->db->query($sql);            
            return $query->result();
        }
        public function search_student_by_id_course($Student_Text,$course){
            $sql = "SELECT Student.Student_ID, Student.Student_Prefix, Student.Student_Name_Th, Student.Student_Lname_Th, Student.Course, Student.Status_ID, Status.Status_Name ,Student.GPAX
                    FROM Student
                    INNER JOIN Status ON Student.Status_ID = Status.Status_ID
                    INNER JOIN Course ON SUBSTRING_INDEX(Student.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
                    WHERE (Student.Student_ID LIKE '".$Student_Text."') ";
                    if($course != '') {
                        $sql.= "AND (Course.Course_ID = '$course')";
                    }
            $query = $this->db->query($sql);            
            return $query->result();
        }
        public function search_addstudent($student_id,$student_name_th,$student_lname_th){
            $sql = "SELECT Student.Student_ID, Student.Student_Prefix, Student.Student_Name_Th, Student.Student_Lname_Th, Student.Course, Student.Status_ID, Status.Status_Name
                    FROM Student
                    INNER JOIN Status ON Student.Status_ID = Status.Status_ID
                    WHERE (Student.Student_ID LIKE '".$student_id."')
                    OR (Student.Student_Name_Th LIKE '".$student_name_th."') 
                    OR (Student.Student_Lname_Th LIKE '".$student_lname_th."') ";
            $query = $this->db->query($sql);            
            return $query->result();
        }
        

        public function search_registstudent($array) {
            $this->db->where('Student_ID', $array['Student_ID']);
            $this->db->where('Subject_Code', $array['Subject_Code']);
            $this->db->where('Term_Number', $array['Term_Number']);
            $this->db->where('Subject_Year', $array['Subject_Year']);
            $this->db->from('Subject_has_Student');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function search_gradstudent($array) {
            $this->db->where('Student_ID', $array['Student_ID']);
            $this->db->where('GPA_Year', $array['GPA_Year']);
            $this->db->where('GPA_Term', $array['GPA_Term']);
            $this->db->from('GPA');
            $query = $this->db->get();
            return $query->result_array();
        }
        public function search_grade($array) {
            $this->db->where('Student_ID', $array['Student_ID']);
            //$this->db->where('GPAX', $array['GPAX']);
            $this->db->from('Student');
            $query = $this->db->get();
            return $query->result_array();
        }
        public function search_adviser($array) {
            $this->db->where('Adviser_ID', $array['Adviser_ID']);
            $this->db->where('Student_ID', $array['Student_ID']);
            $this->db->where('Adviser_Prefix', $array['Adviser_Prefix']);
            $this->db->where('Adviser_Name', $array['Adviser_Name']);
            $this->db->where('Adviser_Lname', $array['Adviser_Lname']);
            $this->db->from('Adviser');
            $query = $this->db->get();
            return $query->result_array();
        }
      
        public function update_registstudent($array) {

            $sql = "insert into Subject_has_Student(Subject_Code,Student_ID,Term_Number,Subject_Credit,Grade,Subject_Year) values ('$array[Subject_Code]',
            '$array[Student_ID]', '$array[Term_Number]', '$array[Subject_Credit]' , '$array[Grade]', '$array[Subject_Year]')
            ON DUPLICATE KEY UPDATE
            Subject_Code = '$array[Subject_Code]',
            Student_ID = '$array[Student_ID]',Term_Number = '$array[Term_Number]',
            Subject_Credit = '$array[Subject_Credit]', Grade = '$array[Grade]' , Subject_Year = '$array[Subject_Year]'";
            $query = $this->db->query($sql);
            /*$this->db->where('Student_ID', $array['Student_ID']);
            $this->db->where('Subject_Code', $array['Subject_Code']);
            $this->db->where('Term_Number', $array['Term_Number']);
            $this->db->where('Subject_Year', $array['Subject_Year']);
            return $this->db->update('Subject_has_Student', $array);*/
            return $query;
        }

        public function update_gradstudent($array) {
            /*$sql = "UPDATE `GPA` SET `Student_ID` = '$array[Student_ID]', `GPA_Year` = '$array[GPA_Year]', 
            `GPA_Term` = '$array[GPA_Term]', `GPAX_Term` = '$array[GPAX_Term]' , `GPA` = '$array[GPA]', `Grade_Pro` = '$array[Grade_Pro]', 
            `Status_Term` = '$array[Status_Term]' 
            WHERE `Student_ID` = '$array[Student_ID]' 
            AND `GPA_Year` = '$array[GPA_Year]' AND `GPA_Term` = '$array[GPA_Term]' ";
            $sql .= ";";*/

            $sql = "insert into GPA(Student_ID,GPA_Year,GPA_Term,GPAX_Term,GPA,Grade_Pro,Status_Term) values ('$array[Student_ID]',
            '$array[GPA_Year]', '$array[GPA_Term]', '$array[GPAX_Term]' , '$array[GPA]', '$array[Grade_Pro]', '$array[Status_Term]' )
            ON DUPLICATE KEY UPDATE
            Student_ID = '$array[Student_ID]', GPA_Year = '$array[GPA_Year]',
            GPA_Term = '$array[GPA_Term]', GPAX_Term = '$array[GPAX_Term]' , GPA = '$array[GPA]', Grade_Pro = '$array[Grade_Pro]',
            Status_Term = '$array[Status_Term]'";
            $query = $this->db->query($sql);
            /*$this->db->where('Student_ID', $array['Student_ID']);
            $this->db->where('GPA_Year', $array['GPA_Year']);
            $this->db->where('GPA_Term', $array['GPA_Term']);
            return $this->db->update('GPA', $array);*/
            return $query;
        }
        public function update_grade($array) {
            $this->db->where('Student_ID', $array['Student_ID']);
            unset($array['Student_ID']);
            return $this->db->update('Student', $array);
        }
        public function update_adviser($array) {
            $this->db->where('Adviser_ID', $array['Adviser_ID']);
            $this->db->where('Student_ID', $array['Student_ID']);
            $this->db->where('Adviser_Prefix', $array['Adviser_Prefix']);
            $this->db->where('Adviser_Name', $array['Adviser_Name']);
            $this->db->where('Adviser_Lname', $array['Adviser_Lname']);
            unset($array['Student_ID']);
            return $this->db->update('Adviser', $array);
        }
        

        public function search_subject($subject_code) {
            $this->db->where('Subject_Code', $subject_code);
            $this->db->from('Subject');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function add_student($array) {
            return $this->db->insert('Student', $array);
        }

        public function add_registstudent($array) {
            return $this->db->insert('Subject_has_Student', $array);
        }

        public function add_gradstudent($array) {
            return $this->db->insert('GPA', $array);
        }

        public function add_grade($array) {
            return $this->db->insert('Student', $array);
        }

        public function add_adviser($array) {
            return $this->db->insert('Adviser', $array);
        }

        public function graduate_actorstudent()
	    {
            $data['user_id'] = $this->session->userdata('user_id');
            $data['student'] = $this->m_student->get_student($data['user_id']);
            $this->template->view('student/graduate_actorstudent',$data);
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

        // หน่วยกิตรวม
        public function ca_student($student_id){
            $sql = "SELECT sum(Subject_Credit) as sum
            FROM Subject_has_Student 
            WHERE Student_ID = '".$student_id."' AND Grade != 'F' AND Grade != 'W' AND Grade != ''";
            $query = $this->db->query($sql);            
            return $query->result();
        }
        
        

        public function get_level_by_years($years) {
                $sql = "SELECT DISTINCT Level
                FROM Student 
                WHERE Entry_Years = '".$years."'
                ORDER BY Level DESC";
                $query = $this->db->query($sql);
                return $query->result();
        }
        public function getAllStatus() {
            $sql = "SELECT Status_ID,Status_Name FROM Status";
            $query = $this->db->query($sql);
            return $query->result();
        }

       
        public function get_status($status_id,$years,$course) {
            
            
            $levels = ['ปริญญาตรี ปกติ','ปริญญาตรี พิเศษ','ปริญญาโท ปกติ','ปริญญาโท พิเศษ','ปริญญาเอก ปกติ'];
            

            if(strlen($years) != 4) {
                $attributes = explode(",",$years);
                foreach ($levels as $key => $level):
                    foreach ($attributes as $k =>$attribute):
                             // changed $variables[] to $variables[$level][]
                    
        
            
                    $sql = "SELECT Status.Status_ID,Entry_Years,Status.Status_Name, Level, count(*) AS Count 
                    FROM Student 
                    LEFT JOIN Status ON Student.Status_ID = Status.Status_ID 
                    INNER JOIN Course ON SUBSTRING_INDEX(Student.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
                    WHERE Status.Status_ID='$status_id' AND Entry_Years = '$attribute' AND Level = '$level' ";
                    if($course != '') {
                        $sql .= "AND (Course.Course_ID = '$course') ";
                    }
                    $sql.= " GROUP BY Status_Name,Level";
                    $query = $this->db->query($sql);
                    
                    if ($query->num_rows() ==0) {
                        
                        
                        $q[$k][$key] = array();
                        $q[$k][$key][0] = new stdClass();
                        $q[$k][$key][0]->Entry_Years = $attribute;
                        $q[$k][$key][0]->Level = $level;
                        $q[$k][$key][0]->Count = '-';
                        
                        
                        
                        
                    } else {
                        
                        $q[$k][] = $query->result();
                    }
                    
                    endforeach;
                endforeach;
                 
            //$sqlyears = "(Entry_Years = '".$years."')";
            return $q;
            } else {
                for($i = 0;$i<count($levels);$i++) {
                
                    $wherelevel = " Level='".$levels[$i]."'";
                
                
                
                $sql = "SELECT Status.Status_ID,Entry_Years,Status.Status_Name, Level, count(*) AS Count 
                FROM Student 
                LEFT JOIN Status ON Student.Status_ID = Status.Status_ID 
                INNER JOIN Course ON SUBSTRING_INDEX(Student.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
                WHERE Status.Status_ID='$status_id' AND Entry_Years = '$years' AND $wherelevel ";
                if($course != '') {
                    $sql .= "AND (Course.Course_ID = '$course') ";
                }
                $sql.= " GROUP BY Status_Name,Level";
                $query = $this->db->query($sql);
            
                if ($query->num_rows() ==0) {
                    
                    $q[$i][2] = new stdClass;
                    
                    $q[$i][2]->Count = "-";
                    
                    
                } else {
                    
                    $q[$i] = $query->result();
                }
                
                
                
                
                
                }
                return $q;
            }
            
            
            
            
        }

        
        public function get_student_has_status($status_id,$years,$course,$level) {
            
            $sql = "SELECT Sta.Status_Name,Stu.Student_ID,Stu.Student_Prefix ,Stu.Student_Name_Th,Stu.Student_Lname_Th,Stu.Course,Level
            FROM Student Stu
            LEFT JOIN Status Sta ON Stu.Status_ID = Sta.Status_ID 
            INNER JOIN Course ON SUBSTRING_INDEX(Stu.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
            WHERE Sta.Status_ID=$status_id AND (Entry_Years = $years) AND Level = '".$level."'";
            if($course != 'all') {
                $sql .= "AND (Course.Course_ID = '$course')";
            }
            $sql.= "GROUP BY Student_Prefix,Student_ID,Student_Name_Th,Status_Name,Student_Lname_Th,Course,Level";

            $query = $this->db->query($sql);
            return $query->result();
        }
        
        
        public function getSubjectStudent($student_id,$subject_code,$operatorsubject,$operatorstudent,$course) {
            $sql = "SELECT  Student.Student_ID,
            CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Student.Course,
            Subject.Subject_Code, Subject.Subject_Name, Subject_has_Student.Term_Number AS Term, Subject_has_Student.Subject_Year AS Year, Subject_has_Student.Subject_Credit AS Credit, Subject_has_Student.Grade
            FROM Student
            INNER JOIN Subject_has_Student ON   Student.Student_ID = Subject_has_Student.Student_ID
            INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
            INNER JOIN Course ON SUBSTRING_INDEX(Student.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
            WHERE (Student.Student_ID $operatorstudent '$student_id') AND (Subject_has_Student.Subject_Code $operatorsubject '$subject_code') ";
            if($course != '') {
                $sql .= "AND (Course.Course_ID = '$course')";
            }
            $sql.= " ORDER BY Student.Student_ID,Full_Name,Student.Course,Subject_has_Student.Subject_Year, Subject_has_Student.Term_Number,Student.Course 
             ";
           

            $query = $this->db->query($sql);
            return $query->result();
        }

        //get Student ที่มี *
        public function getManyStudent($student_id,$subject_code,$course) {
            
            $sql = "SELECT  DISTINCT Student.Student_ID,
            CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Student.Course,Student.Status_ID
            
            FROM Student
            INNER JOIN Subject_has_Student ON   Student.Student_ID = Subject_has_Student.Student_ID
            INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
            INNER JOIN Course ON SUBSTRING_INDEX(Student.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
            WHERE (Student.Student_ID LIKE '$student_id') AND (Subject_has_Student.Subject_Code LIKE '$subject_code') AND Student.Status_ID=10 ";
            if($course != '') {
                $sql .= "AND Course.Course_ID = '$course'";
            }
            $sql.= "ORDER BY Student.Student_ID,Full_Name,Student.Course";
            $query = $this->db->query($sql);
            return $query->result();
        }
        public function getGpax($student_id,$operatorstudent) {
            $sql = "SELECT Student.Student_ID,
            CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,
             Student.Course , Student.GPAX
            FROM Student
             WHERE Student.Student_ID $operatorstudent '$student_id%' AND Student.Status_ID=10";
             $query = $this->db->query($sql);
             return $query->result();
        }
       
        public function get_Years_Subject($subject_code,$course) {
            $sql = "SELECT  Subject.Subject_Code,Subject.Subject_Name,Term_Number,Subject_Year ,COUNT(*) AS Count
            , COUNT(IF(Subject_has_Student.Grade!='W' AND Subject_has_Student.Grade!='F' AND Subject_has_Student.Grade!='I' AND Subject_has_Student.Grade!='',1, NULL )) AS Countpast
            , COUNT(IF(Subject_has_Student.Grade='A',1, NULL)) AS CountA
            , COUNT(IF(Subject_has_Student.Grade='B+',1, NULL)) AS CountBplus
            , COUNT(IF(Subject_has_Student.Grade='B',1, NULL)) AS CountB
            , COUNT(IF(Subject_has_Student.Grade='C+',1, NULL)) AS CountCplus
            , COUNT(IF(Subject_has_Student.Grade='C',1, NULL)) AS CountC
            , COUNT(IF(Subject_has_Student.Grade='D+',1, NULL)) AS CountDplus
            , COUNT(IF(Subject_has_Student.Grade='D',1, NULL)) AS CountD
            , COUNT(IF(Subject_has_Student.Grade='F',1, NULL)) AS CountF
            , COUNT(IF(Subject_has_Student.Grade='W',1, NULL)) AS CountW
            , COUNT(IF(Subject_has_Student.Grade='I',1, NULL)) AS CountI
            , COUNT(IF(Subject_has_Student.Grade='',1, NULL)) AS Countnotgrade
                        FROM Subject_has_Student
                        INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
                        INNER JOIN Student ON Subject_has_Student.Student_ID = Student.Student_ID
                        INNER JOIN Course ON SUBSTRING_INDEX(Student.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
                        WHERE Subject.Subject_Code LIKE '$subject_code' ";
            if($course != '') {
                $sql .= "AND (Course.Course_ID = '$course') ";
            }
            $sql .= " GROUP BY Subject.Subject_Code,Subject.Subject_Name,Term_Number,Subject_Year
                        ORDER BY Subject_Year ASC , Term_Number";
            $query = $this->db->query($sql);
            return $query->result();
        }

        public function getStudentPastSubject($subject_code)  {
            $sql = "SELECT  Subject.Subject_Code,Subject.Subject_Name,Term_Number,Subject_Year ,COUNT(*) AS Count
            FROM Subject_has_Student
            INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
            INNER JOIN Student ON Subject_has_Student.Student_ID = Student.Student_ID
            
            WHERE Subject.Subject_Code LIKE '$subject_code'
            AND Subject_has_Student.Grade != 'W'
            AND Subject_has_Student.Grade != 'I'
            AND Subject_has_Student.Grade != 'F'
            AND Subject_has_Student.Grade != ''
            GROUP BY Subject.Subject_Code,Subject.Subject_Name,Term_Number,Subject_Year
            ORDER BY Subject_Year ASC , Term_Number";
            $query = $this->db->query($sql);
            
            return $query->result();
            
        }
        

        public function get_student_has_subject($statussubject,$subject_code,$Subject_Year,$Term_Number,$course) {
        
        $sql = "SELECT  Subject_has_Student.Student_ID,CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Student.Course,Subject_has_Student.Grade
        FROM Subject_has_Student
        INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
        INNER JOIN Student ON Subject_has_Student.Student_ID = Student.Student_ID
        INNER JOIN Course ON SUBSTRING_INDEX(Student.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
        WHERE Subject.Subject_Code LIKE '$subject_code'
        and Term_Number LIKE '$Term_Number'
        and Subject_Year LIKE '$Subject_Year' ";
        if($statussubject == 'all') {
            $sql .= '';
        } else if ($statussubject == 'past') {
            $sql .= "AND Grade != 'W'
            and Grade != 'I'
            and Grade != 'F'
            and Grade != '' ";
        } else if ($statussubject == 'fail') {
            $sql .= "AND (Grade = 'W'
            or Grade = 'I'
            or Grade = 'F'
             ) ";
        } else if ($statussubject == 'notgrade') {
            $sql .= "AND Grade = '' ";
        }
         else {
            $sql .= "AND Grade = '$statussubject' ";
        }

        if($course != 'all') {
            $sql .= " AND Course.Course_ID = '$course' ";
        }
        $sql .= " GROUP BY Subject_has_Student.Student_ID,Full_Name,Student.Course,Subject_has_Student.Grade
        ORDER BY Subject_has_Student.Student_ID ASC";
        $query = $this->db->query($sql);
        return $query->result();
        }
        public function get_student_has_subject_past($subject_code,$Subject_Year,$Term_Number) {
            $sql = "SELECT  Subject_has_Student.Student_ID,CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Student.Course,Subject_has_Student.Grade
            FROM Subject_has_Student
            INNER JOIN Subject ON Subject_has_Student.Subject_Code = Subject.Subject_Code
            INNER JOIN Student ON Subject_has_Student.Student_ID = Student.Student_ID
            WHERE Subject.Subject_Code LIKE '$subject_code'
            and Term_Number LIKE '$Term_Number'
            and Subject_Year LIKE '$Subject_Year'
            and Grade != 'W'
            and Grade != 'I'
            and Grade != 'F'
            and Grade != ''
    
            GROUP BY Subject_has_Student.Student_ID,Full_Name,Student.Course,Subject_has_Student.Grade
            ORDER BY Subject_has_Student.Student_ID ASC";
            $query = $this->db->query($sql);
            return $query->result();
            }

            public function insert_subject($array) {
                $sql = "insert into Subject(Subject_Code,Subject_Name) values ('$array[Subject_Code]','$array[Subject_Name]' )
                ON DUPLICATE KEY UPDATE
                Subject_Code = '$array[Subject_Code]', Subject_Name = '$array[Subject_Name]'";
                $query = $this->db->query($sql);
                return $query;
            }


            //API 31 รอพินิจ
            public function getGPAManyStudent($student_id,$course,$term,$year) {
                $sql = "SELECT  GPA.Student_ID, CONCAT( ' ',Student.Student_Prefix, ' ',Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name , Student.Course , 
                Status.Status_Name,Status_Pro.Pro_Name
                FROM GPA
                                    INNER JOIN Student ON GPA.Student_ID = Student.Student_ID
                                    INNER JOIN Status_Pro ON GPA.Grade_Pro = Status_Pro.Pro_ID
                                    INNER JOIN Status ON Student.Status_ID = Status.Status_ID
                                    INNER JOIN Course ON SUBSTRING_INDEX(Student.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
                WHERE (GPA.Student_ID like '$student_id')
                AND GPA.Gpa_Term = '$term' AND GPA.Gpa_Year = '$year'";
                if($course != '') {
                    $sql .= " AND Course.Course_ID = '$course'";
                }
                $sql .= " ORDER BY GPA.Student_ID";
                $query = $this->db->query($sql);
                return $query->result();
            }

            public function get_detail_pro_student($student_id) {
                $sql = "SELECT   GPA.Student_ID,GPA.Gpa_Term,GPA.GPA_Year,Status_Pro.Pro_Name,GPA.GPAX_Term,Status.Status_Name AS Status_Term
                FROM GPA
                                  INNER JOIN Student ON GPA.Student_ID = Student.Student_ID
LEFT JOIN Status ON GPA.Status_Term = Status.Status_ID
LEFT JOIN Status_Pro ON GPA.Grade_Pro = Status_Pro.Pro_ID


 WHERE GPA.Student_ID like '$student_id'
 AND GPA_Year != 0 AND GPA_Term != 0";
                $query = $this->db->query($sql);
                return $query->result();
            }

            function getAll_Gpa_Year() {
                $sql = "select distinct GPA.Gpa_Year from GPA
                where GPA.Gpa_Year != 0
                ORDER BY Gpa_Year DESC";
                $query = $this->db->query($sql);
                return $query->result();

            }
            public function getAll_Gpa_Term() {
                $sql = "select distinct GPA.Gpa_Term from GPA
                where GPA.Gpa_Term != 0
                ORDER BY Gpa_Term";
                $query = $this->db->query($sql);
                return $query->result();
            }

            public function getAll_Status_Pro() {
                $sql = "select Pro_id , Pro_Name from Status_Pro";
                $query = $this->db->query($sql);
                return $query->result();
            }

            public function getStudentByProID($pro_id,$course,$term,$year) {
                $sql = "SELECT GPA.Student_ID, CONCAT(Student.Student_Prefix, ' ',Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name, Student.Course , 
                Status.Status_Name, GPA.GPAX_Term, Status_Pro.Pro_Name
                FROM GPA
                
                INNER JOIN Student ON GPA.Student_ID = Student.Student_ID
                INNER JOIN Status ON Student.Status_ID = Status.Status_ID
                INNER JOIN Status_Pro ON GPA.Grade_Pro = Status_Pro.Pro_ID
                INNER JOIN Course ON SUBSTRING_INDEX(Student.Course,':',1) = SUBSTRING_INDEX(Course.Course_Name,':',1)
                WHERE GPA.GPA_Term = '$term'
                AND GPA.GPA_Year = '$year'
                AND GPA.Grade_Pro = '$pro_id'";
                if($course != '') {
                    $sql .= " AND Course.Course_ID = '$course'";
                }
                $sql .= " ORDER BY GPA.Student_ID";
                $query = $this->db->query($sql);
                return $query->result();
            }
        
            public function search_parentStatus($array) {
                $this->db->where('Student_ID', $array['Student_ID']);
                //$this->db->where('GPAX', $array['GPAX']);
                $this->db->from('Student');
                $query = $this->db->get();
                return $query->result_array();
            }

            public function update_parentStatus($array) {
                $this->db->where('Student_ID', $array['Student_ID']);
                unset($array['Student_ID']);
                return $this->db->update('Student', $array);
            }
            //5-1
            public function getStudentEntryInEachYears($branch) {
                $yearslatest = $this->m_admin->get_GPA_Years()[0];
                $yearslatest = $yearslatest->Gpa_Year;
                $sql = "SELECT
                DISTINCT Entry_Years
                ,COUNT(IF(Entry_Method regexp 'โครงการ|ความสามารถพิเศษ|ทุน' ,1, NULL)) AS โครงการพิเศษ
                ,COUNT(IF(Entry_Method regexp 'Admission',1, NULL)) AS Admission
                
                
                ,COUNT(IF(Entry_Method regexp '29:รับตรง 12 จังหวัด|54:รับตรงทั่วประเทศ',1, NULL)) AS 'รับตรงครั้งที่1'
                
                
                ,COUNT(IF(Entry_Method regexp '29.1:รับตรง 12 จังหวัด รอบ 2|54.1:รับตรงทั่วประเทศ รอบ 2|60:รับตรง|60.1:รับตรง รอบ 2|การคัดเลือก'  ,1, NULL)) AS 'รับตรงครั้งที่2'
                ,COUNT(*) AS 'รวม'
                
                FROM Student
                
                WHERE (Entry_Years = $yearslatest
                OR Entry_Years = $yearslatest-1 OR Entry_Years =  $yearslatest-2 OR Entry_Years =  $yearslatest-3
                 OR Entry_Years =  $yearslatest-4)
                
                AND Level like 'ปริญญาตรี%'
                AND Course regexp '$branch' 
                AND (Status_ID != 51 AND Status_ID != 52 AND Status_ID != 53)
                GROUP BY Entry_Years";

                $query = $this->db->query($sql);
                return $query->result();
            }
            public function getListStudentMethod($branch,$Entry_Years,$Entry_Method) {

                $sql = "SELECT
                Student_ID,CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Course,Entry_Method,concat(Student.Status_ID,':',Status.Status_Name) as Status
               
                
                FROM Student
                INNER JOIN Status on Student.Status_ID = Status.Status_ID
                
                WHERE (Entry_Years = $Entry_Years)
                
                AND Entry_Method regexp '$Entry_Method'
                AND Level like 'ปริญญาตรี%'
                AND Course regexp '$branch' 
                AND (Student.Status_ID != 51 AND Student.Status_ID != 52 AND Student.Status_ID != 53)
                ";
                $query = $this->db->query($sql);
                return $query->result();
            }
            //8-1
            public function getEntryData($branch,$term) {

                $yearslatest = $this->m_admin->get_GPA_Years()[0];
                $yearslatest = $yearslatest->Gpa_Year;
                $sql = "SELECT Sub.Subject_Year as YEARS,
                count(distinct Sub.Student_ID) as 'จำนวนที่ลงทะเบียน'

                from (SELECT DISTINCT * FROM Subject_has_Student ) Sub
                
                INNER JOIN Student ON Student.Student_ID = Sub.Student_ID
                INNER JOIN Status ON Student.Status_ID = Status.Status_ID
                
                WHERE  (Sub.Subject_Year = $yearslatest or Sub.Subject_Year = $yearslatest-1 or Sub.Subject_Year = $yearslatest-2
                  or Sub.Subject_Year = $yearslatest-3  or Sub.Subject_Year = $yearslatest-4  ) 
                AND (Sub.Term_Number = $term) AND Entry_Years = (Sub.Subject_Year)
                AND Course regexp '$branch' AND Student.Level regexp 'ปริญญาตรี'
                
                group by YEARS";
                /*$sql = "SELECT 
                GPA.Gpa_Year AS YEARS
                ,count(IF(Student.Entry_Years = GPA.Gpa_Year AND GPA.Gpa_Term = 1,1, NULL)) AS 'จำนวนที่ลงทะเบียน'
                ,count(IF(Student.Entry_Years = GPA.Gpa_Year AND GPA.Gpa_Term = 2,1, NULL)) AS 'จำนวนนิสิตสัปดาห์แรกภาคปลาย'

                From (SELECT DISTINCT * FROM GPA) AS GPA
                
                INNER JOIN Student ON Student.Student_ID = GPA.Student_ID
                WHERE Student.Course regexp 'เทคโนโลยีสารสนเทศ' AND Level like 'ปริญญาตรี%' AND GPA.Gpa_Year != 0 
                GROUP BY YEARS";*/
                $query = $this->db->query($sql);
                return $query->result();
            }
            public function getListEntryData($branch,$Entry_Years) {

                $sql = "SELECT distinct Student.Student_ID,CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Course,count(Sub.Subject_Code) as CountSubject,GPA.Status_Term as StatusTerm

                from (SELECT DISTINCT * FROM Subject_has_Student ) Sub
                
                INNER JOIN Student ON Student.Student_ID = Sub.Student_ID
                INNER JOIN Status ON Student.Status_ID = Status.Status_ID
                INNER JOIN GPA ON GPA.GPA_Year = $Subject_Year and GPA.GPA_Term = $term and GPA.Student_ID = Sub.Student_ID
                
                WHERE  (Sub.Subject_Year = $Subject_Year) 
                AND (Sub.Term_Number = $term) AND Entry_Years = $Entry_Years
                AND Course regexp '$branch' AND Student.Level regexp 'ปริญญาตรี'
                group by Student.Student_ID,Full_Name,Course,Status_Term
                ";
                $query = $this->db->query($sql);
                return $query->result();
            }
            
            //8-2
            public function getStudentInEachYear($branch,$term,$Entry_Years) {

                $yearslatest = $this->m_admin->get_GPA_Years()[0];
                $yearslatest = $yearslatest->Gpa_Year;
                $sql = "SELECT Sub.Subject_Year as YEARS,
                count(distinct Sub.Student_ID) as 'จำนวนที่ลงทะเบียน'



              
                
                from (SELECT DISTINCT * FROM Subject_has_Student ) Sub
                
                INNER JOIN Student ON Student.Student_ID = Sub.Student_ID
                INNER JOIN Status ON Student.Status_ID = Status.Status_ID
                
                WHERE  (Sub.Subject_Year = $yearslatest or Sub.Subject_Year = $yearslatest-1 or Sub.Subject_Year = $yearslatest-2
                  or Sub.Subject_Year = $yearslatest-3  or Sub.Subject_Year = $yearslatest-4  ) 
                AND (Sub.Term_Number = $term) AND Entry_Years $Entry_Years
                AND Course regexp '$branch' AND Student.Level regexp 'ปริญญาตรี'
                
                group by YEARS";
                
                $query = $this->db->query($sql);
                return $query->result();
            }
            public function getListStudentInEachYears($branch,$term,$Entry_Years,$Subject_Year) {
                $yearslatest = $this->m_admin->get_GPA_Years()[0];
                $yearslatest = $yearslatest->Gpa_Year;

                $sql = "SELECT distinct Student.Student_ID,CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Course,count(Sub.Subject_Code) as CountSubject,CONCAT(GPA.Status_Term,':',Status.Status_Name) as StatusTerm

                from (SELECT DISTINCT * FROM GPA ) GPA
                
                INNER JOIN Student ON Student.Student_ID = GPA.Student_ID
                INNER JOIN Status ON  GPA.Status_Term = Status.Status_ID
                INNER JOIN Subject_has_Student as Sub ON GPA.Student_ID = Sub.Student_ID 
                 
                WHERE  (Sub.Subject_Year = $Subject_Year) 
                AND (Sub.Term_Number = $term)
                AND Course regexp '$branch' AND Student.Level regexp 'ปริญญาตรี'
                and GPA.GPA_Year = $Subject_Year and GPA.GPA_Term = $term ";

                if($Entry_Years == 'morethanfouryear') {
                    $sql .= "AND Entry_Years <= $yearslatest-4 ";
                } else {
                    $sql .= "AND Entry_Years = $Entry_Years ";
                }
                $sql .= "group by Student.Student_ID,Full_Name,Course,StatusTerm";
                $query = $this->db->query($sql);
                return $query->result();
            }
            /*public function getAmountStudentInEachYears() {
                $yearslatest = $this->m_admin->get_GPA_Years()[0];
                $yearslatest = $yearslatest->Gpa_Year;
                $sql = "SELECT 
                GPA.Gpa_Year
                ,count(IF(Student.Entry_Years = GPA.Gpa_Year AND GPA.Gpa_Term = 1,1, NULL)) AS 'ปี1ภาคต้น'
                ,count(IF(Student.Entry_Years = GPA.Gpa_Year AND GPA.Gpa_Term = 2,1, NULL)) AS 'ปี1ภาคปลาย'
                ,count(IF(Student.Entry_Years = (GPA.Gpa_Year-1) AND GPA.Gpa_Term = 1,1, NULL)) AS 'ปี2ภาคต้น'
                ,count(IF(Student.Entry_Years = (GPA.Gpa_Year-1) AND GPA.Gpa_Term = 2,1, NULL)) AS 'ปี2ภาคปลาย'
                ,count(IF(Student.Entry_Years = (GPA.Gpa_Year-2) AND GPA.Gpa_Term = 1,1, NULL)) AS 'ปี3ภาคต้น'
                ,count(IF(Student.Entry_Years = (GPA.Gpa_Year-2) AND GPA.Gpa_Term = 2,1, NULL)) AS 'ปี3ภาคปลาย'
                ,count(IF(Student.Entry_Years = (GPA.Gpa_Year-3) AND GPA.Gpa_Term = 1,1, NULL)) AS 'ปี4ภาคต้น'
                ,count(IF(Student.Entry_Years = (GPA.Gpa_Year-3) AND GPA.Gpa_Term = 2,1, NULL)) AS 'ปี4ภาคปลาย'
                ,count(IF(Student.Entry_Years < (GPA.Gpa_Year-3) AND GPA.Gpa_Term = 1,1, NULL)) AS 'มากกว่าปี4ภาคต้น'
                ,count(IF(Student.Entry_Years < (GPA.Gpa_Year-3) AND GPA.Gpa_Term = 2,1, NULL)) AS 'มากกว่าปี4ภาคปลาย'
                
                
                From (SELECT DISTINCT * FROM GPA) AS GPA
                
                INNER JOIN Student ON Student.Student_ID = GPA.Student_ID
                WHERE Student.Course regexp 'เทคโนโลยีสารสนเทศ' AND Level like 'ปริญญาตรี%' 
                AND (GPA_Year = $yearslatest OR GPA_Year =  $yearslatest-1 OR GPA_Year =  $yearslatest-2
                 OR GPA_Year =  $yearslatest-3 OR GPA_Year =  $yearslatest-4)
                GROUP BY GPA.Gpa_Year";
                $query = $this->db->query($sql);
                return $query->result();
            }*/

            public function getAllStudentInCourse($branch) {
                $yearslatest = $this->m_admin->get_GPA_Years()[0];
                $yearslatest = $yearslatest->Gpa_Year;
                $sql = "SELECT Entry_Years,COUNT(*) AS 'รวม'
                
                FROM Student
                
                WHERE (Entry_Years = $yearslatest
                OR Entry_Years = $yearslatest-1 OR Entry_Years =  $yearslatest-2 OR Entry_Years =  $yearslatest-3
                 OR Entry_Years =  $yearslatest-4)
                
                AND Level like 'ปริญญาตรี%'
                AND Course regexp '$branch'
                
                GROUP BY Entry_Years";

                $query = $this->db->query($sql);
                return $query->result();
            }
            public function getListAllStudentInCourse($branch,$Entry_Years) {
                $sql = "SELECT Student_ID,CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Course,concat(Student.Status_ID,':',Status.Status_Name) as Status
                
                FROM Student
                INNER JOIN Status on Student.Status_ID = Status.Status_ID
                WHERE (Entry_Years = $Entry_Years)
                
                AND Level like 'ปริญญาตรี%'
                AND Course regexp '$branch'
                
                ";
                $query = $this->db->query($sql);
                return $query->result();
            }

            public function getRetireStudentInYear($branch) {
                $yearslatest = $this->m_admin->get_GPA_Years()[0];
                $yearslatest = $yearslatest->Gpa_Year;
                $sql = "SELECT 
                Entry_Years as YEARS
                
                ,count(IF(GPA.Gpa_Year = Entry_Years ,1, NULL)) as 'year1'
                ,count(IF(GPA.Gpa_Year = (Entry_Years+1) ,1, NULL)) as 'year2'
                ,count(IF(GPA.Gpa_Year = (Entry_Years+2) ,1, NULL)) as 'year3'
                ,count(IF(GPA.Gpa_Year > (Entry_Years+3) ,1, NULL)) as 'yearmorethan4'
                
                 FROM GPA
                
                INNER JOIN Student ON Student.Student_ID = GPA.Student_ID
                                INNER JOIN Status ON GPA.Status_Term = Status.Status_ID
                
                WHERE (Student.Entry_Years = $yearslatest or Student.Entry_Years = $yearslatest-1 or Student.Entry_Years = $yearslatest-2
                 or Student.Entry_Years = $yearslatest-3 or Student.Entry_Years = $yearslatest-4)
                  AND Status_Term REGEXP '60|61|62|63|64|65|68|69|50'   AND Student.Course regexp '$branch' AND Student.Level regexp 'ปริญญาตรี'
                  
                GROUP BY YEARS
                ";
                $query = $this->db->query($sql);
                return $query->result();
            }
            public function getListRetireStudent($branch,$Entry_Years,$retireYear) {
            $sql = "SELECT distinct Student.Student_ID,CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Course,GPA_Term as RetireTerm
                
                from GPA 
                
                INNER JOIN Student on GPA.Student_ID = Student.Student_ID
                INNER JOIN Status on Status.Status_ID = GPA.Status_Term
                
                WHERE  (Student.Entry_Years = $Entry_Years)   AND Student.Course regexp '$branch' AND Student.Level regexp 'ปริญญาตรี' 
                AND Status_Term REGEXP '60|61|62|63|64|65|68|69|50'";
                
                  
                if($retireYear == "morethanfouryear") {
                    $sql .= "and GPA.Gpa_Year > Student.Entry_Years+3 ";
                }  else {
                    $sql .= "and GPA.Gpa_Year = $retireYear ";
                }
                $sql.= "ORDER BY Student.Student_ID";
                $query =    $this->db->query($sql);
                return $query->result();
                                
        }

            public function countGradStudent($branch) {
                $yearslatest = $this->m_admin->get_GPA_Years()[0];
                $yearslatest = $yearslatest->Gpa_Year;
                $sql = "SELECT Student.Entry_Years as YEARS , 
                COUNT(IF(GPA.Gpa_Year <= Student.Entry_Years+3 and Status_Term regexp '40',1, NULL)) AS 'fouryear',
                COUNT(IF(GPA.Gpa_Year > Student.Entry_Years+3 and Status_Term regexp '40',1, NULL)) AS 'morethanfouryear'
                
                from GPA 
                
                INNER JOIN Student on GPA.Student_ID = Student.Student_ID
                INNER JOIN Status on Status.Status_ID = GPA.Status_Term
                
                WHERE  (Student.Entry_Years = $yearslatest or Student.Entry_Years = $yearslatest-1 or Student.Entry_Years = $yearslatest-2
                or Student.Entry_Years = $yearslatest-3 or Student.Entry_Years = $yearslatest-4)   AND Student.Course regexp '$branch' AND Student.Level regexp 'ปริญญาตรี'
                
                
                
                group by YEARS";
                $query =    $this->db->query($sql);
                return $query->result();
        }
        public function getListGradStudent($gradyear,$branch,$Entry_Years) {
            $sql = "SELECT distinct Student.Student_ID,CONCAT(Student.Student_Prefix, ' ', Student.Student_Name_Th, ' ',Student.Student_Lname_Th) AS Full_Name,Course,GPA_Term as GradTerm
                
                from GPA 
                
                INNER JOIN Student on GPA.Student_ID = Student.Student_ID
                INNER JOIN Status on Status.Status_ID = GPA.Status_Term
                
                WHERE  (Student.Entry_Years = $Entry_Years)   AND Student.Course regexp '$branch' AND Student.Level regexp 'ปริญญาตรี' 
                and Status_Term regexp '40'";
                
                if($gradyear == "fouryear") {
                    $sql .= "and GPA.Gpa_Year <= Student.Entry_Years+3 ";
                } else if($gradyear == "morethanfouryear") {
                    $sql .= "and GPA.Gpa_Year > Student.Entry_Years+3 ";
                } 
                $sql.= "ORDER BY Student.Student_ID";
                $query =    $this->db->query($sql);
                return $query->result();
                                
        }

        public function getAllBranch() {
            $sql = "SELECT Branch_ID,Branch_Name FROM Branch";
            $query = $this->db->query($sql);
            return $query->result();
        }


            
}
?>