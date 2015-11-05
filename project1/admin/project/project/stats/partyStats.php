<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Its a party page! | Stray Pixel Games</title>
	  <script src = "/bootstrap/js/jquery.js"></script>
	
    
       
        <link rel="stylesheet" href="countup/assets/countup/jquery.countup.css" />
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
                    <h3>Party!!</h3>
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
					text-align:center;
				}
				.underTitle
				{
					text-align:center;
					margin-bottom:40px;
				}
				.partyTask
				{
					box-shadow:  0px 0px 1px 0px rgba(50, 50, 50, 0.95);
					padding:8px;
					margin-top:10px;
					list-style:none;
					max-height:37px;
				}
				.partyTaskNew
				{
					border: 3px dashed #c3c3c3;
					padding:8px;
					margin-top:10px;
					list-style:none;
						color: #c3c3c3;
					text-align:center;
				}
				.partyTaskNew:hover
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
				
				

.div1
{
position:relative;
width:5px;
height:5px;
left:-8px; 
bottom:29px;
background-color:#2a90ff;
display:none;
}
.div2
{
position:relative;
width:5px;
height:5px;
background-color:#2a90ff;
left:-8px;
top:-34px; 
display:none;
}
.div3
{
position:relative;
width:5px;
height:5px;
background-color:#2a90ff;
left:297px;
bottom:39px;
display:none;
}
.div4
{
position:relative;
width:5px;
height:5px;
background-color:#2a90ff;
left:297px;
top:-12px;
display:none;
}
.btnStart
{
	background-color: #fff;
	border: 2px solid #2a90ff;
	margin-left:90px;
	
}
.btnStart:hover
{
	background-color: #2a90ff;
}
			</style>
	
  
        
  
    


		
			<?php
			$startStamp = $wpdb->get_var('SELECT start_time FROM wp_dlod_strayParty WHERE ID = 1');
			$activeParty = $wpdb->get_var('SELECT active FROM wp_dlod_strayParty WHERE ID = 1');
				if($activeParty)
				{
					$partyBtnText = "stop party :(";
					$toggle = 0;
					$timer = "#countdown";
				}
				else
				{
					$partyBtnText = "START PARTY!";
					$toggle = 1;
					$timer = "";
					
				}
				
			?>
			
       
     
  
  
			<div class="col-lg-4">
				<div class="releaseBox">
				<h3 class="releaseTitle">Party Time!</h3>
				<p class="underTitle"><small>(Party has been going for...)</small></p>
				<div id="countdown"></div>
				<div class="btn btnStart" onclick="toggleParty(<?php echo $toggle; ?>)"><?php echo $partyBtnText;?></div>
				</div>
			</div>
			
		   <!-- JavaScript includes -->
	
		<script src="countup/assets/countup/jquery.countup.js"></script>
		
	
	<?php

	
	$startStamp = $startStamp;
	$year = date('Y',$startStamp);
	$month = date('m',$startStamp);
	$day = date('d',$startStamp);
	$hour = date('H',$startStamp);
	$min = date('i',$startStamp);
	$sec = date('s',$startStamp);
	
	?>
	<script>
	
	function toggleParty(setTo)
	{
		$.ajax({url: 'partyTime.php',
		type: 'GET',
		data: {setTo},
		success: function(data){				
			location.reload();
		},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
		 timeout: 3000
		});
	}
	
	$('<?php echo $timer;?>').countup({
		start: new Date(<?php echo $year .",". $month .",". $day .",". $hour .",". $min .",". $sec; ?>) //year, month, day, hour, min, sec
		 
	});
	
	</script>
			
			
	
			<?php 
				
				$doneTasks = 0;
				$Totaltasks = 0;
				$parties = $wpdb->get_results('SELECT ID, title FROM wp_dlod_strayParty WHERE ID = 1');
				
				foreach($parties as $r)
				{
					
					echo '<div class="col-lg-4">';
						echo '<div class="releaseBox">';
							echo '<h3 class="releaseTitle">'. $r->title .'</h3>';
							echo '<ul>';
							$PARTYTASKlink = $wpdb->get_results('SELECT party_id, task_id FROM wp_dlod_PARTYTASKS WHERE party_id ="'. 1 .'"');
							foreach($PARTYTASKlink as $ptl)
							{
								$Totaltasks +=1;
								$partyTasks = $wpdb->get_results('SELECT * FROM `wp_dlod_strayPartyTasks` WHERE ID="'. $ptl->task_id .'"');
								foreach($partyTasks as $PT)
								{
									if($PT->completed)
									{ 
										$doneTasks +=1;
										echo '<li class="partyTask partyTask'. $r->ID .'" id="partyTask'. $PT->ID .'" style="text-decoration: line-through;"><i class="fa fa-trash-o releaseHover" onclick="deleteGoal('. $ptl->task_id .')"></i><i class="fa fa-check-square-o releaseHover"  id="goalCheck'. $ptl->task_id .'" onclick="markGoalDone('. $ptl->task_id .')"></i>'. $PT->task .'<div class="div1 div1'. $ptl->task_id .'" ></div><div class="div2 div2'. $ptl->task_id .'" ></div><div class="div3 div3'. $ptl->task_id .'" ></div><div class="div4 div4'. $ptl->task_id .'" ></div></li>';
									}
									else
									{
										echo '<li class="partyTask partyTask'. $r->ID .'" id="partyTask'. $PT->ID .'"><i class="fa fa-trash-o releaseHover" onclick="deleteGoal('. $ptl->task_id .')"></i><i class="fa fa-square-o releaseHover" id="goalCheck'. $ptl->task_id .'" onclick="markGoalDone('. $ptl->task_id .')"></i>'. $PT->task .'<div class="div1 div1'. $ptl->task_id .'" ></div><div class="div2 div2'. $ptl->task_id .'" ></div><div class="div3 div3'. $ptl->task_id .'" ></div><div class="div4 div4'. $ptl->task_id .'" ></div></li>';
									}
									
								}
								
							}
									echo '<li class="partyTaskNew new'. $r->ID .'" onclick="addpartyTask('. $r->ID .')"><i class="fa fa-plus"></i></li>';
							echo '</ul>';
						echo '</div>';
					echo '</div>'; 
					
				}
				
					
			$percentComplete = ($doneTasks/$Totaltasks)*100;
			
					
			?>
			<style>
				.circleStatBoxes div{display:block !important;}
				.circleStatBoxes{margin-left:35px;}
			</style>
			<div class="col-lg-4">
				<div class="releaseBox">
				<h3 class="releaseTitle">Percent Complete</h3>
					<div class="col-lg-4 circleStatBoxes">
						<input class="knob"  data-thickness=".3" readonly value="<?php echo $percentComplete; ?>">
						
					</div>
				</div>
			</div>

</body>
		<script src="circleStats/dist/jquery.knob.min.js"></script>
		 <script>
		
            $(function($) {

                $(".knob").knob({
					'format' : function (value) {
					return value + '%';
					},
					 'change' : function (v) { console.log(v); },
					 'fgColor': '#2a90ff',
            
                });
				
            
            });
			
			
			</script>
	<script>
		initialize();
		 var totalTasks = <?php echo $Totaltasks; ?>;
		 var doneTasks = <?php echo $doneTasks; ?>;
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
				
				$('.partyTask').hover(function(){
					
					$(this).find('.releaseHover').removeClass('hideDiv');
				}, function() {
						$( this ).find( ".releaseHover" ).addClass('hideDiv');					
				});
				
		
				
				
		}
	
	
		
		function goalToDatabase(releaseID)
		{
			var goal = $('.partyTaskNew' + releaseID).val();
			$('.partyTaskNew' + releaseID).replaceWith('<li class="partyTask partyTask'+releaseID +'" >'+goal+'</li>');
			$('.submitButton').remove();
			$.ajax({url: 'newTask.php',
				type: 'GET',
				data: {releaseID,goal},
				success: function(data){
				
					$('.partyTask' + releaseID +':last').after('<li class="partyTaskNew new'+releaseID +'" onclick="addpartyTask('+releaseID +')"><i class="fa fa-plus"></i></li>');
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 timeout: 3000
				});
				initialize();
		}
		function addpartyTask(releaseID)
		{
			
			 var newGoal = $('<textarea type="text" class="partyTask partyTaskNew'+releaseID+'" style="width:100%; height:40px;"/><i class="fa fa-check fa-2x submitButton" onclick="goalToDatabase('+releaseID+')"></i>');
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
			
				$.ajax({url: 'updateTask.php',
				type: 'GET',
				data: {goalID,completed},
				success: function(data){
					$('#goalCheck' + goalID).removeClass('fa-square-o');
					$('#goalCheck' + goalID).addClass('fa-check-square-o');
					$('#partyTask' + goalID).css('text-decoration','line-through');
					if(!completed)
					{
						$('#goalCheck' + goalID).addClass('fa-square-o');
						$('#goalCheck' + goalID).removeClass('fa-check-square-o');
						$('#partyTask' + goalID).css('text-decoration','none');
					}
				
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 
				});
				$(".div1"+ goalID +",.div2"+ goalID +",.div3"+ goalID +",.div4"+ goalID +"").show(); 
				$(".div1"+ goalID).animate({
					width: "300px",
					left:"-3px",
					bottom:"29px"
				  }, 1500 );
				  $(".div2"+ goalID).animate({
					height: "37px"
				  }, 1500 );
				  $(".div3"+ goalID).animate({
					height: "37px",
					bottom:"71px"
				  }, 1500 );
				 $(".div4"+ goalID).animate({
					width: "300px",
					left:"-3px",
					top:"-76px"
				  }, 1500, function() {
						$(".div1"+ goalID +",.div2"+ goalID +",.div3"+ goalID +",.div4"+ goalID +"").fadeOut("slow"); 
				  });
				     var audioElement = document.createElement('audio');
					audioElement.setAttribute('src', 'party_horn.mp3');
					audioElement.setAttribute('autoplay', 'autoplay');
				
					$.get();
						audioElement.addEventListener("load", function() {
						audioElement.play();
					}, true);
				
				if(completed){
					 doneTasks += 1;
				}
				else{
					 doneTasks -=1;
				}
				 var percentComplete = (doneTasks/totalTasks)*100;
				  knobfunction(percentComplete);
		}
		function knobfunction(value1){
			$('.knob')
			.val(value1)
			.trigger('change');
		}
		function deleteGoal(goalID)
		{
			$.ajax({url: 'deleteTask.php',
				type: 'GET',
				data: {goalID},
				success: function(data){
					$('#partyTask' + goalID).remove();				
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 
				});
		}
		
	
	</script>
	
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</html>