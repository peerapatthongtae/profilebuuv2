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
td:empty {content: "No Data"}

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
                <li>ตารางที่ 8-2 ข้อมูลจำนวนนิสิตในแต่ละชั้นปี (ย้อนหลัง 5 ปี)</li>
				
            </ul>
            </div>
          </header>
          <br>
	<body>
	<div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>ตารางที่ 8-2 ข้อมูลจำนวนนิสิตในแต่ละชั้นปี (ย้อนหลัง 5 ปี)</strong></h1>
              
            </div>

    <div class="card-body">    
	<div class="container">  
    <div class="row">
	
	
    <form id="getAmountStudentInEachYears" action="<?php echo site_url("admin/c_admin/getAmountStudentInEachYears/")?>" method ="post">
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

    <?php if($result1) { ?>    
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
            <h1><strong><center>หลักสูตรวิทยาศาสตรบัณฑิต (<?php echo $branch ?>)</strong></h1>
            </div>

    <div class="card-body">    
	<div class="container">  
    <div class="row">
    <?php echo $years->Gpa_Year ?>
    <table id="example" class="table table-bordered " >
		<thead>
		<tr>
		
		<th rowspan = 3>ปีการศึกษา</th>
		<th colspan = 10>นิสิต</th>
		
        <th rowspan = 3>รวม </th>
		
		
		</tr>
        <tr>
        <th colspan=2>ปี 1</th>
        <th colspan=2>ปี 2</th>
        <th colspan=2>ปี 3</th>
        <th colspan=2>ปี 4</th>
        <th colspan=2>> ปี 4</th>
        </tr>
        <tr>
        <th>ภาคต้น</th>
        <th>ภาคปลาย</th>
        <th>ภาคต้น</th>
        <th>ภาคปลาย</th>
        <th>ภาคต้น</th>
        <th>ภาคปลาย</th>
        <th>ภาคต้น</th>
        <th>ภาคปลาย</th>
        <th>ภาคต้น</th>
        <th>ภาคปลาย</th>
        
        
        </tr>
        </thead>
        <tbody>


        <?php 
        foreach($result1 as $row) {
            $i=0;
            
            ?>
            <TR>
            <th align="CENTER">

              <?php echo $row->YEARS ?> </th>
            <td align="CENTER">
              <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'1'.'/'.$row->YEARS.'/'.$row->YEARS)."'>";
                             ?>
              <?php echo $row->จำนวนที่ลงทะเบียน ?> </a>
               </td>
            
            <td align="CENTER"><?php foreach($result2 as $rowterm2) {
                              if($rowterm2->YEARS == $row->YEARS) { 
                                ?>
                                <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'2'.'/'.$row->YEARS.'/'.$row->YEARS)."'>";
                             ?>
                          <?php echo $rowterm2->จำนวนที่ลงทะเบียน ."</a>" ?>
                          <?php $sum[$row->YEARS] += $rowterm2->จำนวนที่ลงทะเบียน?>
                                
                          <?php } } 
                          ?>
            </td>
            <td align="CENTER"><?php foreach($resultyear2term1 as $rowyear2term1) {
                              if($rowyear2term1->YEARS == $row->YEARS) {
                                 ?>
                                 <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'1'.'/'.($row->YEARS-1).'/'.$row->YEARS)."'>";
                             ?>
                          <?php echo $rowyear2term1->จำนวนที่ลงทะเบียน ."</a>" ?> 
                          <?php }
                         } 
                         
                         ?>
            </td>             
            <td align="CENTER"><?php foreach($resultyear2term2 as $rowyear2term2) {
                              if($rowyear2term2->YEARS == $row->YEARS) {
                                 ?>
                                 <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'2'.'/'.($row->YEARS-1).'/'.$row->YEARS)."'>";
                             ?>
                          <?php echo $rowyear2term2->จำนวนที่ลงทะเบียน."</a>" ?>
                          <?php $sum[$row->YEARS] += $rowyear2term2->จำนวนที่ลงทะเบียน?> 
                          <?php }
                         } ?>
            </td>

            <td align="CENTER"><?php foreach($resultyear3term1 as $rowyear3term1) {
                              if($rowyear3term1->YEARS == $row->YEARS) {
                                 ?>
                                 <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'1'.'/'.($row->YEARS-2).'/'.$row->YEARS)."'>";
                             ?>
                          <?php echo $rowyear3term1->จำนวนที่ลงทะเบียน."</a>" ?> 
                          <?php }
                         } ?>
            </td>
            <td align="CENTER"><?php foreach($resultyear3term2 as $rowyear3term2) {
                              if($rowyear3term2->YEARS == $row->YEARS) {
                                 ?>
                                 <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'2'.'/'.($row->YEARS-2).'/'.$row->YEARS)."'>";
                             ?>
                          <?php echo $rowyear3term2->จำนวนที่ลงทะเบียน."</a>" ?> 
                          <?php $sum[$row->YEARS] += $rowyear3term2->จำนวนที่ลงทะเบียน ?> 
                          <?php }
                         } ?>
            </td>
            <td align="CENTER"><?php foreach($resultyear4term1 as $rowyear4term1) {
                              if($rowyear4term1->YEARS == $row->YEARS) {
                                 ?>
                                 <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'1'.'/'.($row->YEARS-3).'/'.$row->YEARS)."'>";
                             ?>
                          <?php echo $rowyear4term1->จำนวนที่ลงทะเบียน."</a>" ?> 
                          <?php }
                         } ?>
            </td>
<td align="CENTER"><?php foreach($resultyear4term2 as $rowyear4term2) {
                              if($rowyear4term2->YEARS == $row->YEARS) {
                                 ?>
                                 <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'2'.'/'.($row->YEARS-3).'/'.$row->YEARS)."'>";
                             ?>
                          <?php echo $rowyear4term2->จำนวนที่ลงทะเบียน."</a>" ?> 
                          <?php $sum[$row->YEARS] += $rowyear4term2->จำนวนที่ลงทะเบียน ?> 
                          <?php }
                         } ?>
            </td>
            <td align="CENTER"><?php foreach($resultmorethanyear4term1 as $rowlessthanyear4term1) {
                              if($rowlessthanyear4term1->YEARS == $row->YEARS) {
                                 ?>
                                 <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'1'.'/'."morethanfouryear".'/'.$row->YEARS)."'>";
                             ?>
                          <?php echo $rowlessthanyear4term1->จำนวนที่ลงทะเบียน."</a>" ?> 
                          <?php }
                         } ?>
            </td>
            <td align="CENTER"><?php foreach($resultmorethanyear4term2 as $rowlessthanyear4term2) {
                              if($rowlessthanyear4term2->YEARS == $row->YEARS) {
                                 ?>
                                 <?php echo "<a href='".site_url('admin/c_admin/getListStudentInEachYears/'.$branch.'/'.'2'.'/'."morethanfouryear".'/'.$row->YEARS)."'>";
                             ?>
                          <?php echo $rowlessthanyear4term2->จำนวนที่ลงทะเบียน."</a>" ?> 
                          <?php $sum[$row->YEARS] += $rowlessthanyear4term2->จำนวนที่ลงทะเบียน ?> 
                          <?php }
                         } ?>
            </td>
            
            <th align="CENTER">
            <?php echo $sum[$row->YEARS]; ?>
            
            </th>
            </TR>
        <?php } 
        
        
        
        /*foreach($result as $row) {
            ?>
            <tr>
                          
                          
                          <td align="CENTER"><?php echo $row->Gpa_Year ?> </td>
                          <td align="CENTER"><?php echo $row->ปี1ภาคต้น	 ?> </td>
                          <td align="CENTER"><?php echo $row->ปี1ภาคปลาย	 ?> </td>
                          <td align="CENTER"><?php echo $row->ปี2ภาคต้น	 ?> </td>
                          <td align="CENTER"><?php echo $row->ปี2ภาคปลาย	 ?> </td>
                          <td align="CENTER"><?php echo $row->ปี3ภาคต้น	 ?> </td>
                          <td align="CENTER"><?php echo $row->ปี3ภาคปลาย	 ?> </td>
                          <td align="CENTER"><?php echo $row->ปี4ภาคต้น	 ?> </td>
                          <td align="CENTER"><?php echo $row->ปี4ภาคปลาย	 ?> </td>
                          <td align="CENTER"><?php echo $row->มากกว่าปี4ภาคต้น	 ?> </td>
                          <td align="CENTER"><?php echo $row->มากกว่าปี4ภาคปลาย	 ?> </td>
                          <?php $sum = $row->ปี1ภาคปลาย+$row->ปี2ภาคปลาย+$row->ปี3ภาคปลาย+$row->ปี4ภาคปลาย+$row->มากกว่าปี4ภาคปลาย ?>
                          <td align="CENTER"><?php echo $sum	 ?> </td>
                          

                          </tr>
        */ ?>
        </tbody>
        </table>
        </div>

        <p style="color:red;font-weight:bold;">
        หมายเหตุ : <br/>1. เก็บเป็นภาคการศึกษา สิ้นสัปดาห์ที่ 1 ของทุกภาคการศึกษา<br />
        2. ในช่องรวม ให้นับจำนวนนิสิตเฉพาะภาคปลาย ของทุกปีการศึกษามาบวกกัน
        </p>

        

        </div>
		</div>
		</div>

    <?php } ?>

        <script>
        $("#example tbody tr td").has( "a" ).each(function() {
            //$(this).append("no");
            $(this).addClass( "hass" );
            //$(this).text($.trim($(this).text()));
        });

        $("#example tbody tr td:not(td[class=hass])").each(function() {
            $(this).append("<p style=color:red>ไม่มี</p>");
            
        });
        

          $(document).ready(function () {
    $("#getAmountStudentInEachYears").validate({
        
        messages: {
            "branch": {
                required: "กรุณาเลือกสาขา"
                
            }
        }
    });

});
 
        </script>