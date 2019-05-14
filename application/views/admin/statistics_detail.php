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
            <li><a href="<?php echo site_url('admin/c_admin/statistics_admin');?>">สถิติจำนวนนิสิต</a></li>
                <li>สถิตินิสิตตามหลักสูตร</li>
            </ul>
            </div>
          </header>
          <br>
<Body>
<div class="col-sm-12">
  <div class="card">
    <div class="card-header">
      <strong><center>สถิตินิสิตตามหลักสูตร</strong>
    </div>
    <div class="card-body">
        <div style="width: 70%; margin: 0 auto;">
            <canvas id="bar-chart"></canvas>
        </div>

    </div>

        </div>
      </div>
    </div>
</Body>

<?php 
$stats_amount = '';
$labels = '';
foreach($static as $row) {
    $stats_amount .= '"'.$row['Stat_Amount'].'",';
    $labels .= '"'.$row['Status_Name'].'",';
} 
$stats_amount = substr($stats_amount,0,-1);
$$labels = substr($labels,0,-1);
?>

<script>


new Chart(document.getElementById("bar-chart"), {

    width: 200,
    height: 200,
    type: 'bar',
    data: {

      labels: [<?php echo $labels; ?>],
          
          
          
          
          
          
      datasets: [
        {
          label: "จำนวนคนทั้งหมด",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#ffff00","#ff8000","#80ff00"],
          data: [<?php echo $stats_amount; ?>]
        }
      ]
 
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true, 
                    callback: function(val) {
                        return Number.isInteger(val) ? val : null;
                    }
                }
            }]
        },
        responsive: true,

        legend: { display: false },
        title: {
            display: true,
            text: '<?php echo $row['Stat_Course'];?>'
        }
    }
});

</script>