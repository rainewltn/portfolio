<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['storyId'])){
	$storyID = $_GET['storyId'];
	$taskTitle = $_GET['taskTitle'];
	$taskDesc =  $_GET['taskDesc'];
	$taskOrder =$_GET['taskOrder'];
	$taskHours =$_GET['taskHours'];
	$taskUsers = $_GET['taskUsers'];
	$taskEnd = $_GET['taskEnd'];
}
	
	
	$wpdb->insert( 
	'wp_dlod_strayTasks', 
		array( 
			'title' => $taskTitle,
			'desc' => $taskDesc, 
			'order' => $taskOrder,
			'col' => 1,
			'hours' => $taskHours,
			'end_date' => $taskEnd
		), 
		array( 
			'%s', 
			'%s', 
			'%d', 
			'%d',
			'%d',
			'%d',
		) 
	);
	$lastID = $wpdb->insert_id;
	foreach($taskUsers as $u)
	{
		$wpdb->insert( 
		'wp_dlod_TASKUSER', 
			array( 
				'task_id' => $lastID,
				'user_id' => $u		
			), 
			array( 
				'%d',
				'%d',
			) 
		);
	}
	
	$wpdb->insert( 
	'wp_dlod_TASKSTORY', 
		array( 
			'task_id' => $lastID,
			'story_id' => $storyID		
		), 
		array( 
			'%d',
			'%d',
		) 
	);
	
	echo $storyID;
?>