<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Projects Page | Stray Pixel Games</title>
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
                    <h3>Projects</h3>
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
				.projectBox
				{
					box-shadow:  0px 0px 5px 0px rgba(50, 50, 50, 0.95);
					height: 85px;
					border-radius:5px;
				}
				.projectBoxNew
				{
					border: 5px dashed #c3c3c3;
					height: 85px;
					color: #c3c3c3;
					text-align:center;
					padding-top:15px;
					
				}
				.projectBoxNew:hover
				{
					border-color:#3498db;
					color:#3498db;
					cursor:pointer;
					
					
				}
				.projectTitle
				{
					float:left;
				}
				.projectButton
				{
					float:right;
					margin-right:10px;
					margin-top:15px;
					color:#c3c3c3;
					
				}
				.projectButton:hover
				{
					color:#2c3e50;
					cursor: pointer;
				}
				.powerButton
				{
					float:right;
					margin-right:10px;
					margin-top:15px;
					text-shadow: -1px -1px rgba(0, 0, 0, 0.2);
					color:#c4c4c4;
				}
				.powerButton:hover
				{
					color:#2C75FF;
					cursor: pointer;
					text-shadow:none;
				}
				.powerButtonOn
				{
					float:right;
					margin-right:10px;
					margin-top:15px;
					color:#2C75FF;
					text-shadow:none;
					
				}
				.powerButtonOn:hover
				{
					

				}
				.projectNewEdit
				{
					min-height: 85px;
					font-size:200%;
					color:#2c3e50;
					font-weight:bold;
				}
				.submitButton
				{
					box-shadow:  0px 0px 5px 0px rgba(50, 50, 50, 0.95);
					color:#fff;
					background-color:#009900;
					position:relative;
					top:-85px;
					left:-75px;
					border-radius:5px;
				}
				.submitButton:hover
				{
					color:#009900;
					background-color:#fff;
					cursor:pointer;
				}
				.row{
					margin-top:25px;
				}
				
				
			</style>
			
			<?php 
			
				$currentProject = $wpdb->get_var('SELECT Current_Project FROM wp_dlod_strayAdminTable WHERE ID = 1');
				$projects = $wpdb->get_results('SELECT ID, name FROM wp_dlod_strayProjects');
			/*Find get all the releases related to the current project.  Then get all the iterations related to the current release.
			then get the iteration currently selected and use that ID as the current iteration*/
				
				foreach($projects as $p)
				{
					echo '<div class="row" id="project'. $p->ID .'">';
						echo '<div class="col-lg-12 projectBox">';
						echo '<h3 class="projectTitle">'. $p->name .'</h3>';
						if($p->ID == $currentProject)
						{
							echo '<i class="fa fa-power-off fa-3x powerButtonOn" id="power'. $p->ID .'" onclick="makeCurrent('. $p->ID .')"></i>';	
						}
						else
						{
							echo '<i class="fa fa-power-off fa-3x powerButton" id="power'. $p->ID .'" onclick="makeCurrent('. $p->ID .')"></i>';	
						}										
						echo '<i class="fa fa-square-o fa-3x projectButton checkbox'. $p->ID .'" onclick="markDone('. $p->ID .')"></i><i class="fa fa-trash-o fa-3x projectButton" onclick="deleteProject('. $p->ID .')"></i>';
						
					echo '</div></div>'; 
				}
				echo '<div class="row">';
						echo '<div class="col-lg-12 projectBoxNew" onclick="newProject()">';
						echo '<span class="fa-stack fa-lg"><i class="fa fa-circle-thin fa-stack-2x"></i><i class="fa fa-plus fa-stack-1x"></i></span>';
			
					echo '</div></div>'; 
			?>
			
			
		
	</div>		
			
		
</body>

	<script>
		$(document).ready(function(){
			
			
			
		});
		function deleteProject(projectID)
		{
			response = prompt('Type DELETE to delete this project');
			
			if(response == "DELETE")
			{
			$.ajax({url: 'deleteProject.php',
				type: 'GET',
				data: {projectID},
				success: function(data){
					 $("#project" + projectID).remove();
					 
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 timeout: 3000
				});
			}
		}
		function newProject()
		{
			var editableText = $("<textarea class='col-lg-12 form-control projectNewEdit' /><i class='fa fa-check fa-3x submitButton' onclick='sendToDatabase()'></i>");
			$(".projectBoxNew").replaceWith(editableText);
			editableText.focus();
		}
		function sendToDatabase()
		{
				var name = $('.projectNewEdit').val();
				$.ajax({url: 'newProject.php',
				type: 'GET',
				data: {name},
				success: function(data){
				
					 var newProject = $('<div class="row" id="project'+data+'"><div class="col-lg-12 projectBox"><h3 class="projectTitle">'+ name +'</h3><i class="fa fa-power-off fa-3x powerButton"></i><i class="fa fa-square-o fa-3x projectButton checkbox'+ data +'"></i><i class="fa fa-trash-o fa-3x projectButton" onclick="deleteProject('+ data +')"></i></div>');
					 $('.row:last').replaceWith(newProject);
					 $('.submitButton').remove();
					 $('.row:last').after('<div class="row"><div class="col-lg-12 projectBoxNew" onclick="newProject()"><span class="fa-stack fa-lg"><i class="fa fa-circle-thin fa-stack-2x"></i><i class="fa fa-plus fa-stack-1x"></i></span></div></div>');
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 timeout: 3000
				});
		}
		function makeCurrent(projectID)
		{
			$('.powerButtonOn').addClass('powerButton');
			$('.powerButtonOn').removeClass('powerButtonOn');
			$('#power' + projectID).removeClass('powerButton');
			$('#power' + projectID).addClass('powerButtonOn');
			
			$.ajax({url: 'currentProject.php',
				type: 'GET',
				data: {projectID},
				success: function(data){
					
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 timeout: 3000
				});
			
		}
		function markDone(projectID)
		{
				
				var completed;
				if($('.checkbox' + projectID).hasClass('fa-square-o'))
				{
					$('.checkbox' + projectID).removeClass('fa-square-o');
					$('.checkbox' + projectID).addClass('fa-check');
					completed = 1;
				}
				else
				{
					$('.checkbox' + projectID).addClass('fa-square-o');
					$('.checkbox' + projectID).removeClass('fa-check');
					completed = 0;
				}
				
				
				$.ajax({url: 'projectDone.php',
				type: 'GET',
				data: {projectID, completed},
				success: function(data){
					
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 timeout: 3000
				});
		}
	</script>
	
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</html>