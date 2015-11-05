
<link rel="stylesheet" href="/css/sidebar.css">
<script src="/admin/js/sidebar.js"></script>

	<?php
	$currentUser = wp_get_current_user();
	$userImage = "/images/people/" . $currentUser->user_login . ".png";
	$currentIteration = $wpdb->get_var('SELECT Current_Iteration FROM wp_dlod_strayAdminTable WHERE ID = 1');	
	
	?>
	
	

<div id = "sidebar_admin" >
	
	<a href="/admin/profile.php"><img id = "profile_picture" src="<?php echo $userImage; ?>"></a>
	<p id="name"><?php echo $currentUser->user_login; ?></p>
	<ul>
		<a href = "/admin/project/project/"><li><i class="fa fa-dashboard"></i>&nbsp;Dashboard</li></a>		
		<a href = "/index.php?p=19"><li><i class="fa fa-file-text-o"></i> &nbsp;Design Document</li></a>			
		<a href = "/wp-admin/"><li><i class="fa fa-pencil"></i>&nbsp;Blog</li></a>
		<a href = "/admin/project/project/stats/stats.php?itr=<?php echo $currentIteration; ?>"><li><i class="fa fa-line-chart"></i>&nbsp;Stats</li></a>		
		<a href = "/admin/project/project/projectPage/releasePage.php"><li><i class="fa fa-gears"></i>&nbsp;Project Planning</li></a>		
		<a href = "/admin/project/store"><li><i class="fa fa-shopping-cart"></i>&nbsp;STORE</li></a>	
		<a href='<?php echo wp_logout_url( home_url() );?>'><li><i class="fa fa-sign-out"></i>Logout</li></a>
		
		
	</ul>
		<div id = "sidebar_arrow_admin1" class = "sidebar_arrow_admin" >
		<div id = "outer_arrow">
		<div id = "arrow_in"></div>
	</div>
	
	</div>
		<div id = "sidebar_arrow_admin2" class = "sidebar_arrow_admin" style="display:none;">
		<div id = "outer_arrow">
		<div id = "arrow_out"></div>
	</div>
	
	</div>
	
</div>