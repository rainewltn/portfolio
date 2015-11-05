<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;
	
		$currentIteration = $wpdb->get_var('SELECT Current_Iteration FROM wp_dlod_strayAdminTable WHERE ID = 1');
				

				$linkSTORYITERATION = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");
				foreach($linkSTORYITERATION as $lsu)
				{
						$storiesALL = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsu->story_id."");
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
				
				$ID = $wpdb->get_var('SELECT MAX(ID) FROM wp_dlod_strayIterationBurndown WHERE Iteration = '.$currentIteration.'');
				
					$wpdb->update( 
						'wp_dlod_strayIterationBurndown', 
						array( 
							'Actual' => $uncompletedHours
						), 
						array( 'ID' =>  $ID)
					);
					
					echo "ID = " . $ID;
			
?>