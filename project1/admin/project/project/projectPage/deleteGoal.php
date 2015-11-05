<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['goalID'])){
	$goalID = $_GET['goalID'];
	
}
	
$wpdb->delete( 'wp_dlod_strayReleaseGoals', array( 'ID' => $_GET['goalID'] ) );
$wpdb->delete('wp_dlod_RELEASEGOALS', array( 'releaseGoal_id' => $_GET['goalID'] ));

?>