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
                <li>ตารางที่ 8-3 ข้อมูลการคงอยู่และการจบการศึกษาของนิสิตในหลักสูตรปริญญาตรี (ย้อนหลัง 5 ปี)</li>
				
            </ul>
            </div>
          </header>
          <br>
	<body>
    





	<div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>ตารางที่ 8-3 ข้อมูลการคงอยู่และการจบการศึกษาของนิสิตในหลักสูตรปริญญาตรี (ม.บูรพา บางแสน) (ย้อนหลัง 5 ปี)</strong></h1>
              
            </div>
    <div class="card-body">    
	<div class="container">  
    <div class="row">
	
	
		<form id="getAmountGradAndRetire" action="<?php echo site_url("admin/c_admin/getAmountGradAndRetire/")?>" method ="post">
        <br><br><br><br>
		

        <div class="form-group">
        
        <label for="student_id">เลือกสาขา :</label>
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
		
    <?php if($retire) { ?>
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
		
		<th rowspan=2>รหัสแรกเข้า</th>
		<th rowspan=2>จำนวนที่ลงทะเบียน</th>
		<th colspan=2>จำนวนนิสิตที่จบภายในระยะเวลา</th>
        <th colspan=4>จำนวนนิสิตที่พ้นสภาพในแต่ละชั้นปี</th>
		
		
		</tr>
        <tr>
        <th>4 ปี</th>
        <th>> 4 ปี</th>
        <th>ปี 1</th>
        <th>ปี 2</th>
        <th>ปี 3</th>
        <th>ปี 4 เป็นต้นไป</th>
        </tr>
        </thead>
        <tbody>
        <?php
        
        foreach($retire as $row) {
            ?>
            <tr>
                          
                          
                          <td><?php echo $row->YEARS ?></td>
                          <?php foreach($result as $rowenroll) {
                              if($rowenroll->YEARS == $row->YEARS) { ?>
                          <td align="CENTER">
                            <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'1'.'/'.$row->YEARS.'/'.$row->YEARS)."'>";
                             ?>
                             <?php echo $rowenroll->จำนวนที่ลงทะเบียน ?> </a></td>
                          <?php } } ?>
                          <?php foreach($grad as $rowgrad) {
                              if($rowgrad->YEARS == $row->YEARS) { 
                                  if($yearslatest->Gpa_Year-$rowgrad->YEARS < 4) {
                                    ?> <td style="color:red;" colspan=2 align="CENTER">ยังไม่ครบระยะเวลาการศึกษาตามหลักสูตร </td> <?php
                                  } else {?>
                              
                          <td align="CENTER">

                            <?php if($rowgrad->fouryear != 0) {
                             echo "<a href='".site_url('admin/c_admin/getListGradStudent/'.'fouryear'.'/'.$branch.'/'.$row->YEARS)."'>";
                            } ?>
                             <?php echo $rowgrad->fouryear ?> </a></td>
                          <td align="CENTER">
                            <?php if($rowgrad->morethanfouryear != 0) {
                            echo "<a href='".site_url('admin/c_admin/getListGradStudent/'.'morethanfouryear'.'/'.$branch.'/'.$row->YEARS)."'>";
                             } ?>
                             <?php echo $rowgrad->morethanfouryear ?> </a></td>
                          <?php } } }?>
                          
                          <td>
                            <?php  if($row->year1 != 0) {
                            echo "<a href='".site_url('admin/c_admin/getListRetireStudent/'.$branch.'/'.$row->YEARS.'/'.($row->YEARS))."'>";
                             } ?>
                            <?php echo $row->year1 ?></a></td>
                          <td>
                            <?php if($row->year2 != 0) {
                            echo "<a href='".site_url('admin/c_admin/getListRetireStudent/'.$branch.'/'.$row->YEARS.'/'.($row->YEARS+1))."'>";
                             } ?>
                            <?php echo $row->year2 ?></a></td>
                          <td>
                            <?php if($row->year3 != 0) {
                            echo "<a href='".site_url('admin/c_admin/getListRetireStudent/'.$branch.'/'.$row->YEARS.'/'.($row->YEARS+2))."'>";
                             } ?>
                            <?php echo $row->year3 ?></a></td>
                          <td>
                            <?php if($row->yearmorethan4 != 0) {
                            echo "<a href='".site_url('admin/c_admin/getListRetireStudent/'.$branch.'/'.$row->YEARS.'/'.'morethanfouryear')."'>";
                             } ?>
                            <?php echo $row->yearmorethan4 ?></a></td>

                          

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
    $("#getAmountGradAndRetire").validate({
        
        messages: {
            "branch": {
                required: "กรุณาเลือกสาขา"
                
            }
        }
    });

});
        </script>