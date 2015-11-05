<?php


require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

		
			$storyLink = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = 0");
			
			foreach($storyLink as $sl) 
			{
				$stories = $wpdb->get_results("SELECT * FROM wp_dlod_strayStories WHERE ID = ".$sl->story_id."");

					 foreach($stories as $s)
					 {
						 $usersID = $wpdb->get_results("SELECT user_id FROM wp_dlod_STORYUSER WHERE story_id = ".$s->ID."");
					
						
							echo '<div class="storyB story" name="'.$s->ID.'" style="width:252px; float:left;"><div class="progressBar" id="'.$s->ID.'"></div>';
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
							echo "<div class='editStory' id='moveToIteration' onclick='moveToIteration(".$s->ID.")' style='position:relative; right:100px;top:10px;'> <i class='fa fa-arrow-left'></i></div>";
							echo '<div class="points points'.$s->ID.'">'. $s->points .'</div></div>';
							
						
					 }
				 
			}
?>