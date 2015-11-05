<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Release Page | Stray Pixel Games</title>
	  <script src = "/bootstrap/js/jquery.js"></script>
</head>
<body>


<nav>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php';



?>
</nav>

</br></br></br></br></br></br>






<div class="container">
<div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Releases</h3>
                    <hr class="star-light">
                </div>
</div> 

<?php 		
			
			
?>

			<style>
				.releaseBoxOuter
				{
					width:300px;
				}
				.releaseBox
				{
					box-shadow:  0px 0px 5px 0px rgba(50, 50, 50, 0.95);
					min-height: 50px;
					border-radius:5px;
					margin:10px;
					padding: 10px;
				}
				
			</style>
		
		
  
    
<div class="releaseHolder">
			<?php 
				
				$currentProject = $wpdb->get_var('SELECT Current_Project FROM wp_dlod_strayAdminTable WHERE ID = 1');
				
				$RELEASEPROJECTlink = $wpdb->get_results('SELECT release_id, project_id FROM wp_dlod_RELEASEPROJECT WHERE project_id ="'. $currentProject .'"');
				echo '<div class="row releasesRow">';
			foreach($RELEASEPROJECTlink as $rpl)
			{	
				
				$releases = $wpdb->get_results('SELECT ID, title FROM wp_dlod_strayReleases WHERE ID = "'. $rpl->release_id .'"');
				
				foreach($releases as $r)
				{
					
					echo '<div class="releaseBoxOuter">';
						echo '<div class="releaseBox">';
							echo '<h4 class="releaseTitle">'. $r->title .'</h4>';
							
						echo '</div>';
					echo '</div>'; 
					
				}
				
					
			}
			
					
					echo '</div>';
			?>
			
			
		
		
	</div>	
			
		
</body>

	<script>
		
	</script>
	
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</html>