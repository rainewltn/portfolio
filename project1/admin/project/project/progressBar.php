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
	$totalTasks = 0;
	$doneTasks = 0;
	$linksTS = $wpdb->get_results("SELECT story_id, task_id FROM wp_dlod_TASKSTORY");
	if(!empty($linksTS)) 
	{ 
		 foreach($linksTS as $link)
		 {	
			if($link->story_id == $selectedStory)
			{
				 $tasks = $wpdb->get_results("SELECT col FROM wp_dlod_strayTasks WHERE ID = ".$link->task_id."");
				  foreach($tasks as $t)
				 {
					 if($t->col == 3)
					 {
						 $doneTasks += 1;
					 }
					 $totalTasks +=1;
					
					
				 }	
			}
		 }
		 array_push($taskArray,$totalTasks);
		 array_Push($taskArray,$doneTasks);
		 echo json_encode($taskArray); 
	} 
?>