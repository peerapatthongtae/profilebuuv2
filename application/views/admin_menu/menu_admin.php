
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
 <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="http://reg.buu.ac.th/registrar/getstudentimage.asp?id=<?php echo $this->session->userdata('user_id');?>" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title" style="margin: 0 auto;">
                <h1 class="h5"> <?php echo $admin['Staff_Name'] ?> </h1>
                </div>
         </div>
          <!-- Sidebar Navidation Menus-->
          <ul class="list-unstyled">
                    <li><a href="/admin/c_admin/activity_student"><i class="fa fa-tasks"></i> ข้อมูลกิจกรรม </a></li>
                    <li><a href="/admin/c_admin/award_student_admin"><i class="fa fa-trophy"></i> รางวัลการแข่งขันนิสิต </a></li>
                    <li><a href="/admin/c_admin/scholarship_student_admin"><i class="far fa-money-bill-alt"></i> ทุนการศึกษา </a></li>
                    <!--<li><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> 
	                    <i class="fas fa-database"></i> ข้อมูลสถิติ </a>
		                    <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                                <li><a href="/admin/c_admin/statistics_admin"> สถิติจำนวนนิสิต </a></li>
                                
		                    </ul>
                    </li> !-->
                    <li><a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse"> 
	                    <i class="far fa-address-book"></i> ข้อมูลนิสิต </a>
                        
		                    <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
                                <li><a href="/admin/c_admin/statistics_admin"> แผนภูมิสถิติจำนวนนิสิต </a></li>
                                <li><a href="/admin/c_admin/search_data_student_admin"> ข้อมูลส่วนตัวนิสิต </a></li>
                                <li><a href="/admin/c_admin/getAmountStudentStatus"> จำนวนนิสิตแยกตามสถานะนิสิต </a></li>
                                <li><a href="/admin/c_admin/getSubjectStudent"> ผลการศึกษาแยกตามรหัสนิสิต </a></li>
                                <li><a href="/admin/c_admin/getAmountSubjectStudent"> สถิติจำนวนนิสิตรวมและผลการศึกษาของรายวิชา </a></li>
                                <li><a href="/admin/c_admin/getProStudent"> รายชื่อนิสิตรอพินิจ <br />โดยค้นหาจากรหัสนิสิต </a></li>
                                <li><a href="/admin/c_admin/getStudentByProID"> รายชื่อนิสิตรอพินิจ <br />โดยค้นหาจากสถานะรอพินิจ </a></li>
		                    </ul>
                    </li>

                    <li><a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse"> 
                      <i class="far fa-address-book"></i> ข้อมูลประกันคุณภาพ</a>
		                    <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
                        <li><a href="#exampledropdownDropdown3-1" aria-expanded="false" data-toggle="collapse"> 
                      <i class="far fa-address-book"></i> องก์ที่ 5</a>
                      <ul id="exampledropdownDropdown3-1" class="collapse list-unstyled ">
                        <li><a href="/admin/c_admin/getStudentEntryInEachYears"> [5-1] ข้อมูลการรับเข้านิสิตในแต่ละรอบในปีการศึกษา </a></li>
                      </ul>
                      <li><a href="#exampledropdownDropdown3-2" aria-expanded="false" data-toggle="collapse"> 
                      <i class="far fa-address-book"></i> องก์ที่ 8</a>
                      <ul id="exampledropdownDropdown3-2" class="collapse list-unstyled ">
                                <li><a href="/admin/c_admin/getEntryData"> [8-1] ข้อมูลการรับเข้าของนิสิตในหลักสูตร </a></li>
                                <li><a href="/admin/c_admin/getAmountStudentInEachYears"> [8-2] ข้อมูลจำนวนนิสิตในแต่ละชั้นปี </a></li>
                                <li><a href="/admin/c_admin/getAmountGradAndRetire"> [8-3] ข้อมูลการคงอยู่และการจบการศึกษาของนิสิต </a></li>
                      </ul>
		                    </ul>
                    </li>

                    <li><a href="#exampledropdownDropdown4" aria-expanded="false" data-toggle="collapse"> 
                      <i class="far fa-plus-square"></i> เพิ่มข้อมูล</a>
		                    <ul id="exampledropdownDropdown4" class="collapse list-unstyled ">
                                <li><a href="/admin/c_admin/add_aboutstudent"> รายละเอียดข้อมูลนิสิต </a></li>
                                <li><a href="/admin/c_admin/add_registstudent"> ข้อมูลการลงทะเบียน </a></li>
                                <li><a href="/admin/c_admin/add_gradstudent"> ข้อมูลเกรดเฉลี่ยแต่ละภาคเรียน </a></li>
                                <li><a href="/admin/c_admin/add_grade"> ข้อมูลเกรดเฉลี่ยรวม (GPAX)</a></li>
                                <li><a href="/admin/c_admin/add_adviser"> ข้อมูลอาจารย์ที่ปรึกษา</a></li>
                                <li><a href="/admin/c_admin/add_parentStatus"> ข้อมูลความสัมพันธ์ผู้ปกครอง</a></li>
                                
		                    </ul>
                    </li>
                    <li><a href="/admin/c_admin/graduate_actoradmin"><i class="fa fa-graduation-cap"></i> ผู้สำเร็จการศึกษา </a></li>
                    <li><a href="https://docs.google.com/document/d/1tJT3SYH61U-xbNQMS7JvhxxpVwSLyDYmY7reNxhk9jw/edit?fbclid=IwAR27nhkuTDGJyVHcfwpSuSROAu4s2jULbkIEIQ0GVKUBZIQg04Gn_Lor4_Q"><i class="far fa-address-book"></i> คู่มือการใช้งานสำหรับเจ้าหน้าที่</a></li>
                    <!--<li><a href="#exampledropdownDropdown4" aria-expanded="false" data-toggle="collapse"> 
                      <i class="far fa-plus-square"></i> API</a>
		                    <ul id="exampledropdownDropdown4" class="collapse list-unstyled ">
                                <li><a href="/admin/c_admin/getAmountStudentStatus"> จำนวนนิสิตแยกตามสถานะนิสิต </a></li>
                                <li><a href="/admin/c_admin/getSubjectStudent"> แสดงเกรดโดยค้นหาจากรหัสนิสิต </a></li>
		                    </ul>
                    </li> !-->

                   
          </ul>
        </nav>
   
