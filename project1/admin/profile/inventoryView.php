<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Inventory for fun | Stray Pixel Games</title>

</head>
<body>


<nav>
<?php 

$id = get_current_user_id();

?>
</nav>



<div class="container">

<div class="row">
<style>
.row
{
	height:100%;
}
.taskBox
{
	background-color:#e2e4e6;
	width: 200px; 
	height: 400px;
	margin:10px;
	padding: 5px;
	border-radius: 3px;
	box-shadow:  0px 0px 3px 0px rgba(0,0,0,1); 
}
img{
	max-width:100px;
	max-height: 600px;
}
.users
{
	float:left;
}
</style>

<?php 

			
										 $item = $wpdb->get_results("SELECT * FROM wp_dlod_EQUIPMENTUSER WHERE user_id = 7");
										foreach($item as $i)
										{
											$equipment = $wpdb->get_results("SELECT * FROM wp_dlod_strayEquipment WHERE ID = ".$i->equipment_id."");	
											foreach($equipment as $e)
											{
															if($e->ID > 7)
															{
																echo '<div class="col-lg-3 taskBox">';
																echo '<b><p>'. $e->name .'</p></b>';															
																echo '<p>'. $e->desc .'</p>';																
																echo "<img src='/admin/".$e->URL."'>";
																echo '</div>';	
															}
											}			
				
										}

	
			
		
?>



	</div>
	

	
	</div>

	
</body>

</html>