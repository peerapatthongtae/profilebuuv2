
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="http://reg.buu.ac.th/registrar/getstudentimage.asp?id=<?php echo $this->session->userdata('user_id');?>" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title" style="margin: 0 auto;">
                                <h1 class="h5"> <?php echo $teacher['Teacher_Name_Th'] ?> <?php echo $teacher['Teacher_Lname_Th'] ?> </h1>
                                        <p> <?php echo $teacher['Teacher_Prefix'] ?> </p>
                        </div>
         </div>
          <!-- Sidebar Navidation Menus-->
          <ul class="list-unstyled">
                    <li><a href="/teacher/c_teacher/activity_student_teacher"><i class="fa fa-tasks"></i> ข้อมูลกิจกรรมนิสิต </a></li>
                    <li><a href="/teacher/c_teacher/award_student_teacher"><i class="fa fa-trophy"></i> รางวัลการแข่งขันนิสิต </a></li>
                    <li><a href="/teacher/c_teacher/scholarship_student_teacher"><i class="far fa-money-bill-alt"></i> ทุนการศึกษา </a></li>
                    <li><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> 
	                    <i class="fas fa-database"></i> ข้อมูลสถิตินิสิต </a>
		                    <ul id="exampledropdownDropdown1" class="collapse list-unstyled">
                                        <li><a href="/teacher/c_teacher/statistics_teacher"> สถิติจำนวนนิสิต </a></li>
                                        <!-- <li><a href="/teacher/c_teacher/consider_student_teacher"> รายชื่อรอพินิจ </a></li> -->
		                    </ul>
                    </li>
                    <li><a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse"> 
	                    <i class="far fa-address-book"></i> ข้อมูลนิสิต </a>
		                    <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
                                <li><a href="/teacher/c_teacher/search_data_student_teacher"> ข้อมูลส่วนตัวนิสิต </a></li>
		                    </ul>
                    </li>
                    <li><a href="/teacher/c_teacher/graduate_actorteacher"><i class="fa fa-graduation-cap"></i> ผู้สำเร็จการศึกษา </a></li>
          </ul>
        </nav>


      