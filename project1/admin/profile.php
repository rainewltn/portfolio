<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;
 if (!is_user_logged_in()) 
 {
	 header('/wp-login.php');
 }
?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';?>	
	
	<title>Profile Page | Stray Pixel Games</title>

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
                    <h3>Profile Page</h3>
                    <hr class="star-light">
                </div>
            </div>  
			</br></br></br>

<style>


</style>
			
				
				
					
	<div class="row">		
		<div class="col-lg-4">

<?php 
if(isset($_GET['userID']))
{
	$id = $_GET['userID'];
}
else
{
	$id = get_current_user_id();
}
	
	$user = get_userdata($id);		
	$userStats = $wpdb->get_results('SELECT stars, platStars, smellyStars, totalPoints FROM wp_dlod_strayUserStats WHERE user_id = "'. $id .'"');
	$userImage = "/images/people/" . $user->user_login . ".png";
	echo '<img  src="'. $userImage .'">';
	foreach($userStats as $userStat)
	{
		
		for($i=0;$i<$userStat->stars;$i++)
		{
			echo '<img src="/admin/project/store/images/goldStar.png" width=50 >';
		}
		for($i=0;$i<$userStat->platStars;$i++)
		{
			echo '<img src="/admin/project/store/images/platStar.png" width=50 >';
		}
		for($i=0;$i<$userStat->smellyStars;$i++)
		{
			echo '<img src="/admin/project/store/images/smellyStar.png" width=50 >';
		}
		echo "<p>Points: " . $userStat->totalPoints . '</p>';
	}
	
	
	
	echo "<p>Username: " . $user->user_login . '</p>';
	echo "<p>Full Name: " . $user->display_name. '</p>';
	echo "<p>E-mail: " . $user->user_email . '</p>';	
	echo "<p>Start Date: " . $user->user_registered . '</p>';

	
			
		
?>
		</div>
	
	<style>
		.avatarHolder
		{
			padding: 5px;
			
		}
		.equipmentSlot
		{
			padding: 5px;
			border-radius: 3px;
			box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,1); 
			margin:5px;
			border-radius: 5px;
			opacity:1;
		}
		.equipmentSlot:hover
		{
			cursor:pointer;
			box-shadow: 0px 0px 3px 0px rgba(0,0,0,1);
			opacity:0.8;		
		}
		.equipmentSlot img{width:100%;}
		#helmet
		{
			width: 100px;
			height: 150px;
			position:absolute;
			left:300px;
			
		}
		#armour
		{
			width: 125px;
			height: 150px;
			position:absolute;
			left:289px;
			top:165px
		}
		#pants
		{
			width: 100px;
			height: 200px;
			position:absolute;
			left:300px;
			top:325px;
		}
		#boots
		{
			width: 150px;
			height: 100px;
			position:absolute;
			left:275px;
			top:530px;
		}
		#gloves
		{
			width: 100px;
			height: 50px;
			position:absolute;
			top: 200px;
			left:180px;
		}
		#weapon
		{
			width: 75px;
			height: 400px;
			position:absolute;
			left:100px;
			top: 100px;
		}
		#offHand
		{
			width: 100px;
			height: 200px;
			position:absolute;
			right:200px;
			top: 125px;
		}
		.statsSpan
		{
			width:250px;
			height:400px;
			
			position:absolute;
			color:#111;
			background: rgba(204, 204, 204, .5);			
			border-radius:5px;
			top:0px;
			left:600px;
			padding: 5px;
		}
		
		
	</style>
	<?php
		if($id == 7)
		{
			$userStats = $wpdb->get_results("SELECT * FROM wp_dlod_strayUserStats WHERE user_id = ".$id."");	
			foreach($userStats as $stat)
			{
				$attack = $stat->ATK;
				$defense =$stat->DEF;
				$speed = $stat->SPD;
				$level = $stat->level;
			}
		
		
			$linkEQUIPMENTUSER = $wpdb->get_results("SELECT equipment_id, equipped FROM wp_dlod_EQUIPMENTUSER WHERE user_id = ".$id."");		
				echo '<div class="col-lg-8 avatarHolder">';
				foreach($linkEQUIPMENTUSER as $leu)
				{
					if($leu->equipped)
					{
						$equipment = $wpdb->get_results("SELECT * FROM wp_dlod_strayEquipment WHERE ID = ".$leu->equipment_id."");	
						foreach($equipment as $item)
						{
							echo'<div class="equipmentSlot" id="'.$item->type.'" onclick="selectInventory('.$item->type.')"><img src="'.$item->URL.'"></div>';
							echo '<span class="statsSpan" id="'.$item->type.'Stats"><p>name: '.$item->name.'</p><p>description: '.$item->desc.'</p><p>Atk: '.$item->ATK.'</p><p>Def: '.$item->DEF.'</p><p>Spd: '.$item->SPD.'</p></span>';
							$attack+=$item->ATK;
							$defense+=$item->DEF;
							$speed+=$item->SPD;
						}
					}
				}
				
				echo'</div>';
	?>
	
	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-8">
			<button class="btn btn-info">Duel!</button>
		</div>
	</div>
	<?php 
		}
	?>
	</div>
	
	</div>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>

<style>
 .hoverOptions:hover
 {
	color:blue;
	
 }
 .hoverOptions
 {
	 position:relative;
	bottom: 10px;
	color:orange;
 }

</style>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';?>
		<script>
			
		
			$('.equipmentSlot').hover(function(){
				$('.statsSpan').hide();
				var hoverId = $(this).attr('id');
				$('#' + hoverId + 'Stats').show();
			});
			function inventory(type)
			{
				
			}
			
			function selectInventory(type)
			{
					h = 600;
					w = 800;
				var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
				var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

				width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
				height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

				var left = ((width / 2) - (w / 2)) + dualScreenLeft;
				var top = ((height / 2) - (h / 2)) + dualScreenTop;
				var newWindow = window.open("profile/inventoryView.php?type="+type+"", "Task View", 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

				// Puts focus on the newWindow
				if (window.focus) {
					newWindow.focus();
				}
					
			}
	
			
			
		</script>
</body>

	<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</html>