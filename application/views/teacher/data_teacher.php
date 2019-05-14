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
<Body>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">  
            <ul class="breadcrumb">
                <li><a href="<?php echo site_url('teacher/c_teacher/menu_teacher');?>">หน้าหลัก</a></li>
                <li>ข้อมูลอาจารย์</li>     
            </ul>
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>ข้อมูลอาจารย์</strong></h1>
            </div>
            <div class="card-body">
                <form  method="get"  action="" target="iframe_target" id="data_teacher" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-6"><BR>
                            
                        </div>
                <div class="collapse" id="open_collapse">
                    <div class="card-body">
                        
                </div>
        </form>
        
        
</Body>
<script>
function open_iframe_Box() {
    $('#reg').submit()
    $('#open_collapse').collapse()
}
</script>