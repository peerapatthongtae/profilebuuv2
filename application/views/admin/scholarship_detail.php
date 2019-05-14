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
            <li><a href="<?php echo site_url('admin/c_admin/menu_admin');?>">หน้าหลัก</a></li>
                <li><a href="<?php echo site_url('admin/c_admin/scholarship_student_admin');?>">ทุนการศึกษา</a></li>
                <li>เพิ่มนิสิตในทุนการศึกษา</li>
            </ul>
            
            </div>
          </header>
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="container"> <br>
                <h1 class="no-margin-bottom"><center>เพิ่มนิสิตในทุนการศึกษา</center></h1><br>
                <form action="<?php echo site_url("admin/c_admin/insert_student_scholarship/")?>" method="post" id="scholarship_form"><br>
                <?php if ($this->session->flashdata('form_error')) {
                    echo $this->session->flashdata('form_error');
                    } ?>  
           <div class="card-body">                         
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="text-input"><b>รหัสนิสิต</b></label>
                            <div class="col-md-3">
                                <input type="hidden" id="Scholarship_ID" name="Scholarship_ID" value="<?php echo $scholarship_id;?>">
                                <textarea rows="4" cols="50" id="Student_ID" name="Student_ID" class="form-control" required=""> </textarea>                        
                            </div>     
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-sm btn-success" style="width:50px;height:40px"> บันทึก </button>
                            </div>
                    </div>
                </form>
                <br><hr> <h2> <?php foreach ($scholarship_name as $name) { ?>
                                                <?php echo "ชื่อกิจกรรม : ".$name->Scholarship_Name ?>
                                                     <?php } ?> </h2><br>
<table id="datatable" class="table table-striped table-bordered">
<thead>
            <tr>

              <th>รหัสนิสิต </th>
              <th>ชื่อ - นามสกุล </th>
              <th>หลักสูตร </th>
               
              <th></th>   
                        
            </tr>
</thead>   
<tbody>
<?php foreach ($result1 as $row) { ?>
  <tr>
        <td><?php echo $row->Student_ID ?> </td>
        <td><?php echo $row->Student_Prefix." ".$row->Student_Name_Th." ".$row->Student_Lname_Th ?> </td>
        <td><?php echo $row->Course ?></td>
        <td><center>
        <form action="<?php echo site_url('admin/c_admin/delete_scholarship_has_scholarship/'.$row->Scholarship_ID);?>" method="post" onsubmit="return confirm('คุณต้องการลบใช่หรือไม่ ?');">
          <input type="hidden" id="Scholarship_ID" name="Scholarship_ID" value="<?php echo $scholarship_id; ?>">
          <input type="hidden" id="Student_ID" name="Student_ID" value="<?php echo $row->Student_ID; ?>">
          <button type="submit" class="btn btn-danger btn-sm" >ลบ</button></a>
          </form>
        </center></td>
      

    
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

      jQuery(document).ready(function(){
    $('#scholarship_form').validate();
    })
    </script>

	
	