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
  
        <div class="content-inner" >
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
                <li><a href="<?php echo site_url('teacher/c_teacher/menu_teacher');?>">หน้าหลัก</a></li>
                <li>รางวัลการแข่งขัน</li>     
            </ul>
            </div>
          </header><br>
          <Body>
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                  <div class="container">
                <h1 class="no-margin-bottom"><center>รางวัลการแข่งขัน</center></h1>
                  <br></div>
                      <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                                  <tr>
                                    
                                    <th>ชื่อรางวัล</th>
                                    <th>เทอม</th>
                                    <th>ปีการศึกษา</th>  
                                    <th>อาจารย์ผู้ช่วย</th>  
                                    <th>เงินรางวัล(บาท)</th>
                                    
                                    <th></th>             
                                  </tr>
                      </thead>   
                      <tbody>
                      <?php  foreach ($result as $row) { ?>
                        <tr>
                            
                            <td><?php echo $row['Award_Name'];?></td>
                            <td><?php echo $row['Award_Term'];?></td>
                            <td><?php echo $row['Award_Year'];?></td>
                            <td><?php echo $row['Award_Giver'];?></td>
                            <td><?php echo $row['Award_Amount'];?></td>
                            <td><center>
                              <a href="<?php echo site_url('teacher/c_teacher/award_detail_student/'.$row['Award_ID']);?>">
                                <button type="button" class="btn btn-primary btn-sm"></i> รายละเอียดผู้ได้รับรางวัล</button>&nbsp;
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

	
	