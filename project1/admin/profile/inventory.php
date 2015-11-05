<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;
 if (!is_user_logged_in()) 
 {
	 header('/wp-login.php');
 }


$linkEQUIPMENTUSER = $wpdb->get_results("SELECT equipment_id, equipped FROM wp_dlod_EQUIPMENTUSER WHERE user_id = ".$id."");		
				echo '<div class="col-lg-8 avatarHolder">';
				foreach($linkEQUIPMENTUSER as $leu)
				{
					$equipment = $wpdb->get_results("SELECT * FROM wp_dlod_strayEquipment WHERE ID = ".$leu->equipment_id."");	
					foreach($equipment as $item)
					{
					if($item->ATK > 0){$atk = "<p>Atk:<b style='color:green;'> ".$item->ATK."</b></p>";}
					if($item->ATK < 0){$atk = "<p>Atk:<b style='color:red;'> ".$item->ATK."</b></p>";}
					echo'<div class="equipmentSlot" id="'.$item->type.'"><img src="'.$item->URL.'"></div>';
					echo '<span class="statsSpan" id="'.$item->type.'Stats"><p>name: '.$item->name.'</p><p>description: '.$item->desc.'</p>'.$atk.'<p>Def: '.$item->DEF.'</p><p>Spd: '.$item->SPD.'</p></span>';
					
	?> 