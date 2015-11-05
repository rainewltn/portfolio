<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['goal'])){
	$goal = $_GET['goal'];
	$releaseID = $_GET['releaseID'];
	
}
	
	$wpdb->insert( 
	'wp_dlod_strayReleaseGoals', 
		array(
			'goal' => $goal, 			
		), 
		array( 
			'%s', 
		) 
	);
	$lastInsert = $wpdb->insert_id;
	$wpdb->insert( 
	'wp_dlod_RELEASEGOALS', 
		array(
			'releaseGoal_id' => $lastInsert,
			'release_id' => $releaseID
		), 
		array( 
			'%d', 
			'%d'
		) 
	);
	
?>