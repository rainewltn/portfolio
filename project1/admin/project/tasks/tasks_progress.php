<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Tasks Progress | Stray Pixel Games</title>

</head>
<body>


<nav>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php';

$currentIteration = $_GET['itr'];

?>
</nav>

</br></br></br></br></br></br>

<div class="container">
<div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Tasks in progress</h3>
                    <hr class="star-light">
                </div>
            </div> 
			</br></br></br>
<div class="row">
<style>

.taskBox
{
	background-color:#e2e4e6;
	height:185px;

	margin:10px;
	padding: 5px;
	border-radius: 3px;
	box-shadow:  0px 0px 3px 0px rgba(0,0,0,1); 
}
.users
{
	float:left;
}
.userBox
{
	
}
</style>

<?php 

		
			$linkSTORYITERATION = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");
				foreach($linkSTORYITERATION as $lsu)
				{
						$storiesALL = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsu->story_id." AND completed = 0");
						foreach($storiesALL as $sALL)
						{							
							$assignedStoryPoints += $sALL->points;

							$linkTASKSTORY = $wpdb->get_results("SELECT task_id FROM wp_dlod_TASKSTORY WHERE story_id = ".$sALL->ID."");
							foreach($linkTASKSTORY as $lts)
							{
								$tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$lts->task_id."");
								foreach($tasks as $tALL)
								 {
									if($tALL->col == 2)
									{
										foreach($linkTASKUSER as $ltu)
										{
											echo '<div class="userBox userBox'.$tALL->ID.'">';															
											$users = get_userdata($ltu->user_id);
											echo '<div class="users users'.$tALL->ID .'-'.$u->user_id.'"><img style="width:15px" src=/images/people/'.$users->user_login.'.png> &nbsp;</div>';
											echo '</div>';
										}
												
												echo '<div class="col-sm-2 taskBox">';
												echo '<p>Title: '. $tALL->title .'</p>';
									
												echo '<p>Hours: '. $tALL->hours .'</p>';
												$linkTASKUSER = $wpdb->get_results("SELECT user_id FROM wp_dlod_TASKUSER WHERE task_id = ".$tALL->ID."");																							
												echo '</div>';
										
									}
								}
							}	
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
$(document).ready(function(){
	
		setInterval(function() {	
		  //your jQuery ajax code
			/*$.ajax({url: 'globalBacklog.php',
						type: 'GET',
						data: {},
						success: function(data){
							$('#openBacklog i').removeClass('fa-plus');
							$('#openBacklog i').addClass('fa-minus');
							$('.storyBoxBacklog').append(data);
							initialize();
							},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
							 timeout: 6000
			});*/
			console.log("fish");
		}, 1000 * 60 * 1); // where X is your every X minutes

});
</script>
</html>