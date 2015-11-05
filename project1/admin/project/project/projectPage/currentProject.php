<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['projectID'])){
	
	
}
	
	$wpdb->update( 
				'wp_dlod_strayAdminTable', 
				array( 
					'Current_Project' => $_GET['projectID']
				), 
				array( 'ID' => 1), 
				array( 
					'%d',	// value1
				), 
				array( '%d' ) 
	);
?>