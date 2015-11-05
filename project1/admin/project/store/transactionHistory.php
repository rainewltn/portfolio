<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;
		
		
			
?>
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Transaction Page | Stray Pixel Games</title>
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
                    <h3>Transactions</h3>
                    <hr class="star-light">
                </div>
</div> 
<div class="releaseHolder">
<?php 		
			
		$transactions = $wpdb->get_results("SELECT ID, user_id, storeItem_id, fulfilled FROM wp_dlod_strayTransactionHistory WHERE fulfilled = 0");			
				echo '<div class="row">';
				echo '<div class="col-lg-12">';
				echo '<div class="releaseBox">';
						
				echo '<ul>';
				foreach($transactions as $t)
				{			
						$username = $wpdb->get_var('SELECT user_login FROM wp_dlod_users WHERE ID = '. $t->user_id .'');
						$storeInfo = $wpdb->get_results('SELECT ID, title, cost FROM wp_dlod_strayStore WHERE ID = '. $t->storeItem_id .'');						
						foreach($storeInfo as $item)
						{						
							
									if($t->fulfilled)
									{
										$class="fa fa-check-square-o fa-2x releaseHover";
									}else
									{
										$class="fa fa-square-o fa-2x releaseHover";
									}
									
									echo '<li class="transaction" id="transaction'. $t->ID .'">
									
									<i class="'. $class .'" id="goalCheck'. $t->ID .'" onclick="fillOrder('. $t->ID .')"></i>
									 <b>'. $username .'</b> bought a <b style="color:orange;">'. $item->title .'</b></li>';
								 
						} 
				}	
				echo '</ul>';
				echo '</div>';
			echo '</div>';
?>

			<style>
				
				.releaseBox
				{
					box-shadow:  0px 0px 5px 0px rgba(50, 50, 50, 0.95);
					height: 600px;
					border-radius:5px;
					margin:10px;
					padding: 10px;
				}
			
				.transaction
				{
					box-shadow:  0px 0px 1px 0px rgba(50, 50, 50, 0.95);
					padding:8px;
					margin-top:10px;
					list-style:none;
				}
			
				.releaseHover
				{
					margin:-2px;
					color: #111;		
					float:right;					
				}
				.releaseHover:hover
				{
					cursor:pointer;
					color:#3498db;
				}
				
				ul
				{
					padding:0px;
				}
				.box
				{
					background-color:#e3e3e3;
					border-radius:5px;
					padding:10px;
					
				}
			
				
				
			</style>
					
		
	</div>	
			
		
</body>

	<script>

		
		function fillOrder(transactionID)
		{
				var completed = 0;
				if($('#goalCheck' + transactionID).hasClass('fa-square-o'))
				{
					completed = 1;
				}
			
				$.ajax({url: 'fillOrder.php',
				type: 'GET',
				data: {transactionID,completed},
				success: function(data){
					$('#goalCheck' + transactionID).removeClass('fa-square-o');
					$('#goalCheck' + transactionID).addClass('fa-check-square-o');
					console.log(transactionID);
					console.log(completed);
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 
				});
		}
		
		
	</script>
	
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</html>