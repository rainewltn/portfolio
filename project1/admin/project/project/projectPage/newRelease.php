<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['title'])){
	$title = $_GET['title'];
	$projectID = $_GET['projectID'];
	
}
	
	$wpdb->insert( 
	'wp_dlod_strayReleases', 
		array(
			'title' => $title, 			
		), 
		array( 
			'%s', 
		) 
	);
	$lastInsert = $wpdb->insert_id;
	$wpdb->insert( 
	'wp_dlod_RELEASEPROJECT', 
		array(
			'release_id' => $lastInsert,
			'project_id' => $projectID
		), 
		array( 
			'%d', 
			'%d'
		) 
	);
	
?>