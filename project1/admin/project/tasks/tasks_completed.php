<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Completed Tasks | Stray Pixel Games</title>

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
                    <h3>Tasks Completed by you</h3>
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
						//$linkSTORYUSER = $wpdb->get_results("SELECT user_id, story_id FROM wp_dlod_STORYUSER WHERE story_id = ".$lsi->story_id."");
						//foreach($linkSTORYUSER as $lsu)
						//{
							//if($lsu->user_id == get_current_user_id())
							//{
								$storiesALL = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsi->story_id."");//lsu if you want by user
								foreach($storiesALL as $sALL)
								{							
										$assignedStoryPoints += $sALL->points;

									$linkTASKSTORY = $wpdb->get_results("SELECT task_id FROM wp_dlod_TASKSTORY WHERE story_id = ".$sALL->ID."");
									foreach($linkTASKSTORY as $lts)
									{
										 $tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$lts->task_id."");
										foreach($tasks as $tALL)
										{
													if($tALL->col == 3)
													{
														//$user_on_task = $wpdb->get_var( "SELECT COUNT(*) FROM wp_dlod_TASKUSER WHERE task_id = ".$tALL->ID." AND user_id = ". get_current_user_id() ."");
														//if($user_on_task)
														//{
															$totalTaskHours += $tALL->hours;
															$totalTasks +=1;
															echo '<div class="col-sm-2 taskBox">';
															
															echo '<b><p>'. $tALL->title .'</p></b>';
															
															
												
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
															echo '</div>';	
														//}
													}
												
											
										}
									}
								}
							//}
						//}
				}
			

	
			
		
?>



	</div>
	
	<?php 
		
		
		echo "<p>Total Tasks Done: " . $totalTasks ." (". $doneHours ." hours)</p>";
		
	?>
	
	</div>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';?>
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</body>

</html>