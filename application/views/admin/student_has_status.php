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
            <li><a href="<?php echo site_url('admin/c_admin/getAmountStudentStatus');?>">จำนวนนิสิตแยกตามสถานะนิสิต</a></li>
                <li>รายชื่อนิสิตตามสถานะนิสิต</li>
       
            </ul>
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center><?php echo "ข้อมูลนิสิต".$level." ปี ".$years." ที่มีสถานะ".$result[0]->Status_Name ?></strong></h1>
            </div>
            <div class="card-body">

        
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
              echo "<a href='".site_url('admin/c_admin/data_student_detail_admin/'.$row->Student_ID)."'>";
              echo "<button type='submit' class='btn btn-primary btn-sm'>"."รายละเอียดข้อมูลนิสิต"."</button>";
              echo "</a> ";
              echo "<a href='".site_url('admin/c_admin/transcript_student_admin/'.$row->Student_ID)."'>";
              echo "<button type='submit' class='btn btn-sm btn-primary'>"."ผลการศึกษา". "</button>";
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
          
      } );

      function validateForm() {
    var x = document.forms["myform"]["textfield"].value;
    if (x == "") {
        alert("กรุณาใส่ข้อมูล");
        return false;
          }
    }
      
</script>

