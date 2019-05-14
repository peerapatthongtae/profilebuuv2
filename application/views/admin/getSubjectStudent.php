<?php
session_start();
header("Cache-control: private");
ini_set('memory_limit', '-1');
?>
<html>
<link href="http://mottie.github.io/tablesorter/css/theme.default.css" rel="stylesheet">
  <script type="text/javascript" src="http://mottie.github.io/tablesorter/js/jquery.tablesorter.js"></script>
<style>
#div1 {
    float:left;
    width:100px;
    height:100px;
    border:solid 2px red;
    text-align:center;
}

thead{background-color:lightblue}
thead tr th{cursor:pointer}
thead tr th:hover{background-color:#cccccc}
.asc:after,
.desc:after {
    color: gray;
    font-size: 11px
}
.asc:after {
    content: '\25B2'
}

.desc:after {
    content: '\25BC'
}

label {
    width: 140px;
    display: inline-block;
}
label.error {
    color: red;
    width: 300px;
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
                <li>ผลการศึกษาแยกตามรหัสนิสิต</li>
				
            </ul>
            </div>
          </header>
          <br>
	<body>
	<div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>ผลการศึกษาแยกตามรหัสนิสิต</strong></h1>
            </div>

    <div class="card-body">    
	<div class="container">  
    <div class="row">
	
	
		<form id= "getSubjectStudents" action="<?php echo site_url("admin/c_admin/getSubjectStudent/")?>" method ="post">
        <br><br><br><br>
		<div class="form-group">
      <label for="student_id">รหัสนิสิต :</label>
      <input type="text" class="form-control" id="student_id" required name="student_id" >
    </div>
    <div class="form-group">
      <label for="subject_code">รหัสวิชา :</label>
      <input type="text" class="form-control" id="subject_code" required name="subject_code"  >
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
		
		<br />
		</div>
		</div>
		</div>
		</div>

		
		<?php 
		
		if(count($student) || count($result)) {?> 
			<div class="card">
			<div class="card-body"> 
			<div class="row">
			<div class="container">
		<?php } 

		
		if(count($student)) { ?>
		
		
		     
    	
			<img src="http://reg.buu.ac.th/registrar/getstudentimage.asp?id=<?php echo $student_id ?>" style="float:left;width:200px;height:200px"> <br><!-- รูปนิสิต !-->
			<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; รหัสนิสิต : <?php echo $student[0]->Student_ID ?> </p>
			<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ - นามสกุล : <?php echo $student[0]->Student_Prefix." ".$student[0]->Student_Name_Th." ".$student[0]->Student_Lname_Th ?> </p>
			<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; หลักสูตร : <?php echo $student[0]->Course ?> </p>
			<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; สถานะ : <?php echo $student[0]->Status_Name ?> </p>
			<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; GPAX : <?php echo $student[0]->GPAX ?> </p>
			
			<button style="margin-left:20%;width:60%;float:center" type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $student_id ?>">ตรวจสอบรายวิชาที่ยังไม่ผ่าน ของรหัสวิชา 
			<?php echo $subject_code ?></button>
			
			
			<br><hr>
		  <?php } 
		
		

		if(count($result) && !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $student_id)){
		 ?>
		

		 <h1><strong><center>แสดง GPA ของรายวิชา <?php echo $subject_code ?></strong></h1>
            <hr>
		<table id="studentTable" class="table  table-bordered">
		<tr>
		<th>รหัสวิชา</th>
		<th>ชื่อวิชา</th>
		<th>เทอม</th>
		<th>ปีการศึกษา</th>
		<th>หน่วยกิต</th>
		<th>เกรดที่ได้</th>
		</tr>
		
        
		 <tr> 
			<?php $i=0; $subjectfail = array();
		 foreach ($result as $row) {
			 		if($row->Grade == 'W' || $row->Grade == 'F' || $row->Grade == 'I' || $row->Grade == '') {
					echo "<tr bgcolor=lightsalmon>";
					 } else {
						 echo "<tr>";
					 }
					echo "<td> {$row->Subject_Code} </td>";
					echo "<td> {$row->Subject_Name} </td>";
					echo "<td> {$row->Term} </td>";
					echo "<td> {$row->Year} </td>";
					echo "<td> {$row->Credit} </td>";
					echo "<td > {$row->Grade} </td>";
					
					echo "</tr>";
					?> <?php 
					
					//การคิด GPA
					if($row->Grade != '' ) 
					if($row->Grade != 'W') 
					 
					if($row->Grade != 'I') {
					
						$sumcredit += $row->Credit;
					}

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
					
					/*echo "<tr>";
					echo "<td>{$sumcredit}</td>";
					echo "</tr>";*/
		 //} ?> </tr>
			

			





		 <?php 
		 
		}
	
	
		
	 ?>
		
		</table>
		
		<?php
		if($sumcredit)
		echo "<b>หน่วยกิตทั้งหมด = {$sumcredit}</b><br />";
		if($sumcredit)
		if($grade) {
		$gpa = round($grade/$sumcredit,2);
		}
		if($gpa) {
		echo "<b>GPA = {$gpa}</b><br />";
		}
		
		
		?> 
	<div class="modal fade" id="<?php echo $student_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
>
  <div class="modal-dialog" role="document" style="margin-left:200px; min-width:900px;">
    <div class="modal-content" style="margin-left:200px; min-width:900px;">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">แสดงเกรดในรายวิชา <?php echo $subject_code ?> ของรหัสนิสิต <?php echo $rowstudent->Student_ID ?></h5>
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
			foreach($subject_fail as $row) {
			if($rowsubjectfail == $row->Subject_Code) {
			?>
				
				<div class="rTableRow">
				<div class="rTableCell"><?php echo $row->Subject_Code ?></div>
				<div class="rTableCell"><?php echo $row->Subject_Name ?></div>
				<div class="rTableCell"><?php echo $row->Credit ?></div>
				
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
		<?php
		
	} 

	else if($result && preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $student_id)) { ?>
		
		
              <h1><strong><center>แสดง GPA รายวิชา <?php echo $subject_code ?> ของรหัสนิสิต <?php echo $student_id ?></strong></h1>
							<hr>
			<!--<input class="form-control" type="text" id="search" onkeyup="myFunction()" placeholder="Search" title="Type in a name">
			
			<hr> !-->
			<button class="btn btn-info" id=showall>แสดงทั้งหมด</button>
			<button class="btn btn-info" id=notpast>แสดงเฉพาะคนที่ยังไม่ผ่าน</button>
			<button class="btn btn-info" id=past>แสดงเฉพาะคนที่ผ่านแล้ว</button>
			

			<hr />
			<div style="text-align:center ;color:red;">*คลิกที่หัวตารางเพื่อเรียงข้อมูล</div>
		<table id="example" class="table table-bordered " >
		<thead>
		<tr>
		
		<th>รหัสนิสิต</th>
		<th>ชื่อ-นามสกุล</th>
		<th>หลักสูตร</th>
		<th>หน่วยกิตรวม</th>
		<th>GPA</th>
		</tr>
		</thead>
		<?php
        $lengthstudent = count($manystudent);
		$lengthresult = count($result);
		
			?> 
			
			<?php 
			for($i = 0;$i<$lengthstudent;$i++) {
				for($j = 0;$j<$lengthresult;$j++) {	
					?>
					
					<?php
					//การคิดเกรด
					if($manystudent[$i]->Student_ID == $result[$j]->Student_ID) {
							if($result[$j]->Grade != '' )
						if( $result[$j]->Grade != 'W' ) 
						
						if($result[$j]->Grade != 'I') { 
							$sumcredit[$i] += $result[$j]->Credit;
						}

						if($result[$j]->Grade == 'F' ) {
							$grade[$i] += 0*$result[$j]->Credit;
						} else if($result[$j]->Grade == 'D') {
							$grade[$i] += 1*$result[$j]->Credit;
						} else if($result[$j]->Grade == 'D+') {
							$grade[$i] += 1.5*$result[$j]->Credit;
						} else if($result[$j]->Grade == 'C') {
							$grade[$i] += 2*$result[$j]->Credit;
						} else if($result[$j]->Grade == 'C+') {
							$grade[$i] += 2.5*$result[$j]->Credit;
						} else if($result[$j]->Grade == 'B') {
							$grade[$i] += 3*$result[$j]->Credit;
						} else if($result[$j]->Grade == 'B+') {
							$grade[$i] += 3.5*$result[$j]->Credit;
						} else if($result[$j]->Grade == 'A') {
							$grade[$i] += 4*$result[$j]->Credit;
						} else if($result[$j]->Grade == 'W') {
							$grade[$i] += 0;
						} 
						
						
					} 
				}
				
				
			} 
			
			$i=0;
			$numrows=1;
			
			?>
			
			 <tbody id='myTbody'>
			 <tr>
			  <?php 
			foreach($manystudent as $rowstudent) {
					
					if($grade[$i] == 0) {
						
					echo "<tr class='notpast' bgcolor=lightsalmon>";
					} else {
						echo "<tr class='past'>";
					}
					 
				 
					$numrows++;
					echo "<td>{$rowstudent->Student_ID}</td>";
					echo "<td>{$rowstudent->Full_Name}</td>";
					echo "<td>{$rowstudent->Course}</td>";
					
					//$sumcredits = $sumcredit[$i];
					
					$gpa = @(round($grade[$i]/$sumcredit[$i],2));
					if($sumcredit[$i] != 0) {
					echo "<td>{$sumcredit[$i]}</td>";
					} else {
						echo "<td>-</td>";
					}
					
					if(is_nan($gpa) == false) {
						echo "<td>{$gpa}</td>";
					} else   {
						echo "<td>-</td>";
					} 
					?>
					
					<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $rowstudent->Student_ID ?>">รายละเอียด</button></td>
					
					<?php
					
					echo "</tr>";
					$i++;

					?> 
					
							
							<!-- Modal -->
<div class="modal fade" id="<?php echo $rowstudent->Student_ID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
>
  <div class="modal-dialog" role="document" style="margin-left:200px; min-width:900px;">
    <div class="modal-content" style="margin-left:200px; min-width:900px;">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">แสดงเกรดในรายวิชา <?php echo $subject_code ?> ของรหัสนิสิต <?php echo $rowstudent->Student_ID ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
			<div class="rTable" id="example">
				<div class="rTableHeading">
				<div class="rTableHead"><strong>รหัสวิชา</strong></div>
				<div class="rTableHead"><strong>ชื่อวิชา</strong></div>
				<div class="rTableHead"><strong>เทอม</strong></div>
				<div class="rTableHead"><strong>ปีการศึกษา</strong></div>
				<div class="rTableHead"><strong>หน่วยกิต</strong></div>
				<div class="rTableHead"><strong>เกรดที่ได้</strong></div>
				
				</div>
				<div class="rTableBody">
		<?php 
		foreach($result as $row)
		if($rowstudent->Student_ID == $row->Student_ID) {
			?>

				<div class="rTableRow">
				<div class="rTableCell"><?php echo $row->Subject_Code ?></div>
				<div class="rTableCell"><?php echo $row->Subject_Name ?></div>
				<div class="rTableCell"><?php echo $row->Term ?></div>
				<div class="rTableCell"><?php echo $row->Year ?></div>
				<div class="rTableCell"><?php echo $row->Credit ?></div>
				<div class="rTableCell"><?php echo $row->Grade ?></div>
				</div>
				
		
			<?php }
			
		?>
      </div>
	  <br />

	  </div>
	  <div class="modal-footer">
	  
	  <?php 
	  if(is_nan($gpa) == false) {
		echo "<b>GPA</b> : {$gpa}";
	} else   {
		echo "<b>GPA</b> : -";
	} 
	   ?>
      </div>
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	  
    
  </div>
</div>				
				<?php 
					
				}
					echo "</tr>";
					?> </tr>
			</tbody>
		 <?php 
		

	
		
	 ?>
		
		</table>
		
		<?php
		$numrows = $numrows-1;
		echo "ทั้งหมด $numrows คน";
		?> 
		<span id=spanpast></span>
		<span id=spannotpast></span>
		<?php
	} else if(!$result && $student_id != '' && $subject_code != '') {
		echo '<div class=" alert alert-warning" role="alert">
			ไม่พบข้อมูล
		  </div>';
	} ?>

</div>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>


    

<script>

$(document).ready(function(){
  $('#replyb').click(function(){
    $('#reply').toggle();
  });
});







$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    }
	);
  });
});


$(document).ready(function () {
    $("#getSubjectStudents").validate({
        
        messages: {
            "student_id": {
                required: "กรุณากรอกรหัสนิสิต"
                
            },
            "subject_code": {
                required: "กรุณากรอกรหัสวิชา"
                
			},
            "course": {
                required: "กรุณาเลือกหลักสูตร"
                
			}
        }
    });

});
//$("#student_id").rules("add", { regex: "^[a-zA-Z'.\\s]{1,40}$" })





/*$(document).on('click', 'th', function() {
	$(this).toggleClass("down");
  var table = $(this).parents('table').eq(0);
  var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
  this.asc = !this.asc;
  if (!this.asc) {
    rows = rows.reverse();
  }
  table.children('tbody').empty().html(rows);
});

function comparer(index) {
  return function(a, b) {
    var valA = getCellValue(a, index),
      valB = getCellValue(b, index);
    return $.isNumeric(valA) && $.isNumeric(valB) ?
      valA - valB : valA.localeCompare(valB);
  };
}

function getCellValue(row, index) {
  return $(row).children('td').eq(index).text();
}*/
var sorted = true;
$('table#example').each(function() {
    var $table = $(this);
    $table.find('th').each(function(column) {
        var $header = $(this); 
        $header.click(function() {
            
            sorted = !sorted;

            $table.find('th').removeClass('asc desc');
            $header.addClass(sorted ? 'asc' : 'desc');

            var $rows = $table.find('tbody > tr');
            $rows.sort(function(a, b) {
                var keyA = $(a).children('td').eq(column).text().toUpperCase();
                var keyB = $(b).children('td').eq(column).text().toUpperCase();
                if (keyA > keyB) return sorted ? -1 : 1;
                if (keyA < keyB) return sorted ? 1 : -1;
                // return !sorted || (keyA > keyB) ? 1 : -1;
            });
            $rows.each(function(index, row) {
                $table.children('tbody').append(row);
            });
        });
    });
});

$('#notpast , #past').click(function(e){ 
    e.preventDefault();
		
    $('#example tbody > tr').not($('.'+this.id).show(200)).hide();
}); 

$('#showall').click(function(e){ 
    e.preventDefault();
		
    $('#example tbody > tr').show(200);
}); 

		var past = $('#example tbody tr.past').length;
		var notpast = $('#example tbody tr.notpast').length;

    $("#spanpast").append("ผ่าน "+past+ " คน");
		$("#spannotpast").append("ยังไม่ผ่าน "+notpast+ " คน");

</script>

<!--<hr>
			<input class="form-control" type="text" id="search" onkeyup="myFunction()" placeholder="Search" title="Type in a name">
			
			<hr> !-->
</html>

