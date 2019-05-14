<style>

table {
    width:60%;
}
th, td {
    padding: 5px;
    text-align: left;
}

.button {
    background-color: #4CAF50;
    border: 1;
    color: white;
    padding: 5px 22px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
.button {border-radius: 8px;}
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
                <li>เพิ่มรายชื่อทุนการศึกษา</li>
                 
            </ul>
            
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                <h1><strong><center>เพิ่มทุนการศึกษา</strong></h1>
                </div>
                    <div class="card-body">
                        <form action="<?php echo site_url("admin/c_admin/insert_scholarship/")?>" method="post" id="Scholarship_form" name="Scholarship_form" onsubmit="return checkInp()"><br>
                        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>                           
                            <div class="row">
                                <div class="container">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="text-input">ชื่อทุนการศึกษา</label>
                                            <div class="col-md-3">
                                            <select id="Scholarship_Name" name="Scholarship_Name" class="form-control">
                                                <option value="ทุนผลการเรียนดีเด่น">ทุนผลการเรียนดีเด่น</option>
                                                <option value="ทุนกิจกรรม">ทุนกิจกรรม</option>
                                                <option value="ทุนขาดแคลนทุนทรัพย์">ทุนขาดแคลนทุนทรัพย์</option>
                                            </select>
                                            </div>
                                    </div>   

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="text-input">ผู้มอบทุนการศึกษา</label>
                                            <div class="col-md-3">
                                                <input type="text" id="Scholarship_Giver" name="Scholarship_Giver" class="form-control" required="">
                                            </div>
                                    </div>
                    
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="text-input">ปีการศึกษา</label>
                                            <div class="col-md-3">
                                            <select name="Scholarship_Year" id="Scholarship_Year" onchange="open_iframe_Box()" class="form-control">
                                            <?php
                                                $year = date('Y')+543;
                                                //++ year
                                                for($i=$year-1;$i<$year+1;$i++) {
                                                    if($i == $year) {
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
                                                <input type="number" min="1" max="5000" required="" id="Scholarship_Count" name="Scholarship_Count" class="form-control">
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="text-input">จำนวนเงินทุนละ(บาท)<code>* ตัวอย่าง 5000</code></label>
                                            <div class="col-md-3">
                                                <input type="number" min="100" max="100000" required="" id="Scholarship_Amount" name="Scholarship_Amount" class="form-control">
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="text-input">รวมเป็นเงิน<code>* ตัวอย่าง 5000</code></label>
                                            <div class="col-md-3">
                                                <input type="number" min="100" max="50000000" required="" id="Scholarship_Amounttotal" name="Scholarship_Amounttotal" class="form-control">
                                            </div>
                                    </div>

                                    <center>
                                    <button type="reset" class="btn btn-sm btn-danger"> ยกเลิก </button>
                                    <button type="submit" class="btn btn-sm btn-success"> บันทึก </button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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