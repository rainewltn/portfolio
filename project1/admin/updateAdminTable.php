<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;
	
		if(isset($_GET['currentIteration']))
		{
					$wpdb->update( 
						'wp_dlod_strayAdminTable', 
						array( 
							'Current_Iteration' => $_GET['currentIteration']
						), 
						array( 'ID' =>  1)
					);
					
		}
			
?>