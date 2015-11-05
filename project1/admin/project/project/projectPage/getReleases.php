<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;
$currentProject = $_GET['projectID'];
				
			$RELEASEPROJECTlink = $wpdb->get_results('SELECT release_id, project_id FROM wp_dlod_RELEASEPROJECT WHERE project_id ="'. $currentProject .'"');
				echo '<div class="row releasesRow">';
			foreach($RELEASEPROJECTlink as $rpl)
			{	
				
				$releases = $wpdb->get_results('SELECT ID, title FROM wp_dlod_strayReleases WHERE ID = "'. $rpl->release_id .'"');
				
				foreach($releases as $r)
				{
					
					echo '<div class="col-lg-4">';
						echo '<div class="releaseBox">';
							echo '<h3 class="releaseTitle">'. $r->title .'</h3>';
							echo '<ul>';
							$RELEASEGOALlink = $wpdb->get_results('SELECT release_id, releaseGoal_id FROM wp_dlod_RELEASEGOALS WHERE release_id ="'. $r->ID .'"');
							foreach($RELEASEGOALlink as $rgl)
							{
								$releaseGoals = $wpdb->get_results('SELECT * FROM `wp_dlod_strayReleaseGoals` WHERE ID="'. $rgl->releaseGoal_id .'"');
								foreach($releaseGoals as $RG)
								{
									if($RG->completed)
									{
										echo '<li class="releaseGoal releaseGoal'. $r->ID .'" id="releaseGoal'. $RG->ID .'" style="text-decoration: line-through;"><i class="fa fa-trash-o releaseHover" onclick="deleteGoal('. $rgl->releaseGoal_id .')"></i><i class="fa fa-check-square-o releaseHover"  id="goalCheck'. $rgl->releaseGoal_id .'" onclick="markGoalDone('. $rgl->releaseGoal_id .')"></i>'. $RG->goal .'</li>';
									}
									else
									{
										echo '<li class="releaseGoal releaseGoal'. $r->ID .'" id="releaseGoal'. $RG->ID .'"><i class="fa fa-trash-o releaseHover" onclick="deleteGoal('. $rgl->releaseGoal_id .')"></i><i class="fa fa-square-o releaseHover" id="goalCheck'. $rgl->releaseGoal_id .'" onclick="markGoalDone('. $rgl->releaseGoal_id .')"></i>'. $RG->goal .'</li>';
									}
								}
								
							}
									echo '<li class="releaseGoalNew new'. $r->ID .'" onclick="addReleaseGoal('. $r->ID .')"><i class="fa fa-plus"></i></li>';
							echo '</ul>';
						echo '</div>';
					echo '</div>'; 
					
				}
				
					
			}
			
					echo '<div class="col-lg-4 ">';
						echo '<div class="releaseBoxNew" onclick="addRelease()">';
							echo '<span class="fa-stack fa-lg"><i class="fa fa-circle-thin fa-stack-2x"></i><i class="fa fa-plus fa-stack-1x"></i></span>';			
						echo '</div>';
					echo '</div>'; 
					
					echo '</div>';
			?>