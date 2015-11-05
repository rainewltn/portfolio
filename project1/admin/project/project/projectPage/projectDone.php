<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['projectID'])){
	$projectName = $_GET['projectID'];
	
}
	
	$wpdb->update( 
				'wp_dlod_strayProjects', 
				array( 
					'completed' => $_GET['completed']	
				), 
				array( 'ID' => $_GET['projectID'] ), 
				array( 
					'%d',	// value1
				), 
				array( '%d' ) 
	);
?>