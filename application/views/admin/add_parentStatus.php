<style>
meta name="viewport" content="width=device-width, initial-scale=1">
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
                <li>เพิ่มข้อมูลความสัมพันธ์ผู้ปกครอง</li>
       
            </ul>
            </div>
          </header>
  <div class="col-sm-12"><br>
          <div class="card">
            <div class="card-header">
              <h1><strong><center>เพิ่มข้อมูลความสัมพันธ์ผู้ปกครอง</strong></h1>
            </div> 
            <form role="form" action="<?php echo site_url('admin/c_admin/post_parentStatus');?>" method="post" enctype="multipart/form-data" id="file_input">
              <div id="step-1">
               <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                  <?php 
                  if($status) {
                    echo '<br>';
                    echo '<div class="alert alert-'.$status['color'].'" role="alert"> '.$status['text'].' </div>';
                  } ?>
                <div class="col-md-12 form-group" ><br>
                  <div class="form-group row">
                  <label class="col-md-12 col-form-label" for="text-input">เลือกไฟล์</label>
                      <div class="col-md-6">
                        <input type="file" id="file-input" name="file-input" required="">
                        <button type="submit" class="btn btn-sm btn-success pull-right"> Submit</button>
                      </div>
                      <img class="col-sm-4" style="max-width:1000px" src="<?php echo base_url('theme/img/gradetable.png');?>">
                      </div>                    
                  </div>         
                </div> 
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
jQuery(document).ready(function(){
    $('#file_input').validate();
})
</script>
