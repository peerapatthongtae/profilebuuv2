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
                <li><a href="<?php echo site_url('admin/c_admin/scholarship_student_admin');?>">ทุนการศึกษา</a></li>
                <li>แก้ไขทุนการศึกษา</li>
                 
            </ul>
            
            </div>
          </header>
          <br>
        
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>แก้ไขทุนการศึกษา</strong></h1>
            </div>
            
            <form action="<?php echo site_url("admin/c_admin/editscholarship_student_admin/".$result[0]['Scholarship_ID']);?>" method="post" id="Scholarship_form" name="Scholarship_form" onsubmit="return checkInp()"><br>
            <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>                           
           <div class="card-body">
         
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input" >ชื่อทุนการศึกษา</label>
                            <div class="col-md-3">
                            <select class="form-control" id="Scholarship_Name" name="Scholarship_Name">
                                <?php foreach(get_scholarship() as $key => $scholarship){
                                    if($result[0]['Scholarship_Name'] == $key){
                                    echo '<option value="'.$key.'" selected>'.$scholarship.'</option>';
                                    } else {
                                    echo '<option value="'.$key.'">'.$scholarship.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">ผู้มอบทุนการศึกษา</label>
                        <div class="col-md-3">
                            <input type="text" id="Scholarship_Giver" name="Scholarship_Giver" class="form-control" required=""  value="<?php echo $result[0]['Scholarship_Giver']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">ปีการศึกษา</label>
                        <div class="col-md-3">
                            <select name="Scholarship_Year" id="Scholarship_Year" onchange="open_iframe_Box()" class="form-control">
                                            <?php 
                                            $year = date('Y')+543;
                                                for($i=$year-1;$i<$year+1;$i++) {
                                                    if($i == $result[0]['Scholarship_Year']) {
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
                        <label class="col-md-3 col-form-label" for="text-input">จำนวนทุน</label>
                        <div class="col-md-3">
                            <input type="number" min="1" max="5000" id="Scholarship_Count" name="Scholarship_Count" class="form-control" required=""  value="<?php echo $result[0]['Scholarship_Count']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">จำนวนเงินทุนละ(บาท)<code>* ตัวอย่าง 5000</code></label>
                        <div class="col-md-3">
                            <input type="number" min="100" max="100000" id="Scholarship_Amount" name="Scholarship_Amount" class="form-control" required="" value="<?php echo $result[0]['Scholarship_Amount']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">รวมเป็นเงิน(บาท)<code>* ตัวอย่าง 5000</code></label>
                        <div class="col-md-3">
                            <input type="number" min="100" max="50000000" id="Scholarship_Amounttotal" name="Scholarship_Amounttotal" class="form-control" required="" value="<?php echo $result[0]['Scholarship_Amounttotal']; ?>"><br>
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
    $('#Scholarship_form').validate();
})

function checkInp()
    {
    var count=document.forms["Scholarship_form"]["Scholarship_Count"].value;
    var amount=document.forms["Scholarship_form"]["Scholarship_Amount"].value;
    var total=document.forms["Scholarship_form"]["Scholarship_Amounttotal"].value;
    var sum=count*amount;
    
    if (sum > total) 
    {
        alert("กรุณากรอกข้อมูลให้พอดีกับจำนวนเงินรวม");
        return false;
    }
    
    else if (sum < total)
    {
        alert("กรุณากรอกข้อมูลให้พอดีกับจำนวนเงินทุนละ");
        return false;
    }
    else if (sum == total && total > 500000)
    {
        return confirm("จำนวนเงินรวมเกิน 500,000 บาท จะทำการยืนยันหรือไม่");
    }
    return true;
    
    }
</script>