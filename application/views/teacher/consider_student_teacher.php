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
  
  <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
            <li><a href="<?php echo site_url('teacher/c_teacher/menu_teacher');?>">หน้าหลัก</a></li>
                <li>รายชื่อนิสิตรอพินิจ</li>
            </ul>
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
                <div class="container"><br>
                <h1><strong><center>รายชื่อนิสิติรอพินิจ</strong></h1><br>
                
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input"><b>เลือกประเภทการรอพินิจ</b></label><br>
                      <div class="col-md-6">
                      <form method="post"  action="<?php echo site_url('teacher/c_teacher/consider_student_teacher');?>" id="consiter" name="">
                        <select onchange="this.form.submit()" id="consider" name="consider" class="form-control">
                        <option>โปรดเลือกรายชื่อรอพินิจ</option>
                        <option value="high">รายชื่อรอพินิจ - โปรสูง</option>
                        <option value="low">รายชื่อรอพินิจ - โปรต่ำ</option>
                      </form>
                        </select>
                      </div>
                  </div><br>
                  <?php 
                  if( count($student) > 0){

                  ?>
                  <table id="datatable" class="table table-striped table-bordered">
                      
                      <thead>
                                  <tr>
                                    
                                    <th>รหัสนิสิต</th>
                                    <th>ชื่อ - นามสกุล</th>
                                    <th>หลักสูตร</th>
                                    <th>เกรด</th>            
                                  </tr>
                      </thead>   
                      <tbody>
                      <?php 
                      $i=1; foreach ($student as $row) { ?>
                        <tr>
                            
                            <td><?php echo $row['Student_ID'];?></td>
                            <td><?php echo $row['Student_Prefix']." ".$row['Student_Name_Th']." ".$row['Student_Lname_Th'];?></td>
                            <td><?php echo $row['Course'];?></td>
                            <td><?php echo $row['GPAX'];?></td>
                           
                        </tr>      
                      <?php } ?>
                      </tbody>
                      </table>    
                  <?php } ?> 
                </div>
            </div>
          </div>
        </div>
                
    <script>
      $(document).ready(function() {
          $('#datatable').DataTable();
      } );
    </script>
