<?php 
require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

	$wpdb->update( 
				'wp_dlod_strayTransactionHistory', 
				array( 
					'fulfilled' => $_GET['completed']	
				), 
				array( 'ID' => $_GET['transactionID'] ), 
				array( 
					'%d',	// value1
				), 
				array( '%d' ) 
	);
	
	?>