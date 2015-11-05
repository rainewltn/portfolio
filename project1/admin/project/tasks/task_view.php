<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Task View | Stray Pixel Games</title>

</head>
<body>


<nav>
<?php 

$task_id = $_GET['id'];

?>
</nav>



<div class="container">

<div class="row">
<style>
.row
{
	height:100%;
}
.taskBox
{
	background-color:#e2e4e6;
	
height:100vh;
	margin:10px;
	padding: 5px;
	border-radius: 3px;
	box-shadow:  0px 0px 3px 0px rgba(0,0,0,1); 
}
img{
	max-width:700px;
	max-height: 600px;
}
.users
{
	float:left;
}
</style>

<?php 

			
										 $tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$task_id."");
										foreach($tasks as $tALL)
										{
													
															$totalTaskHours += $tALL->hours;
															$totalTasks +=1;
															echo '<div class="col-lg-12 taskBox">';
															
															echo '<b><p>'. $tALL->title .'</p></b>';
															
															echo '<p>'. $tALL->desc .'</p>';
												
															echo '<p>Planned Hours: '. $tALL->hours .'</p>';
															if($tALL->actual_hours){echo '<p>Actual Hours: '. $tALL->actual_hours .'</p>';}

															$doneHours += $tALL->hours;
		
															$linkTASKUSER = $wpdb->get_results("SELECT user_id FROM wp_dlod_TASKUSER WHERE task_id = ".$tALL->ID."");
															foreach($linkTASKUSER as $ltu)
															{
																echo '<div class="userBox userBox'.$tALL->ID.'">';
																
																	$users = get_userdata($ltu->user_id);
																	echo '<div class="users users'.$tALL->ID .'-'.$u->user_id.'"><img style="width:15px" src=/images/people/'.$users->user_login.'.png> &nbsp;</div>';
																	echo '</div>';
															}
															echo '<p>Attached Files</p>';
															$linkTASKFILE = $wpdb->get_results("SELECT file_id FROM wp_dlod_TASKFILE WHERE task_id = ".$tALL->ID."");
															foreach($linkTASKFILE as $ltf)
															{
																$file = $wpdb->get_results("SELECT file_url FROM wp_dlod_strayFiles WHERE ID = ". $ltf->file_id ."");
																foreach($file as $f)
																{
																	
																	echo "<img src='/uploads/uploads/".$f->file_url."'>";
																}
																
															}
															echo '</div>';	
				
										}

	
			
		
?>



	</div>
	

	
	</div>

	
</body>

</html>