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
            <li>สถิติจำนวนนิสิต</li>
            </ul>
            </div>
          </header>
          <br>
        <Body>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h1><strong><center>สถิติจำนวนนิสิต</strong></h1>
            </div>
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <label class="col-md-3 col-form-label" for="text-input"><b>ปีการศึกษาที่เข้า</b></label>
                  <div class="col-md-3">                          
                    <div id="custom-search-input"> 
                    <!-- <form  method="get"  action="admin/statistics_admin"> -->
                        <div class="input-group col-md-12">     
                                <select class="form-control" name="years" id="years">
                                        <option value="">---------</option>
                                    <?php
                                        foreach($static as $row) {   ?>
                                        <option value="<?php echo $row['Stat_Years'] ?>"><?php echo $row['Stat_Years'] ?> </option>
                                      <?php  }
                                    ?>
                                </select>                       
                            </div> 
                    <!-- </form> -->
                        </div>
                    </div>     

                        </div> <br>
                        <table id="myTable" class="table table-striped table-bordered" >
                            <thead>
                                <tr>
                                <th>หลักสูตร</th>
                                <th></th>             
                                </tr>
                            </thead>   
                        <tbody id="mybody"></tbody>
                            </table>
                        </div> 
                    </div>                        
                </div>              
                </div>
              </div>
          </div>
         <BR>
</Body>
<script>
    $(document).ready(function(){
        $('#years').change(function(){
            var static_years = $(this).val();
            // alert(static_years);
            $.getJSON('<?php echo site_url('admin/c_admin/statistics_ajax/');?>'+static_years, function(data){
                $('#mybody').empty()
                $.each(data.course, function(i, item) {
                    var tr = "<tr>";
                    tr = tr + "<td>" +  item.Stat_Course + "</td>";
                    tr = tr + "<td class='text-center'>" + item.button + "</td>";
                    tr = tr + "</tr>";
                    $('#myTable > tbody:last').append(tr);
                    // $('#mybody').append(item.Stat_Course+'<br>');
                })
            });
        });
    });
</script>