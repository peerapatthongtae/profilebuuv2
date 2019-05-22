<?php
session_start();
header("Cache-control: private");
?>

<html>
<style>

fieldset.suggestion {
    border: 1px groove #ddd !important;
    padding: 0px 1.4em 1.4em 1.4em !important;
    margin: 35px 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.suggestion {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
table {
    width:100%;
    
}
th {
    padding: 5px;
    text-align: center;
    font-size: 1.3em;
}
td {
    padding: 5px;
    text-align: center;
    font-size: 1.3em;
}

td.left {
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

  /*Modal*/



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


<div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/c_admin/menu_admin');?>">หน้าหลัก</a></li>
                <li>สถิติจำนวนนิสิตรวมและผลการศึกษาของรายวิชา</li>
            </ul>
            </div>
          </header>
          <br>
	<body>
	<div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>สถิติจำนวนนิสิตรวมและผลการศึกษาของรายวิชา</strong></h1>
            </div>

    <div class="card-body">    
	<div class="container">  
    <div class="row">
	
	
		<form id="getAmountSubjectStudent" action="<?php echo site_url("admin/c_admin/getAmountSubjectStudent/")?>" method ="post">
        <br><br>
		  <fieldset class="suggestion"><legend class="suggestion"><b>คำแนะนำ</legend>
ไม่สามารถกรอกรหัสวิชาที่มีเครื่องหมาย * ได้
</b></fieldset>
<br><br>

        <div class="form-group">
      <label for="subject_code">รหัสวิชา :</label>
      <input type="text" class="form-control" id="subject_code" name="subject_code" required>
        </div>
        
        <div class="form-group">
      <label for="course">หลักสูตร :</label>   
      <div class="form-inline" style="padding:15px">
		 
		<select class="form-control" name="course" id="course" >

											<option value="">ทุกหลักสูตร</option>
                                        
                                    <?php
                                        foreach($allCourse as $row) {   ?>
                                        <option value="<?php echo $row->Course_Name ?>"><?php echo $row->Course_Name ?> </option>
                                      <?php  }
                                    ?>
                                </select>


		</div>
    </div>
		 
		
		
    
    
        <!--<input type="text"  id="reply" class="form-control pull-right"  placeholder="Write a reply..." style="display:none;"/>!-->
		
		<button id="button" class="btn btn-info" type="submit">เรียกดูข้อมูล</button>

		</form>
		
		
    
		</div>
    
    
		</div>
		</div>
		</div>

        <?php 
       if($_POST['subject_code'] != '') { 
        if($course != '') {
            $courseid = explode(":", $course);
            $courseid = $courseid[0];
            } else {
                $courseid = 'all';
            }
        if($Subject_Rows) { ?>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
            <h1><strong><center><?php echo $Subject_Rows[0]->Subject_Code. ' '. $Subject_Rows[0]->Subject_Name .' '
            
            . "<br /><br />". $course?>  
            
            </strong></h1> 
            </div>

    <div class="card-body">    
	<div class="container"> 
    
    <div class="row">
        <table border="1" width="600" cellspacing="2" cellpadding="0" class="table table-responsive-sm table-bordered">
                  <thead>
                    
                    <tr bgcolor="#E0E0FF">
                    <th rowspan = 2><CENTER>เทอม</CENTER></th>
                    <th rowspan = 2><CENTER>ปีการศึกษา</CENTER></th>
                    
                    <th rowspan = 2><CENTER>จำนวนคนลงทะเบียน</CENTER></th>
                    <th rowspan = 2><CENTER>จำนวนคนที่เรียนผ่าน</CENTER></th>
                    <th rowspan = 2><CENTER>จำนวนคนที่เรียนไม่ผ่าน</CENTER></th>
                    <th colspan=11>เกรด</th>
                    </tr>
                    <tr bgcolor="#E0E0FF">
                    <th width=10>A</th>
                    <th width=10>B+</th>
                    <th width=10>B</th>
                    <th width=10>C+</th>
                    <th width=10>C</th>
                    <th width=10>D+</th>
                    <th width=10>D</th>
                    <th width=10>F</th>
                    <th width=10>W</th>
                    <th width=10>I</th>
                    <th>ยังไม่ออกเกรด</th>
                    </tr>
                    
                    </thead>
        
                

              

                
                    <tbody>
                    <?php foreach ($Subject_Rows as $keyrow => $row) { ?>
                        
                      <tr bgcolor="#F6F6FF">
                        
                        
                        <td width="70" align="CENTER"><?php echo $row->Term_Number ?> </td>
                        <td width="30" align="CENTER"><?php echo $row->Subject_Year ?> </td>
                        <td width="30" align="CENTER">
                        <?php if($row->Count!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'all'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                             ?>
                        <?php echo $row->Count ?> </td></a>
                    <?php $countall += $row->Count; 
                  } ?>
                  <td width="30" align="CENTER">
                  <?php if($row->Countpast!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'past'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->Countpast ?> </td></a>
                    <?php $countallpast += $row->Countpast; 
                   ?>
                   <td width="30" align="CENTER">
                  <?php $countfail = $row->CountF+$row->CountW+$row->CountI; 
                  if($countfail != 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'fail'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $countfail ?> </td></a>
                    <?php $countallfail += $countfail; 
                   ?>
                   <td width="30" align="CENTER">
                  <?php if($row->CountA!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'A'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountA ?> </td></a>
                    <?php $countA += $row->CountA; 
                   ?>     
                   <td width="30" align="CENTER">
                  <?php if($row->CountBplus!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'B+'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountBplus ?> </td></a>
                    <?php $countBplus += $row->CountBplus; 
                   ?>    
                   <td width="30" align="CENTER">
                  <?php if($row->CountB!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'B'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountB ?> </td></a>
                    <?php $countB += $row->CountB; 
                   ?>   
                   <td width="30" align="CENTER">
                  <?php if($row->CountCplus!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'C+'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountCplus ?> </td></a>
                    <?php $countCplus += $row->CountCplus; 
                   ?>   
                   <td width="30" align="CENTER">
                  <?php if($row->CountC!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'C'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountC ?> </td></a>
                    <?php $countC += $row->CountC; 
                   ?>   
                   <td width="30" align="CENTER">
                  <?php if($row->CountDplus!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'D+'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountDplus ?> </td></a>
                    <?php $countDplus += $row->CountDplus; 
                   ?>   
                   <td width="30" align="CENTER">
                  <?php if($row->CountD != 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'D'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountD ?> </td></a>
                    <?php $countD += $row->CountD; 
                   ?>   
                   <td width="30" align="CENTER">
                  <?php if($row->CountF!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'F'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountF ?> </td></a>
                    <?php $countF += $row->CountF; 
                   ?>   
                   <td width="30" align="CENTER">
                  <?php if($row->CountW!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'W'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountW ?> </td></a>
                    <?php $countW += $row->CountW; 
                   ?>   
                   <td width="30" align="CENTER">
                  <?php if($row->CountI!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'I'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->CountI ?> </td></a>
                    <?php $countI += $row->CountI; 
                   ?>   
                   <td width="30" align="CENTER">
                  <?php if($row->Countnotgrade!= 0) { 
                             echo "<a href='".site_url('admin/c_admin/student_has_subject/'.'notgrade'.'/'.$row->Subject_Code.'/'.$courseid.'/'.$row->Subject_Year.'/'.$row->Term_Number)."'>";
                            }?>
                        <?php echo $row->Countnotgrade ?> </td></a>
                    <?php $countnotgrade += $row->Countnotgrade; 
                   ?>  
                          
                            
                      
                      </tr>      
                    <?php }  ?>
                    <tr bgcolor="#E0E0FF">
                    <th colspan=2 >ทั้งหมด</th>
                    <td><?php echo $countall ?></td>
                    <td><?php echo $countallpast ?></td>
                    <td><?php echo $countallfail ?></td>
                    <td><?php echo $countA ?></td>
                    <td><?php echo $countBplus ?></td>
                    <td><?php echo $countB ?></td>
                    <td><?php echo $countCplus ?></td>
                    <td><?php echo $countC ?></td>
                    <td><?php echo $countDplus ?></td>
                    <td><?php echo $countD ?></td>
                    <td><?php echo $countF ?></td>
                    <td><?php echo $countW ?></td>
                    <td><?php echo $countI ?></td>
                    <td><?php echo $countnotgrade ?></td>


                    
                    </tr>
                  </tbody>
              </table> <br>
                    <?php } else {
                        echo '<div class=" alert alert-warning" role="alert">
                        ไม่พบรายวิชา
                      </div>';
                    } ?>
                    </div>
		</div>
		</div>
		</div>
                <?php } ?>

                <script>
                

            $('#select-all').click(function(event) {   
            if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});

    $(document).ready(function () {
    $("#getAmountSubjectStudent").validate({
        
        messages: {
            "course": {
                required: "กรุณาเลือกหลักสูตร"
                
            },
            "subject_code": {
                required: "กรุณากรอกรหัสวิชา"
                
            }
        }
    });

});
                </script>
            