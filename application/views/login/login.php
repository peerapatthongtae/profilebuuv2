<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project Student</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url('theme/vendor/bootstrap/css/bootstrap.min.css');?>">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url('theme/vendor/font-awesome/css/font-awesome.min.css');?>">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php echo base_url('theme/css/fontastic.css');?>">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url('theme/css/style.default.css" id="theme-stylesheet');?>">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url('theme/css/custom.css');?>">
    <link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">
    <style>
      body {
        font-family: 'Athiti', sans-serif;
      }
    </style>  
   
  </head>
  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center" >
        <div class="form-holder" >
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center" style="background-color:white">
                <div class="content">
                  <div class="logo" >
                    <h1 style="color:#7B68EE">เข้าสู่ระบบ</h1>

                  </div>
                  <p style="color:#7B68EE">Welcome to Student Profile.</p>

                </div>
              </div>
            </div>
            <!-- Form Panel-->
            <div class="col-lg-6" style="background-color:#778899">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <img src="https://i.ibb.co/6YvnFPY/11.png" style="float:center;width:300px;height:70px">
                <?php if($status) { ?>
                  <div class="alert alert-danger" role="alert"> โปรดตรวจสอบการกรอกข้อมูลใหม่ !!! </div>
                  <?php } ?>
                  <form id="login-form" method="post" action="<?php echo site_url('c_login/post_login');?>">
                    <div class="form-group">
                      <input id="login-username" type="text" name="username" required="" class="input-material">
                      <label for="login-username" class="label-material">Username</label>
                    </div>
                    <div class="form-group">
                      <input id="login-password" type="password" name="password" required="" class="input-material">
                      <label for="login-password" class="label-material" >Password</label>
                    </div><button id="login" style="background-color:white" type="submit" class="btn btn-primary" ><h5 style="color:#7B68EE">Login</h5></button>

                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                  </form>
                  <i class="fa fa-hand-o-right" aria-hidden="true"></i> <a href="<?php echo site_url('/welcome');?>"> <h5 style="color:white">กลับสู่หน้าหลัก</h5> </a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</Body>
    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url('theme/vendor/popper.js/umd/popper.min.js');?>"> </script>
    <script src="<?php echo base_url('theme/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('theme/vendor/jquery.cookie/jquery.cookie.js');?>"> </script>
    <script src="<?php echo base_url('theme/vendor/chart.js/Chart.min.js');?>"></script>
    <script src="<?php echo base_url('theme/vendor/jquery-validation/jquery.validate.min.js');?>"></script>
    <!-- Main File-->
    <script src="<?php echo base_url('theme/js/front.js');?>"></script>
    <script>
    setTimeout(() => {
      jQuery('.alert').hide()
    }, 200000);
    </script>
  </body>
</html>