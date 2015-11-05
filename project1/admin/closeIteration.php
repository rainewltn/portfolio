<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;
		$currentIteration = $wpdb->get_var('SELECT Current_Iteration FROM wp_dlod_strayAdminTable WHERE ID = 1');
		$linkSTORYITERATION = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");			
				foreach($linkSTORYITERATION as $lsi)
				{			
						$linkSTORYUSER = $wpdb->get_results("SELECT user_id, story_id FROM wp_dlod_STORYUSER WHERE story_id = ".$lsi->story_id."");
						foreach($linkSTORYUSER as $lsu)
						{
								$storiesALL = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsu->story_id."");//lsu if you want by user
								foreach($storiesALL as $sALL)
								{	
									if($sALL->completed)
									{
										$totalPoints = $wpdb->get_var('SELECT totalPoints FROM wp_dlod_strayUserStats WHERE user_id='. $lsu->user_id .'');
										
										$totalPoints += $sALL->points;
										
										$status = $wpdb->update( 
											'wp_dlod_strayUserStats', 
											array( 
												'totalPoints' => $totalPoints
											), 
											array( 'user_id' =>  $lsu->user_id)
										);
									}
								
								}
							
						}
				}
			echo "Complete.";
?>