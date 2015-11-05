<?php
require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

		$storyID = $_GET['storyID'];
		$storyIteration = $_GET['storyIteration'];
		$storyDesc =  $_GET['storyDesc'];
		$storyTitle = $_GET['storyTitle'];
		$storyOrder =$_GET['storyOrder'];
		$storyPoints =$_GET['storyPoints'];
		$storyUsers = $_GET['storyUsers'];

		$storyPoints = round($storyPoints/2);
		$storyTitle = $storyTitle . " 2";
		$storyIteration += 1;
		$status = $wpdb->update( 
		'wp_dlod_strayStories', 
		array( 
			'points' => $storyPoints,
		), 
		array( 'ID' =>  $storyID)
		);
		
		
	
	
		$wpdb->insert( 
		'wp_dlod_strayStories', 
			array(
				'title' => $storyTitle, 
				'desc' => $storyDesc, 
				'order' => $storyOrder,
				'points' => $storyPoints,
			), 
			array( 
				'%s', 
				'%s', 
				'%d', 
				'%d',
			) 
		);
		$lastID = $wpdb->insert_id;
		foreach($storyUsers as $u)
		{
			$wpdb->insert( 
			'wp_dlod_STORYUSER', 
				array( 
					'story_id' => $lastID,
					'user_id' => $u		
				), 
				array( 
					'%d',
					'%d',
				) 
			);
		}
		$wpdb->insert( 
		'wp_dlod_STORYITERATION', 
			array( 
				'story_id' => $lastID,
				'iteration_id' => $storyIteration		
			), 
			array( 
				'%d',
				'%d',
			) 
		);
	
	
	
	$tasks = $wpdb->get_results("SELECT * FROM wp_dlod_TASKSTORY WHERE story_id = ".$storyID."");
	foreach($tasks as $t)
	{
		$taskCol = $wpdb->get_var("SELECT col FROM wp_dlod_strayTasks WHERE ID = ".$t->task_id." ");
		if($taskCol != 3)
		{
			$status = $wpdb->update( 
				'wp_dlod_TASKSTORY', 
				array( 
				'story_id' => $lastID		
				), 
				array( 'task_id' =>  $t->task_id)
			);
		}
	}
?>