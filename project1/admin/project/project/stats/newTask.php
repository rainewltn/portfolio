<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['goal'])){
	$goal = $_GET['goal'];
	$releaseID = $_GET['releaseID'];
	
}
	
	$wpdb->insert( 
	'wp_dlod_strayPartyTasks', 
		array(
			'task' => $goal, 			
		), 
		array( 
			'%s', 
		) 
	);
	$lastInsert = $wpdb->insert_id;
	$wpdb->insert( 
	'wp_dlod_PARTYTASKS', 
		array(
			'task_id' => $lastInsert,
			'party_id' => $releaseID
		), 
		array( 
			'%d', 
			'%d'
		) 
	);
	
?>