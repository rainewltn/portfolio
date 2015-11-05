$(document).ready(function(){

		$( ".progressBar" ).each(function( index ) {
					 
					 var storyId = $( this ).attr('id');
					 var thisStory = $(this);
						$.ajax({url: 'progressBar.php',
							type: 'GET',
							data: {storyId},
							success: function(data){
							var returnedData = JSON.parse(data);	
							var percent = (returnedData[1]/returnedData[0]) * 100;
							var colorBar = "3cc920";
							thisStory.addClass('progress-bar progress-bar-striped active');
							if(percent == 100)
							{
								percent = 104;
								thisStory.removeClass('progress-bar progress-bar-striped active');
								colorBar = "#3498db";
							}
							thisStory.css( "width", percent + "%");
							thisStory.css( "background-color", "#" + colorBar );
							thisStory.css( "height", "6px" );
							thisStory.css( "position", "relative" );
							thisStory.css( "top", "-5px" );
							thisStory.css( "left", "-5px" );					
							},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
							
						});
				 
					});
		var $editer = $('#editWindow').addClass('hideDiv');
		var $editer = $('#editWindowStory').addClass('hideDiv');
		$('#addTaskFiles').addClass('hideDiv');

		var $blanker = $('#blankout').addClass('hideDiv');	
			
		var $loading = $('#loadingDiv').addClass('hideDiv');
		var $current = $('#currentDiv');
		$(document)
		.ajaxStart(function () {
			
			$loading.removeClass('hideDiv');
			$current.addClass('hideDiv');
		})
		.ajaxStop(function () {
			
			$loading.addClass('hideDiv');
			$current.removeClass('hideDiv');
			
		});
		
		
		$('.taskClose').click(function() {
			var $editer = $('#editWindow').addClass('hideDiv');
			var $blanker = $('#blankout').addClass('hideDiv');
			$('nav').removeClass('zTo1');
			$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
			});
			$('.userSelect').removeClass('hideDiv');
			for(var i = 0; i <25;i++)
			{								
				$('#fancy-checkbox-' + i).prop('checked', false);				
			}
			
		});
		$('.storyClose').click(function() {
			var $editer = $('#editWindowStory').addClass('hideDiv');
			var $blanker = $('#blankout').addClass('hideDiv');
			$('nav').removeClass('zTo1');
			$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
			});
			for(var i = 0; i <25;i++)
			{								
				$('#fancy-checkbox-' + i).prop('checked', false);				
			}
		});
		
		
		$('#openBacklog').click(function() {
			
			if($('#openBacklog i').hasClass('fa-minus'))
			{
				location.reload();
			}
			else{
			
		
			$('#one').remove();
			$('#two').remove();
			$('#three').remove();
			$('.trackingBoard_outline').append('<div class="col-sm-9 storyBoxBacklog"></div>');
			
				$.ajax({url: 'globalBacklog.php',
				type: 'GET',
				data: {},
				success: function(data){
					$('#openBacklog i').removeClass('fa-plus');
					$('#openBacklog i').addClass('fa-minus');
					$('.storyBoxBacklog').append(data);
					initialize();
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 6000
				});
			
			}
		});
		
			
			
			//Function for saving the TASK when you click the save story checkbox
			$('.taskSave').click(function(){			
				$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
				});
				$('nav').removeClass('zTo1');	
				var $editer = $('#editWindow').addClass('hideDiv');
				var $blanker = $('#blankout').addClass('hideDiv');
				var storyId = $('.selectedStory').attr('name');
				var taskTitle =  $('.titleInput').val();
				var taskDesc = $('.descInput').val();
				var taskOrder = 1;
				var taskUsers = [];
				var userString;
				for(var i = 0; i <25;i++)
				{
					var box = $('#fancy-checkboxs-' + i);
					if(box.is(":checked"))
					{
						taskUsers.push(i);	
						userString += " " + i;
					}	

				}
				
				var taskHours = $('.hoursInput').val();
				var taskEnd = 1;
				$.ajax({url: 'addTask.php',
				type: 'GET',
				data: {storyId,taskTitle,taskDesc,taskOrder,taskUsers,taskHours,taskEnd},
				success: function(data){
					var id = JSON.parse(data);
								console.log("Story ID: " + data);
								
					 var task = "<div class='dragger' id=" + id +"><aside class='taskText'> " + taskTitle + " </aside></aside><aside class='points' style='position: absolute; bottom: 3px; right: 0px;'>"+ taskHours +"</aside><aside class='usersTasks '>"+ userString +" &nbsp;</aside></div>";		
					$(task).detach().css({top: 0,left: 3}).appendTo('#innerOne');
					initialize();
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 6000
				});
			});
			
			
			
			//Function for saving the story when you click the save story checkbox
			$('.storySave').click(function(){			
				$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
				});
				$('nav').removeClass('zTo1');	
				var $editer = $('#editWindowStory').addClass('hideDiv');
				var $blanker = $('#blankout').addClass('hideDiv');
								
				var storyTitle =  $('.storyTitle').val();
				var storyDesc = $('.storyDesc').val();
				var storyOrder = 1;
				var storyUsers = [];
				var currentIteration = $('.iterationInput').val();
				var storyPoints = $('.pointsInput').val();
				for(var i = 0; i <25;i++)
				{
					var box = $('#fancy-checkbox-' + i);
					if(box.is(":checked"))
					{
						storyUsers.push(i);
					}	
				}
				
				$.ajax({url: 'addStory.php',
				type: 'GET',
				data: {storyTitle,storyDesc,storyOrder,storyUsers,storyPoints,currentIteration},
				success: function(data){
					var id = JSON.parse(data);
					var storyB = "";
					var style = "";
					if(currentIteration == 0)
					{
						storyB += "storyB";
						style = 'style="width:252px; float:left;"';
					}
					var story = '<div name=' + id + ' class="'+storyB+' story" '+style+'><aside class="taskText">' + storyTitle +'</aside><div class="userBox">';
						story+='<div class="users">';
						for(var i=0; i < storyUsers.length;i++)
						{
							story+=  storyUsers[i];
						}
						story+='&nbsp;</div></div><div class="points">' + storyPoints + '</div></div>';
						
					if(currentIteration == 0)
					{
						$(story).detach().css({top: 0,left: 3}).appendTo('.storyBoxBacklog');
						
					}
					else{
						$(story).detach().css({top: 0,left: 3}).appendTo('.storyBox');
					}
					
					initialize();
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 3000
				});
			});
			//Updates the database for teh story
			$('.storySaveEdit').click(function(){			
				$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
				});
				$('nav').removeClass('zTo1');	
				var $editer = $('#editWindowStory').addClass('hideDiv');
				var $blanker = $('#blankout').addClass('hideDiv');
				var storyID = window.storyId;

				var storyTitle =  $('.storyTitle').val();
				var storyDesc = $('.storyDesc').val();
				var storyPoints = $('.pointsInput').val();
				var storyIteration = $('.iterationInput').val();
				var storyOrder = 1;
				var storyUsers = [];
			
				for(var i = 0; i <25;i++)
				{
					var box = $('#fancy-checkbox-' + i);
					if(box.is(":checked"))
					{
						storyUsers.push(i);
					}	
				}
				
				$.ajax({url: 'editStories.php',
				type: 'GET',
				data: {storyID,storyTitle,storyDesc,storyOrder,storyUsers,storyPoints,storyIteration},
				success: function(data){
						
				
						location.reload();
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 3000
				});
			});
			
			
			//Updates the database for the task
			$('.taskSaveEdit').click(function(){			
				
				
				
				var taskTitle = $('.titleInput').val();
				var taskDesc = $('.descInput').val();
				var taskHours = $('.hoursInput').val();
				var taskId = window.taskGlobalID;
			
				var $editer = $('#editWindow').addClass('hideDiv');
				var $blanker = $('#blankout').addClass('hideDiv');
				$('nav').removeClass('zTo1');
				$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
				});
				$('.userSelect').removeClass('hideDiv');
				
				$.ajax({url: 'editTask.php',
				type: 'GET',
				data: {taskId,taskTitle,taskDesc,taskHours},
				success: function(data){
						var returned = JSON.parse(data);
					
						$('.taskText' + taskId).text(returned[0]);		
						$('#taskDesc' + taskId ).text(returned[1]);
						$('.taskHours' + taskId).text(returned[2]);
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 3000
				});
			});
			
			
			
			//Deletes from teh database for the story
			$('.deleteStory').click(function(){			
				
				if (confirm('Are you sure you want to delete this story?')) {
				$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
				});
				$('nav').removeClass('zTo1');	
				var $editer = $('#editWindowStory').addClass('hideDiv');
				var $blanker = $('#blankout').addClass('hideDiv');
				var storyID = window.storyId;
				
				$.ajax({url: 'deleteStory.php',
				type: 'GET',
				data: {storyID},
				success: function(data){

					$( ".story" ).each(function( index ) {											
						var id = $( this ).attr('name');							
						if(id == window.storyId)
						{							
							$(this).remove(); 							
						}				
					});
					
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 3000
				});
				
				}
			});
			
			//Deletes from teh database for the story
			$('.splitStory').click(function(){			
				
				if (confirm('Are you sure you want to split this story?  All unfinished tasks will be moved to a story of the same name in the next iteration.')) {
				$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
				});
				$('nav').removeClass('zTo1');	
				var $editer = $('#editWindowStory').addClass('hideDiv');
				var $blanker = $('#blankout').addClass('hideDiv');
				var storyID = window.storyId;
				
				var storyTitle =  $('.storyTitle').val();
				var storyDesc = $('.storyDesc').val();
				var storyPoints = $('.pointsInput').val();
				var storyIteration = $('.iterationInput').val();
				var storyOrder = 1;
				var storyUsers = [];
			
				for(var i = 0; i <25;i++)
				{
					var box = $('#fancy-checkbox-' + i);
					if(box.is(":checked"))
					{
						storyUsers.push(i);
					}	
				}
				console.log(storyID + ", ");
				console.log(storyTitle + ", ");
				console.log(storyDesc + ", ");
				console.log(storyPoints + ", ");
				
				$.ajax({url: 'splitStory.php',
				type: 'GET',
				data: {storyID,storyTitle,storyDesc,storyOrder,storyUsers,storyPoints,storyIteration},
				success: function(data){
					
					location.reload();
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 3000
				});
				
				}
			});

		initialize();	
		
});
	
	
			//Deletes from teh database for the story
			function deleteTask(taskID){			
				
				if (confirm('Are you sure you want to delete this task?')) {
				$.ajax({url: 'deleteTask.php',
				type: 'GET',
				data: {taskID},
				success: function(data){

					$( ".dragger" ).each(function( index ) {											
						var id = $( this ).attr('id');							
						if(id == taskID)
						{							
							$(this).remove(); 							
						}				
					});
					initialize();
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 3000
				});
				
				}
			}
	
	function updateProgressBars(storyID)
	{
			if(storyID < 1)
			{
			$( ".progressBar" ).each(function( index ) {
					 
					 var storyId = $( this ).attr('id');
					 var thisStory = $(this);
						$.ajax({url: 'progressBar.php',
							type: 'GET',
							data: {storyId},
							success: function(data){
							var returnedData = JSON.parse(data);	
							var percent = (returnedData[1]/returnedData[0]) * 100;
							thisStory.css( "width", percent + "%");
							thisStory.css( "background-color", "#3cc920" );
							thisStory.css( "height", "6px" );
							thisStory.css( "position", "relative" );
							thisStory.css( "top", "-5px" );
							thisStory.css( "left", "-5px" );					
							},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
							 timeout: 3000
						});
				 
					});
			}else
			{
				var storyId = storyID;
				var thisBar;
				$( ".progressBar" ).each(function( index ){ 
					var id = $( this ).attr('id');
					if(id == storyId)
					{   
						thisBar = $(this);
					}
				
				});										 
						$.ajax({url: 'progressBar.php',
							type: 'GET',
							data: {storyId},
							success: function(data){
							var returnedData = JSON.parse(data);
	
							var percent = (returnedData[1]/returnedData[0]) * 100;
							thisBar.css( "width", percent + "%");
							thisBar.css( "background-color", "#3cc920" );
							thisBar.css( "height", "6px" );
							thisBar.css( "position", "relative" );
							thisBar.css( "top", "-5px" );
							thisBar.css( "left", "-5px" );						
							},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
							 timeout: 3000
						});
							
				
			}
	}
	
	//Restart some of the drag drop functionality and other things that need to happen
	function initialize()
	{
			
			
					//AJAX call to make the tasks change
			$('.story').unbind().click(function(){
							
				var col1 = [];
				var col2 = [];
				var col3 = [];
				
				var storyId = $(this).attr('name');
				window.storyId = storyId;
				$('.story').removeClass('selectedStory');
				$(this).addClass('selectedStory');

				$.ajax({url: 'getTasks.php',
				type: 'GET',
				data: {storyId},
				success: function(data){
					var tasks = JSON.parse(data);
						
						$('#innerOne').empty();
						$('#innerTwo').empty();
						$('#innerThree').empty();
						
						$('#innerOne').append("<p class='title'>Accepted <button class = 'btn btn-info buttonRight' id='addTask'>Task <i class='fa fa-plus'></i></button></p>");		
						$('#innerTwo').append("<p>Current</p>");
						$('#innerThree').append("<p>Done</p>");
						for(var i = 0; i < tasks.length; i++)
						{						
							if( tasks[i].col == 1)
							{
								$('#innerOne').append("<div class='dragger' id=" + tasks[i].ID +"><aside class='taskText taskText" + tasks[i].ID +"'> " +  tasks[i].title + 
								" </aside><aside class='userBox'><aside class='users'><img style='width:15px' src='/images/people/" + tasks[i].usersBox + ".png'></aside></aside><aside class='checkbox checkbox1 hideDiv'></aside><aside class='points taskHours" + tasks[i].ID +"' style='position: absolute; bottom: 3px; right: 0px;'>"+   tasks[i].hours+
								"</aside><aside class='hideDiv' id='taskDesc" + tasks[i].ID +"'>" + tasks[i].desc +"</aside></div>");							
							}
							if( tasks[i].col == 2)
							{							
								$('#innerTwo').append("<div class='dragger' id=" +  tasks[i].ID +"><aside class='taskText taskText" + tasks[i].ID +"'> " +  tasks[i].title + 
								" </aside><aside class='userBox'><aside class='users'><img style='width:15px' src='/images/people/" + tasks[i].usersBox + ".png'></aside></aside><aside class='checkbox checkbox1 hideDiv'></aside><aside class='points taskHours" + tasks[i].ID +"' style='position: absolute; bottom: 3px; right: 0px;'>"+tasks[i].hours+
								"</aside><aside class='hideDiv' id='taskDesc" + tasks[i].ID +"'>" + tasks[i].desc +"</aside></div>");
							}
							if( tasks[i].col == 3)
							{	
								var checkboxStatus;
								if(tasks[i].status == 0)
								{
									checkboxStatus = "checkbox1"
								}
								if(tasks[i].status == 1)
								{
									checkboxStatus = "checkbox3"
								}	
								
															
								$('#innerThree').append("<div class='dragger' id=" +  tasks[i].ID +"><aside class='taskText taskText" + tasks[i].ID +"'> " +  tasks[i].title + 
								" </aside><aside class='userBox'><aside class='users'><img style='width:15px' src='/images/people/" + tasks[i].usersBox + ".png'></aside></aside><aside class='checkbox "+ checkboxStatus +"'></aside><aside class='points taskHours" + tasks[i].ID +"' style='position: absolute; bottom: 3px; right: 0px;'>"+ tasks[i].hours+
								"</aside><aside class='hideDiv' id='taskDesc" + tasks[i].ID +"'>" + tasks[i].desc +"</aside></div>");
							}
							
						}
						$('#addTask').addClass('addTask');
						initialize();
					
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 6000
					});
					
				
			});
		
			$('.checkbox1').unbind().click(function(){
				$(this).removeClass('checkbox1');
				$(this).addClass('checkbox3');
				var storyID = window.storyId;
				var status = 1;
				var taskID = $(this).parent().attr('id');
				var actualHours = prompt("How many hours did this take you?","0");
				var actual = parseInt(actualHours);
				var completed = 0;
				$( ".checkbox" ).each(function( index ) {
					
					if(!($(this).hasClass('checkbox3')))
					{
						completed = 0;
					}
					else
					{
						completed = 1;
					}
					if($("#innerOne").children().length > 1)
					{completed = 0;}
					if($("#innerTwo").children().length > 1)
					{completed = 0;}
					
				});
				
				
				$.ajax({url: 'updateDB.php',
				type: 'GET',
				data: {status,taskID,actual,completed,storyID},
				success: function(data){
					
				
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 timeout: 3000
				});
				initialize();
			});
			
			
				$('.checkbox3').unbind().click(function(){
					
				$(this).removeClass('checkbox3');
				$(this).addClass('checkbox');
			
				var storyID = window.storyId;
				var completed = 0;	
				var status = 0;
				var taskID = $(this).parent().attr('id');
				
				$.ajax({url: 'updateDB.php',
				type: 'GET',
				data: {status,taskID,storyID,completed},
				success: function(data){
					
				
				},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
				 timeout: 3000
				});
			});
			
		
		
			//Brings up the stuff when you hover a story
			$( ".story" ).hover(function() {
					$( this ).find( "span:last" ).remove();
					
				var storyID = $(this).attr('name');
				
					$( this ).append( $( "<span class='editStory' onclick='editStory(" + storyID +")' style='position:relative; right:-16px;top:-2px;'> <i class='fa fa-pencil'></i></span>" ) );
			
				}, function() {
					$( this ).find( "span:last" ).remove();
					
			});
			
			$( ".dragger" ).hover(function() {
				var id = $(this).attr('id');
				
				
				$( this ).append( $( "<div class='taskHoverHolder' style='position:absolute; right: 23px;'><aside class='editTask' onclick='editTask("+ id +")' style='float:right;'> <i class='fa fa-pencil'></i></aside><aside class ='deleteTask' onclick='deleteTask("+id+")' style='float:right;'><i class='fa fa-trash-o'></i></aside><aside class='addImage' style='float:right;'> <i class='fa fa-image' onclick='openTaskImage("+id+")'></i></aside><aside class='openTask' style='float:right;'> <i class='fa fa-search' onclick='viewTask("+id+")'></i></aside></div>" ) );

				}, function() {
					$(this).find(".editTask" ).remove();
					$(this).find(".deleteTask" ).remove();
					$(this).find(".openTask" ).remove();
					$(this).find(".taskHoverHolder" ).remove();
			});
			
		
		$('.dropTarget').droppable({
			activeClass: "active",
            hoverClass:  "hover",
  
			drop: function(ev, ui) {
			var dropped = ui.draggable;
			var droppedOn = $(this).children().first();
			$(dropped).detach().css({top: 0,left: 3}).appendTo(droppedOn);
			var droppedID = dropped.attr('id');
			var droppedOnID = droppedOn.attr('name');
									
			$.ajax({url: 'updateDB.php',
			type: 'GET',
			data: {taskID:droppedID,colID:droppedOnID},
			success: function(data){
					//updateProgressBars(window.storyId);
					
					if(droppedOnID == 3)
					{
						dropped.find('.checkbox').removeClass('hideDiv');
						
					}else
						dropped.find('.checkbox').addClass('hideDiv');
			},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
			 timeout: 3000
			});

			}
		});
		
		$(function() {
		$( ".dropTarget div" ).draggable();
		});
		
		$('#addTask').click(function() {
			var $editer = $('#editWindow').removeClass('hideDiv');
			var $blanker = $('#blankout').removeClass('hideDiv');
			$('html, body').css({
				'overflow': 'hidden',
				'height': '100%'
			});
			$('nav').addClass('zTo1');
			var hideTaskSave = $('.taskSave').removeClass('hideDiv');	
			var hideTask = $('.taskSaveEdit').addClass('hideDiv');
		});
		$('#addStory').click(function() {
			var $editer = $('#editWindowStory').removeClass('hideDiv');
			var $blanker = $('#blankout').removeClass('hideDiv');
			$('html, body').css({
				'overflow': 'hidden',
				'height': '100%'
			});
			$('nav').addClass('zTo1');	
			var hideStorySave = $('.storySave').removeClass('hideDiv');	
			var hideStory = $('.storySaveEdit').addClass('hideDiv');
		});
		
	
	}
	//Called when you press the edit pencil on a story
	function editStory(storyID)
	{
			
			var $editer = $('#editWindowStory').removeClass('hideDiv');
			var $blanker = $('#blankout').removeClass('hideDiv');
			$('html, body').css({
				'overflow': 'hidden',
				'height': '100%'
			});
			$('nav').addClass('zTo1');		
			window.storyId = storyID;
			
			var hideStorySave = $('.storySave').addClass('hideDiv');	
			var showEditStory = $('.storySaveEdit').removeClass('hideDiv');	
			var storyIteration = $('#currentIteration span').text();
			var storyTitle =  $('.storyTitle' + storyID).text();
			var storyDesc = $('.storyDesc' + storyID ).text();
			var storyPoints = $('.points' + storyID).text();
			
			var storyOrder = 1;
			var storyUsers = [];

				$('.storyTitle').val(storyTitle);
				$('.storyDesc').val(storyDesc);
				$('.pointsInput').val(storyPoints);
				$('.iterationInput').val(storyIteration);
				for(var i = 0; i <25;i++)
				{
					if($('.users'+ storyID + '-' + i).val() == $('#userCheckbox'+i).val())	
					{		
						$('#fancy-checkbox-' + i).prop('checked', true);
					}
				}
				 
		
	}
	
	//Called when you press the edit pencil on a task
	function editTask(taskId)
	{
			
			var $editer = $('#editWindow').removeClass('hideDiv');
			var $blanker = $('#blankout').removeClass('hideDiv');
			$('html, body').css({
				'overflow': 'hidden',
				'height': '100%'
			});
			$('nav').addClass('zTo1');	
			
			 window.taskGlobalID = taskId;
			var hideTaskSave = $('.taskSave').addClass('hideDiv');	
			var showEditTask = $('.taskSaveEdit').removeClass('hideDiv');	
			
		
			var taskTitle =  $('.taskText' + taskId).text();		
			var taskDesc = $('#taskDesc' + taskId ).text();
			var taskHours = $('.taskHours' + taskId).text();
			
			var taskOrder = 1;
		


				$('.titleInput').val(taskTitle);
				$('.descInput').val(taskDesc);
				$('.hoursInput').val(taskHours);
				
			var hideTaskSave = $('.taskSave').addClass('hideDiv');	
			var showEditTask = $('.taskSaveEdit').removeClass('hideDiv');		
			$('.userSelect').addClass('hideDiv');
				 
		
	}
	
	
	
	
	//IterationNumber: Number of the iterationNumber
	//Increase: bool, go up?
	function changeIteration(increase)
	{

		iterationNumber = $('#currentIteration span').text();
		if(increase == 1)
		{
			iterationNumber++;		
		}else if(increase == 3)
		{
			iterationNumber = iterationNumber;
		}
		else
		{
			iterationNumber--;
		}			
		
		$.ajax({url: 'fillBacklog.php',
		type: 'GET',
		data: {selectedIteration:iterationNumber},
		success: function(data){
				$('#currentIteration span').text(iterationNumber);

			 $('.storyBox').empty();
			 $('#innerOne').empty();
			 $('#innerTwo').empty();
			 $('#innerThree').empty();
			 $('#innerOne').append("<p class='title'>Accepted <button class = 'btn btn-info buttonRight' id='addTask'>Task <i class='fa fa-plus'></i></button></p>");		
			 $('#innerTwo').append("<p>Current</p>");
			 $('#innerThree').append("<p>Done</p>");
			 $('.storyBox').append('<p class="title1">Backlog <span id="openBacklog"><i class="fa fa-plus"></i></span><button class = "btn btn-info buttonRight" id="addStory">Story <i class="fa fa-plus"></i></button></p>');
			 $('.storyBox').append(data);
			 initialize();
			 //updateProgressBars(0);
		},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
		 timeout: 3000
		});
		
	}
	
	//userId: Id of the user to filter the backlog for
	function sortByUser(userId)
	{

		
		
		$.ajax({url: 'fillBacklogbyUser.php', 
		type: 'GET',
		data: {userId},
		success: function(data){
				$('.userSorts').css('color','#2c3e50');
				$('.userSorts').css('background-color','#e2e4e6');
				$('#userSort' + userId).css('color','blue');
				$('#userSort' + userId).css('background-color','#fff');
				
			 $('.storyBox').empty();
			 $('#innerOne').empty();
			 $('#innerTwo').empty();
			 $('#innerThree').empty();
			 $('#innerOne').append("<p class='title'>Accepted <button class = 'btn btn-info buttonRight' id='addTask'>Task <i class='fa fa-plus'></i></button></p>");		
			 $('#innerTwo').append("<p>Current</p>");
			 $('#innerThree').append("<p>Done</p>");
			 $('.storyBox').append('<p class="title1">Backlog <button class = "btn btn-info buttonRight" id="addStory">Story <i class="fa fa-plus"></i></button></p>');
			 $('.storyBox').append(data);
			 initialize();
		},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
		 timeout: 3000
		});
		
	}
	function testCron()
	{
		$.ajax({url: 'cron.php', 
		type: 'GET',
		data: {},
		success: function(data){
				alert("didiit");
		},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
		 timeout: 3000
		});
	}
	function openTaskImage(id)
	
	{
			var $editer = $('#addTaskFiles').removeClass('hideDiv');
			var $blanker = $('#blankout').removeClass('hideDiv');
			$('html, body').css({
				'overflow': 'hidden',
				'height': '100%'
			});
			$('nav').addClass('zTo1');	
			$('#addTaskFiles').addClass("" + id);
	}
	function imageAddClose()
	{
		var $editer = $('#addTaskFiles').addClass('hideDiv');
			var $blanker = $('#blankout').addClass('hideDiv');
			$('html, body').css({
					'overflow': 'auto',
					'height': 'auto'
			});
			$('nav').removeClass('zTo1');	
	}
	
	function viewTask(id)
	{
		
		
		h = 600;
		w = 800;
		 // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open("../tasks/task_view.php?id="+id+"", "Task View", 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
		
	}
	
	function moveToIteration(storyID)
	{
		var storyIteration = $('#currentIteration span').text();
		var story;
		var storyDiv = "<div class='story' id='justAdded' name = '"+ storyID +"'></div>";
		$(storyDiv).detach().css({top: 0,left: 3}).appendTo('.storyBox');
					$( ".storyB" ).each(function( index ) {											
						var id = $( this ).attr('name');							
						if(id == storyID)
						{	
							story = $(this).html();
							$(this).remove(); 
							return false;
						}				
					});	
		
					$('#justAdded').append(story);
					$('#justAdded #moveToIteration').remove();
					$('#justAdded').removeAttr('id');
					initialize();
					$.ajax({url: 'editStories.php', 
					type: 'GET',
					data: {storyID,storyIteration},
					success: function(data){
						
					},error: function (xhr, ajaxOptions, thrownError) {alert("ERROR:" + xhr.responseText+" - "+thrownError);},
					 timeout: 3000
					});
	}
	
		
		
 
   
   

 