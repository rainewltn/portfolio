<?php


require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

			if(isset($_GET['selectedIteration']))
			{
				$currentIteration = $_GET['selectedIteration'];
			}
			$currentRelease = $wpdb->get_var('SELECT Current_Release FROM wp_dlod_strayAdminTable WHERE ID = 1');
			$ITERATIONRELEASElink = $wpdb->get_results("SELECT iteration_id FROM wp_dlod_strayStories WHERE ID = ".$currentRelease."");
			$counter = 0;
			$currentIterationID;
			foreach($ITERATIONRELEASElink as $irl)
			{
				if($counter == $currentIteration)
				{
					$currentIterationID = $irl->iteration_id;
				}
				$counter++;
			}
			$storyLink = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");
			
			foreach($storyLink as $sl) 
			{
				$stories = $wpdb->get_results("SELECT * FROM wp_dlod_strayStories WHERE ID = ".$sl->story_id."");

					 foreach($stories as $s)
					 {
						 $usersID = $wpdb->get_results("SELECT user_id FROM wp_dlod_STORYUSER WHERE story_id = ".$s->ID."");
					
						
							echo '<div class="story" name="'.$s->ID.'"><div class="progressBar" id="'.$s->ID.'"></div>';
							echo '<aside class="taskText storyTitle'.$s->ID.'">'. $s->title.'</aside>';
							echo '<aside class="hideDiv storyDesc'.$s->ID.'">'. $s->desc.'</aside>';
							echo '<div class="userBox userBox'.$s->ID.'">';
							foreach($usersID as $u)
							{
								$users = get_userdata($u->user_id);
								echo '<div class="users users'.$s->ID .'-'.$u->user_id.'"><img style="width:15px" src=/images/people/'.$users->user_login.'.png> &nbsp;</div>';
							}
							echo '</div>';
							if($s->completed)
							{
								echo '<div class="" style="position:relative; right:-15px;top:-4px;color:rgb(60, 201, 32);"><i class="fa fa-check"></i></div>';
							}
							echo '<div class="points points'.$s->ID.'">'. $s->points .'</div></div>';
							
						
					 }
				 
			}
?>