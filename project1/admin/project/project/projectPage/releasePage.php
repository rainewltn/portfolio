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
				.hideDiv
				{
					display: none !important;
				}
				.releaseBox
				{
					box-shadow:  0px 0px 5px 0px rgba(50, 50, 50, 0.95);
					height: 600px;
					border-radius:5px;
					margin:10px;
					padding: 10px;
				}
				.releaseBoxNew
				{
					border: 5px dashed #c3c3c3;
					height: 600px;
					color: #c3c3c3;
					text-align:center;
					padding-top:275px;
					margin:10px;
					
				}
				.releaseBoxNew:hover
				{
					border-color:#3498db;
					color:#3498db;
					cursor:pointer;
					
					
				}
				.releaseTitle
				{
					margin:auto;
				}
				.releaseGoal
				{
					box-shadow:  0px 0px 1px 0px rgba(50, 50, 50, 0.95);
					padding:8px;
					margin-top:10px;
					list-style:none;
				}
				.releaseGoalNew
				{
					border: 3px dashed #c3c3c3;
					padding:8px;
					margin-top:10px;
					list-style:none;
						color: #c3c3c3;
					text-align:center;
				}
				.releaseGoalNew:hover
				{
					border-color:#3498db;
					color:#3498db;
					cursor:pointer;
					
					
				}
				.releaseHover
				{
					margin:3px;
					color: #c3c3c3;		
					float:right;					
				}
				.releaseHover:hover
				{
					cursor:pointer;
					color:#3498db;
				}
				
				ul{padding:0px;}
				.box
				{
					background-color:#e3e3e3;
					border-radius:5px;
					padding:10px;
					
				}
				.topShelf
				{
					float:right;
				}
				.submitButton
				{
					box-shadow:  0px 0px 5px 0px rgba(50, 50, 50, 0.95);
					color:#197519;
					background-color:#fff;
					position:relative;
					top:-40px;
					left:-46px;
					border-radius:5px;
				}
				.submitButton:hover
				{
					color:#fff;
					background-color:#197519;					
					cursor:pointer;
				}
					.submitButtonR
				{
					box-shadow:  0px 0px 5px 0px rgba(50, 50, 50, 0.95);
					color:#197519;
					background-color:#fff;
					position:relative;
					top:-615px;
					left:-37px;
					border-radius:5px;
				}
				.submitButtonR:hover
				{
					color:#fff;
					background-color:#197519;
					
					cursor:pointer;
				}
				
			</style>
			<div class="row box">
				<h3 style="float:left; margin-right:10px; line-height:0px;">Select Project:</h3>
				<select class="form-control" id="projectSelect" style="float:left;width:250px; margin-right:10px;">
					<?php 
					
						$projects = $wpdb->get_results('SELECT ID, name FROM wp_dlod_strayProjects');
				
							foreach($projects as $p)
							{
								echo '<option value="'. $p->ID .'">'. $p->name .'</option>';
							}
					
					?>
				</select>
				<div class="btn btn-primary topShelf"  style="width:150px;" onclick="changeProject()">submit</div>
				<div id="loadingDiv" class="topShelf"><i class="fa fa-circle-o-notch fa-spin fa-3x" style="margin-right: 10px;"></i></div>
				<div id="currentDiv" class="topShelf"><i class="fa fa-check fa-3x" style="color:green; margin-right: 10px;"></i></div>
				
	
			</div>
		
  
    
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
					
					echo '<div class="col-lg-4">';
						echo '<div class="releaseBox">';
							echo '<h3 class="releaseTitle">'. $r->title .'</h3>';
							echo '<ul>';
							$RELEASEGOALlink = $wpdb->get_results('SELECT release_id, releaseGoal_id FROM wp_dlod_RELEASEGOALS WHERE release_id ="'. $r->ID .'"');
							foreach($RELEASEGOALlink as $rgl)
							{
								$releaseGoals = $wpdb->get_results('SELECT * FROM `wp_dlod_strayReleaseGoals` WHERE ID="'. $rgl->releaseGoal_id .'"');
								foreach($releaseGoals as $RG)
								{
									if($RG->completed)
									{
										echo '<li class="releaseGoal releaseGoal'. $r->ID .'" id="releaseGoal'. $RG->ID .'" style="text-decoration: line-through;"><i class="fa fa-trash-o releaseHover" onclick="deleteGoal('. $rgl->releaseGoal_id .')"></i><i class="fa fa-check-square-o releaseHover"  id="goalCheck'. $rgl->releaseGoal_id .'" onclick="markGoalDone('. $rgl->releaseGoal_id .')"></i>'. $RG->goal .'</li>';
									}
									else
									{
										echo '<li class="releaseGoal releaseGoal'. $r->ID .'" id="releaseGoal'. $RG->ID .'"><i class="fa fa-trash-o releaseHover" onclick="deleteGoal('. $rgl->releaseGoal_id .')"></i><i class="fa fa-square-o releaseHover" id="goalCheck'. $rgl->releaseGoal_id .'" onclick="markGoalDone('. $rgl->releaseGoal_id .')"></i>'. $RG->goal .'</li>';
									}
									
								}
								
							}
									echo '<li class="releaseGoalNew new'. $r->ID .'" onclick="addReleaseGoal('. $r->ID .')"><i class="fa fa-plus"></i></li>';
							echo '</ul>';
						echo '</div>';
					echo '</div>'; 
					
				}
				
					
			}
			
					echo '<div class="col-lg-4 ">';
						echo '<div class="releaseBoxNew" onclick="addRelease()">';
							echo '<span class="fa-stack fa-lg"><i class="fa fa-circle-thin fa-stack-2x"></i><i class="fa fa-plus fa-stack-1x"></i></span>';			
						echo '</div>';
					echo '</div>'; 
					
					echo '</div>';
			?>
			
			
		
		
	</div>	
			
		
</body>

	<script>
		initialize();
			$('.releaseHover').addClass('hideDiv');
			var $loading = $('#loadingDiv').addClass('hideDiv');
			var $current = $('#currentDiv');
			$(document).ajaxStart(function () {			
				$loading.removeClass('hideDiv');
				$current.addClass('hideDiv');
			}).ajaxStop(function () {					
				$loading.addClass('hideDiv');
				$current.removeClass('hideDiv');
			});
		function initialize()
		{
				
				$('.releaseGoal').hover(function(){
					
					$(this).find('.releaseHover').removeClass('hideDiv');
				}, function() {
						$( this ).find( ".releaseHover" ).addClass('hideDiv');					
				});
				
		
				
				
		}
		function sendToDatabaseRelease()
		{
			var projectID = $('#projectSelect :selected').val();
			var title = $('.releaseNewEdit').val();
			var fulltitle = "<h3 class='releaseTitle'>"+title+"</h3>"
			$('.releaseNewEdit').replaceWith('<div class="releaseBox">'+fulltitle+'</div>');
			$('.submitButtonR').remove();
			$.ajax({url: 'newRelease.php',
				type: 'GET',
				data: {projectID,title},
				success: function(data){
				
					
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 timeout: 3000
				});
		}
		function addRelease()
		{
			var editableText = $("<textarea class='releaseNewEdit releaseBox' style='width:100%;'/><i class='fa fa-check fa-3x submitButtonR' onclick='sendToDatabaseRelease()'></i>");
			$(".releaseBoxNew").replaceWith(editableText);
			editableText.focus();
			
		}
		
		function goalToDatabase(releaseID)
		{
			var goal = $('.releaseGoalNew' + releaseID).val();
			$('.releaseGoalNew' + releaseID).replaceWith('<li class="releaseGoal releaseGoal'+releaseID +'" >'+goal+'</li>');
			$('.submitButton').remove();
			$.ajax({url: 'newGoal.php',
				type: 'GET',
				data: {releaseID,goal},
				success: function(data){
				
					$('.releaseGoal' + releaseID +':last').after('<li class="releaseGoalNew new'+releaseID +'" onclick="addReleaseGoal('+releaseID +')"><i class="fa fa-plus"></i></li>');
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 timeout: 3000
				});
				initialize();
		}
		function addReleaseGoal(releaseID)
		{
			
			 var newGoal = $('<textarea type="text" class="releaseGoal releaseGoalNew'+releaseID+'" style="width:100%; height:40px;"/><i class="fa fa-check fa-2x submitButton" onclick="goalToDatabase('+releaseID+')"></i>');
			$('.new'+releaseID).replaceWith(newGoal);				
			newGoal.focus();							
			
			
		}
		function markGoalDone(goalID)
		{
				var completed = 0;
				if($('#goalCheck' + goalID).hasClass('fa-square-o'))
				{
					completed = 1;
				}
			
				$.ajax({url: 'updateGoal.php',
				type: 'GET',
				data: {goalID,completed},
				success: function(data){
					$('#goalCheck' + goalID).removeClass('fa-square-o');
					$('#goalCheck' + goalID).addClass('fa-check-square-o');
				
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 
				});
		}
		function deleteGoal(goalID)
		{
			$.ajax({url: 'deleteGoal.php',
				type: 'GET',
				data: {goalID},
				success: function(data){
					$('#releaseGoal' + goalID).remove();				
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 
				});
		}
		function deleteRelease(releaseID)
		{}
		function changeProject()
		{
			var projectID = $('#projectSelect :selected').val();
			$.ajax({url: 'getReleases.php',
				type: 'GET',
				data: {projectID},
				success: function(data){
					
					$('.releasesRow').remove();
					$('.releaseHolder').append(data);
					
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 
				});
				initialize();
		}
	</script>
	
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</html>