<?php
session_start();
header("Cache-control: private");
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
      </style>
      <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
            <li><a href="<?php echo site_url('admin/c_admin/menu_admin');?>">หน้าหลัก</a></li>
                <li>จำนวนนิสิตแยกตามสถานะนิสิต</li>
                
            </ul>
            </div>
          </header>
          <br>
	<body>
    
    
    <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>จำนวนนิสิตแยกตามสถานะนิสิต</strong></h1>
            </div>

            



            <div class="card-body">
              <div class="container">
                <div class="row">
                <div class="col-md-15"> 
                <center>
                  <label class="col-md-3 col-form-label" for="text-input"><b>ปีการศึกษาที่เข้า</b></label>
                  
                  <form id="getAmountStudentStatus" action="<?php echo site_url("admin/c_admin/getAmountStudentStatus")?>" method ="post">                           
                    <div id="custom-search-input"> 
                        <div class="input-group col-md-5">
                         
                                <select class="form-control" name="years" id="years">
                                        <option value="">---------</option>
                                    <?php
                                        foreach($static as $row) {   ?>
                                        <option value="<?php echo $row['Stat_Years'] ?>"><?php echo $row['Stat_Years'] ?> </option>
                                      <?php  }
                                    ?>
                                </select>  
                                
                                 
                                     &nbsp;&nbsp;
                                <button id="button" class="btn btn-primary">ค้นหา</button>
                                </div>
                                <br />
                                <label class="col-md-3 col-form-label" for="text-input"><b>หลักสูตร</b></label>
                                <div class="form-inline" style="margin-left:27%;margin-bottom:20px;">
		 
		<select class="form-control" name="course" id="course">
										
                                        
                                            
											<option value="">ทุกหลักสูตร</option>
                                        
                                    <?php
                                        foreach($allCourse as $row) {   ?>
                                        <option value="<?php echo $row->Course_Name ?>"><?php echo $row->Course_Name ?> </option>
                                      <?php  }
                                    ?>
                                </select>


		</div>
                                </center>

                               
                    
                    <table cellpadding="0" cellspacing="5"> 
                    
        <tr>
        <td></td>
        <td><input type="checkbox" name="select-all" id="select-all" autocomplete="off" >ทั้งหมด</td>
        <?php $yearspresent = $static[0]['Stat_Years']; ?>
       
        
        <td></td>
        </tr>
        
        <tr>
        <td class="left"><input type="checkbox" name="10" id="checkbox[]" value="กำลังศึกษา">กำลังศึกษา</td>
        <td class="left"><input type="checkbox" name="11" id="checkbox[]" value="รักษาสภาพ">รักษาสภาพ</td>
        <td class="left"><input type="checkbox" name="12" id="checkbox[]" value="ลาพัก">ลาพัก</td>
        <td class="left"><input type="checkbox" name="40" id="checkbox[]" value="สำเร็จการศึกษา">สำเร็จการศึกษา</td>
        </tr>
        <tr>
        
        <td class="left"><input type="checkbox" name="45" id="checkbox[]" value="ย้ายกลับประเทศ(ครบกำหนดตามโครงการ)">ย้ายกลับประเทศ(ครบกำหนดตามโครงการ)</td>
        <td class="left"><input type="checkbox" name="50" id="checkbox[]" value="ลาออก">ลาออก</td>
        <td class="left"><input type="checkbox" name="51" id="checkbox[]" value="ไม่มารายงานตัว">ไม่มารายงานตัว</td>
        <td class="left"><input type="checkbox" name="52" id="checkbox[]" value="ไม่ผ่านสัมภาษณ์">ไม่ผ่านสัมภาษณ์</td>
        </tr>
        <tr><td></td></tr><tr><td></td></tr>
        <tr>
        <td></td>
        <td><input type="checkbox" name="retire-all" id="retire-all" autocomplete="off" >พ้นสภาพทั้งหมด</td>
        
        </tr>

        <tr>
        <td class="left"><input type="checkbox" class = "retire[]" name="69" id="checkbox[]" value="พ้นสภาพ-คัดชื่อออก">พ้นสภาพ-คัดชื่อออก</td>
        <td class="left"><input type="checkbox" class = "retire[]" name="60" id="checkbox[]" value="พ้นสภาพ-คะแนนเฉลี่ยสะสมไม่ถึง">พ้นสภาพ-คะแนนเฉลี่ยสะสมไม่ถึง</td>
        <td class="left"><input type="checkbox" class = "retire[]" name="61" id="checkbox[]" value="พ้นสภาพ-ระยะเวลาเกินกำหนด">พ้นสภาพ-ระยะเวลาเกินกำหนด</td>
        <td class="left"><input type="checkbox" class = "retire[]" name="62" id="checkbox[]" value="พ้นสภาพ-วิชาฝึกงานไม่ผ่าน">พ้นสภาพ-วิชาฝึกงานไม่ผ่าน</td>
        </tr>
        <tr>
        <td class="left"><input type="checkbox" class = "retire[]" name="63" id="checkbox[]" value="พ้นสภาพ-ไม่มาชำระเงิน">พ้นสภาพ-ไม่มาชำระเงิน</td>
        <td class="left"><input type="checkbox" class = "retire[]" name="64" id="checkbox[]" value="พ้นสภาพ-ไม่ลงทะเบียนภาคเรียนแรก">พ้นสภาพ-ไม่ลงทะเบียนภาคเรียนแรก</td>
        <td class="left"><input type="checkbox" class = "retire[]" name="65" id="checkbox[]" value="พ้นสภาพ-ขาดคุณสมบัติ">พ้นสภาพ-ขาดคุณสมบัติ</td>
        <td class="left"><input type="checkbox" class = "retire[]" name="68" id="checkbox[]" value="พ้นสภาพ-ให้ออก">พ้นสภาพ-ให้ออก</td>
        </tr>
        <tr><td></td></tr><tr><td></td></tr>
        <tr>
        
        
        <td class="left"><input type="checkbox" name="80" id="checkbox[]" value="ย้ายออก">ย้ายออก</td>
        <td class="left"><input type="checkbox" name="81" id="checkbox[]" value="ย้ายวิทยาเขต">ย้ายวิทยาเขต</td>
        <td class="left"><input type="checkbox" name="82" id="checkbox[]" value="ย้ายคณะ">ย้ายคณะ</td>
        </tr>
        <tr>
        <td class="left"><input type="checkbox" name="53" id="checkbox[]" value="สละสิทธิ์ (Quota)">สละสิทธิ์ (Quota)</td>
        <td class="left"><input type="checkbox" name="83" id="checkbox[]" value="ย้ายระดับ">ย้ายระดับ</td>
        <td class="left"><input type="checkbox" name="90" id="checkbox[]" value="เสียชิวิต">เสียชีวิต</td>
        </tr>
        </table>
         </fieldset>
         <?php 
         $years2previous = ($yearspresent).",".($yearspresent-1);
         $years3previous = ($yearspresent).",".($yearspresent-1).",".($yearspresent-2)  ;    
         $years4previous = ($yearspresent).",".($yearspresent-1).",".($yearspresent-2).",".($yearspresent-3)  ; 
         $years5previous = ($yearspresent).",".($yearspresent-1).",".($yearspresent-2).",".($yearspresent-3).",".($yearspresent-4)  ; 
                ?>
                <hr>
         <button class="btn btn-info" name="years" type="submit" value = <?php echo $years2previous ?>>เรียกดูข้อมูล 2 ปีย้อนหลัง</button>
         <button class="btn btn-info" name="years" type="submit" value = <?php echo $years3previous ?>>เรียกดูข้อมูล 3 ปีย้อนหลัง</button>
         <button class="btn btn-info" name="years" type="submit" value = <?php echo $years4previous ?>>เรียกดูข้อมูล 4 ปีย้อนหลัง</button>
         <button class="btn btn-info" name="years" type="submit" value = <?php echo $years5previous ?>>เรียกดูข้อมูล 5 ปีย้อนหลัง</button>
		</form>

        

        
                      
                            </div> 
                    <!-- </form> -->
                        </div>
                    </div>     

                        </div></div> <br>


                                                           
        <?php 
        
            if($_POST['select-all']) { ?>
                <script>
                $('input:checkbox[name=select-all]').each(function() {
                    this.checked = true;                        
                });
                </script> 
          <?php  } 
            

                if($_POST['retire-all']) { ?>
                    <script>
                    $('input:checkbox[name=retire-all]').each(function() {
                        this.checked = true;                        
                    });
                    </script> 
               <?php } 
        foreach($allstatus as $row) {
            if($_POST[$row->Status_ID]) { ?>
                <script>
                    $('input:checkbox[name=<?php echo $row->Status_ID ?>]').each(function() {
                        this.checked = true;                        
                    });
                    </script> 
            <?php }
            
        }
        if($years && strlen($years) == 4) {
            if($course != '') {
                $courseid = explode(":", $course);
                $courseid = $courseid[0];
                } else {
                    $courseid = 'all';
                }
            ?>
        
            
            <div class="card">
            <div class="card-header">
              <h1><strong><center>ปีการศึกษา <?php echo $years ?>
              <?php if($course != '') {
                  echo "หลักสูตร {$course}";
              } ?>
              </strong></h1>
            </div>
                        <div class="card-body">
              <div class="container">
        
		<table id="example" class="table table-bordered datatable" width="100%">
                <tr>
                    <th rowspan="2">สถานะ</th>
                    <th colspan=2>ปริญญาตรี</th>
                    <th colspan=2>ปริญญาโท</th>
                    <th>ปริญญาเอก</th>
                    <th rowspan=2>รวมทั้งหมด</th>
                </tr>
                <tr>
                    <th>ปกติ</th>
                    <th>พิเศษ</th>
                    <th>ปกติ</th>
                    <th>พิเศษ</th>
                    <th >ปกติ</th>
                </tr>
                
                <tr>    
            
                <?php
                
                
                foreach($allstatus as $rowallstatus) {
                if ($_POST[$rowallstatus->Status_ID]) {
                    
                    ?>
                      
                        <tr><th><?php echo $rowallstatus->Status_Name ?></th>
                            <?php
                            
                           for($i=0;$i<count($status[$rowallstatus->Status_ID]);$i++) {
                               
                             foreach($status[$rowallstatus->Status_ID][$i] as $row) {
                                echo "<td>";
                                ?> 
                                <?php if($row->Count!= "-") {
                             echo "<a href='".site_url('admin/c_admin/student_has_status/'.$row->Status_ID.'/'.str_replace(' ','',$years).'/'.$courseid.'/'
                             .$row->Level)."'>";
                                }
                                echo $row->Count;
                                $sumcount[$rowallstatus->Status_ID] += $row->Count;
                                
                            echo "</td>";
                                }
                            
                         } echo "<td>".$sumcount[$rowallstatus->Status_ID]."</td>"; ?>
                        
                        </tr>
                        
                
                        <?php $sumcountall += $sumcount[$rowallstatus->Status_ID]; ?>
                        <?php   
                } 
            } 
        
        

                ?> <tr><th colspan=6>ทั้งหมด</th> 

                <td><?php echo $sumcountall ?></td>
                </tr>
       
                </tr>
                </table>  <?php }  
                if($years && strlen($years) != 4) {
                    if($course != '') {
                    $courseid = explode(":", $course);
                    $courseid = $courseid[0];
                    } else {
                        $courseid = 'all';
                    }
                    echo "<br />";
        
        
        ?>
        
        <div class="card">
            <div class="card-header">
            <h1><strong><center>ปีการศึกษา <?php echo $years ?>
              <?php if($course != '') {
                  echo "หลักสูตร {$course}";
              } ?>
              </strong></h1>
            </div>
                        <div class="card-body">
              <div class="container">
              <table id="example" class="table table-bordered datatable" width="100%">
                <tr>
                    <th rowspan="2">สถานะ</th>
                    <th rowspan="2">ปี</th>
                    <th colspan=2>ปริญญาตรี</th>
                    <th colspan=2>ปริญญาโท</th>
                    <th>ปริญญาเอก</th>
                    <th rowspan=2>รวมทั้งหมด</th>
                </tr>
                <tr>
                    <th>ปกติ</th>
                    <th>พิเศษ</th>
                    <th>ปกติ</th>
                    <th>พิเศษ</th>
                    <th >ปกติ</th>
                </tr>
                
                
                <?php
                foreach($allstatus as $rowallstatus) {
                 if($_POST[$rowallstatus->Status_ID]) { ?>     
            
            <tr><th rowspan=<?php echo count($yearsprevious)+1 ?> style="padding-top:4%;"><?php echo $rowallstatus->Status_Name ?></th>
            
                <?php
                 
                
                $sumcount = array();
                
                ?>
                
                
                <?php
                
                $j=0;
                for($i=0;$i<count($status[$rowallstatus->Status_ID]);$i++) {
                    ?> <th><?php echo $yearsprevious[$i] ?></th> 
                    <?php 
                for($j=0;$j<count($status[$rowallstatus->Status_ID][$i]);$j++) { 
                    
                    ?>
                    
                    
                    <?php  
                    
                    echo "<td>"; 
                    if($status[$rowallstatus->Status_ID][$i][$j][0]->Count!= "-") {
                        echo "<a href='".site_url('admin/c_admin/student_has_status/'.$status[$rowallstatus->Status_ID][$i][$j][0]->Status_ID.'/'.$status[$rowallstatus->Status_ID][$i][$j][0]->Entry_Years
                        .'/'.$courseid.'/'.$status[$rowallstatus->Status_ID][$i][$j][0]->Level)."'>";
                           }
                        echo $status[$rowallstatus->Status_ID][$i][$j][0]->Count;
                    
                        $sumcount[$i] += $status[$rowallstatus->Status_ID][$i][$j][0]->Count;

                        
                        $sumcountlevel[$rowallstatus->Status_ID][$j] +=  $status[$rowallstatus->Status_ID][$i][$j][0]->Count;
                        
                            echo "</td>";
 
                       
                    }  echo "<td>{$sumcount[$i]}</td>";
                    
                    
                    echo "<tr>"; 
                    $sumcountstatus[$rowallstatus->Status_ID]+=$sumcount[$i];
                }

            ?> <th bgcolor="#E0FFFF">รวม</th>
            <?php for($i=0;$i<count($sumcountlevel[$rowallstatus->Status_ID]);$i++) { 
                if($sumcountlevel[$rowallstatus->Status_ID][$i] == 0) {
                ?>
            <td bgcolor="#E0FFFF"><?php echo '-' ?></td>
                <?php } else { ?>
            <td bgcolor="#E0FFFF"><?php echo $sumcountlevel[$rowallstatus->Status_ID][$i]; ?></td>
                <?php } ?>
            <?php } ?>
            <td bgcolor="#E0FFFF"><?php echo $sumcountstatus[$rowallstatus->Status_ID] ;?></td>
            
            <?php $sumcountall += $sumcountstatus[$rowallstatus->Status_ID]; ?>
            </tr>
            
            </tr>
            
            <?php } 
            } ?>

                <tr><th colspan=7>ทั้งหมด</th> 

                <td><?php echo $sumcountall ?></td>
                </tr>

                </tr>
                </table>
                <p style="color:red;font-weight:bold;">        
        *การรวมนิสิตได้รวมจำนวนนิสิตที่เปลี่ยนรหัสจากภาคพิเศษมาปกติด้วย  
        </p>
                 <?php }
              ?>
        

        
        
         
		</div>
		</div>
        </body>
</html>

        <script>
        

            $('#select-all').click(function(event) {   
            if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});

$('input[id="checkbox[]"]').change(function(){
    if ($('input[id="checkbox[]"]:checked').length != $('input[id="checkbox[]"]').length) {
        $('#select-all').each(function() {
            this.checked = false;                        
        });
    } else {
        $('#select-all').each(function() {
            this.checked = true;                        
        });
    }
});


$('input[class="retire[]"]').change(function(){
    if ($('input[class="retire[]"]:checked').length != $('input[class="retire[]"]').length) {
        $('#retire-all').each(function() {
            this.checked = false;                        
        });
        
    } else {
        $('#retire-all').each(function() {
            this.checked = true;                        
        });
    }
});


$('button').click(function () {
    if ($('input[id="checkbox[]"]:checked').length <= 0) {
        alert('กรุณาเลือกสถานะที่ต้องการค้นหา');
        return false;
    }
});



$('button[id=button]').click(function () {
    if( !$('#years').val() ) { 
        alert('กรุณาเลือกปีการศึกษา');
        return false;
    }
});

$('#retire-all').change(function () {
    if ($(this).prop('checked')) {
    $('input:checkbox[name=60]').prop('checked', true);
    $('input:checkbox[name=61]').prop('checked', true);
    $('input:checkbox[name=62]').prop('checked', true);
    $('input:checkbox[name=63]').prop('checked', true);
    $('input:checkbox[name=64]').prop('checked', true);
    $('input:checkbox[name=65]').prop('checked', true);
    $('input:checkbox[name=68]').prop('checked', true);
    $('input:checkbox[name=69]').prop('checked', true);
    }
    else {
        $('input:checkbox[name=60]').prop('checked', false);
        $('input:checkbox[name=61]').prop('checked', false);
        $('input:checkbox[name=62]').prop('checked', false);
        $('input:checkbox[name=63]').prop('checked', false);
        $('input:checkbox[name=64]').prop('checked', false);
        $('input:checkbox[name=65]').prop('checked', false);
        $('input:checkbox[name=68]').prop('checked', false);
        $('input:checkbox[name=69]').prop('checked', false);
    }
});
$('#selectall').trigger('change');

        </script>




        
        
