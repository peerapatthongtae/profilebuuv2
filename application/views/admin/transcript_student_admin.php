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


  /*DIVTABLE*/
  /*divtable*/
.rTable {
  	display: table;
  	width: 100%;
	
	padding-top :10px;
}
.rTableRow {
  	display: table-row;
	  
}
.rTableHeading {
  	display: table-header-group;
  	background-color: #ddd;
	  
}
.rTableCell {
	background-color:#F8F8FF;
}
.rTableCell, .rTableHead {
  	display: table-cell;
	   
  	padding: 3px 10px;
  	border: 1px solid #999999;
	  
	  padding: 5px;
    text-align: center;
}
.rtableHead {
	background-color: 	#F5F5DC;
}
.rTableHeading {
  	display: table-header-group;
  	
  	font-weight: bold;
	  
    
}
.rTableFoot {
  	display: table-footer-group;
  	font-weight: bold;
  	background-color: #ddd;
}
.rTableBody {
	height:130px;
	overflow:scroll;
  	display: table-row-group;
}




  </style>
<Body>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
                <li><a href="<?php echo site_url('admin/c_admin/menu_admin');?>">หน้าหลัก</a></li>
                <li><a href="<?php echo site_url('admin/c_admin/search_data_student_admin');?>">ข้อมูลนิสิต</a></li>
                <li>ผลการศึกษา</li>
            </ul>
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <strong><center>ผลการศึกษา</strong>
            </div>
            <div class="card-body">
              <p class="text-muted"><?php echo $result['Student_ID'] ?> : <?php echo $result['Student_Prefix'] ?> <?php echo $result['Student_Name_Th'] ?> <?php echo $result['Student_Lname_Th'] ?> </p>
              <p class="text-muted">หลักสูตร : <?php echo $result['Course'] ?> </p>
              <p class="text-muted">สถานภาพ : <?php echo $status[0]->Status_Name ?> </p>
              <p class="text-muted">หน่วยกิตรวมที่ผ่านแล้ว : <?php echo $CA[0]->sum ?> </p>
              <p class="text-muted">GPAX : <?php echo $result['GPAX']?> </p>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $result['Student_ID'] ?>"
              >ตรวจสอบรายวิชาที่ยังไม่ผ่าน</button>
              <br>
              <hr />

                      
              <?php foreach($transcript_rows as $row_table) { 
                if($row_table->GPA_Year == "0")
                  continue;
                ?>

              

                <table border="1" width="600" cellspacing="2" cellpadding="0" class="table table-responsive-sm table-bordered">
                  <thead>
                    <tr>
                    <th colspan="4" bgcolor="#8080ff" ><CENTER>ภาคการศึกษาที่ &nbsp; <?php echo $row_table->GPA_Term.'/'.$row_table->GPA_Year;?></CENTER></th>
                    </tr>
                    <tr bgcolor="#E0E0FF">
                    <th><CENTER>รหัสวิชา</CENTER></th>
                    <th><CENTER>ชื่อรายวิชา</CENTER></th>
                    <th><CENTER>หน่วยกิต</CENTER></th>
                    <th><CENTER>เกรด</CENTER></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $subjectfail = array();
                    $i=0;
                    foreach ($transcript as $row) { 
                      
                      
                      if($row->Grade == 'F' ) {
                        $grade += @(0*$row->Credit);
                        if (!in_array($row->Subject_Code, $subjectfail)) {
                          $subjectfail[$i] = $row->Subject_Code;
                          $i++;
                        }
                        
                      } else if ($row->Grade == 'W') {
                        if (!in_array($row->Subject_Code, $subjectfail)) {
                          $subjectfail[$i] = $row->Subject_Code;
                          $i++;
                        }
                      }  else if ($row->Grade == 'I') {
                        if (!in_array($row->Subject_Code, $subjectfail)) {
                          $subjectfail[$i] = $row->Subject_Code;
                          $i++;
                        }
                      } else if($row->Grade == '') {
                        if (!in_array($row->Subject_Code, $subjectfail)) {
                          $subjectfail[$i] = $row->Subject_Code;
                          $i++;
                        }
                      } else if($row->Grade == 'D') {
                        $grade += 1*$row->Credit;
                        if (($key = array_search($row->Subject_Code, $subjectfail)) !== false) {
                          unset($subjectfail[$key]);
                        }
                      } else if($row->Grade == 'D+') {
                        $grade += 1.5*$row->Credit;
                        if (($key = array_search($row->Subject_Code, $subjectfail)) !== false) {
                          unset($subjectfail[$key]);
                        }
                      } else if($row->Grade == 'C') {
                        $grade += 2*$row->Credit;
                        if (($key = array_search($row->Subject_Code, $subjectfail)) !== false) {
                          unset($subjectfail[$key]);
                        }
                      } else if($row->Grade == 'C+') {
                        $grade += 2.5*$row->Credit;
                        if (($key = array_search($row->Subject_Code, $subjectfail)) !== false) {
                          unset($subjectfail[$key]);
                        }
                      } else if($row->Grade == 'B') {
                        $grade += 3*$row->Credit;
                        if (($key = array_search($row->Subject_Code, $subjectfail)) !== false) {
                          unset($subjectfail[$key]);
                        }
                      } else if($row->Grade == 'B+') {
                        $grade += 3.5*$row->Credit;
                        if (($key = array_search($row->Subject_Code, $subjectfail)) !== false) {
                          unset($subjectfail[$key]);
                        }
                      } else if($row->Grade == 'A') {
                        $grade += 4*$row->Credit;
                        if (($key = array_search($row->Subject_Code, $subjectfail)) !== false) {
                          unset($subjectfail[$key]);
                        }
                      } 
                      
                      ?>
  

                      <tr bgcolor="#F6F6FF">
                        <?php if($row->Term_Number == $row_table->GPA_Term && $row_table->GPA_Year == $row->Subject_Year) { ?>
                        <td width="100"><?php echo $row->Subject_Code ?> </td>
                        <td><?php echo $row->Subject_Name ?> </td>
                        <td width="70" align="CENTER"><?php echo $row->Subject_Credit ?> </td>
                        <td width="30" align="CENTER"><?php echo $row->Grade ?> </td>
                      </tr>      
                    <?php } } ?>
                  </tbody>
              </table> <br>
            <?php } ?>



            <div class="modal fade" id="<?php echo $result['Student_ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
>
  <div class="modal-dialog" role="document" style="margin-left:200px; min-width:900px;">
    <div class="modal-content" style="margin-left:200px; min-width:900px;">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">ตรวจสอบรายวิชาที่ยังไม่ผ่านของรหัสนิสิต <?php echo $result['Student_ID'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
			<div class="rTable" id="example">
				<div class="rTableHeading">
				<div class="rTableHead"><strong>รหัสวิชา</strong></div>
				<div class="rTableHead"><strong>ชื่อวิชา</strong></div>
				<div class="rTableHead"><strong>หน่วยกิต</strong></div>
				
				
				</div>
				<div class="rTableBody">
		<?php 
		
		
    foreach($subjectfail as $rowsubjectfail) {
			foreach($transcript as $row) {
			if($rowsubjectfail == $row->Subject_Code) {
			?>
				
				<div class="rTableRow">
				<div class="rTableCell"><?php echo $row->Subject_Code ?></div>
				<div class="rTableCell"><?php echo $row->Subject_Name ?></div>
				<div class="rTableCell"><?php echo $row->Subject_Credit ?></div>
				
				</div>
				
		
			<?php break;
			}
		}
	}
			
		?>
      </div>
	  <br />

	  </div>
	  <div class="modal-footer">
	  
	  <?php 
	  
	   ?>
      </div>
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	  
    
  </div>
</div>

        
</Body>