<?php
session_start();
header("Cache-control: private");
ini_set('memory_limit', '2048M');
?>
<html>
<style>
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
                <li>ตารางที่ 8-1 ข้อมูลการรับเข้าของนิสิตในหลักสูตร (ย้อนหลัง 5 ปี)</li>
				
            </ul>
            </div>
          </header>
          <br>
	<body>
	<div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>ตารางที่ 8-1 ข้อมูลการรับเข้าของนิสิตในหลักสูตร (ย้อนหลัง 5 ปี)</strong></h1>
              
            </div>
            <div class="card-body">    
	<div class="container">  
    <div class="row">
	
	
    <form id="getEntryData" action="<?php echo site_url("admin/c_admin/getEntryData/")?>" method ="post">
        <br><br><br><br>
		

        <div class="form-group">
        <label for="branch">เลือกสาขา :</label>
		<select class="form-control" name="branch" required id="branch" >

											<option value="">---------</option>
                                        
                                    <?php
                                        foreach($allbranch as $row) {   ?>
                                        <option value="<?php echo $row->Branch_Name ?>"><?php echo $row->Branch_Name ?> </option>
                                      <?php  }

                                    ?>

                                </select>


		</div>
    </div>
		 
		
		
    
    
        <!--<input type="text"  id="reply" class="form-control pull-right"  placeholder="Write a reply..." style="display:none;"/>!-->
		
		<button id="button" class="btn btn-primary" type="submit">เรียกดูข้อมูล</button>

		</form>
		
		<br />
		</div>
		</div>
		</div>
        <?php if ($result) { ?>
            <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
            <h1><strong><center>หลักสูตรวิทยาศาสตรบัณฑิต (<?php echo $branch ?>)</strong></h1>
            </div>
    <div class="card-body">    
	<div class="container">  
    <div class="row">
    <table id="example" class="table table-bordered " >
		<thead>
		<tr>
		
		<th>ภาคการศึกษา/ปีการศึกษา</th>
		<th>จำนวนผู้มีสิทธิเข้าศึกษา<br />(No. Admitted)</th>
		<th>จำนวนที่ลงทะเบียน<br />(No. Enrolled)</th>
        <th>จำนวนนิสิต ณ สัปดาห์แรกของภาคปลาย<br />(เฉพาะ ป.ตรี)</th>
		
		
		</tr>
        </thead>
        <tbody>
        <?php
        foreach($result as $row) {
            ?>
            <tr>
                          
                          
                          <td align="CENTER"><?php echo $row->YEARS ?> </td>
                          <?php foreach($allstudentincourse as $row1) { 
                              if($row1->Entry_Years == $row->YEARS) {
                              ?>
                              

                          <td align="CENTER">
                            <?php echo "<a href='".site_url('admin/c_admin/getListAllStudentInCourse/'.$branch.'/'.$row->YEARS)."'>";
                             ?>
                            <?php echo $row1->รวม ?> </a></td>
                          <?php } } ?>
                          
                          
                          <td align="CENTER">
                            <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'1'.'/'.$row->YEARS.'/'.$row->YEARS)."'>";
                             ?>
                            <?php echo $row->จำนวนที่ลงทะเบียน ?> </a></td>
                          
                          <?php foreach($result2 as $rowterm2) {
                              if($rowterm2->YEARS == $row->YEARS) { ?>

                          <td align="CENTER">
                            <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'2'.'/'.$row->YEARS.'/'.$row->YEARS)."'>";
                             ?>
                             <?php echo $rowterm2->จำนวนที่ลงทะเบียน ?></a> </td>
                          <?php } } ?>

                          

                          </tr>
        <?php } /*foreach ($result as  $row) { ?>
                        
                        <tr>
                          
                          
                          <td width="10%" align="CENTER"><?php echo $row->Gpa_Term ?> </td>
                          <td align="CENTER"><?php echo $row->GPA_Year ?> </td>
                          <td align="CENTER"><?php echo $row->Pro_Name ?> </td>
                          <td align="CENTER"><?php echo $row->GPAX_Term ?> </td>
                          <td align="CENTER"><?php echo $row->Status_Term ?> </td>
                          

                          </tr>
        <?php }*/ ?>
        </tbody>
        </table>
        
        </div>
        </div>
		</div>
		</div>
        <?php } ?>

        <script>
          $(document).ready(function () {
    $("#getEntryData").validate({
        
        messages: {
            "branch": {
                required: "กรุณาเลือกสาขา"
                
            }
        }
    });

});
        </script>