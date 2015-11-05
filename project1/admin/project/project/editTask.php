<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['taskId'])){
	$taskId = $_GET['taskId'];
	$taskDesc =  $_GET['taskDesc'];
	$taskTitle = $_GET['taskTitle'];
	$taskHours =$_GET['taskHours'];
}
	
	
	$status = $wpdb->update( 
	'wp_dlod_strayTasks', 
	array( 
		'title' => $taskTitle,
		'desc' => $taskDesc, 
		'hours' => $taskHours,
	), 
	array( 'ID' =>  $taskId)
);

$returnArray = Array();
Array_push($returnArray,$taskTitle);
Array_push($returnArray,$taskDesc);
Array_push($returnArray,$taskHours);
echo json_encode($returnArray);

?>