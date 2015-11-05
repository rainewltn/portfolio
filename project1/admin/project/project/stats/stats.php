<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Stats Page | Stray Pixel Games</title>

</head>
<body>


<nav>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php';

$currentIteration = $_GET['itr'];
$currentUser = $_GET['user'];

?>
</nav>

</br></br></br></br></br></br>

<style>
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
		.iterButton:hover
		{
			color:#fff;
			cursor:pointer;
		}
</style>



<div class="container">
<div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Stats Page</h3>
                    <hr class="star-light">
                </div>
</div> 

<?php 		
	
			
	
			//For one user in a certain iteration
			if($currentIteration != 0 && $currentUser != 0)
			{
				$monday;$tuesday;$wednesday;$thursday;$friday;$saturday;$sunday;
				$midnightTosix;$sixToNoon;$noonToSix;$sixToMidnight;
			$linkSTORYITERATION = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");
				foreach($linkSTORYITERATION as $lsi)
				{			
							$STORYUSERlink = $wpdb->get_results("SELECT user_id FROM wp_dlod_STORYUSER WHERE story_id = ".$lsi->story_id."");
							foreach($STORYUSERlink as $sul)
							{
								if($sul->user_id == $currentUser)
								{
									$storiesALL = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsi->story_id."");
									foreach($storiesALL as $sALL)
									{							
											
										if($sALL->completed)
										{
											$storiesCompleted += 1;
											$storyPointsCompleted += $sALL->points;
										}
											$totalStoryPoints += $sALL->points;
											
										$linkTASKSTORY = $wpdb->get_results("SELECT task_id FROM wp_dlod_TASKSTORY WHERE story_id = ".$sALL->ID."");
										foreach($linkTASKSTORY as $lts)
										{
											$tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$lts->task_id."");
											foreach($tasks as $tALL)
											{
															$totalTaskHours += $tALL->hours;
															$totalTasks +=1;
															
															
															
															
															if($tALL->col == 3)
															{
																
																$tasksCompleted +=1;
																$taskHoursCompleted += $tALL->hours;
																
																$hourCompleted = date('G',$tALL->end_date);
																$hourCompleted = intval($hourCompleted);						
																$dayCompleted  = date('N',$tALL->end_date);
																$dayCompleted = intval($dayCompleted);
																if($dayCompleted == 0)
																{
																	$dayCompleted = 7;
																}
																if($dayCompleted == 1){$monday+=1;}
																if($dayCompleted == 2){$tuesday+=1;}
																if($dayCompleted == 3){$wednesday+=1;}
																if($dayCompleted == 4){$thursday+=1;}
																if($dayCompleted == 5){$friday+=1;}
																if($dayCompleted == 6){$saturday+=1;}
																if($dayCompleted == 7){$sunday+=1;}
																$bestDay = 0;
																$bestValue = 0;
																if($monday > $bestValue){$bestDay = "Monday";$bestValue = $monday;}
																if($tuesday > $bestValue){$bestDay = "Tuesday";$bestValue = $tuesday;}
																if($wednesday > $bestValue){$bestDay = "Wednesday";$bestValue = $wednesday;}
																if($thursday > $bestValue){$bestDay = "Thursday";$bestValue = $thursday;}
																if($friday > $bestValue){$bestDay = "Friday";$bestValue = $friday;}
																if($saturday > $bestValue){$bestDay = "Saturday";$bestValue = $saturday;}
																if($sunday > $bestValue){$bestDay = "Sunday";$bestValue = $sunday;}
																
																if($hourCompleted <= 6){$midnightToSix += 1;}
																if($hourCompleted > 6 && $hourCompleted <= 12){$sixToNoon += 1;}
																if($hourCompleted > 12 && $hourCompleted <= 18){$noonToSix += 1;}
																if($hourCompleted > 18 && $hourCompleted <= 24){$sixToMidnight += 1;}
																
																$bestTime = 0;
																$bestTimeValue = 0;
																if($midnightToSix > $bestTimeValue){$bestTime = "12am-6am";$bestTimeValue = $midnightToSix;}
																if($sixToNoon > $bestTimeValue){$bestTime = "6am-12pm";$bestTimeValue = $sixToNoon;}
																if($noonToSix > $bestTimeValue){$bestTime = "12pm-6pm";$bestTimeValue = $noonToSix;}
																if($sixToMidnight > $bestTimeValue){$bestTime = "6pm-12am";$bestTimeValue = $sixToMidnight;}
																
																
															}
															
															
															
															$linkTASKUSER = $wpdb->get_results("SELECT user_id FROM wp_dlod_TASKUSER WHERE task_id = ".$tALL->ID."");
															foreach($linkTASKUSER as $ltu)
															{
																	$users = get_userdata($ltu->user_id);												
															}
															$percentComplete = ($taskHoursCompleted/$totalTaskHours) * 100;

											}
										}
									}
								}
							}
				}
				$completedTimePercent = ($bestTimeValue/($midnightToSix + $sixToNoon + $noonToSix + $sixToMidnight)) * 100;
				$completedDayPercent = ($bestValue/($monday + $tuesday + $wednesday + $thursday + $friday + $saturday + $sunday)) * 100;
				
				$iterationMinus1 = $currentIteration - 1;
				$linkSTORYITERATION1 = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$iterationMinus1 ."");
				foreach($linkSTORYITERATION1 as $lsi1)
				{			
						
								$stories1 = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsi1->story_id."");
								foreach($stories1 as $s1)
								{							
										
									if($s1->completed)
									{
										$storiesCompleted1 += 1;
										$storyPointsCompleted1 += $s1->points;
									}
								}
								
				}
				$iterationMinus2 = $currentIteration -2;
				$linkSTORYITERATION2 = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$iterationMinus2 ."");
				foreach($linkSTORYITERATION2 as $lsi2)
				{			
						
								$stories2 = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsi2->story_id."");
								foreach($stories2 as $s2)
								{							
										
									if($s2->completed)
									{
										$storiesCompleted2 += 1;
										$storyPointsCompleted2 += $s2->points;
										
									}
								}
				}
				$velocity = round(($storyPointsCompleted + $storyPointsCompleted1 + $storyPointsCompleted2)/3);
				$currentRelease = $wpdb->get_var('SELECT Current_Release FROM wp_dlod_strayAdminTable WHERE ID = 1');
					$totalGoals;
					$totalDoneGoals;
					$linkRELEASEGOAL = $wpdb->get_results("SELECT releaseGoal_id FROM wp_dlod_RELEASEGOALS WHERE release_id = ". $currentRelease ."");
					foreach($linkRELEASEGOAL as $lrg)
					{
							$goals = $wpdb->get_var("SELECT completed FROM wp_dlod_strayReleaseGoals WHERE ID = ".$lrg->releaseGoal_id."");
							
								$totalGoals+=1;
								if($goals)
								{
									$totalDoneGoals+=1;
								}
							
						}
					$goalsPercentComplete = round(($totalGoals/$totalDoneGoals)*100);
					
			}
			
			//For all users for current iteration
			else if($currentIteration != 0 && $currentuser == 0)
			{
			$totalStoryPoints = 0;
			$totalTaskHours = 0;
			$monday;$tuesday;$wednesday;$thursday;$friday;$saturday;$sunday;
			$midnightTosix;$sixToNoon;$noonToSix;$sixToMidnight;
			$linkSTORYITERATION = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$currentIteration."");
				foreach($linkSTORYITERATION as $lsi)
				{			
						
								$storiesALL = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsi->story_id."");
								foreach($storiesALL as $sALL)
								{							
										
									if($sALL->completed)
									{
										$storiesCompleted += 1;
										$storyPointsCompleted += $sALL->points;
									}
										$totalStoryPoints += $sALL->points;
										
									$linkTASKSTORY = $wpdb->get_results("SELECT task_id FROM wp_dlod_TASKSTORY WHERE story_id = ".$sALL->ID."");
									foreach($linkTASKSTORY as $lts)
									{
										$tasks = $wpdb->get_results("SELECT * FROM wp_dlod_strayTasks WHERE ID = ".$lts->task_id."");
										foreach($tasks as $tALL)
										{
														$totalTaskHours += $tALL->hours;
														$totalTasks +=1;
														
														
														
														
														if($tALL->col == 3)
														{
															
															$tasksCompleted +=1;
															$taskHoursCompleted += $tALL->hours;
															
															$hourCompleted = date('G',$tALL->end_date);
															$hourCompleted = intval($hourCompleted);						
															$dayCompleted  = date('N',$tALL->end_date);
															$dayCompleted = intval($dayCompleted);
															if($dayCompleted == 0)
															{
																$dayCompleted = 7;
															}
															if($dayCompleted == 1){$monday+=1;}
															if($dayCompleted == 2){$tuesday+=1;}
															if($dayCompleted == 3){$wednesday+=1;}
															if($dayCompleted == 4){$thursday+=1;}
															if($dayCompleted == 5){$friday+=1;}
															if($dayCompleted == 6){$saturday+=1;}
															if($dayCompleted == 7){$sunday+=1;}
															$bestDay = 0;
															$bestValue = 0;
															if($monday > $bestValue){$bestDay = "Monday";$bestValue = $monday;}
															if($tuesday > $bestValue){$bestDay = "Tuesday";$bestValue = $tuesday;}
															if($wednesday > $bestValue){$bestDay = "Wednesday";$bestValue = $wednesday;}
															if($thursday > $bestValue){$bestDay = "Thursday";$bestValue = $thursday;}
															if($friday > $bestValue){$bestDay = "Friday";$bestValue = $friday;}
															if($saturday > $bestValue){$bestDay = "Saturday";$bestValue = $saturday;}
															if($sunday > $bestValue){$bestDay = "Sunday";$bestValue = $sunday;}
															
															if($hourCompleted <= 6){$midnightToSix += 1;}
															if($hourCompleted > 6 && $hourCompleted <= 12){$sixToNoon += 1;}
															if($hourCompleted > 12 && $hourCompleted <= 18){$noonToSix += 1;}
															if($hourCompleted > 18 && $hourCompleted <= 24){$sixToMidnight += 1;}
															
															$bestTime = 0;
															$bestTimeValue = 0;
															if($midnightToSix > $bestTimeValue){$bestTime = "12am-6am";$bestTimeValue = $midnightToSix;}
															if($sixToNoon > $bestTimeValue){$bestTime = "6am-12pm";$bestTimeValue = $sixToNoon;}
															if($noonToSix > $bestTimeValue){$bestTime = "12pm-6pm";$bestTimeValue = $noonToSix;}
															if($sixToMidnight > $bestTimeValue){$bestTime = "6pm-12am";$bestTimeValue = $sixToMidnight;}
															
															
														}
														
														
														
														$linkTASKUSER = $wpdb->get_results("SELECT user_id FROM wp_dlod_TASKUSER WHERE task_id = ".$tALL->ID."");
														foreach($linkTASKUSER as $ltu)
														{
																$users = get_userdata($ltu->user_id);												
														}
														$percentComplete = ($taskHoursCompleted/$totalTaskHours) * 100;

										}
									}
								}
				}
				$completedTimePercent = ($bestTimeValue/($midnightToSix + $sixToNoon + $noonToSix + $sixToMidnight)) * 100;
				$completedDayPercent = ($bestValue/($monday + $tuesday + $wednesday + $thursday + $friday + $saturday + $sunday)) * 100;
				
				$iterationMinus1 = $currentIteration - 1;
				$linkSTORYITERATION1 = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$iterationMinus1 ."");
				foreach($linkSTORYITERATION1 as $lsi1)
				{			
						
								$stories1 = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsi1->story_id."");
								foreach($stories1 as $s1)
								{							
										
									if($s1->completed)
									{
										$storiesCompleted1 += 1;
										$storyPointsCompleted1 += $s1->points;
									}
								}
								
				}
				$iterationMinus2 = $currentIteration -2;
				$linkSTORYITERATION2 = $wpdb->get_results("SELECT story_id FROM wp_dlod_STORYITERATION WHERE iteration_id = ".$iterationMinus2 ."");
				foreach($linkSTORYITERATION2 as $lsi2)
				{			
						
								$stories2 = $wpdb->get_results("SELECT ID, points, completed FROM wp_dlod_strayStories WHERE ID = ".$lsi2->story_id."");
								foreach($stories2 as $s2)
								{							
										
									if($s2->completed)
									{
										$storiesCompleted2 += 1;
										$storyPointsCompleted2 += $s2->points;
										
									}
								}
				}
				$velocity = round(($storyPointsCompleted + $storyPointsCompleted1 + $storyPointsCompleted2)/3);
				
					$currentRelease = $wpdb->get_var('SELECT Current_Release FROM wp_dlod_strayAdminTable WHERE ID = 1');
					$totalGoals;
					$totalDoneGoals;
					$linkRELEASEGOAL = $wpdb->get_results("SELECT releaseGoal_id FROM wp_dlod_RELEASEGOALS WHERE release_id = ". $currentRelease ."");
					foreach($linkRELEASEGOAL as $lrg)
					{
							$goals = $wpdb->get_var("SELECT completed FROM wp_dlod_strayReleaseGoals WHERE ID = ".$lrg->releaseGoal_id."");
							
								$totalGoals+=1;
								if($goals)
								{
									$totalDoneGoals+=1;
								}
							
						}
					$goalsPercentComplete = round(($totalDoneGoals/$totalGoals)*100);
					
			}
					
?>
	
	<div id="currentIteration" class="topShelf"><aside class="iterButton" id="leftIteration" onclick="changeIteration(0)" style="display:inline; margin-right:6px; padding-right:6px; border-right: 1px solid #ccc;"><i class="fa fa-chevron-left"></i></aside>Iteration: 
		<span onclick="testCron()"  style="color:green;"><?php echo $currentIteration;?></span>
		<aside id="rightIteration" onclick="changeIteration(1)" class="iterButton" style="display:inline; margin-left:6px; padding-left:6px; border-left: 1px solid #ccc;"><i class="fa fa-chevron-right"></i></aside></div>
		

		<div id="selectUserSort" class="topShelf">
		<span class="userSorts" onclick="sortByUser(0)"><i class="fa fa-users"></i> All</span>
		<?php 
		
		$users = get_users('number=25');//I know right...
				
				$userIDs = array();
				foreach($users as $u)
				{
					if($u->user_status == 1)
					{		
						
						echo '<span onclick="sortByUser('.$u->ID.','.$currentIteration.')" id="userSort'.$u->ID.'" class="userSorts"><img style="width:15px" src="/images/people/'.$u->user_login.'.png"> '.$u->user_login.' </span>';
					}
					
				}
		
		?>
		
		</div>
		

			<style>
				.statsBox
				{
					background-color:#fff;
					box-shadow: 0px 0px 3px 0px rgba(0,0,0,1); 
					padding: 5px;
					min-height: 120px;
				}
				.statsTitle
				{
					background-color:#e2e4e6;
					box-shadow: inset 3px 9px 5px -9px rgba(50,50,50,0.95);
					border-bottom-left-radius:5px;
					border-bottom-right-radius:5px;				
					padding: 2px;
					padding-left:10px;
					height:25px;
					
				}
				.statsNumber
				{
					float:right;
					
					font-size:550%;
					padding-right:20px;
				
				}
				.statsIcon
				{
					color:#373737;
					padding-left:10px;
					text-shadow:0 1px 0;
				}
				.rowBorder
				{
					height:165px; 
					border-bottom: 3px solid #b6b6b6;
					border-left: 1px solid #b6b6b6;
			
				}
			</style>
			</br></br></br>
			<div id="allStats">
			<div class="row rowBorder">
					<div class="col-lg-3">
						<div class="statsBox" style="background-color:#337ab7;">
							<span class="statsIcon" style="color:#265a88"><i class="fa fa-archive fa-5x"></i></span>
							<span class="statsNumber" id="storiesCompleted" style="color:#fff"><?php echo $storiesCompleted; ?></span>
							
						</div>
						<div class="statsTitle">Stories Completed</div>
					</div>
					<div class="col-lg-3">
						<div class="statsBox" style="background-color:#5cb85c ;">
							<span class="statsIcon" style="color:#419641;"><i class="fa fa-check fa-5x"></i></span>
							<span class="statsNumber" id="storyPointsCompleted" style="color:#fff;"><?php echo $storyPointsCompleted; ?></span>
							
						</div>
						<div class="statsTitle"><p style="float:left;">Story Points Completed</p></div> 
					</div>
					<div class="col-lg-3">
						<div class="statsBox" style="background-color:#5bc0de">
							<span class="statsIcon" style="color:#2aabd2;"><i class="fa fa-tasks fa-5x"></i></span>
							<span class="statsNumber" id="tasksCompleted" style="color:#fff;"><?php echo $tasksCompleted; ?></span>
							
						</div>
						<div class="statsTitle">Tasks Completed</div>
					</div>
					<div class="col-lg-3">
						<div class="statsBox" style="background-color:#e0e0e0  ">
							<span class="statsIcon" style="color:#777;"><i class="fa fa-clock-o fa-5x"></i></span>
							<span class="statsNumber" id="taskHoursCompleted" style="color:#111;"><?php echo $taskHoursCompleted; ?></span>
							
						</div>
						<div class="statsTitle">Task Hours Done</div>
					</div>
			
			</div>
			</br></br></br>
				<div class="row rowBorder">
					<div class="col-lg-3">
						<div class="statsBox" id="chartDivVelocity">
							
							
						</div>
						<div class="statsTitle">Velocity Trend</div>
					</div>
					<div class="col-lg-3">
						<div class="statsBox">
							<span class="statsIcon"><i class="fa fa-area-chart fa-5x"></i></span>
							<span class="statsNumber"><?php echo $velocity; ?></span>
							
						</div>
						<div class="statsTitle">Average Velocity</div>
					</div>
					<div class="col-lg-3">
						<div class="statsBox">
							<span class="statsIcon"><i class="fa fa-bar-chart-o fa-5x"></i></span>
							<span class="statsNumber"><?php echo $totalTaskHours; ?></span>
							
						</div>
						<div class="statsTitle">Accepted Hours</div>
					</div>
					<div class="col-lg-3">
						<div class="statsBox">
							<span class="statsIcon"><i class="fa fa-bar-chart-o fa-5x"></i></span>
							<span class="statsNumber"><?php echo $totalStoryPoints; ?></span>							
						</div>
						<div class="statsTitle">Accepted Points</div>
					</div>
			
			</div>
			
			</br></br></br>
				<div class="row rowBorder">
					<div class="col-lg-3">
						<div class="statsBox" id="chart_div1">
							
							
						</div>
						<div class="statsTitle">Work by day</div>
					</div>
					<div class="col-lg-3">
						<div class="statsBox">
							<span class="statsIcon"><i class="fa fa-calendar-o fa-5x"></i></span>
							<span class="statsNumber" style="font-size:200%;"><?php echo $bestDay ?></span>
							
						</div>
						<div class="statsTitle">Most Productive Day</div>
					</div>
					<div class="col-lg-3">
						<div class="statsBox" id="chart_div">
							
						
							
						</div>
						<div class="statsTitle">Work by Time</div>
					</div>
					<div class="col-lg-3">
						<div class="statsBox">
							<span class="statsIcon"><i class="fa fa-history fa-5x"></i></span>
							<span class="statsNumber" style="font-size:200%;"><?php echo $bestTime; ?></span>	
							
						</div>
						<div class="statsTitle">Most Productive Time</div>
					</div>
			
			</div>
			
			<style>
				.circleStatBoxes
				{
					text-align:center;
				}
				
			</style>
			
			</br></br></br>
				<div class="row">
					<div class="col-lg-4 circleStatBoxes">
						<input class="knob" data-thickness=".3"  data-thickness=".4" readonly value="<?php echo $completedTimePercent; ?>">
						<div class=" cirlceStatsTitle">of work is completed between <?php echo $bestTime;?>.</div>
					</div>
					<div class="col-lg-4 circleStatBoxes">
						<input class="knob" data-thickness=".3" data-fgColor="chartreuse" data-thickness=".4" readonly value="<?php echo $goalsPercentComplete; ?>">
						<div class=" cirlceStatsTitle">of Release is complete.</div>
					</div>
					<div class="col-lg-4 circleStatBoxes">
						<input class="knob" data-thickness=".3" data-fgColor="chartreuse" data-thickness=".4" readonly value="<?php echo round($percentComplete); ?>">
						<div class=" cirlceStatsTitle">of Iteration is complete.</div>
					</div>
					
			
			</div>
		</div>	
		




 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Satus', 'Hours'],
          ['Accepted',     <?php echo $acceptedHours?>],
          ['In Progress',      <?php echo $progressHours?>],
          ['Done',  <?php echo $doneHours?>]
       
        ]);

        var options = {
          title: 'Task Status'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
	  
	  
	  function changeIteration(increase)
	  {
		 
		var iterationNumber = $('#currentIteration span').text();
		 if(iterationNumber == "ALL")
		 {iterationNumber=0;}
		if(increase == 1)
		{
			iterationNumber++;		
		}
		else
		{
			iterationNumber--;
		}			
		if(iterationNumber == 0)
		{iterationNumber = "ALL";}
		$('#currentIteration span').text(iterationNumber);

	  }
	  function sortByUser(userId)
	  {
		var iterationNumber = $('#currentIteration span').text();
		if(iterationNumber == "ALL")
		 {iterationNumber=0;}
	 
		 $('.userSorts').css('background-color','#e2e4e6');
		 $('#userSort' + userId).css('background-color','#fff');
		 window.location.href = "http://www.straypixelgames.com/admin/project/project/stats/stats.php?itr=" + iterationNumber + "&user=" +userId;
		
		
	  }
	  
    </script>
  




	

	</div>
</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';?>
		<script src="statsJS.js"></script>
		<script src="circleStats/dist/jquery.knob.min.js"></script>
		 <script>
            $(function($) {

                $(".knob").knob({
					'format' : function (value) {
					return value + '%';
					}
            
                });
				
            
            });
			
			
			google.load('visualization', '1', {packages: ['corechart', 'bar']});
			google.setOnLoadCallback(drawBasic);
			google.setOnLoadCallback(drawBasic1);

function drawBasic() {

      var data = new google.visualization.arrayToDataTable([
		['Time', 'Tasks Done'],
        ['12AM-6AM', <?php if($midnightToSix){echo $midnightToSix;}else{echo 0;} ?>],            // RGB value
        ['6AM-12PM', <?php if($sixToNoon){echo $sixToNoon;}else{echo 0;} ?>],            // English color name
        ['12PM-6PM', <?php if($noonToSix){echo $noonToSix;}else{echo 0;} ?>],
		['6PM-12AM', <?php if($sixToMidnight){echo $sixToMidnight;}else{echo 0;} ?>],  // CSS-style declaration
      ]);

      var options = {
		legend: { position: 'none' },
		chartArea:{left:0,top:0,width:"100%",height:"80%"}
        
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }
	
	function drawBasic1() {

      var data = new google.visualization.arrayToDataTable([
		['Day', 'Tasks Done'],
        ['Monday', <?php if($monday){echo $monday;}else{echo 0;} ?>], 
  ['Tuesday', <?php if($tuesday){echo $tuesday;}else{echo 0;} ?>],
  ['Wednesday', <?php if($wednesday){echo $wednesday;}else{echo 0;} ?>],
  ['Thursday', <?php if($thursday){echo $thursday;}else{echo 0;} ?>],
  ['Firday', <?php if($friday){echo $friday;}else{echo 0;} ?>],
  ['Saturday', <?php if($saturday){echo $saturday;}else{echo 0;} ?>],
  ['Sunday', <?php if($sunday){echo $sunday;}else{echo 0;} ?>],
  // RGB value

      ]);

      var options = {
		legend: { position: 'none' },
		chartArea:{left:0,top:0,width:"100%",height:"80%"}
        
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div1'));

      chart.draw(data, options);
    }
	
	
	
	
			
        </script>
		
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
						 ['Iteration', 'Points Completed'],
						  ['Iteration <?php echo $iterationMinus2; ?>',  <?php if($storyPointsCompleted2){echo $storyPointsCompleted2;}else{echo json_encode(NULL);} ?>],
						  ['Iteration <?php echo $iterationMinus1; ?>',  <?php if($storyPointsCompleted1){echo $storyPointsCompleted1;}else{echo json_encode(NULL);} ?>],
						  ['Iteration <?php echo $currentIteration; ?>',  <?php if($storyPointsCompleted){echo $storyPointsCompleted;}else{echo json_encode(NULL);} ?>]						 
						]);

						var options = {
						 
						  interpolateNulls: true,
						  legend: { position: 'none' },
						  chartArea:{left:0,top:10,width:"100%",height:"100%"}
						  
						};

						var chart = new google.visualization.LineChart(document.getElementById('chartDivVelocity'));

						chart.draw(data, options);
					  }
					    </script>
		
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</body>

</html>