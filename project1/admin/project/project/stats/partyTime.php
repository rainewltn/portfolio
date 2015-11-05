<?php 
require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;


	$current_date = time()-21600;
	
	$wpdb->update( 
	'wp_dlod_strayParty', 
	array( 
		'active' => $_GET['setTo'],
		'start_time' => $current_date
	), 
	array( 'ID' => 1), 
	array( 
		'%d',	// value1
		'%d'	// value2
	), 
	array( '%d' ) 
);



	
	
	


	

?>
