<style>
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
                <li><a href="<?php echo site_url('admin/c_admin/award_student_admin');?>">รางวัลการแข่งขัน</a></li>
                <li><a href="<?php echo site_url('admin/c_admin/insert_form_student_award');?>">เพิ่มรายชื่อรางวัลการแข่งขัน</a></li>
            </ul>
            </div>
          </header>
          <br>
          <br>
        
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
                
              <strong><center>เพิ่มรายชื่อนิสิตในรางวัลการแข่งขัน</strong>
            </div>
            <form action="<?php echo site_url("admin/c_admin/insert_student_award/")?>" method="post" id="Award_form"><BR>          
            <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
           <div class="card-body"><br>
                <form action="<?php echo site_url('admin/c_admin/insert');?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">วัน / เดือน / ปี</label>
                            <div class="col-md-3">
                                <input type="date" id="Award_Date" name="Award_Date" class="form-control" required="">
                            </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">รหัสนิสิต</label>
                            <div class="col-md-3">
                                <input type="hidden" id="Award_ID" name="Award_ID" value="<?php echo $award_id;?>">
                                <input type="text" id="Student_ID" name="Student_ID" class="form-control" required="">
                                
                            </div>
                    </div>
                    <div class="text-center">
                            <button type="reset" class="btn btn-sm btn-danger"> ยกเลิก </button>
                            <button type="submit" class="btn btn-sm btn-success"> บันทึก </button>
                            
                    </div>
                </form>
            </div>
        </div>
    </div>
</Body>

<script>
jQuery(document).ready(function(){
    $('#Award_form').validate();
})
</script>
