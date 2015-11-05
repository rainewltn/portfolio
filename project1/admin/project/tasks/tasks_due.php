<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Assigned Tasks | Stray Pixel Games</title>

</head>
<body>


<nav>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php';

$currentIteration = $_GET['itr'];

?>
</nav>

</br></br></br></br></br></br>

<div class="container">
<div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Tasks Left</h3>
                    <hr class="star-light">
                </div>
            </div> 
			</br></br></br>
<div class="row">
<style>

.taskBox
{
	background-color:#e2e4e6;
	height:185px;
	overflow-y:scroll;
	margin:10px;
	padding: 5px;
	border-radius: 3px;
	box-shadow:  0px 0px 3px 0px rgba(0,0,0,1); 
}
.users
{
	float:left;
}

</style>

<?php 

			$linkSTORYITERATION = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");
				foreach($linkSTORYITERATION as $lsi)
				{			
						
								$storiesALL = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsi->story_id."");
								foreach($storiesALL as $sALL)
								{							
										

									$linkTASKSTORY = $wpdb->get_results("SELECT task_id FROM wp_dlod_TASKSTORY WHERE story_id = ".$sALL->ID."");
									foreach($linkTASKSTORY as $lts)
									{
										$tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$lts->task_id."");
										foreach($tasks as $tALL)
										{
											if($tALL->col == 1 || $tALL->col == 2)
											{
												
														
														echo '<div class="col-sm-2 taskBox">';
														if(!$tALL->title)
														{
															echo '<b><p>Title Missing</p></b>';
														}else
														{
															echo '<b><p>'. $tALL->title .'</p></b>';
														}
														
														
														echo '<p>Hours: '. $tALL->hours .'</p>';
														if($tALL->col == 1)
														{
															echo '<p>Status: <b>Accepted</b></p>';
															$totalTasksAccepted +=1;
															$acceptedHours += $tALL->hours;
															$totalTasks +=1;
														}
														elseif($tALL->col == 2)
														{
															echo '<p>Status: <b>In Progress</b></p>';
															$totalTasksInProgress +=1;
															$progressHours += $tALL->hours;
															$totalTasks +=1;
														}
														
														
														$linkTASKUSER = $wpdb->get_results("SELECT user_id FROM wp_dlod_TASKUSER WHERE task_id = ".$tALL->ID."");
														foreach($linkTASKUSER as $ltu)
														{
															echo '<div class="userBox userBox'.$tALL->ID.'">';
															
																$users = get_userdata($ltu->user_id);
																echo '<div class="users users'.$tALL->ID .'-'.$u->user_id.'"><img style="width:15px" src=/images/people/'.$users->user_login.'.png> &nbsp;</div>';
																echo '</div>';
														}
														echo '</div>';
												
											}
										}
									}
								}
				}
						
				
			

	
			
		
?>



	</div>
	<?php 
		
		echo "<p>Total Tasks left: " . $totalTasks .'</p>';
		echo "<p>Total Tasks Accepted: " . $totalTasksAccepted ." (". $acceptedHours ." hours)</p>";
		echo "<p>Total Tasks In Progress: " . $totalTasksInProgress ." (". $progressHours ." hours)</p>";
		
		
	?>
	</div>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';?>
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</body>

</html>