<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['id'])){
	$storeItemId = $_GET['id'];
	$remainder =  $_GET['remainder'];
}

	
	$userId = get_current_user_id();
	$wpdb->insert( 
	'wp_dlod_strayTransactionHistory', 
		array(
			'user_id' => $userId, 
			'storeItem_id' => $storeItemId
			
		), 
		array( 
			'%d', 
			'%d',
		) 
	);

	$status = $wpdb->update( 
	'wp_dlod_strayUserStats', 
	array( 
		'totalPoints' => $remainder
	), 
	array( 'user_id' =>  $userId)
);
	
?>