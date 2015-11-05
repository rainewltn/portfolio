<?php 


require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['taskID'])){
	
$wpdb->delete( 'wp_dlod_strayTasks', array( 'ID' => $_GET['taskID'] ) );
$wpdb->delete( 'wp_dlod_TASKSTORY', array( 'task_id' => $_GET['taskID'] ) );
$wpdb->delete( 'wp_dlod_TASKUSER', array( 'task_id' => $_GET['taskID'] ) );



}

?>