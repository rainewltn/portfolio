<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['goalID'])){
	$goalID = $_GET['goalID'];
	
}
	
$wpdb->delete( 'wp_dlod_strayPartyTasks', array( 'ID' => $_GET['goalID'] ) );
$wpdb->delete('wp_dlod_PARTYTASKS', array( 'task_id' => $_GET['goalID'] ));

?>