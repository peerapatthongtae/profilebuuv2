
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="http://reg.buu.ac.th/registrar/getstudentimage.asp?id=<?php echo $this->session->userdata('user_id');?>" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title" style="margin: 0 auto;">
                    <h1 class="h5"> <?php echo $student['Student_Prefix'] ?> <?php echo $student['Student_Name_Th'] ?> <?php echo $student['Student_Lname_Th'] ?> </h1>
                        <p> <?php echo $student['Student_ID'] ?> </p>
                </div>
         </div>
          <!-- Sidebar Navidation Menus-->
          <ul class="list-unstyled">
                    <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> 
	                    <i class="icon-interface-windows"></i> ข้อมูลนิสิต </a>
		                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                                <li><a href="/student/c_student/data_student"> ข้อมูลส่วนตัว </a></li>
                                <li><a href="/student/c_student/edit_datastudent"> แก้ไขข้อมูลส่วนตัว </a></li>
                                <li><a href="/student/c_student/transcript_student"> ผลการศึกษา </a></li>
		                    </ul>
                    </li>
                    <li><a href="/student/c_student/graduate_actorstudent"><i class="fa fa-graduation-cap"></i> ผู้สำเร็จการศึกษา </a></li>
                   
          </ul>
        </nav>
