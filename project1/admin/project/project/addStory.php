<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['storyDesc'])){
	$storyTitle = $_GET['storyTitle'];
	$storyDesc =  $_GET['storyDesc'];
	$storyOrder =$_GET['storyOrder'];
	$storyPoints =$_GET['storyPoints'];
	$storyUsers = $_GET['storyUsers'];
	$storyIteration = $_GET['currentIteration'];
}
	
	
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
	
	
	echo $lastID;
?>