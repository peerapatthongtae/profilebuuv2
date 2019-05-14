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
                <li>แสดงรายชื่อนิสิตรอพินิจ ไม่รอพินิจ แยกตามภาคการศึกษา และปีการศึกษา</li>
				
            </ul>
            </div>
          </header>
          <br>
	<body>
	<div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>ประวัติการพินิจของ <?php echo $result[0]->Student_ID ?></strong></h1>
            </div>

    <div class="card-body">    
	<div class="container">  
    <div class="row">
    <table id="example" class="table table-bordered " >
		<thead>
		<tr>
		
		<th>เทอม</th>
		<th>ปีการศึกษา</th>
		<th>Pro_Name</th>
        <th>GPAX Term</th>
		<th>สถานะในเทอมนั้น</th>
		
		</tr>
        </thead>
        <tbody>
        <?php foreach ($result as  $row) { ?>
                        
                        <tr>
                          
                          
                          <td width="10%" align="CENTER"><?php echo $row->Gpa_Term ?> </td>
                          <td align="CENTER"><?php echo $row->GPA_Year ?> </td>
                          <td align="CENTER"><?php echo $row->Pro_Name ?> </td>
                          <td align="CENTER"><?php echo $row->GPAX_Term ?> </td>
                          <td align="CENTER"><?php echo $row->Status_Term ?> </td>
                          

                          </tr>
        <?php } ?>
        </tbody>
        </table>
        

        </div>
		</div>
		</div>