<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['storyId'])){
	$selectedStory = $_GET['storyId'];	
}else
{
	$selectedStory = 1;
}
	
	$taskArray = array();
	$linksTS = $wpdb->get_results("SELECT story_id, task_id FROM wp_dlod_TASKSTORY");
	if(!empty($linksTS)) 
	{ 
		 foreach($linksTS as $link)
		 {	
			if($link->story_id == $selectedStory)
			{
				 $tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$link->task_id."");
				  foreach($tasks as $t)
				 {
					 	
						$usersElement;
						$linkTASKUSER = $wpdb->get_results("SELECT user_id FROM wp_dlod_TASKUSER WHERE task_id = ".$t->ID."");
						foreach($linkTASKUSER as $ltu)
						{																		
							$users = get_userdata($ltu->user_id);		
							$usersElement = $users->user_login;
						}
						$t->usersBox = $usersElement;
						$taskArray[] = $t;	
				 }	
			}
		 }
		 echo json_encode($taskArray); 
	}


				
						
	
?>