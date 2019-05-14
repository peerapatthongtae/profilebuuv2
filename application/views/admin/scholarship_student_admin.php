<style>

table {
    width:60%;
}
th, td {
    padding: 5px;
    text-align: left;
}

.button {
    background-color: #4CAF50;
    border: 1;
    color: white;
    padding: 5px 22px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
.button {border-radius: 8px;}
<meta name="viewport" content="width=device-width, initial-scale=1">
ul.breadcrumb {
    padding: 5px 16px;
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
header.page-header { 
  padding: 0px 0; 
  }
</style>
  
  <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/c_admin/menu_admin');?>">หน้าหลัก</a></li>
                <li>ทุนการศึกษา</li>
            </ul>
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
                <div class="container">
                <h1 class="no-margin-bottom"><center>ทุนการศึกษา</center></h1><br>
                <br>
                <div align="left">
                    <a href="<?php echo site_url('admin/c_admin/add_scholarship_student');?>"><button type="submit" class="btn btn-success btn-sm" >เพิ่มรายชื่อทุนการศึกษา</button></a>
                </div>
                </div><br><br>
                
                <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                      <tr>
                        <th>ชื่อทุนการศึกษา</th>
                        <th>ผู้มอบทุนการศึกษา</th>
                        <th>ปีการศึกษา</th>
                        <th>จำนวนทุน</th>
                        <th>จำนวนเงินทุนละ(บาท)</th>
                        <th>รวมเป็นเงิน(บาท)</th>
                        <th></th>
                      </tr>
                  </thead>   
                  <tbody>
                    <?php $i=1; foreach ($result as $row) { ?>
                    <tr> 
                      <td><?php echo $row['Scholarship_Name'] ?></td>
                      <td><?php echo $row['Scholarship_Giver'] ?></td>
                      <td><?php echo $row['Scholarship_Year'] ?></td>
                      <td><?php echo $row['Scholarship_Count'] ?></td>
                      <td><?php echo $row['Scholarship_Amount'] ?></td>
                      <td><?php echo $row['Scholarship_Amounttotal'] ?></td>
                      <td><center>
                        <a href="<?php echo site_url('admin/c_admin/scholarship_detail/'.$row['Scholarship_ID']);?>">
                        <button type="button" class="btn btn-primary btn-sm"></i> รายละเอียดผู้รับทุน</button>&nbsp;
                        <a href="<?php echo site_url('admin/c_admin/form_editscholarship_student_admin/'.$row['Scholarship_ID']);?>">
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

