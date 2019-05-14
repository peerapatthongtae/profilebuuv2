<?php
session_start();
header("Cache-control: private");
?>

<style>
<meta name="viewport" content="width=device-width, initial-scale=1">
    ul.breadcrumb {
        padding: 10px 16px;
        list-style: none;
        background-color: #eee;
    }
    ul.breadcrumb li {
        display: inline;
        font-size: 18px;
    }
    ul.breadcrumb li+li:before {
        padding: 8px;
        color: black;
        content: "/\00a0";
    }
    ul.breadcrumb li a {
        color: #0275d8;
        text-decoration: none;
    }
    ul.breadcrumb li a:hover {
        color: #01447e;
        text-decoration: underline;
    }

    header.page-header { 
  padding: 0px 0; 
  }
      </style>
 <body>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">   
            <ul class="breadcrumb">
            <li><a href="<?php echo site_url('student/c_student/menu_student');?>">หน้าหลัก</a></li>
                <li>แก้ไขข้อมูลส่วนตัว</li>
            </ul>   
            </div>
          </header>
          <br>
        <Body>
        
        <div class="col-sm-12">
        

        <form action="<?php echo site_url("student/c_student/post_edit_student/".$student['Student_ID']); ?>" method="post" id="form_checker" onsubmit="return confirm('ยืนยันการบันทึกหรือไม่ ?');">
        <div class="row">
        <?php echo validation_errors('<div class="col-sm-6"><div class="alert alert-danger" role="alert">','</div></div>'); ?>  
        </div>
            <div class="card">
              <div class="card-header">
              <h1><strong><center>แก้ไขข้อมูลส่วนตัว</strong></h1>
              </div>
              <div class="card-body">
              <p style="color:red;font-weight:bold;">หากไม่มีข้อมูล กรุณาใส่ -</p>
                <B>1. ข้อมูลทั่วไป</B><br>
                <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Student_Name_Eng">ชื่อ(ภาษาอังกฤษ)</label>
                      <input type="text" class="form-control" id="Student_Name_Eng" name="Student_Name_Eng" value="<?php echo $student['Student_Name_Eng'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Student_Lname_Eng">นามสกุล(ภาษาอังกฤษ)</label>
                      <input type="text" class="form-control" id="Student_Lname_Eng" name="Student_Lname_Eng" value="<?php echo $student['Student_Lname_Eng'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Student_Nickname">ชื่อเล่น</label>
                      <input type="text" class="form-control" id="Student_Nickname" name="Student_Nickname" value="<?php echo $student['Student_Nickname'] ?>">
                    </div>
                  </div>
                </div>               
                <div class="row"> 
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Student_Phone">เบอร์โทรศัพท์</label>
                      <input type="text" class="form-control" id="Student_Phone" name="Student_Phone" value="<?php echo $student['Student_Phone'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Student_Email">E-Mail</label>
                      <input type="text" class="form-control" id="Student_Email" name="Student_Email" value="<?php echo $student['Student_Email'] ?>">
                    </div>
                  </div>
                  <div class="form-group col-sm-4">
                    <br><label for="Blood">หมู่เลือด</label>
                      <select class="form-control" id="Blood" name="Blood">
                      <?php foreach(get_bloods() as $key => $blood){
                        if($student['Blood'] == $key){
                          echo '<option value="'.$key.'" selected>'.$blood.'</option>';
                        } else {
                          echo '<option value="'.$key.'">'.$blood.'</option>';
                        }
                      } ?>
                      </select>
                  </div> 
                </div>
                <div class="row">
                  
               
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Facebook">Facebook</label>
                      <input type="text" class="form-control" id="Facebook" name="Facebook" value="<?php echo $student['Facebook'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Line">Line</label>
                      <input type="text" class="form-control" id="Line" name="Line" value="<?php echo $student['Line'] ?>">
                    </div>
                  </div>

                </div><br>

                <B>2. ที่อยู่ปัจจุบัน</B><br>              
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                    <br><label for="Address_Number">บ้านเลขที่</label>
                      <input type="text" class="form-control" id="Address_Number" name="Address_Number" value="<?php echo $student['Address_Number'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Address_Moo">หมู่</label>
                      <input type="text" class="form-control" id="Address_Moo" name="Address_Moo" value="<?php echo $student['Address_Moo'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Address_Soi">ซอย</label>
                      <input type="text" class="form-control" id="Address_Soi" name="Address_Soi" value="<?php echo $student['Address_Soi'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Address_Tumbon">ตำบล / แขวง</label>
                      <input type="text" class="form-control" id="Address_Tumbon" name="Address_Tumbon" value="<?php echo $student['Address_Tumbon'] ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Address_Aumper">อำเภอ / เขต</label>
                      <input type="text" class="form-control" id="Address_Aumper" name="Address_Aumper" value="<?php echo $student['Address_Aumper'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Address_Province">จังหวัด</label>
                      <input type="text" class="form-control" id="Address_Province" name="Address_Province" value="<?php echo $student['Address_Province'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Address_Postcode">รหัสไปรษณีย์</label>
                      <input type="text" class="form-control" id="Address_Postcode" name="Address_Postcode" value="<?php echo $student['Address_Postcode'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Address_Phone">โทรศัพท์</label>
                      <input type="text" class="form-control" id="Address_Phone" name="Address_Phone" value="<?php echo $student['Address_Phone'] ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Address_Email">E-Mail</label>
                      <input type="text" class="form-control" id="Address_Email" name="Address_Email" value="<?php echo $student['Address_Email'] ?>">
                    </div>
                  </div>
                </div><BR>              
                <B>4. ข้อมูลครอบครัว</B>
                <br><br>
                <B>ข้อมูลบิดา</B>
               <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <br><label for="Father_Name">ชื่อบิดา</label>
                        <input type="text" class="form-control" id="Father_Name" name="Father_Name" value="<?php echo $student['Father_Name'] ?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                      <br><label for="Father_Career">อาชีพ</label>
                        <input type="text" class="form-control" id="Father_Career" name="Father_Career" value="<?php echo $student['Father_Career'] ?>">
                      </div>
                    </div>
                    <div class="form-group col-sm-4">
                    <br><label for="Father_status">สถานภาพ</label>
                      <select class="form-control" id="Father_status" name="Father_Status">
                      <?php foreach(get_status_creator() as $key => $status_creator){
                        if($student['Father_Status'] == $key){
                          echo '<option value="'.$key.'" selected>'.$status_creator.'</option>';
                        } else {
                          echo '<option value="'.$key.'">'.$status_creator.'</option>';
                        }
                      } ?>
                      </select>
                  </div>  
                </div> 
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Father_Address_Number">บ้านเลขที่</label>
                      <input type="text" class="form-control" id="Father_Address_Number" name="Father_Address_Number" value="<?php echo $student['Father_Address_Number'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Father_Address_Moo">หมู่</label>
                      <input type="text" class="form-control" id="Father_Address_Moo" name="Father_Address_Moo" value="<?php echo $student['Father_Address_Moo'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Father_Address_Soi">ซอย</label>
                      <input type="text" class="form-control" id="Father_Address_Soi" name="Father_Address_Soi" value="<?php echo $student['Father_Address_Soi'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Father_Address_Tumbon">ตำบล / แขวง</label>
                      <input type="text" class="form-control" id="Father_Address_Tumbon" name="Father_Address_Tumbon" value="<?php echo $student['Father_Address_Tumbon'] ?>">
                    </div>
                  </div>
                </div>    
                  <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Father_Address_Aumper">อำเภอ / เขต</label>
                      <input type="text" class="form-control" id="Father_Address_Aumper" name="Father_Address_Aumper" value="<?php echo $student['Father_Address_Aumper'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Father_Address_Province">จังหวัด</label>
                      <input type="text" class="form-control" id="Father_Address_Province" name="Father_Address_Province" value="<?php echo $student['Father_Address_Province'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Father_Address_Postcode">รหัสไปรษณีย์</label>
                      <input type="text" class="form-control" id="Father_Address_Postcode" name="Father_Address_Postcode" value="<?php echo $student['Father_Address_Postcode'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Father_Phone">โทรศัพท์</label>
                      <input type="text" class="form-control" id="Father_Phone" name="Father_Phone" value="<?php echo $student['Father_Phone'] ?>">
                    </div>
                  </div>
                </div>             
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Father_Email">E-Mail</label>
                      <input type="text" class="form-control" id="Father_Email" name="Father_Email" value="<?php echo $student['Father_Email'] ?>">
                    </div>
                  </div>
                </div>
                <B>ข้อมูลมารดา</B>
                <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <br><label for="Mother_Name">ชื่อมารดา</label>
                        <input type="text" class="form-control" id="Mother_Name" name="Mother_Name" value="<?php echo $student['Mother_Name'] ?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                      <br><label for="Mother_Career">อาชีพ</label>
                        <input type="text" class="form-control" id="Mother_Career" name="Mother_Career" value="<?php echo $student['Mother_Career'] ?>">
                      </div>
                    </div>
                    <div class="form-group col-sm-4">
                    <br><label for="Mother_Status">สถานภาพ</label>
                      <select class="form-control" id="Mother_Status" name="Mother_Status">
                        <?php foreach(get_status_creator() as $key => $status_creator){
                          if($student['Mother_Status'] == $key){
                            echo '<option value="'.$key.'" selected>'.$status_creator.'</option>';
                          } else {
                            echo '<option value="'.$key.'">'.$status_creator.'</option>';
                          }
                        } ?>
                      </select>
                  </div>  
                </div> 
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Mother_Address_Number">บ้านเลขที่</label>
                      <input type="text" class="form-control" id="Mother_Address_Number" name="Mother_Address_Number" value="<?php echo $student['Mother_Address_Number'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Mother_Address_Moo">หมู่</label>
                      <input type="text" class="form-control" id="Mother_Address_Moo" name="Mother_Address_Moo" value="<?php echo $student['Mother_Address_Moo'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Mother_Address_Soi">ซอย</label>
                      <input type="text" class="form-control" id="Mother_Address_Soi" name="Mother_Address_Soi" value="<?php echo $student['Mother_Address_Soi'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Mother_Address_Tumbon">ตำบล / แขวง</label>
                      <input type="text" class="form-control" id="Mother_Address_Tumbon" name="Mother_Address_Tumbon" value="<?php echo $student['Mother_Address_Tumbon'] ?>">
                    </div>
                  </div>
                </div>    
                  <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Mother_Address_Aumper">อำเภอ / เขต</label>
                      <input type="text" class="form-control" id="Mother_Address_Aumper" name="Mother_Address_Aumper" value="<?php echo $student['Mother_Address_Aumper'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Mother_Address_Province">จังหวัด</label>
                      <input type="text" class="form-control" id="Mother_Address_Province" name="Mother_Address_Province" value="<?php echo $student['Mother_Address_Province'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Mother_Address_Postcode">รหัสไปรษณีย์</label>
                      <input type="text" class="form-control" id="Mother_Address_Postcode" name="Mother_Address_Postcode" value="<?php echo $student['Mother_Address_Postcode'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Mother_Phone">โทรศัพท์</label>
                      <input type="text" class="form-control" id="Mother_Phone" name="Mother_Phone" value="<?php echo $student['Mother_Phone'] ?>">
                    </div>
                  </div>
                </div>             
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Mother_Email">E-Mail</label>
                      <input type="text" class="form-control" id="Mother_Email" name="Mother_Email" value="<?php echo $student['Mother_Email'] ?>">
                    </div>
                  </div>
                </div><br>
                <B>5. ข้อมูลผู้ปกครอง</B><br>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <br><label for="Parent_Name">ชื่อ</label>
                        <input type="text" class="form-control" id="Parent_Name" name="Parent_Name" value="<?php echo $student['Parent_Name'] ?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                      <br><label for="Parent_Career">อาชีพ</label>
                        <input type="text" class="form-control" id="Parent_Career" name="Parent_Career" value="<?php echo $student['Parent_Career'] ?>">
                      </div>
                    </div>
                    

                    <div class="form-group col-sm-4">
                    <br><label for="Parent_Status">ความสัมพันธ์</label>
                      <select class="form-control" id="Parent_Status" name="Parent_Status">
                        <?php foreach(get_status_parent() as $key => $status_parent){
                          if($student['Parent_Status'] == $key){
                            echo '<option value="'.$key.'" selected>'.$status_parent.'</option>';
                          } else {
                            echo '<option value="'.$key.'">'.$status_parent.'</option>';
                          }
                        } ?>
                      </select>
                  </div>  
                    
                  </div>
                  <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Parent_Address_Number">บ้านเลขที่</label>
                      <input type="text" class="form-control" id="Parent_Address_Number" name="Parent_Address_Number" value="<?php echo $student['Parent_Address_Number'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Parent_Address_Moo">หมู่</label>
                      <input type="text" class="form-control" id="Parent_Address_Moo" name="Parent_Address_Moo" value="<?php echo $student['Parent_Address_Moo'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Parent_Address_Soi">ซอย</label>
                      <input type="text" class="form-control" id="Parent_Address_Soi" name="Parent_Address_Soi" value="<?php echo $student['Parent_Address_Soi'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Parent_Address_Tumbon">ตำบล / แขวง</label>
                      <input type="text" class="form-control" id="Parent_Address_Tumbon" name="Parent_Address_Tumbon" value="<?php echo $student['Parent_Address_Tumbon'] ?>">
                    </div>
                  </div>
                </div>    
                  <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Parent_Address_Aumper">อำเภอ / เขต</label>
                      <input type="text" class="form-control" id="Parent_Address_Aumper" name="Parent_Address_Aumper" value="<?php echo $student['Parent_Address_Aumper'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Parent_Address_Province">จังหวัด</label>
                      <input type="text" class="form-control" id="Parent_Address_Province" name="Parent_Address_Province" value="<?php echo $student['Parent_Address_Province'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Parent_Address_Postcode">รหัสไปรษณีย์</label>
                      <input type="text" class="form-control" id="Parent_Address_Postcode" name="Parent_Address_Postcode" value="<?php echo $student['Parent_Address_Postcode'] ?>">
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Parent_Phone">โทรศัพท์</label>
                      <input type="text" class="form-control" id="Parent_Phone" name="Parent_Phone" value="<?php echo $student['Parent_Phone'] ?>">
                    </div>
                  </div>
                </div>             
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Parent_Email">E-Mail</label>
                      <input type="text" class="form-control" id="Parent_Email" name="Parent_Email" value="<?php echo $student['Parent_Email'] ?>">
                    </div>
                  </div>
                </div><br>

                <B>5. ข้อมูลผู้ที่ติดต่อได้</B><br>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <br><label for="Contact_Name">ชื่อ</label>
                        <input type="text" class="form-control" id="Contact_Name" name="Contact_Name" value="<?php echo $student['Contact_Name'] ?>">
                      </div>
                    </div>
                    
                    <div class="form-group col-sm-4">
                    <br><label for="Contact_Status">ความสัมพันธ์</label>
                      <select class="form-control" id="Contact_Status" name="Contact_Status">
                        <?php foreach(get_status_parent() as $key => $status_parent){
                          if($student['Contact_Status'] == $key){
                            echo '<option value="'.$key.'" selected>'.$status_parent.'</option>';
                          } else {
                            echo '<option value="'.$key.'">'.$status_parent.'</option>';
                          }
                        } ?>
                      </select>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Contact_Email">E-Mail</label>
                      <input type="text" class="form-control" id="Contact_Email" name="Contact_Email" value="<?php echo $student['Contact_Email'] ?>">
                    </div>
                  </div>
                <br>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Contact_Address_Number">ที่อยู่ของผู้ที่ติดต่อได้</label>
                      <input type="text" class="form-control" id="Contact_Address_Number" name="Contact_Address_Number" value="<?php echo $student['Contact_Address_Number'] ?>">
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Contact_Address_Tumbon">ตำบล / แขวง</label>
                      <input type="text" class="form-control" id="Contact_Address_Tumbon" name="Contact_Address_Tumbon" value="<?php echo $student['Contact_Address_Tumbon'] ?>">
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Contact_Address_Aumper">อำเภอ / เขต</label>
                      <input type="text" class="form-control" id="Contact_Address_Aumper" name="Contact_Address_Aumper" value="<?php echo $student['Contact_Address_Aumper'] ?>">
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Contact_Address_Province">จังหวัด</label>
                      <input type="text" class="form-control" id="Contact_Address_Province" name="Contact_Address_Province" value="<?php echo $student['Contact_Address_Province'] ?>">
                    </div>
                  </div>
                  


                </div>    

                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Contact_Address_Postcode">รหัสไปรษณีย์</label>
                      <input type="text" class="form-control" id="Contact_Address_Postcode" name="Contact_Address_Postcode" value="<?php echo $student['Contact_Address_Postcode'] ?>">
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Contact_Phone">โทรศัพท์</label>
                      <input type="text" class="form-control" id="Contact_Phone" name="Contact_Phone" value="<?php echo $student['Contact_Phone'] ?>">
                    </div>
                  </div>
                </div>             
                
                <B>6. สถานที่ทำงาน</B><br>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <br><label for="Workplace_Company">ชื่อบริษัท</label>
                        <input type="text" class="form-control" id="Workplace_Company" name="Workplace_Company" value="<?php echo $student['Workplace_Company'] ?>">
                      </div>
                    </div>
                    
                    <div class="form-group col-sm-4">
                    <br><label for="Work_Status">สถานนะการทำงาน</label>
                      <select class="form-control" id="Work_Status" name="Work_Status">
                        <?php foreach(get_workplace() as $key => $status_workplace){
                          if($student['Work_Status'] == $key){
                            echo '<option value="'.$key.'" selected>'.$status_workplace.'</option>';
                          } else {
                            echo '<option value="'.$key.'">'.$status_workplace.'</option>';
                          }
                        } ?>
                      </select>
                  </div>
                              
                  <div class="col-sm-4">
                    <div class="form-group">
                      <br><label for="Workplace_Address">ที่อยู่บริษัท</label>
                      <input type="text" class="form-control" id="Workplace_Address" name="Workplace_Address" value="<?php echo $student['Workplace_Address'] ?>">
                    </div>
                  </div>
                <br>
                </div>

                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <br><label for="Work_Position">ตำแหน่งภายในบริษัท</label>
                      <input type="text" class="form-control" id="Work_Position" name="Work_Position" value="<?php echo $student['Work_Position'] ?>">
                    </div>
                </div>
              
              </div>
                
          <button type="submit" class="btn btn-primary">บันทึก</button>
          
          </form>
              </div>
            </div>            
          </div>
        </Body>   
  </body>

<script>
  $(document).ready(function () {
    $("#form_checker").validate({
        rules: {
            "Student_Name_Eng": {
                required: true
                
                
            },
            "Student_Lname_Eng": {
                required: true
                
						},
            "Student_Nickname": {
                required: true
                
						},
            "Student_Phone": {
              required: true
                
						},
            "Student_Email": {
              required: true
                
						},
            "Blood": {
              required: true
                
						},
            "Facebook": {
              required: true
                
						},
            "Line": {
              required: true
                
						},
            "Address_Number": {
              required: true
                
						},
            "Address_Moo": {
              required: true
                
						},
            "Address_Soi": {
              required: true
                
						},
            "Address_Tumbon": {
              required: true
                
						},
            "Address_Aumper": {
              required: true
                
						},
            "Address_Province": {
              required: true
                
						},
            "Address_Postcode": {
              required: true
                
						},
            "Address_Phone": {
              required: true
                
						},
            "Address_Email": {
              required: true
                
            },
            "Father_Name": {
              required: true
                
						},
            "Father_Career": {
              required: true
                
						},
            "Father_status": {
              required: true
                
						},
            "Father_Address_Number": {
              required: true
                
						},
            "Father_Address_Moo": {
              required: true
                
						},
            "Father_Address_Soi": {
              required: true
                
						},
            "Father_Address_Tumbon": {
              required: true
                
						},
            "Father_Address_Aumper": {
              required: true
                
						},
            "Father_Address_Province": {
              required: true
                
						},
            "Father_Address_Postcode": {
              required: true
                
						},
            "Father_Phone": {
              required: true
                
						},
            "Father_Email": {
              required: true
                
						},
            "Mother_Name": {
              required: true
                
						},
            "Mother_Career": {
              required: true
                
						},
            "Mother_status": {
              required: true
                
						},
            "Mother_Address_Number": {
              required: true
                
						},
            "Mother_Address_Moo": {
              required: true
                
						},
            "Mother_Address_Soi": {
              required: true
                
						},
            "Mother_Address_Tumbon": {
              required: true
                
						},
            "Mother_Address_Aumper": {
              required: true
                
						},
            "Mother_Address_Province": {
              required: true
                
						},
            "Mother_Address_Postcode": {
              required: true
                
						},
            "Mother_Phone": {
              required: true
                
						},
            "Mother_Email": {
              required: true
                
						},
            "Parent_Name": {
              required: true
                
						},
            "Parent_Career": {
              required: true
                
						},
            "Parent_status": {
              required: true
                
						},
            "Parent_Address_Number": {
              required: true
                
						},
            "Parent_Address_Moo": {
              required: true
                
						},
            "Parent_Address_Soi": {
              required: true
                
						},
            "Parent_Address_Tumbon": {
              required: true
                
						},
            "Parent_Address_Aumper": {
              required: true
                
						},
            "Parent_Address_Province": {
              required: true
                
						},
            "Parent_Address_Postcode": {
              required: true
                
						},
            "Parent_Phone": {
              required: true
                
						},
            "Parent_Email": {
              required: true
                
						},
            "Contact_Name": {
              required: true
                
						},
            "Contact_status": {
              required: true
                
						},
            "Contact_Address_Number": {
              required: true
                
						},
            "Contact_Address_Moo": {
              required: true
                
						},
            "Contact_Address_Soi": {
              required: true
                
						},
            "Contact_Address_Tumbon": {
              required: true
                
						},
            "Contact_Address_Aumper": {
              required: true
                
						},
            "Contact_Address_Province": {
              required: true
                
						},
            "Contact_Address_Postcode": {
              required: true
                
						},
            "Contact_Phone": {
              required: true
                
						},
            "Contact_Email": {
              required: true
                
						}


            
        }/*,
        messages: {
            "Student_Name_Eng": {
                required: "กรุณากรอกชื่อภาษาอังกฤษ"
                
            },
            "Student_Lname_Eng": {
                required: "กรุณากรอกนามสกุลภาษาอังกฤษ"
                
						},
            "Student_Nickname": {
                required: "กรุณากรอกชื่อเล่น"
                
						},
            "Student_Phone": {
                required: "กรุณากรอกรหัสวิชา"
                
						},
            "Student_Email": {
                required: "กรุณากรอกรหัสวิชา"
                
						},
            "Student_Nickname": {
                required: "กรุณากรอกรหัสวิชา"
                
						}
        }*/
    });

});

</script>