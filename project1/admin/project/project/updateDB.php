<?php 
require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

if(isset($_GET['status']))
{
	$wpdb->update( 
	'wp_dlod_strayTasks', 
	array( 
		'status' => $_GET['status'],
		'actual_hours' => $_GET['actual']
	), 
	array( 'ID' => $_GET['taskID'] ), 
	array( 
		'%d',	// value1
	), 
	array( '%d' ) 
	);
	$wpdb->update( 
				'wp_dlod_strayStories', 
				array( 
					'completed' => $_GET['completed']	
				), 
				array( 'ID' => $_GET['storyID'] ), 
				array( 
					'%d',	// value1
				), 
				array( '%d' ) 
	);
}else{
	$current_date = time()-21600;
	
	$wpdb->update( 
	'wp_dlod_strayTasks', 
	array( 
		'col' => $_GET['colID'],	
		'order' => $_GET['taskID'],
		'end_date' => $current_date
	), 
	array( 'ID' => $_GET['taskID'] ), 
	array( 
		'%d',	// value1
		'%d'	// value2
	), 
	array( '%d' ) 
);


}
	
	
	


	

?>
