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
<Body>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
              <li><a href="<?php echo site_url('user/c_user/menu_user');?>">หน้าหลัก</a></li>
              <li>ข้อมูลกิจกรรม</li>
            </ul>
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <strong><center>ข้อมูลกิจกรรม</strong>
            </div>
            <div class="card-body">

        <form  name="myform" method="get"  action="activity" onsubmit="return validateForm()">
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
            if(count($student)) { ?>
              <img src="http://reg.buu.ac.th/registrar/getstudentimage.asp?id=<?php echo $student_code ?>" style="float:left;width:200px;height:200px"> <br><!-- รูปนิสิต !-->
              <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; รหัสนิสิต : <?php echo $student[0]->Student_ID ?> </p>
              <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ - นามสกุล : <?php echo $student[0]->Student_Prefix." ".$student[0]->Student_Name_Th." ".$student[0]->Student_Lname_Th ?> </p>
              <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; หลักสูตร : <?php echo $student[0]->Course ?> </p>
              <br><br><br><br>
            <?php } else if (!count($student) && $student != '') {
              echo '<div class="alert alert-warning" role="alert">
              ไม่พบนิสิต
            </div>';
            }

            if(count($result) == 0 && count($student)) {

              echo '<div class="alert alert-warning" role="alert">
              ไม่พบข้อมูล
            </div>';
              
              
            
            } else if(count($result)) { ?>
              <?php /*
              <img src="http://reg.buu.ac.th/registrar/getstudentimage.asp?id=<?php echo $student_code ?>" style="float:left;"> <br><!-- รูปนิสิต !-->
              <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; รหัสนิสิต : <?php echo $result[0]->Student_Student_ID ?> </p>
              <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ - นามสกุล : <?php echo $result[0]->Student_Prefix." ".$result[0]->Student_Name_Th." ".$result[0]->Student_Lname_Th ?> </p>
              <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; หลักสูตร : <?php echo $result[0]->Course ?> </p>
              <br><br><br><br> */ ?>
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
