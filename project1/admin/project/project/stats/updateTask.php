<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['goalID'])){
	$goalID = $_GET['goalID'];
	
}
	
	$wpdb->update( 
				'wp_dlod_strayPartyTasks', 
				array( 
					'completed' => $_GET['completed']	
				), 
				array( 'ID' => $_GET['goalID'] ), 
				array( 
					'%d',	// value1
				), 
				array( '%d' ) 
	);
	
?>