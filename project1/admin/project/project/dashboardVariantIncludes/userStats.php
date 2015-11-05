<?php

	$assignedTasks = 0;//#of tasks in progress
	$tasksInProgress = 0;//#of task HOURS that have been done
	$completedHours = 0;//# of points
	$uncompletedHours = 0;//# of hours left
		
		$linkSTORYITERATION = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");
				foreach($linkSTORYITERATION as $lsi)//loop through all stories in iteration
				{	
					$linkSTORYUSER = $wpdb->get_results("SELECT user_id, story_id FROM wp_dlod_STORYUSER WHERE story_id = ".$lsi->story_id."");//get the user id associated with every story in the iteration				
					foreach($linkSTORYUSER as $lsu)//loop through user ids on the stories
					{
						if($lsu->user_id == get_current_user_id())
						{//check to see if the user id for the story is associated with the current user
							$stories = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsu->story_id."");//get the story if it is
							foreach($stories as $s)
							{
									$linkTASKSTORY = $wpdb->get_results("SELECT task_id FROM wp_dlod_TASKSTORY WHERE story_id = ".$s->ID."");	//get all the tasks for current story id
									foreach($linkTASKSTORY as $ltu)
									{
										
																		
										 $tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$ltu->task_id."");
										  foreach($tasks as $t)
										 { 
											
											$user_on_task = $wpdb->get_var( "SELECT COUNT(*) FROM wp_dlod_TASKUSER WHERE task_id = ".$t->ID." AND user_id = ". get_current_user_id() ."");
											
											if($user_on_task)
											{
												$assignedTasks +=1;
												if($t->col == 2)
												{
													$tasksInProgress += 1;
													$uncompletedHours += $t->hours;
												}
												if($t->col == 3)
												{
													$completedHours += $t->hours;
													
												}
												if($t->col == 1)
												{
													$uncompletedHours += $t->hours;
												}
											}
										}
									}
							}
							
						}
					}
				}
?>

<section id ="portfolio">
	<div class="container"> 	
		<div class="row">
                
		<a href="../tasks/tasks_progress.php?itr=<?php echo $currentIteration ?>" style="color:#2c3e50;">
		<div class="col-sm-2 trackingBox" style="cursor: pointer;" onclick="changePage('project','/project/tasks/tasks_completed.php?id=1')">
			<i class="fa fa-tasks"></i>
			
				<p>You have</p>
					<p style = " color: #3498db; font-size:200%;">
					<?php echo $tasksInProgress;?>
				</p>	
				<p>tasks in progress</p>
		</div>
		</a>
		<a href="../tasks/tasks_completed.php?itr=<?php echo $currentIteration ?>" style="color:#2c3e50;">
		<div class="col-sm-2 trackingBox" ><i class="fa fa-check"></i>
		<p>You have finished</p>
		
			<p style = " color: #3cc920;  font-size:200%;">
			<?php 
			  echo $completedHours;
			?>
			
			</p>
		<p>task hours</p>
		</div>
		</a>
		<a href="../tasks/tasks_assigned.php?itr=<?php echo $currentIteration ?>" style="color:#2c3e50;">
		<div class="col-sm-2 trackingBox" onclick="changePage('project','/project/tasks/tasks_assigned.php?id=1')" style="cursor: pointer;"><i class="fa fa-archive"></i>
		<p>You have</p>
		
			<p style = " color: #5bc0de; font-size:200%;">
		<?php echo $assignedTasks;?>
			</p>	
		<p>tasks assigned</p>
		
		</div>
		</a>
		<div class="col-sm-2 trackingBox" style="cursor: pointer;" onclick = "changePage('project','/admin/project/project/test.php)">
		<i class="fa fa-clock-o"></i>
		<p>You have</p>
		
			<p style = " color: red;  font-size:200%;">
			<?php
				echo $uncompletedHours;
			?>
			
			</p>	
		<p>hours left</p>
		</div>