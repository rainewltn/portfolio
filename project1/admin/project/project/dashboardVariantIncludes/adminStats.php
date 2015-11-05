<?php

				$assignedTasks = 0;//#of tasks in tasks in the iteration
				$tasksInProgress = 0;//#of task HOURS that have been done
				$completedHours = 0;//#
				$uncompletedHours = 0;//# of hours left
				
				$linkSTORYITERATION = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");
				foreach($linkSTORYITERATION as $lsu)
				{
						$storiesALL = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsu->story_id."");
						foreach($storiesALL as $sALL)
						{							
								$assignedStoryPoints += $sALL->points;

							$linkTASKSTORY = $wpdb->get_results("SELECT task_id FROM wp_dlod_TASKSTORY WHERE story_id = ".$sALL->ID."");
							foreach($linkTASKSTORY as $lts)
							{
								 $tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$lts->task_id."");
								foreach($tasks as $tALL)
								 {
									$assignedTasks +=1;
									if($tALL->col == 2)
									{
										$tasksInProgress += 1;
										$uncompletedHours += $tALL->hours;
									}
									if($tALL->col == 3)
									{
										$completedHours += $tALL->hours;
										
									}
									if($tALL->col == 1)
									{
										$uncompletedHours += $tALL->hours;
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
		<div class="col-sm-2 trackingBox" style="cursor: pointer;">
			<i class="fa fa-tasks"></i>
			
				<p>There are</p>
					<p style = "color: #3498db; font-size:200%;">
					<?php echo $tasksInProgress;?>
				</p>	
				<p>tasks in progress</p>
		</div>
		</a>
		<a href="../tasks/tasks_completed.php?itr=<?php echo $currentIteration ?>" style="color:#2c3e50;">
		<div class="col-sm-2 trackingBox" ><i class="fa fa-check"></i>
		<p>There has been</p>
		
			<p style = " color: #3cc920; font-size:200%;">
			<?php 
			  echo $completedHours;
			?>
			
			</p>	
		<p>task hours finished</p>
		</div>
		</a>
		<a href="../tasks/tasks_assignedAdmin.php?itr=<?php echo $currentIteration ?>" style="color:#2c3e50;">
		<div class="col-sm-2 trackingBox" style="cursor: pointer;"><i class="fa fa-archive"></i>
		<p>There are</p>
		
			<p style = "color: #5bc0de; font-size:200%;">
		<?php echo $assignedTasks;?>
			</p>	
		<p>tasks assigned</p>
		
		</div>
		</a>
		<a href="../tasks/tasks_due.php?itr=<?php echo $currentIteration ?>" style="color:#2c3e50;">
		<div class="col-sm-2 trackingBox" style="cursor: pointer;" onclick = "changePage('project','/admin/project/project/test.php)">
		<i class="fa fa-clock-o"></i>
		<p>There are</p>
		
			<p style = "color: red; font-size:200%;">
			<?php
				echo $uncompletedHours;
			?>
			
			</p>	
		<p>task hours left</p>
		</div>
		</a>