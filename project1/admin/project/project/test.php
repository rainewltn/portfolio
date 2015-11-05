<style>
*
{
	background-color:#23282d;
	color:#fff;
}
</style>
<?php 
require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;
$currentIteration = 1;
$DailyValues = $wpdb->get_results("SELECT Actual FROM wp_dlod_strayIterationBurndown WHERE Iteration = ".$currentIteration."");

$actual[] = array();
foreach($DailyValues as $dv)
{
	array_push($actual,$dv->Actual);
}
if(!$actual[0])
{
	$actual[0] = 20;
}
$decrement = $actual[0]/7; 
?>
<html>
  <head>
    <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Day', 'Goal', 'Actual'],
          ['Day 1',  <?php echo $actual[0] ?>,      <?php if($actual[0]){echo $actual[0];}else{echo json_encode(NULL);} ?>],
          ['Day 2',   <?php echo round($actual[0] - ($decrement * 1),1); ?>,      <?php if($actual[1]){echo $actual[1];}else{echo json_encode(NULL);} ?>],
          ['Day 3',  <?php echo round($actual[0] - ($decrement * 2),1); ?>,       <?php if($actual[2]){echo $actual[2];}else{echo json_encode(NULL);} ?>],
          ['Day 4',  <?php echo round($actual[0] - ($decrement * 3),1); ?>,      <?php if($actual[3]){echo $actual[3];}else{echo json_encode(NULL);}?>],
		  ['Day 5',  <?php echo round($actual[0] - ($decrement * 4),1); ?>,      <?php if($actual[4]){echo $actual[4];}else{echo json_encode(NULL);} ?>],
		  ['Day 6',  <?php echo round($actual[0] - ($decrement * 5),1); ?>,      <?php if($actual[5]){echo $actual[5];}else{echo json_encode(NULL);} ?>],
		  ['Day 7',  <?php echo round($actual[0] - ($decrement * 6),1); ?>,      <?php if($actual[6]){echo $actual[6];}else{echo json_encode(NULL);} ?>]
        ]);

        var options = {
          width: 200,
		  height: 100,
		  interpolateNulls: true,
          legend: { position: 'none' },
		  chartArea:{left:0,top:0,width:"100%",height:"100%"}
		  
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>