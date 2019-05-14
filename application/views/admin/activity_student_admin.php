<style>
table {
    width:100%;
}
th, td {
    padding: 5px;
    text-align: left;
}
section.dashboard-counts .row {
  padding: 5px 5px;
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
  
        <div class="content-inner" >
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
                <li><a href="<?php echo site_url('admin/c_admin/menu_admin');?>">หน้าหลัก</a></li>
                  <li>ข้อมูลกิจกรรม</li>
            </ul>
            </div>
          </header><br>
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
                <div class="container">
                <h1 class="no-margin-bottom"><center>กิจกรรม</center></h1><br><br>
                <div align="left">
                    <a href="<?php echo site_url('admin/c_admin/insert_form_activity');?>"><button type="submit" class="btn btn-success btn-sm" >เพิ่มรายชื่อกิจกรรม</button></a>
                    </div>
                </div><br><br>
                      <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                                  <tr>
                                    <th>ชื่อกิจกรรม</th>
                                    <th>เทอม</th>
                                    <th>ปีการศึกษา</th>  
                                    <th>ชั่วโมง</th>  
                                    <th></th>    
                                  </tr>
                      </thead>   
                      <tbody>
                      <?php foreach ($result as $row) { ?>
                        <tr>
                            <td><?php echo $row['Activitie_Name'];?></td>
                            <td><?php echo $row['Activity_Term'];?></td>
                            <td><?php echo $row['Activity_Year'];?></td>
                            <td><?php echo $row['Hour'];?></td>
                            <td><center>
                              <a href="<?php echo site_url('admin/c_admin/activity_detail/'.$row['Activitie_ID']);?>">
                              <button type="button" class="btn btn-primary btn-sm"></i> รายละเอียดผู้เข้าร่วมโครงการ</button>&nbsp;
                              <a href="<?php echo site_url('admin/c_admin/form_editactivity_student_admin/'.$row['Activitie_ID']);?>">
                              <button type="button" class="btn btn-warning btn-sm"></i> แก้ไข</button><br>
                            </center></td>
                        </tr>      
                      <?php } ?>

                      </tbody>
                      </table>             

                </div>
              </div>
            </div>
          </div>
                   
                          <script>
                            $(document).ready(function() {
                                $('#datatable').DataTable();
                            } );
                          </script>

	
	