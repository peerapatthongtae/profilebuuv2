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
              <li><a href="<?php echo site_url('user/c_user/menu_user');?>">หน้าหลัก</a></li>
              <li><a href="<?php echo site_url('user/c_user/award_detail_user');?>">ทุนการศึกษา</a></li>
              <li>รายชื่อนิสิตในทุนการศึกษา</li>
            </ul>
            </div>
          </header>

          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="container"><br>
                  <div class="container">
                  <h1 class="no-margin-bottom"><center>ทุนการศึกษา</center></h1>
                  <br>
                  <br><hr> <h2> <?php foreach ($scholarship_name as $name) { ?>
                                                <?php echo "ชื่อทุนการศึกษา : ".$name->Scholarship_Name ?>
                                                     <?php } ?> </h2><br>
<table id="datatable" class="table table-striped table-bordered">
<thead>
            <tr>

            <th>รหัสนิสิต </th>
            <th>ชื่อ - นามสกุล </th>
            <th>หลักสูตร </th>
     
            </tr>
</thead>   
<tbody>
<?php foreach ($result1 as $row) { ?>
  <tr>
    <td><?php echo $row->Student_ID ?> </td>
    <td><?php echo $row->Student_Prefix." ".$row->Student_Name_Th." ".$row->Student_Lname_Th ?> </td>
    <td><?php echo $row->Course ?></td>    
  </tr>      
<?php } ?>

</tbody>
</table>             

  
                  </div>
                </div>
              </div>
            </div>
          </section>           


    <script>
      $(document).ready(function() {
          $('#datatable').DataTable();
      } );
    </script>

	
	