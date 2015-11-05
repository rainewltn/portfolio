<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Project Admin | Stray Pixel Games</title>

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
                    <h3>Project Admin</h3>
                    <hr class="star-light">
                </div>
            </div> 
			</br></br></br>

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
</style>
			<div class="row">
				<div class="col-lg-4 taskBox">
				<p>Current Iteration will be marked as done.</p>
				<button class="btn btn-info" onclick="closeCurrentIteration()">Close Iteration</button>
				</div>
			
			
		
				<div class="col-lg-4 taskBox">
					<p>Set the iteration that will show up as default for everyone.</p>
					<input type="number" id="iterationInput">
					
					<button class="btn btn-warning" onclick="setIteration()">Set Iteration</button>
					
				</div>
				
				
				<div class="col-lg-4 taskBox">
					<p>Update the burndown chart so the number is saved.</p>
					
					
					<button class="btn btn-info" onclick="updateBurndown()">Update Burndown</button>
					
				</div>
				<div class="col-lg-4 taskBox">
					<a class="btn btn-default" href="project/project/projectPage/projectPage.php">Project Page</a>
					
					
					
					
				</div>
				
					
			</div>
		

<?php 

			
			

	
			
		
?>



	
	</div>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';?>
</body>
<script>

function setIteration()
{
	var currentIteration = $('#iterationInput').val();

		
		$.ajax({url: 'updateAdminTable.php',
			type: 'GET',
			data: {currentIteration},
			success: function(data){
			alert("Iteration now set to " + currentIteration);
			},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
							
		});
	
}
function closeCurrentIteration()
{
	$.ajax({url: 'closeIteration.php',
			type: 'GET',
			data: {},
			success: function(data){
				alert("Output: " + data);
			},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
							
		});
}
function setRelease()
{}
function setDefaultProject()
{}

function updateBurndown()
{
	$.ajax({url: 'updateBurndown.php',
			type: 'GET',
			data: {},
			success: function(data){
				alert("Burndown updated");
			},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
							
		});
}

</script>
	<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</html>