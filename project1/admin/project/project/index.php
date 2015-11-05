<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 


<!doctype html>
<html lang="en">
<head>
<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';  ?>
  <meta charset="utf-8">
  <title>Dashboard</title>
  
  <!--Page Specific-->
  
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	   <link rel="stylesheet" href="/css/dropzone.css">

  <script src = "/bootstrap/js/jquery.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script src="/admin/js/ajax.js"></script>
   <script src="/js/dropzone.js"></script>

</head>
<body>
<nav><?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php';?></nav>



	 <!-- Header -->
    <header>
       <br/>
	   <br/>
    </header>
	<br /><br /><br /><br /><br />
	<?php
	
		$currentIteration = $wpdb->get_var('SELECT Current_Iteration FROM wp_dlod_strayAdminTable WHERE ID = 1');
	
			if(get_current_user_id() == 7)
			{
				include 'dashboardVariantIncludes/adminStats.php';
			}else{
				include 'dashboardVariantIncludes/userStats.php';
			}
	
				
				$DailyValues = $wpdb->get_results("SELECT Actual FROM wp_dlod_strayIterationBurndown WHERE Iteration = ".$currentIteration." ORDER BY ID");

				$actual = array();
				foreach($DailyValues as $dv)
				{
					array_push($actual,$dv->Actual);
				}
				
				$decrement = $actual[0]/7; 
				?>
						 <script type="text/javascript"
						  src="https://www.google.com/jsapi?autoload={
							'modules':[{
							  'name':'visualization',
							  'version':'1',
							  'packages':['corechart']
							}]
						  }"></script>

					<script type="text/javascript">
					  google.setOnLoadCallback(drawChart);

					  function drawChart() {
						var data = google.visualization.arrayToDataTable([
						 ['Day', 'Goal', 'Actual'],
						 ['Starting Value',  <?php echo $actual[0] ?>, 	<?php if($actual[0]){echo $actual[0];}else{echo json_encode(NULL);} ?>],
						  ['Day 1',  <?php echo round($actual[0] - ($decrement * 1),1); ?>, 	 <?php if($actual[1]){echo $actual[1];}else{echo json_encode(NULL);} ?>],
						  ['Day 2',  <?php echo round($actual[0] - ($decrement * 2),1); ?>,      <?php if($actual[2]){echo $actual[2];}else{echo json_encode(NULL);} ?>],
						  ['Day 3',  <?php echo round($actual[0] - ($decrement * 3),1); ?>,      <?php if($actual[3]){echo $actual[3];}else{echo json_encode(NULL);} ?>],
						  ['Day 4',  <?php echo round($actual[0] - ($decrement * 4),1); ?>,      <?php if($actual[4]){echo $actual[4];}else{echo json_encode(NULL);}?>],
						  ['Day 5',  <?php echo round($actual[0] - ($decrement * 5),1); ?>,      <?php if($actual[5]){echo $actual[5];}else{echo json_encode(NULL);} ?>],
						  ['Day 6',  <?php echo round($actual[0] - ($decrement * 6),1); ?>,      <?php if($actual[6]){echo $actual[6];}else{echo json_encode(NULL);} ?>],
						  ['Day 7',  <?php echo round($actual[0] - ($decrement * 7),1); ?>,      <?php if($actual[7]){echo $actual[7];}else{echo json_encode(NULL);} ?>]
						]);

						var options = {
						  width: 200,
						  height: 100,
						  interpolateNulls: true,
						  legend: { position: 'none' },
						  chartArea:{left:0,top:10,width:"100%",height:"100%"}
						  
						};

						var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

						chart.draw(data, options);
					  }
					    </script>
						
					<div class="col-sm-2" style="height:100px; padding-top:20px;">
					<div id="curve_chart"></div>
					<style>
						#chartTitle
						{
							background-color:#e2e4e6;
							width: 200px;
							border-bottom-left-radius:5px;
							border-bottom-right-radius:5px;
							text-align:center;
							padding: 2px;
							position:relative;
							top:-1px;
							
							
						}
					</style>
					<p id="chartTitle">Burndown Chart</p>
				  </div>
		
		</div>
		</div>
		
		</section>

<br /><br /><br /><br />

	<style>
		body
		{
			background-color:#f6f6f6;
		}
		.dragger{
			background-color:#fff; 
			font-size:100%;
			padding: 5px;
			z-index:1;
			border-radius:3px; 
			border-bottom: 1px solid #ccc;
			min-height:50px;
			cursor:pointer;
			margin-top: 5px;
			overflow:hidden;
		}
		.dropTarget{	
			
			-webkit-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,1);
-moz-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,1);
box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,1);
		
			min-height: 100px; 
			padding: 10px; 
			border-radius: 3px; 
			margin-top:20px;
			background-color:#D3D3D3;
		}
		.hover {
				background-color: #b5b5b5;
				
		}
		 .trackingBoard_outline
		 {
			box-shadow:  0px 0px 5px 0px rgba(50, 50, 50, 0.95);
			 min-height: 800px;
			 background-color:#e2e4e6;
		 }
		 .checkbox
		 {
			position:relative;
			right:-19px;
			
			margin:0px;
			
		 }
 
		 .checkbox1:after
		 {
		  font-family: FontAwesome;
		  content: "\f096";
				 
		 }
		 .checkbox2:after
		 {
			font-family: FontAwesome;
			content: "\f110";
		 }
		 .checkbox3:after
		 {
			font-family: FontAwesome;
			content: "\f046";
		 }
		 
		
		
		 .story
		 {
			background-color:#7e7e7e; 
			font-size:100%;
			padding: 5px;
			z-index:1;
			min-height:50px;
			cursor:pointer;	
			overflow:hidden;			
			-webkit-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,1);
			-moz-box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,1);
			box-shadow: inset 0px 0px 3px 0px rgba(0,0,0,1); 
			border-radius:0px;
			margin-top: 5px;
			color:#fff; 
		
		 }
		 .story:hover
		 {
			 background-color: #2c3e50;			 
		 }
		 .storyB
		 {		 
			-webkit-box-shadow:  0px 0px 3px 0px rgba(0,0,0,1);
			-moz-box-shadow:  0px 0px 3px 0px rgba(0,0,0,1);
			box-shadow:  0px 0px 3px 0px rgba(0,0,0,1); 
			margin:5px;		
			background-color:#b7b7b7;
			color:#111;
		 }
		 .storyB:hover
		 {
			 background-color:#e9e9e9;
		 }
		 .storyBox
		 {
			 min-height:800px;
			 margin:0px;
			 background-color: #7e7e7e;
			 border-radius:0px;
			 color:#111;
			 
		 }
		 .storyBoxBacklog
		 {
			 min-height:800px;
			 margin:0px;
			 background-color: #D3D3D3;
			 border-radius:0px;
			 color:#111;
			 -webkit-box-shadow: 0px 0px 3px 0px rgba(0,0,0,1);
			-moz-box-shadow: 0px 0px 3px 0px rgba(0,0,0,1);
			box-shadow: 0px 0px 3px 0px rgba(0,0,0,1); 
		 }
		 .selectedStory
		 {
			 	
			 background-color:#696969;
			 color:#fff;
		 }
		  .buttonRight
		 {
			 float:right;
			 height: 25px;
			 margin: 3px;
			 padding-bottom: 20px;
			 line-height:1px;
		 }
		 .title{
			 padding:10px;
			 padding-top: 0px;
		 }
		 .title1{
			 padding:10px;

		 }
		 .taskText
		 {
			 float:left;
			 width: 85%;
		 }
		 .clearBoth
		 {
			 clear: both;
		 }
		 /*Inline Storeis*/
		.users
		{
			float:left;
			color:#0000F0;
		}
		.story:hover .users
		{
				color:#3498db;
		}
		.usersTasks
		{
				float:left;

			color:#3498db;
		}
		.usersPlus
		{
			float:left;
			color:#fff;
		}
		.usersPlus:hover
		{
			color:#3498db;
		}
		.editStory:hover
		{
			color:#3498db;
		}
		.userBox
		{
			float:left;
			width:75%;
		}
		.points
		{
			float:right;
			margin-right: 10px;
		}
		
		/*Task Hovers*/
		.editTask:hover{color:#3498db;}
		.deleteTask:hover{color:#3498db;}
		.openTask:hover{color:#3498db;}	
		.addImage:hover{color:#3498db;}	
		.taskHoverHolder aside
		{
			margin-right: 2px;
		}
		.taskHoverHolder
		{
			 background:rgba(255,255,255,0.7);
			padding-left: 3px;
		}
		#loadingDiv
		{
	border-radius: 3px;
			background-color: #e2e4e6;
			padding: 4px;
			 border-bottom-left-radius: 0px;
			 border-bottom-right-radius: 0px;
			 padding-left:6px;
			padding-right:6px;
				
			box-shadow: inset 3px -9px 5px -9px rgba(50,50,50,0.95);
		
			float:right;
		}
		#currentDiv
		{

			float:right;
		
		}
		#currentIteration
		{
			float:left;

		}
		#selectUserSort
		{
			float:left;
			margin-left: 30px;

		}
		.userSorts
		{
			padding-left:8px;
			border-radius:5px;
		}
		.userSorts:hover
		{
			cursor:pointer;
			color: darkblue;
			background-color:#fff;
		}
		.topShelf
		{
			border-radius: 3px;
			background-color: #e2e4e6;
			padding: 4px;
			
			border-bottom-left-radius: 0px;
			border-bottom-right-radius: 0px;
			padding-left:6px;
			padding-right:6px;			
			box-shadow: inset 3px -9px 5px -9px rgba(50,50,50,0.95);
		}
		.hideDiv
		{
			display: none !important;
		}

		.iterButton:hover
		{
			color:#fff;
			cursor:pointer;
		}
		
		
		/******Edit Window*******/
		#editWindow
		{
			width:600px;
			height:500px;
			position: fixed;
			  top: 50%;
			  left: 50%;
			  border-radius:2px;
			  transform: translate(-50%, -40%);
			  background-color:#b7b7b7;
			  z-index:9999999;
			  padding:10px;
		}
		#editWindowStory
		{
			width:600px;
			height:500px;
			position: fixed;
			  top: 50%;
			  left: 50%;
			  border-radius:2px;
			  transform: translate(-50%, -40%);
			  background-color:#b7b7b7;
			  z-index:99;
			  padding:10px;
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
			border: 1px solid #ccc;
			color:#fff;
		}
		.closeButton:active
		{
			border: 1px solid #ccc;
			background-color:#fff;
			color:#111;
		}
		.deleteButton
		{
			position:absolute;
			top: 5px;
			right:35px;
			width:20px;
			height:20px;
			text-align:center;
			border-radius:2px;
			line-height:17px;
			
		}
		.deleteButton:hover
		{
			border: 1px solid #ccc;
			color:#fff;
		}
		.deleteButton:active
		{
			border: 1px solid #ccc;
			background-color:#fff;
			color:#111;
		}
		.splitButton
		{
			position:absolute;
			top: 5px;
			right:60px;
			width:20px;
			height:20px;
			text-align:center;
			border-radius:2px;
			line-height:17px;
			
		}
		.splitButton:hover
		{
			border: 1px solid #ccc;
			color:#fff;
		}
		.splitButton:active
		{
			border: 1px solid #ccc;
			background-color:#fff;
			color:#111;
		}
		.saveButton
		{
			position:absolute;
			bottom: 5px;
			right:10px;
			width:40px;
			text-align:center;
			height:40px;
			border-radius:2px;
			font-size:190%;
			line-height:36px;
		}
		
		.saveButton:hover
		{
			border: 1px solid #ccc;
			color:green;
		}
		.saveButton:active
		{
			border: 1px solid #ccc;
			background-color:#fff;
			color:green;
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
		.titleInput
		{
			
		}
		.descInput
		{
			
		}
		.userSelect
		{
			width: 75%;
			margin-left: 10px;
		}
		.hoursInput
		{
			width: 75px;
			position:absolute;
			right: 10px;
			bottom:55px;
			
			
		}
		.pointsInput
		{
			width: 75px;
			position:absolute;
			right: 10px;
			bottom:55px;
			
			
		}
		.iterationInput
		{
			position:absolute;
			top:75px;
			width:75px;
			right:15px;
		}
		#iterationInputLabel
		{
			position:absolute;
			top:85px;			
			right:95px;
		}
		#pointInputLabel
		{
			position:absolute;
			bottom:55px;			
			right:95px;
		}
		.zTo1
		{
			Z-index:1;
		}
	
		.form-group input[type="checkbox"] {
    display: none;
}

.form-group input[type="checkbox"] + .btn-group > label span {
    width: 20px;
}

.form-group input[type="checkbox"] + .btn-group > label span:first-child {
    display: none;
}
.form-group input[type="checkbox"] + .btn-group > label span:last-child {
    display: inline-block;   
}

.form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
    display: inline-block;
}
.form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
    display: none;  
}
#openBacklog:hover
{
	color:#fff;
	cursor:pointer;
}

	</style>
	
	<div id="blankout"></div>
	<div id="editWindow"> 
		<span class="closeButton taskClose"><i class="fa fa-times"></i></span>
		<!-- Add Delte button -->
		<h2>Edit Task</h2>
		<div class="row">
			 <div class="col-xs-6">
				<input type="text" class="titleInput form-control" value="Title">
			</div>
		</div>
		<br>
		<textarea class="descInput form-control" rows="10">Description...</textarea>
		<br>
		
		<div class= "userSelect row">
			
			<?php 
			$users = get_users('number=25');
				
				$userIDs = array();
				foreach($users as $u)
				{
					if($u->user_status == 1)
					{
						
					echo '<div class="[ form-group ] " style="float:left; margin:5px;">
						<input type="checkbox" name="fancy-checkboxs-'.$u->ID.'" id="fancy-checkboxs-'.$u->ID.'" autocomplete="off" />
						<div class="[ btn-group btn-group-xs ]">
							<label for="fancy-checkboxs-'.$u->ID.'" class="[ btn btn-info ]">
								<span class="[ glyphicon glyphicon-ok ]"></span>
								<span> </span>
							</label>
							<label for="fancy-checkboxs-'.$u->ID.'" class="[ btn btn-info active ]">
								'.$u->user_login.'
							</label>
						</div>
					</div>';
					}
					
				}
				
			?>
			
			
		</div>
		<input type="number" class="form-control hoursInput">
		<span class="saveButton taskSave"><i class="fa fa-check"></i></span>
		<span class="saveButton taskSaveEdit"><i class="fa fa-check"></i></span>
	</div>
	
	<div id="editWindowStory">
		<span class="closeButton storyClose"><i class="fa fa-times"></i></span>
		<span class="deleteButton deleteStory"><i class="fa fa-trash-o"></i></span>
		<span class="splitButton splitStory"><i class="fa fa-arrows-h"></i></span>
		<h2>Edit Story</h2>
		<div class="row">
			 <div class="col-xs-6">
				<input type="text" class="storyTitle form-control" value="Title">
			</div>
		</div>
		<br>
		<textarea class="storyDesc form-control" rows="10">Description...</textarea>
		<br>
		<p id="iterationInputLabel">Iteration: </p>
		<input type="number" class="form-control iterationInput">
		<div class= "userSelect row">
		
			
			<?php 
			$users = get_users('number=25');
				
				$userIDs = array();
				foreach($users as $u)
				{
					if($u->user_status == 1)
					{
						echo '<div class="[ form-group ] " style="float:left; margin:5px;">
						<input type="checkbox" name="fancy-checkbox-'.$u->ID.'" id="fancy-checkbox-'.$u->ID.'" autocomplete="off" />
						<div class="[ btn-group btn-group-xs ]">
							<label for="fancy-checkbox-'.$u->ID.'" class="[ btn btn-info ]">
								<span class="[ glyphicon glyphicon-ok ]"></span>
								<span> </span>
							</label>
							<label for="fancy-checkbox-'.$u->ID.'" id="userCheckbox'.$u->ID.'" class="[ btn btn-info active ]">
								'.$u->user_login.'
							</label>
						</div>
					</div>';
					
					}
					
				}
				
			?>
			
			
		</div>
		<p id="pointInputLabel">Points:</p>
		<input type="number" class="form-control pointsInput">
		<span class="saveButton storySave"><i class="fa fa-check"></i></span>
		<span class="saveButton storySaveEdit"><i class="fa fa-check"></i></span>
	</div>
	
	<section style="position:relative;top:-190px;">
	<div class="container">
	<div class="row">
		<div id="loadingDiv" class="topShelf">thinking... <i class="fa fa-circle-o-notch fa-spin" ></i></div>
		<div id="currentDiv" class="topShelf">synced <i class="fa fa-check" onclick="testCron()" style="color:green;"></i></div>
		
		<div id="currentIteration" class="topShelf"><aside class="iterButton" id="leftIteration" onclick="changeIteration(0)" style="display:inline; margin-right:6px; padding-right:6px; border-right: 1px solid #ccc;"><i class="fa fa-chevron-left"></i></aside>Iteration: 
		<span onclick="testCron()"  style="color:green;"><?php echo $currentIteration;?></span>
		<aside id="rightIteration" onclick="changeIteration(1)" class="iterButton" style="display:inline; margin-left:6px; padding-left:6px; border-left: 1px solid #ccc;"><i class="fa fa-chevron-right"></i></aside></div>
		<div id="selectUserSort" class="topShelf">
		<span class="userSorts" onclick="changeIteration(3)"><i class="fa fa-users"></i> All</span>
		<?php 
		
		$users = get_users('number=25');//I know right...
				
				$userIDs = array();
				foreach($users as $u)
				{
					if($u->user_status == 1)
					{		
						
						echo '<span onclick="sortByUser('.$u->ID.')" id="userSort'.$u->ID.'" class="userSorts"><img style="width:15px" src="/images/people/'.$u->user_login.'.png"> '.$u->user_login.' </span>';
					}
					
				}
		
		?>
		
		</div>
	</div>
	<div class="row trackingBoard_outline">	
	
	<div class="col-sm-3 storyBox">
		<p class="title1">Backlog <span id="openBacklog"><i class="fa fa-plus"></i></span><button class = "btn btn-info buttonRight" id="addStory">Story <i class="fa fa-plus"></i></button></p>
		
		<?php 
			$currentProject = $wpdb->get_var('SELECT Current_Project FROM wp_dlod_strayAdminTable WHERE ID = 1');
			$currentRelease = $wpdb->get_var('SELECT Current_Release FROM wp_dlod_strayAdminTable WHERE ID = 1');
			/*Find get all the releases related to the current project.  Then get all the iterations related to the current release.
			then get the iteration currently selected and use that ID as the current iteration*/
			if(isset($_GET['selectedIteration']))
			{
				$currentIteration = $_GET['selectedIteration'];
			}
			$storyLink = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ". $currentIteration ."");
			foreach($storyLink as $sl) 
			{
				$stories = $wpdb->get_results("SELECT * FROM wp_dlod_strayStories WHERE ID = ".$sl->story_id."");

					 foreach($stories as $s)
					 {
						 $usersID = $wpdb->get_results("SELECT user_id FROM wp_dlod_STORYUSER WHERE story_id = ".$s->ID."");
					
						
							echo '<div class="story" name="'.$s->ID.'"><div class="progressBar" id="'.$s->ID.'"></div>';
							echo '<aside class="taskText storyTitle'.$s->ID.'">'. $s->title.'</aside>';
							echo '<aside class="hideDiv storyDesc'.$s->ID.'">'. $s->desc.'</aside>';
							echo '<div class="userBox userBox'.$s->ID.'">';
							foreach($usersID as $u)
							{
								$users = get_userdata($u->user_id);
								echo '<div class="users users'.$s->ID .'-'.$u->user_id.'"><img style="width:15px" src=/images/people/'.$users->user_login.'.png> &nbsp;</div>';
							}
							
							echo '</div>';
							if($s->completed)
							{
								echo '<div class="" style="position:relative; right:-15px;top:-4px;"><i class="fa fa-check"></i></div>';
							}
							echo '<div class="points points'.$s->ID.'">'. $s->points .'</div></div>';
							
						
					 }
				 
			}
				
		?>

	
	</div>
	<div class="col-sm-3"  id="one">
	<div class="dropTarget" name ="1">
	<aside id="innerOne" name="1">
		<p class='title'>Accepted <button class = "btn btn-info buttonRight" id="addTask">Task <i class="fa fa-plus"></i></button></p>
		
		
		</aside>
	</div>
	</div>
	<div class="col-sm-3"  id="two">
		<div class="dropTarget" name ="2">
		<aside id="innerTwo" name="2">
			<p>Current</p>
			<?php 
				 /*foreach($tasks as $t)
				 {
					 if($t->col == 2)
					 echo '<div class="dragger"><aside class="taskText">'.$t->desc.'</aside><aside class="checkbox"></aside></div>';
				 }*/
			?>
			
			</aside>
		</div>
	</div>
	<div class="col-sm-3"  id="three">
		<div class="dropTarget" name ="3">
		<aside id="innerThree" name="3">
		<p>Done</p>
		<?php 
			 /*foreach($tasks as $t)
			 {
				 if($t->col == 3)
				 echo '<div class="dragger"><aside class="taskText">'.$t->desc.'</aside><aside class="checkbox"></aside></div>';
			 }*/
		?>
		</aside>
		</div>
	</div>
	
</div>
</div>
</section>

<style>

		#addTaskFiles
		{
			width:600px;
			height:500px;
			position: fixed;
			  top: 50%;
			  left: 50%;
			  border-radius:2px;
			  transform: translate(-50%, -40%);
			  background-color:#b7b7b7;
			  z-index:99;
			  padding:10px;
		}
</style>
<div id="addTaskFiles">
<span class="closeButton"><i class="fa fa-times" onclick="imageAddClose()"></i></span>
 <form action="/uploads/upload.php" class="dropzone"  id="my-awesome-dropzone"></form>

</div>

		
	<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</body>
</html>
