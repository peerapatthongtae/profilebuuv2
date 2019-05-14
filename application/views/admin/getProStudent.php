<?php
session_start();
header("Cache-control: private");
ini_set('memory_limit', '2048M');
?>
<html>
<style>
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
                <li>รายชื่อนิสิตรอพินิจโดยค้นหาจากรหัสนิสิต</li>
				
            </ul>
            </div>
          </header>
          <br>
	<body>
	<div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>รายชื่อนิสิตรอพินิจโดยค้นหาจากรหัสนิสิต</strong></h1>
            </div>

    <div class="card-body">    
	<div class="container">  
    <div class="row">
	
	
		<form id= "getProStudent" action="<?php echo site_url("admin/c_admin/getProStudent/")?>" method ="post">
        <br><br><br><br>
		<div class="form-group">
      <label for="student_id">รหัสนิสิต :</label>
      <input type="text" class="form-control" id="student_id" name="student_id"  required>
    </div>
    <label for="course">หลักสูตร :</label>   
    <div class="form-inline" style="padding:15px">
		 
		<select class="form-control" name="course" id="course">
										
											<option value="">ทุกหลักสูตร</option>
                                        
                                    <?php
                                        foreach($allCourse as $row) {   ?>
                                        <option value="<?php echo $row->Course_Name ?>"><?php echo $row->Course_Name ?> </option>
                                      <?php  }
                                    ?>
                                </select>


		</div>

        <div class="form-inline" style="padding:15px">
        เทอม : &nbsp;&nbsp;&nbsp;&nbsp;
		<select class="form-control" name="term" required id="term">
                                            
										<?php if(!$term) { ?>
                                        <option value="">---------</option>
										<?php } else { ?>
                                            <option value=<?php echo $term ?>><?php echo $term ?></option>
											<option value="">---------</option>
                                        <?php } ?>
                                    <?php
                                        foreach($allterm as $row) {   ?>
                                        <option value="<?php echo $row->Gpa_Term ?>"><?php echo $row->Gpa_Term ?> </option>
                                      <?php  }
                                    ?>
                                </select>
                                &nbsp;&nbsp;&nbsp;&nbsp; ปีการศึกษา : &nbsp;&nbsp;&nbsp;&nbsp;
                                <select class="form-control" name="year" required id="year">
										<?php if(!$year) { ?>
                                        <option value="">---------</option>
										<?php } else { ?>
                                            <option value=<?php echo $year ?>><?php echo $year ?></option>
											<option value="">---------</option>
                                        <?php } ?>
                                    <?php
                                        foreach($allyear as $row) {   ?>
                                        <option value="<?php echo $row->Gpa_Year ?>"><?php echo $row->Gpa_Year ?> </option>
                                      <?php  }
                                    ?>
                                </select>


		</div>
    	
		<button id="button" class="btn btn-info" type="submit">เรียกดูข้อมูล</button>

		</form>
		
		<br />
		</div>
		</div>
		</div>
		</div>

        <?php if($resultstudent) { ?>
            <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
            <h1><strong><center><?php echo 'รหัสนิสิต '.$student_id.' เทอม '.$term.' ปีการศึกษา '.$year ?> </strong></h1> 
            </div>

    <div class="card-body"> 
    
    <hr />
    <div id=submittername></div> 
    
    <div id=countstatus></div>
    <hr />
    <div style="text-align:center ;color:red;">*คลิกที่หัวตารางเพื่อเรียงข้อมูล</div>
	<div class="container"> 
    
    

    <div class="row">
            <hr />
            
    
            <br />
            
        <table id="example" class="table table-bordered sortable" >
		<thead>
		<tr>
		
		<th >รหัสนิสิต</th>
		<th >ชื่อ-นามสกุล</th>
		<th >หลักสูตร</th>
		<th >สถานะ</th>
        <th id="facility_header">PRO_NAME</th>
		
		</tr>
        </thead>
        <tbody>
        <?php foreach ($resultstudent as  $row) { ?>
                        
                        <tr>
                          
                        
                          <td width="10%" align="CENTER"><?php echo $row->Student_ID ?> </td>
                          <td align="CENTER"><?php echo $row->Full_Name ?> </td>
                          <td align="CENTER"><?php echo $row->Course ?> </td>
                          <td align="CENTER"><?php echo $row->Status_Name ?> </td>
                          <td align="CENTER"><?php echo $row->Pro_Name ?> </td>
                          <td>
                          <?php 
                          echo "<a href='".site_url('admin/c_admin/detail_pro_student/'.$row->Student_ID)."'>";
              echo "<button type='submit' class='btn btn-primary btn-sm'>"."ประวัติการพินิจ"."</button>";
              echo "</a> "; ?>
                          </td>

                          </tr>
        <?php } ?>
        </tbody>
        </table>
        

        </div>
		</div>
		</div>
    <?php } else if(!$resultstudent && $student_id != '' ) {
		echo '<div class=" alert alert-warning" role="alert">
			ไม่พบข้อมูล
		  </div>';
	} ?> 

            </body>
    </html>
    

    <script>
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

var rowCount = $('#example tbody tr').length;

    
    $("#submittername").append("ทั้งหมด "+rowCount+ " คน");

    function count()
{
var map = {};

$("tbody tr td:nth-child(5)").each(function (i, val) {
    var key = $(val).text();
    if (key in map) map[key] = map[key] + 1;
    else map[key] = 1;
});

var result = '';
for (var key in map) {
    result += key + ' : ' + map[key] + ' คน <br />';
}
$("#countstatus").append(result);
}

count();

$(document).ready(function () {
    $("#getProStudent").validate({
        
        messages: {
            "course": {
                required: "กรุณาเลือกหลักสูตร"
                
            },
            "student_id": {
                required: "กรุณากรอกรหัสนิสิต"
                
            },
            "term": {
                required: " กรุณาเลือกเทอม"
                
            },
            "year": {
                required: " กรุณาเลือกปี"
                
            }
        }
    });

});

    </script>