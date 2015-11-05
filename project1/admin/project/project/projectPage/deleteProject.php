<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['projectID'])){
	$projectID = $_GET['projectID'];
	
}
	
$wpdb->delete( 'wp_dlod_strayProjects', array( 'ID' => $_GET['projectID'] ) );
//$wpdb->delete( 'wp_dlod_STORYITERATION', array( 'story_id' => $_GET['storyID'] ) );
//$wpdb->delete( 'wp_dlod_STORYUSER', array( 'story_id' => $_GET['storyID'] ) );

//$tasks = $wpdb->get_results("SELECT * FROM wp_dlod_TASKSTORY WHERE story_id = ".$_GET['storyID']."");
//foreach($tasks as $t)
//{
//	$wpdb->delete( 'wp_dlod_TASKUSER', array( 'task_id' => $t->task_id ) );
//	$wpdb->delete( 'wp_dlod_strayTasks', array( 'ID' => $t->task_id ) );
//}
//$wpdb->delete( 'wp_dlod_TASKSTORY', array( 'story_id' => $_GET['storyID'] ) );



//}
?>