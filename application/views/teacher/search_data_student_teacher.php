<style>
table {
    width:100%;
}
th {
    padding: 5px;
    text-align: left;
    font-size: 1.3em;
}
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
            <li><a href="<?php echo site_url('admin/c_admin/menu_admin');?>">หน้าหลัก</a></li>
                <li>ข้อมูลนิสิต</li>
       
            </ul>
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>ข้อมูลนิสิต</strong></h1>
            </div>
            <div class="card-body">

        <form  name="myform" method="get"  action="search_data_student_teacher" onsubmit="return validateForm()">
          <div class="container">
            <div class="row">
              <div class="col-md-6"><BR>
                <h2>การค้นหานิสิต </h2><BR>
                  <div id="custom-search-input">
                    <div class="input-group col-md-7">
                      <input type="text" name="textfield" id="textfield" class="form-control input-lg" placeholder="ค้นหารหัสนิสิต, ชื่อ หรือนามสกุล">&nbsp;&nbsp;
                      <input type="submit" name="button" id="button" value="ตกลง" class="btn btn-primary">
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </form> <BR>    
          <?php

                if(count($result) == 0 && $Student_Text != '') {

                      echo "ไม่พบข้อมูล";

              } else if(count($result)) { ?>

            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                <th>รหัสนิสิต</th>
                <th>ชื่อ - นามสกุล</th>
                <th>หลักสูตร</th>
                <th>สถานภาพ</th>  
                <th></th>             
                </tr>
              </thead>   

              <?php foreach($result as $row) {

              echo "<tr>";
              echo "<td>".$row->Student_ID."</td>";
              echo "<td>".$row->Student_Prefix." "."$row->Student_Name_Th"." ".$row->Student_Lname_Th."</td>";
              echo "<td>".$row->Course."</td>";
              echo "<td>".$row->Status_Name."</td>";
              echo "<td>"."<center>";
              echo "<a href='".site_url('teacher/c_teacher/data_student_detail_teacher/'.$row->Student_ID)."'>";
              echo "<button type='submit' class='btn btn-primary btn-sm'>"."รายละเอียดข้อมูลนิสิต"."</button>";
              echo "</a>";
              echo " ";
              echo "<a href='".site_url('teacher/c_teacher/transcript_student_teacher/'.$row->Student_ID)."'>";
              echo "<button type='submit' class='btn btn-primary btn-sm'>"."ผลการศึกษา"."</button>";
              echo "</a>";
              echo "</td>"."</center>";
              echo "</tr>";            
              }
            }
          ?>
        </table>
          <br>
</Body>

<script>
      $(document).ready(function() {
          $('#datatable').DataTable();
          $('.dataTables_filter').hide()
      } );
      
    function validateForm() {
    var x = document.forms["myform"]["textfield"].value;
    if (x == "") {
        alert("กรุณาใส่ข้อมูล");
        return false;
          }
    }

</script>


