<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Store | Stray Pixel Games</title>

</head>
<body>


<nav>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php';



?>
</nav>
	<div id="blankout"></div>
	<div id="viewWindow"> 
		<span class="closeButton taskClose" onclick="closeViewItem()"><i class="fa fa-times"></i></span>
		<!-- Add Delte button -->
		<h2 id="itemTitle"></h2>
		<p id="itemDesc"></p>
		<br>
		<img src="" id="itemImg">
		<h3 id="itemCost">Cost: </h3>
		<br>
		<button class="btn btn-default storeBuyThis" onclick="buyItemThis()">Buy</button>
	
	</div>
	
</br></br></br></br></br></br>

	<div class="container">
			<div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Stray Pixel STORE</h3>
                    <hr class="star-light">
					<h4>This is the Stray Pixel Employee store!  You use story points to buy these awesome and lame things! </h4>
					<small>Incentive programs are actually under debate in the organizational psychology community. Some say they do nothing or make things worse.
					While others claim that you will get no where without them.  I personally don't really care!  It sounds like fun which is what we are all about. If you want to 
					know more about this topic then talk to DARREN! #themoreyouknow</small>
                </div>
            </div> 
			</br></br></br>
			<style>
		#itemImg
		{
			max-height:300px;
		}
		#itemDesc
		{
			
		}
		#itemTitle
		{
			color:#3498db;
		}
		#itemCost
		{
			
			color: #ff9c00;
			position:absolute;
			top:440px;
			right:15px;
		}
		.storeBuyThis
		{
			
			position:absolute;
			top:400px;
			right:15px;
			width:100px;
		}
		.hideDiv
		{
			display: none !important;
		}
		#viewWindow
		{
			width:600px;
			height:500px;
			position: fixed;
			top: 50%;
			left: 50%;
			border-radius:2px;
			transform: translate(-50%, -40%);
		    background-color:#fff;
			z-index:9999999;
			padding:10px;
		}
		#blankout
		{
			position:fixed;
			top:0px;
			width:100%;
			height:100%;
			background-color:rgba(0,0,0,.6);
			z-index:98;
		}
		.zTo1
		{
			Z-index:1;
		}
		.closeButton
		{
			position:absolute;
			top: 5px;
			right:10px;
			width:20px;
			height:20px;
			text-align:center;
			border-radius:2px;
			line-height:17px;
		}
		.closeButton:hover
		{
			border: 1px solid #111;
			color:#111;
			background-color:#fff;
		}
		.closeButton:active
		{
			border: 1px solid #ccc;
			background-color:#fff;
			color:#111;
		}
		
			
			.taskBox
			{
				background-color:#fff;
				height:185px;

		
				padding: 5px;
				border-radius: 3px;
				box-shadow:  0px 0px 3px 0px rgba(0,0,0,1); 
				margin-bottom:5px;
			}
			.taskBox:hover
			{
				background-color:#e9e9e9;
				cursor:pointer;
			}
			.taskBox img
			{
				max-height: 170px;
				max-width:215px;
			}
			.outer p
			{
				margin-bottom:0px;
			}
			.outer{
				margin-bottom:15px;
			}
			.storeBuy
			{
				position:relative;
				left:-23px;
				top:-160px;
				width:80px;
				height: 65px;
				float:right;
			}
			.storeView
			{
				position:relative;
				left:56px;
				top:-70px;
				width:80px;
				height: 65px;
				float:right;
			}
			.itemTitle
			{
				font-weight:bold;
			}
			.cost
			{
				color:#ff9c00;
			}
			.imageHolder
			{
				height: 170px;
				width:215px;
			}

			</style>
			
			<?php
				$totalPoints = $wpdb->get_var("SELECT totalPoints FROM wp_dlod_strayUserStats WHERE user_id =". get_current_user_id() ."");
			
			?>
			<div class="row">
				<p>You have: <b class="totalPoints cost"><?php echo $totalPoints; ?></b> points to spend.</p>
			</div>
			<div class="row">
			<?php
				$storeItems = $wpdb->get_results("SELECT * FROM wp_dlod_strayStore");
					foreach($storeItems as $s)
					{
						echo '<div class="col-sm-4 outer"><div class="taskBox">';
						echo '<div class="imageHolder"><img class="itemImg'. $s->ID .'" src="../store/images/'. $s->image .'"></div>';
						echo ' <button class="btn btn-info storeBuy" onclick="buyItem('. $s->ID .')">Buy</button>';
						echo ' <button class="btn btn-info storeView" onclick="viewItem('. $s->ID .')">View</button></div>';
						echo '<p class="itemTitle itemTitle'. $s->ID .'">'. $s->title .'</p>';
						echo '<p class="itemDesc itemDesc'. $s->ID .' hideDiv">'. $s->desc .'</p>';
						echo '<p>Cost: <span class="cost cost'. $s->ID .'">'. $s->cost .' pts</span></p></div>';
					}
			?>
				
			</div>
			<div class="row">
			<?php
			$id = get_current_user_id();
			if($id==7)
			{
				$equipment = $wpdb->get_results("SELECT * FROM wp_dlod_strayEquipment WHERE cost > 0");
					foreach($equipment as $e)
					{
						echo '<div class="col-sm-4 outer"><div class="taskBox">';
						echo '<div class="imageHolder"><img class="itemImg'. $e->ID .'" src="/admin/'. $e->URL .'"></div>';
						echo ' <button class="btn btn-info storeBuy" onclick="buyEquip('. $e->ID .')">Buy</button>';
						echo ' <button class="btn btn-info storeView" onclick="viewEquip('. $e->ID .')">View</button></div>';
						echo '<p class="itemTitle itemTitle'. $e->ID .'">'. $e->name .'</p>';
						echo '<p class="itemDesc itemDesc'. $e->ID .' hideDiv">'. $e->desc .'</p>';
						echo '<p>Cost: <span class="cost cost'. $e->ID .'">'. $e->cost .' pts</span></p></div>';
					}
			}
			?>
				
			</div>
		
	</div>

</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';?>
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</body>
	<script>
	$('#viewWindow').addClass('hideDiv');
	$('#blankout').addClass('hideDiv');
		function viewItem(id)
		{
			$('#viewWindow').removeClass('hideDiv');
			$('#blankout').removeClass('hideDiv');
			$('html, body').css({
				'overflow': 'hidden',
				'height': '100%'
			});
			$('nav').addClass('zTo1');	
			var title = $('.itemTitle' + id).text();
			var desc = $('.itemDesc' + id).text();
			var img = $('.itemImg' + id).attr('src');
			var cost = $('.cost' + id).text();
			
			$(".storeBuyThis").attr("onclick","buyItem("+id+")");
			$('#itemTitle').text(title);
			$('#itemDesc').text(desc);
			$('#itemImg').attr('src', img);
			$('#itemCost').text(cost);
		}
		function closeViewItem()
		{
				$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
				});
				$('nav').removeClass('zTo1');	
				var $editer = $('#viewWindow').addClass('hideDiv');
				var $blanker = $('#blankout').addClass('hideDiv');
								
		}
		function buyItem(id)
		{
			var cost = parseInt($('.cost' + id).text());
			var total = parseInt($('.totalPoints').text());
			var remainder = total - cost;
			console.log(remainder);
			if(cost <= total)
			{
				$.ajax({url: 'buyItem.php',
				type: 'GET',
				data: {id, remainder},
				success: function(data){
					
					$('.totalPoints').text(remainder);
					alert("Item boughted...pls wait for darren do do the thing");
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 6000
				});
			}
			else
			{
				alert("You are too poor.");
			}
			
		}
		
	
	</script>
</html>