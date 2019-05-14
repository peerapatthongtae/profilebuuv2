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
                <li>แก้ไขรางวัลการแข่งขัน</li>
                  
            </ul>
            
            </div>
          </header>
          <br>
        
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>แก้ไขรางวัล</strong></h1>
            </div>
            
            <form action="<?php echo site_url("admin/c_admin/editaward_student_admin/".$result[0]['Award_ID']);?>" method="post" id="Award_form" name="Award_form" onsubmit="return checkInp()"><BR>
            <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>  
           <div class="card-body">        
           <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="text-input">วัน / เดือน / ปี</label>
                                <div class="col-md-3">
                                    <input type="date" id="Award_Date" name="Award_Date" class="form-control" required="" value="<?php echo $result[0]['Award_Date']; ?>">
                                </div>  
                        </div> 
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input" >ชื่อรางวัล</label>
                            <div class="col-md-3">
                                <input type="text" id="Award_Name" name="Award_Name" class="form-control" required="" value="<?php echo $result[0]['Award_Name']; ?>">
                            </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">เทอม</label>
                            <div class="col-md-3">
                                <select id="Award_Term" name="Award_Term" class="form-control" >                                    
                                    <?php foreach(get_terms() as $key => $term){
                                        if($result[0]['Award_Term'] == $key){
                                            echo '<option value="'.$key.'" selected> '.$term.' </option>';                                          
                                        } else {
                                            echo '<option value="'.$key.'" > '.$term.' </option>';
                                        }
                                     } ?>
                                    
                                </select>
                            </div>                           
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">ปีการศึกษา</label>
                        <div class="input-group col-md-3" >     
                            <select name="Award_Year" onchange="open_iframe_Box()" class="form-control">
                                <?php
                                    $year = date('Y')+543;
                                    //++ year
                                    for($i=$year-5;$i<$year+2;$i++) {
                                        if($i == $result[0]['Award_Year']) {
                                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                        } else {
                                            echo '<option value="'.$i.'">'.$i.'</option>';		
                                        }
                                    }
                                ?>
                            </select>                       
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">อาจารย์ที่ปรึกษารางวัล</label>
                        <div class="col-md-3">
                            <input type="text" id="Award_Giver" name="Award_Giver" class="form-control" required=""  value="<?php echo $result[0]['Award_Giver']; ?>"><br>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">เงินรางวัล(บาท)<code>* ตัวอย่าง 5000</code></label>
                        <div class="col-md-3">
                            <input type="number" min="1" max="100000" id="Award_Amount" name="Award_Amount" class="form-control" required="" value="<?php echo $result[0]['Award_Amount']; ?>"><br>
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

function checkInp()
{
  var x=document.forms["Award_form"]["Award_Amount"].value;
  if (x > 10000) 
  {
    return confirm("ยืนยันจะกรอกเงินรางวัลที่มากกว่า 10,000 บาทหรือไม่");
  }

  return true;
}
</script>
