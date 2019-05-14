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
<Body>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
          <ul class="breadcrumb">
                <li><a href="<?php echo site_url('admin/c_admin/menu_admin');?>">หน้าหลัก</a></li>
                <li><a href="<?php echo site_url('admin/c_admin/scholarship_student_admin');?>">ทุนการศึกษา</a></li>
                <li>เพิ่มรายชื่อนิสิตในทุนการศึกษา</li>
            </ul>
            </div>
          </header>
          <br>
        
        <div class="col-sm-12">
          <div class="card">
           
            <strong><center>เพิ่มรายชื่อนิสิตในทุนการศึกษา</strong>
            <form action="<?php echo site_url("admin/c_admin/insert_student_scholarship/")?>" method="post" >
           <div class="card-body">
                <form action="<?php echo site_url('admin/c_admin/insert');?>" method="post" enctype="multipart/form-data" class="form-horizontal"><br>
                <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>                           
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">วัน / เดือน / ปี</label>
                            <div class="col-md-3">
                                <input type="date" id="Scholarship_Date" name="Scholarship_Date" class="form-control" required="">
                            </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">รหัสนิสิต</label>
                            <div class="col-md-3">
                                <input type="hidden" id="Scholarship_ID" name="Scholarship_ID" value="<?php echo $scholarship_id;?>">
                                <input type="text" id="Student_ID" name="Student_ID" class="form-control" required="">
                                
                            </div>
                    </div>
                    <div class="text-center">
                            <button type="reset" class="btn btn-sm btn-danger"> ยกเลิก </button>
                            <button type="submit" class="btn btn-sm btn-success"> ตกลง </button>
                            
                    </div>
                </form>
            </div>
        </div>
    </div>
</Body>
