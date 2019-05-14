<style>
table {
    width:100%;
}
th {
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
                <li>ข้อมูลนิสิต</li>
            </ul>
            </div>
          </header>
          <br>
        <Body>
<div class="col-sm-12">
  <div class="card">
    <div class="card-header">
      <strong><center>ข้อมูลทั่วไป</strong>
    </div>
    <div class="card-body">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>ชื่อ - นามสกุล (ภาษาไทย) </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="name_th"><b>:</b> <?php echo $result['Student_Prefix'] ?> <?php echo $result['Student_Name_Th'] ?> <?php echo $result['Student_Lname_Th'] ?> </p>
        </div>
        <label class="col-sm-2 col-form-label"><b>ชื่อ - นามสกุล (ภาษาอังกฤษ) </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="name_eng"><b>:</b> <?php echo $result['Student_Name_Eng'] ?> <?php echo $result['Student_Lname_Eng'] ?> </p>
        </div>
    </div>   

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>ชื่อเล่น </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="nickname"><b>:</b> <?php echo $result['Student_Nickname'] ?></p>
        </div>
        <label class="col-sm-2 col-form-label"><b>เลขประจำตัวประชาชน </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="idnum"><b>:</b> <?php echo $result['Student_IdNum'] ?></p>
        </div>
    </div>   

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>วัน เดือน ปี เกิด </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="birthday"><b>:</b> <?php echo thaiDate($result['Birthday'], true, false) ?> </p>
        </div>
        <label class="col-sm-2 col-form-label"><b>กรุ๊ปเลือด </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="blood"><b>:</b> <?php echo $result['Blood'] ?></p>
        </div>
    </div>     

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>สัญชาติ </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="nationality"><b>:</b> <?php echo $result['Nationality'] ?> </p>
        </div>
        <label class="col-sm-2 col-form-label"><b>ศาสนา </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="relidion"><b>:</b> <?php echo $result['Relidion'] ?></p>
        </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>Facebook </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="facebook"><b>:</b> <?php echo $result['Facebook'] ?> </p>
        </div>
        <label class="col-sm-2 col-form-label"><b>Line </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="line"><b>:</b> <?php echo $result['Line'] ?></p>
        </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>E-mail </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="e_mail"><b>:</b> <?php echo $result['Student_Email'] ?> </p>
        </div>
      <label class="col-sm-2 col-form-label"><b>เบอร์โทรศัพท์ </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="student_phone"><b>:</b> <?php echo $result['Student_Phone'] ?> </p>
        </div>
    </div>            

    </div>               
  </div>

        <div class="card">
    <div class="card-header">
      <strong><center>ข้อมูลด้านการศึกษา</strong>
    </div>
    <div class="card-body">

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>ปีการศึกษาที่เข้า </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="entry_years"><b>:</b> <?php echo $result['Entry_Years'] ?> </p>
        </div>
        <label class="col-sm-2 col-form-label"><b>วุฒิก่อนเข้าการศึกษา </b></label>
        <div class="col-sm-4 col-form-label">
        <p id="highes_ed"><b>:</b> <?php echo $result['Highes_Ed'] ?> </p>
        </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>จบการศึกษาจาก </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="gradfromschool"><b>:</b> <?php echo $result['Gradfromschool'] ?> </p>
        </div>
        <label class="col-sm-2 col-form-label"><b>วิธีรับเข้า </b></label>
        <div class="col-sm-4 col-form-label">
        <p id="entry_Method"><b>:</b> <?php echo $result['Entry_Method'] ?> </p>
        </div>
    </div>    

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>รหัสนิสิต </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="student_ID"><b>:</b> <?php echo $result['Student_ID'] ?> </p>
        </div>
        <label class="col-sm-2 col-form-label"><b>ชั้นปี </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="entry_years"><b>:</b> <?php 
          if(empty( $GPA_Year[0]->GPA_Year )) {
              echo " - ";
          } else {
            $level = $GPA_Year[0]->GPA_Year-$result['Entry_Years']; 
            echo ++$level;
          }
          ?></p>
        </div>
    </div>     

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>วิทยาเขต </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="campus"><b>:</b> <?php echo $result['Campus'] ?> </p>
        </div>
        <label class="col-sm-2 col-form-label"><b>ชื่อปริญญา </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="level"><b>:</b> <?php echo $result['Level'] ?></p>
        </div>
    </div>   

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>ระดับการศึกษา </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="degree"><b>:</b> <?php echo $result['Degree'] ?></p>
        </div>
        <label class="col-sm-2 col-form-label"><b>หลักสูตร </b></label>
        <div class="col-sm-4 col-form-label">
        <p id="course"><b>:</b> <?php echo $result['Course'] ?> </p>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>หน่วยกิตที่ผ่าน </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="degree"><b>:</b> <?php echo $CA[0]->sum ?></p>
        </div>
        <label class="col-sm-2 col-form-label"><b>GPAX </b></label>
        <div class="col-sm-4 col-form-label">
        <p id="GPAX"><b>:</b> <?php echo $result['GPAX'] ?> </p>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>สถานภาพ </b></label>
        <div class="col-sm-3 col-form-label">
        <p id="status"><b>:</b> <?php echo $status[0]->Status_Name ?></p>
        </div>
    </div>         

    </div>               
  </div>

  <div class="card">
    <div class="card-header">
      <strong><center>อาจารย์ที่ปรึกษา</strong>
    </div>
    <div class="card-body">
    <div class="form-group row">
    <?php 
    if(count($Adviser) == 0) {
        echo "<td><h4>ไม่มีข้อมูล</h4></td>";
    } else if(count($Adviser)) { ?>

    <?php foreach ($Adviser as $student) { ?>
      <div class="col-sm-12 col-form-label">
      <p id="Adviser"> <?php echo $student->Adviser_Prefix." ".$student->Adviser_Name." ".$student->Adviser_Lname; ?> </p>
      </div>
      <?php   } 
          } ?>
    </div>

    </div>               
  </div>

  <div class="card">
    <div class="card-header">
      <strong><center>ที่อยู่ตามทะเบียนบ้าน</strong>
    </div>
    <div class="card-body">

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>บ้านเลขที่ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="home_address_number"><b>:</b> <?php echo $result['Home_Address_Number'] ?> </p>
        </div>
      <label class="col-sm-2 col-form-label"><b>หมู่ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="home_address_moo"><b>:</b> <?php echo $result['Home_Address_Moo'] ?> </p>
        </div>
      <label class="col-sm-1 col-form-label"><b>ซอย </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="home_address_soi"><b>:</b> <?php echo $result['Home_Address_Soi'] ?> </p>
        </div>
      
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>ตำบล / แขวง </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="home_address_tumbon"><b>:</b> <?php echo $result['Home_Address_Tumbon'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>เขต / อำเภอ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="home_address_aumper"><b>:</b> <?php echo $result['Home_Address_Aumper'] ?> </p>
          </div>
        <label class="col-sm-1 col-form-label"><b>จังหวัด </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="home_address_province"><b>:</b> <?php echo $result['Home_Address_Province'] ?> </p>
          </div>  
    </div>    

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>รหัสไปรษณีย์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="home_address_postcode"><b>:</b> <?php echo $result['Home_Address_Postcode'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>เบอร์โทรศัพท์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="student_phone"><b>:</b> <?php echo $result['Student_Phone'] ?> </p>
          </div>
        <label class="col-sm-1 col-form-label"><b>E-mail </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="student_email"><b>:</b> <?php echo $result['Student_Email'] ?> </p>
          </div>  
    </div>    

    </div>               
  </div>

  <div class="card">
    <div class="card-header">
      <strong><center>ที่อยู่ที่สามารถติดต่อ(ที่อยู่ปัจจุบัน)</strong>
    </div>
    <div class="card-body">

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>บ้านเลขที่ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="address_number"><b>:</b> <?php echo $result['Address_Number'] ?> </p>
        </div>
      <label class="col-sm-2 col-form-label"><b>หมู่ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="address_moo"><b>:</b> <?php echo $result['Address_Moo'] ?> </p>
        </div>
      <label class="col-sm-1 col-form-label"><b>ซอย </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="address_Soi"><b>:</b> <?php echo $result['Address_Soi'] ?> </p>
        </div>
      
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>ตำบล / แขวง </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="address_tumbon"><b>:</b> <?php echo $result['Address_Tumbon'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>เขต / อำเภอ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="address_aumper"><b>:</b> <?php echo $result['Address_Aumper'] ?> </p>
          </div>
        <label class="col-sm-1 col-form-label"><b>จังหวัด </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="address_province"><b>:</b> <?php echo $result['Address_Province'] ?> </p>
          </div>  
    </div>    

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>รหัสไปรษณีย์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="address_postcode"><b>:</b> <?php echo $result['Address_Postcode'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>เบอร์โทรศัพท์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="address_phone"><b>:</b> <?php echo $result['Address_Phone'] ?> </p>
          </div>
        <label class="col-sm-1 col-form-label"><b>E-mail </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="address_email"><b>:</b> <?php echo $result['Address_Email'] ?> </p>
          </div>  
    </div>    

    </div>               
  </div>

  <div class="card">
    <div class="card-header">
      <strong><center>ข้อมูลบิดา</strong>
    </div>
    <div class="card-body">

    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>ชื่อบิดา </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="father_name"><b>:</b> <?php echo $result['Father_Name'] ?> </p>
        </div>
      <label class="col-sm-2 col-form-label"><b>อาชีพ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="father_career"><b>:</b> <?php echo $result['Father_Career'] ?> </p>
        </div>
      <label class="col-sm-1 col-form-label"><b>สถานภาพ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="father_status"><b>:</b> <?php echo $result['Father_Status'] ?> </p>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>เบอร์โทรศัพท์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="father_Phone"><b>:</b> <?php echo $result['Father_Phone'] ?> </p>
          </div>
    </div>    

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>บ้านเลขที่ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="father_address_number"><b>:</b> <?php echo $result['Father_Address_Number'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>หมู่ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="father_address_moo"><b>:</b> <?php echo $result['Father_Address_Moo'] ?> </p>
          </div>  
        <label class="col-sm-1 col-form-label"><b>ซอย </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="father_address_soi"><b>:</b> <?php echo $result['Father_Address_Soi'] ?> </p>
          </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>ตำบล / แขวง </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="Father_Address_Tumbon"><b>:</b> <?php echo $result['Father_Address_Tumbon'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>เขต / อำเภอ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="father_address_aumper"><b>:</b> <?php echo $result['Father_Address_Aumper'] ?> </p>
          </div>
        <label class="col-sm-1 col-form-label"><b>จังหวัด </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="father_address_province"><b>:</b> <?php echo $result['Father_Address_Province'] ?> </p>
          </div>
      </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>รหัสไปรษณีย์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="father_address_postcode"><b>:</b> <?php echo $result['Father_Address_Postcode'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>E-mail </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="father_email"><b>:</b> <?php echo $result['Father_Email'] ?> </p>
          </div>
    </div>

    </div>               
  </div>

  <div class="card">
    <div class="card-header">
      <strong><center>ข้อมูลมารดา</strong>
    </div>
    <div class="card-body">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>ชื่อมารดา </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="mother_name"><b>:</b> <?php echo $result['Mother_Name'] ?> </p>
        </div>
      <label class="col-sm-2 col-form-label"><b>อาชีพ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="mother_career"><b>:</b> <?php echo $result['Mother_Career'] ?> </p>
        </div>
      <label class="col-sm-1 col-form-label"><b>สถานภาพ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="mother_status"><b>:</b> <?php echo $result['Mother_Status'] ?> </p>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>เบอร์โทรศัพท์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="mother_phone"><b>:</b> <?php echo $result['Mother_Phone'] ?> </p>
          </div>
    </div>    

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>บ้านเลขที่ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="mother_address_number"><b>:</b> <?php echo $result['Mother_Address_Number'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>หมู่ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="mother_address_moo"><b>:</b> <?php echo $result['Mother_Address_Moo'] ?> </p>
          </div>  
        <label class="col-sm-1 col-form-label"><b>ซอย </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="mother_address_soi"><b>:</b> <?php echo $result['Mother_Address_Soi'] ?> </p>
          </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>ตำบล / แขวง </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="mother_address_tumbon"><b>:</b> <?php echo $result['Mother_Address_Tumbon'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>เขต / อำเภอ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="mother_address_aumper"><b>:</b> <?php echo $result['Mother_Address_Aumper'] ?> </p>
          </div>
        <label class="col-sm-1 col-form-label"><b>จังหวัด </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="mother_address_province"><b>:</b> <?php echo $result['Mother_Address_Province'] ?> </p>
          </div>
      </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>รหัสไปรษณีย์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="mother_address_postcode"><b>:</b> <?php echo $result['Mother_Address_Postcode'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>E-mail </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="mother_email"><b>:</b> <?php echo $result['Mother_Email'] ?> </p>
          </div>
    </div>

    </div>               
  </div>

  <div class="card">
    <div class="card-header">
      <strong><center>ข้อมูลผู้ปกครอง</strong>
    </div>
    <div class="card-body">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>ชื่อผู้ปกครอง </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="parent_Name"><b>:</b> <?php echo $result['Parent_Name'] ?> </p>
        </div>
      <label class="col-sm-2 col-form-label"><b>อาชีพ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="parent_career"><b>:</b> <?php echo $result['Parent_Career'] ?> </p>
        </div>
      <label class="col-sm-2 col-form-label"><b>ความสัมพันธ์ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="parent_status"><b>:</b> <?php echo $result['Parent_Status'] ?> </p>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>เบอร์โทรศัพท์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="parent_phone"><b>:</b> <?php echo $result['Parent_Phone'] ?> </p>
          </div>
    </div>    

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>บ้านเลขที่ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="parent_address_number"><b>:</b> <?php echo $result['Parent_Address_Number'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>หมู่ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="parent_address_moo"><b>:</b> <?php echo $result['Parent_Address_Moo'] ?> </p>
          </div>  
        <label class="col-sm-1 col-form-label"><b>ซอย </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="parent_address_soi"><b>:</b> <?php echo $result['Parent_Address_Soi'] ?> </p>
          </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>ตำบล / แขวง </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="parent_address_tumbon"><b>:</b> <?php echo $result['Parent_Address_Tumbon'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>เขต / อำเภอ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="parent_address_aumper"><b>:</b> <?php echo $result['Parent_Address_Aumper'] ?> </p>
          </div>
        <label class="col-sm-1 col-form-label"><b>จังหวัด </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="parent_address_province"><b>:</b> <?php echo $result['Parent_Address_Province'] ?> </p>
          </div>
      </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>รหัสไปรษณีย์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="parent_address_postcode"><b>:</b> <?php echo $result['Parent_Address_Postcode'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>E-mail </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="parent_email"><b>:</b> <?php echo $result['Parent_Email'] ?> </p>
          </div>
    </div>

    </div>               
  </div>

  <div class="card">
    <div class="card-header">
      <strong><center>ที่อยู่ของผู้ที่ติดต่อ</strong>
    </div>
    <div class="card-body">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>ชื่อ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="contact_name"><b>:</b> <?php echo $result['Contact_Name'] ?> </p>
        </div>
      <label class="col-sm-2 col-form-label"><b>ความสัมพันธ์ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="contact_status"><b>:</b> <?php echo $result['Contact_Status'] ?> </p>
        </div>
      <label class="col-sm-2 col-form-label"><b>เบอร์โทรศัพท์ </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="parent_phone"><b>:</b> <?php echo $result['Parent_Phone'] ?> </p>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>บ้านเลขที่ </b></label>
          <div class="col-sm-4 col-form-label">
          <p id="Contact_Address_Number"><b>:</b> <?php echo $result['Contact_Address_Number'] ?> </p>
          </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>ตำบล / แขวง </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="contact_address_tumbon"><b>:</b> <?php echo $result['Contact_Address_Tumbon'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>เขต / อำเภอ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="contact_address_aumper"><b>:</b> <?php echo $result['Contact_Address_Aumper'] ?> </p>
          </div>
        <label class="col-sm-1 col-form-label"><b>จังหวัด </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="contact_address_province"><b>:</b> <?php echo $result['Contact_Address_Province'] ?> </p>
          </div>
      </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>รหัสไปรษณีย์ </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="contact_address_postcode"><b>:</b> <?php echo $result['Contact_Address_Postcode'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>E-mail </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="contact_email"><b>:</b> <?php echo $result['Contact_Email'] ?> </p>
          </div>
    </div>

    </div>               
  </div>

  <div class="card">
    <div class="card-header">
      <strong><center>สถานที่การทำการ</strong>
    </div>
    <div class="card-body">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>สถานะการทำงาน </b></label>
        <div class="col-sm-2 col-form-label">
        <p id="Work_Status"><b>:</b> <?php echo $result['Work_Status'] ?> </p>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><b>ชื่อบริษัท </b></label>
          <div class="col-sm-3 col-form-label">
          <p id="workplace_company"><b>:</b> <?php echo $result['Workplace_Company'] ?> </p>
          </div>
        <label class="col-sm-2 col-form-label"><b>ที่อยู่บริษัท </b></label>
          <div class="col-sm-3 col-form-label">
          <p id="workplace_address"><b>:</b> <?php echo $result['Workplace_Address'] ?> </p>
          </div>
      </div>

      <div class="form-group row">
      <label class="col-sm-2 col-form-label"><b>ตำแหน่งงานภายในบริษัท </b></label>
          <div class="col-sm-2 col-form-label">
          <p id="workplace_position"><b>:</b> <?php echo $result['Work_Position'] ?> </p>
          </div>
      </div>

    </div>               
  </div>

  <div class="card">
    <div class="card-header">
      <strong><center>สถานภาพการรับทุน</strong>
    </div>
    <div class="card-body">
      <div class="form-group row">
        <table>
          <tr>
            <?php 
            if(count($scholarship) == 0) {
                echo "<td><h4>ไม่มีข้อมูล</h4></td>";
            } else if(count($scholarship)) { ?>

          <td><b><h4>ชื่อทุน </h4></b></td>
          <td><b><h4>ผู้มอบทุน </h4></b></td>
          <td><b><h4>ปีการศึกษา </h4></b></td>
          <td><b><h4>จำนวนเงิน(บาท) </h4></b></td>

          </tr>

    <?php foreach ($scholarship as $student) { ?>

    <tr>
    <td><?php echo $student->Scholarship_Name ?></td>
    <td><?php echo $student->Scholarship_Giver ?></td>
    <td><?php echo $student->Scholarship_Year ?></td>
    <td><?php echo $student->Scholarship_Amount ?></td>
    </tr>

    <?php   } 
          } ?>
  </table>

    </div>               
  </div>
</div>

<div class="card">
    <div class="card-header">
      <strong><center>ข้อมูลกิจกรรม</strong>
    </div>
    <div class="card-body">
      <div class="form-group row">
        <table>
          <tr>
          <?php 
    if(count($activity) == 0) {
        echo "<td><h4>ไม่มีข้อมูล</h4></td>";
    } else if(count($activity)) { ?>

          <tr>
          <td><b><h4>ชื่อกิจกรรม</h4> </td>
          <td><b><h4>เทอม</h4> </td>
          <td><b><h4>ปีการศึกษา</h4> </td>
          <td><b><h4>ชั่วโมง</h4> </td>
          </tr>
    
    <?php foreach ($activity as $student) { ?>
    <tr>
    <td><?php echo $student->Activitie_Name ?></td>
    <td><?php echo $student->Activity_Term ?></td>
    <td><?php echo $student->Activity_Year ?></td>
    <td><?php echo $student->Hour ?></td>
    </tr>
    <?php  
          }
        } ?>
  </table>

    </div>               
  </div>
</div>

<div class="card">
    <div class="card-header">
      <strong><center>ข้อมูลรางวัลการแข่งขัน</strong>
    </div>
    <div class="card-body">
      <div class="form-group row">
        <table>
          <tr>
          <?php 
    if(count($award) == 0) {
              echo "<td><b>ไม่มีข้อมูล</b></td>";
    } else if(count($award)) { ?>

      <td><b><h4>ชื่อรางวัลการแข่งขัน</h4> </b></td>
      <td><b><h4>เทอม</h4> </b></td>
      <td><b><h4>ปีการศึกษา</h4> </b></td>
      <td><b><h4>เงินรางวัล</h4> </b></td>
      <td><b><h4>อาจารย์ผู้ช่วย</h4> </b></td>

    </tr>

    <?php foreach ($award as $student) { ?>
    <tr>
    <td><?php echo $student->Award_Name ?></td>
    <td><?php echo $student->Award_Term ?></td>
    <td><?php echo $student->Award_Year ?></td>
    <td><?php echo $student->Award_Amount ?></td>
    <td><?php echo $student->Award_Giver ?></td>
    </tr>
    <?php   } 
          }  ?>

  </table>

    </div>               
  </div>
</div>

        </div>
      </div>

   

    </div>
</Body>