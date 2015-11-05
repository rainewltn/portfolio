<?php


require('/home/straypix/public_html/wp-blog-header.php');

global $wpdb;
$uncompletedHours;

$currentIteration = $wpdb->get_var('SELECT Current_Iteration FROM wp_dlod_strayAdminTable WHERE ID = 1');
		$linkSTORYITERATION = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");
				foreach($linkSTORYITERATION as $lsu)
				{
						$storiesALL = $wpdb->get_results("SELECT ID, completed FROM wp_dlod_strayStories WHERE ID = ".$lsu->story_id."");
						foreach($storiesALL as $sALL)
						{															
							$linkTASKSTORY = $wpdb->get_results("SELECT task_id FROM wp_dlod_TASKSTORY WHERE story_id = ".$sALL->ID."");
							foreach($linkTASKSTORY as $lts)
							{
								 $tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$lts->task_id."");
								foreach($tasks as $tALL)
								 {
									if($tALL->col == 2)
									{
										
										$uncompletedHours += $tALL->hours;
									}
									if($tALL->col == 1)
									{
										$uncompletedHours += $tALL->hours;
									}
								}
							}
						}
				}
			$wpdb->insert( 
				'wp_dlod_strayIterationBurndown', 
				array( 
					'Actual' => $uncompletedHours,
					'Iteration' => $currentIteration
				), 
				array( 
					'%d',
					'%d',
				)
			);
			
				echo "Iteration: " . $currentIteration . "Uncompleted Hours: " . $uncompletedHours;
?>