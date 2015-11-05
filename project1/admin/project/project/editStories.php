<?php
require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

$storyID = $_GET['storyID'];
$storyIteration = $_GET['storyIteration'];
if(isset($_GET['storyDesc'])){
	
		$storyDesc =  $_GET['storyDesc'];
		$storyTitle = $_GET['storyTitle'];
		$storyOrder =$_GET['storyOrder'];
		$storyPoints =$_GET['storyPoints'];
		$storyUsers = $_GET['storyUsers'];

		$status = $wpdb->update( 
		'wp_dlod_strayStories', 
		array( 
			'title' => $storyTitle,
			'desc' => $storyDesc, 
			'order' => $storyOrder,
			'points' => $storyPoints,
		), 
		array( 'ID' =>  $storyID)
		);
		$wpdb->delete( 'wp_dlod_STORYUSER', array( 'story_id' => $storyID ) );
		foreach($storyUsers as $u)
		{
			$wpdb->insert( 
			'wp_dlod_STORYUSER', 
				array( 
					'story_id' => $storyID,
					'user_id' => $u		
				), 
				array( 
					'%d',
					'%d',
				) 
			);
		}
	}
	$status = $wpdb->update( 
	'wp_dlod_STORYITERATION', 
	array( 
		'iteration_id' => $storyIteration		
	), 
	array( 'story_id' =>  $storyID)
	);

?>