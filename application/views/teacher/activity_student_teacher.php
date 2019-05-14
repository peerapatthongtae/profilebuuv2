<style>
meta name="viewport" content="width=device-width, initial-scale=1">
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
<Body>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
                <li><a href="<?php echo site_url('teacher/c_teacher/menu_teacher');?>">หน้าหลัก</a></li>
                <li>ข้อมูลกิจกรรม</li>     
            </ul>
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>ข้อมูลกิจกรรม</strong></h1>
            </div>
            <div class="card-body">

        <form  name="myform" method="get"  action="activity_student_teacher" onsubmit="return validateForm()">
          <div class="container">
            <div class="row">
              <div class="col-md-6"><BR>
                <h2>การตรวจสอบชั่วโมงกิจกรรม</h2><BR>
                  <div id="custom-search-input">
                    <div class="input-group col-md-7">
                      <input type="text" name="textfield" id="textfield" class="form-control input-lg" placeholder="ค้นหารหัสนิสิต" maxlength ="8">&nbsp;&nbsp;
                      <input type="submit" name="button" id="button" value="ตกลง" class="btn btn-primary">
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </form> <BR>
                  
        <table id="example" class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                     

          
        <?php

          if(count($result) == 0 && $student_code != '') {

            echo "ไม่มีข้อมูล";

          } else if(count($result)) { ?>
            
            <img src="http://reg.buu.ac.th/registrar/getstudentimage.asp?id=<?php echo $student_code ?>" style="float:left;"> <br>
            <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; รหัสนิสิต : <?php echo $result[0]->Student_Student_ID ?> </p>
            <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ - นามสกุล : <?php echo $result[0]->Student_Prefix." ".$result[0]->Student_Name_Th." ".$result[0]->Student_Lname_Th ?> </p>
            <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; หลักสูตร : <?php echo $result[0]->Course ?> </p>
            <br><br><br><br>
            <TR>
            <TD><center>ชื่อกิจกรรม</TD>
            <TD><center>เทอม</TD>
            <TD><center>ปี</TD>
            <TD><center>ชั่วโมง</TD>
            </TR>

            <?php foreach($result as $row) {

            echo "<TR>";
            echo "<TD>$row->Activitie_Name</TD>";
            echo "<TD align = 'right'>$row->Activity_Term</TD>";
            echo "<TD align = 'right'>$row->Activity_Year</TD>";
            echo "<TD align = 'right'>$row->Hour</TD>";
            echo "</TR>";

            }
          }
        ?>
    </table>  
                  </table>  
</Body>

<script>
function validateForm() {
    var x = document.forms["myform"]["textfield"].value;
    if (x == "") {
        alert("กรุณาใส่ข้อมูล");
        return false;
    }
}
</script>
