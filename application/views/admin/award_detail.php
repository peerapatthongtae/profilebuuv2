
<style>
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
  /*FORM +- DYNAMIC */
  .entry:not(:first-of-type)
{
    margin-top: 10px;
}

.glyphicon
{
    font-size: 12px;
}
      </style>
      
  
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
            <ul class="breadcrumb">
                <li><a href="<?php echo site_url('admin/c_admin/menu_admin');?>">หน้าหลัก</a></li>
                <li><a href="<?php echo site_url('admin/c_admin/award_student_admin');?>">รางวัลการแข่งขัน</a></li>
                <li>เพิ่มนิสิตรางวัลการแข่งขัน</li>
            </ul>
            </div>
          </header>
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="container"><br>
                <h1 class="no-margin-bottom"><center>เพิ่มนิสิตรางวัลการแข่งขัน</center></h1>
            <form action="<?php echo site_url("admin/c_admin/insert_student_award/")?>" method="post" id="award_form"><BR>          
            <?php if ($this->session->flashdata('form_error')) {
                    echo $this->session->flashdata('form_error');
                    } ?>
    
                   
           <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="text-input"><b>รหัสนิสิต</b></label>
                        
                            <div class="col-md-3">
                                <input type="hidden" id="Award_ID" name="Award_ID" value="<?php echo $award_id;?>">
                                <textarea rows="4" cols="50" id="Student_ID" name="Student_ID" class="form-control" required=""> </textarea>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-sm btn-success" style="width:50px;height:40px"> บันทึก </button>
                            </div>
                    </div>   
                                  
                </form>  
        <br><hr> <h2> <?php foreach ($award_name as $name) { ?>
                                                <?php echo "ชื่อกิจกรรม : ".$name->Award_Name ?>
                                                     <?php } ?> </h2><br>
     
<table id="datatable" class="table table-striped table-bordered">
<thead>
            <tr>
              <th>รหัสนิสิต </th>
              <th>ชื่อ - นามสกุล</th>
              <th>หลักสูตร</th>
              <th></th>   
                        
            </tr>
</thead>   
<tbody>
  <?php foreach ($result1 as $row) { ?>
  <tr>
        <td><?php echo $row->Student_ID ?> </td>
        <td><?php echo $row->Student_Prefix." ".$row->Student_Name_Th." ".$row->Student_Lname_Th ?> </td>
        <td><?php echo $row->Course ?> </td>
        <td><center>
          <form action="<?php echo site_url('admin/c_admin/delete_award_has_student/');?>"  onsubmit="return confirm('คุณต้องการลบใช่หรือไม่ ?');" method="post">
          <input type="hidden" id="Award_ID" name="Award_ID" value="<?php echo $award_id; ?>">
          <input type="hidden" id="Student_ID" name="Student_ID" value="<?php echo $row->Student_ID; ?>">
          <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
          </form>
        </center></td>
      

    
  </tr>      
<?php } ?>

</tbody>
</table>             

  
                  </div>
                </div>
              </div>
            </div>
          </section>           



    <script>
      $(document).ready(function() {
         $('#datatable').DataTable();
    });

      jQuery(document).ready(function(){
         $('#award_form').validate();
    });
    /*form +- dynamic*/
    $(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls form:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
});
    </script>

	
	