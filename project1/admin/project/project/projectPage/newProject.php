<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['name'])){
	$projectName = $_GET['name'];
	
}
	
	$wpdb->insert( 
	'wp_dlod_strayProjects', 
		array(
			'name' => $projectName, 			
		), 
		array( 
			'%s', 
		) 
	);
	echo $wpdb->insert_id;
?>