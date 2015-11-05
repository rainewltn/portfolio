<?php 


require('../includes/config.php');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


try {
		
							//update database
							$stmt1 = $db->prepare('UPDATE tasks SET complete ='."1".' WHERE task_id = '.$_GET['task_id'].'') ;
							$stmt1->execute(array(
								':complete' => 1
								
								
							));
						
			

	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

	

?>
