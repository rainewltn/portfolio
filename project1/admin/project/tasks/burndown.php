<?php
 require_once('../includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Get all tasks before the next deadline.
//Draw an estimated line on hover of the best case senario?
//Everyday add a new line for what is left on that day.  We are going to have a do a chron job? 
// Or maybe just as long as someone logs in that day it will update the database hole for it?

	//Update the tasks table everytime someone looks at it.  Take the current number complete and save it to that day...? i only want one saved a day..........
		if(isset($_POST['submit'])){
			
			
			try {
						
						$stmt = $db->prepare('INSERT INTO deadlines_link (deadline_id,amount,date) VALUES (:deadline_id, :amount, :date)');
						$stmt->execute(array(
							':deadline_id' => $_POST['deadlines_id'],
							':amount' => NULL,
							':date' => NULL
						));
				

			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
			
			
	
		}
		$nextId = 0;
		if(isset($_POST['update'])){
			
			
			try {
						$stmt1 = $db->query('SELECT id, amount FROM deadlines_link');
						while($row1 = $stmt1->fetch())
						{
							if($row1['amount'] == NULL)
							{
								$nextId = $row1['id'];
								break;
							}
						}
			
						
						$stmt = $db->prepare('UPDATE deadlines_link SET amount = :amount, date = :date WHERE id = "'.$nextId.'"');
						$stmt->execute(array(
							':amount' => $_POST['current_left'],
							':date' => date("m/d",time())
						));
				

				}
				catch(PDOException $e) {
					echo $e->getMessage();
				}
		}
	
	
	$stmt_Deadlines = $db->query('SELECT id, start, end, name FROM deadlines');
	$current_left = 0;
	$total_deadline_count = 0;
	$saved_deadlines = 20;
	$idnumber = 1;
	while($row_Deadlines = $stmt_Deadlines->fetch())
	{
		
		$stmt_current = $db->query('SELECT end_date, complete FROM tasks WHERE end_date between "'.$row_Deadlines['start'].'" and  "'.$row_Deadlines['end'].'"');

		
		while($row_current = $stmt_current->fetch())
		{
			if($row_current['complete'] == 0)
				$current_left++;
			$total_deadline_count++;
		}

		
		
		?>
		<style>
			.chartBox
			{
				height: <?php echo $total_deadline_count * 20 . "px;";?>
				list-style-type: none;
				padding: 0px;
				padding-top:25px;
				
				background-color: #e9e9e9;
			}
			.chartBox li
			{
				display:inline-block;				
				margin: 0px 8px;
				width: 30px; 
			}
			.chartBox #bar #value
			{				
				position:relative;
				top: -20px;
				text-align: center;
				margin: 0;
			}
			
			.chartBox #bar #date
			{
				position: absolute;
				bottom: -30px;
				left:-8px;
				margin: 0;
				 -ms-transform: rotate(-7deg); /* IE 9 */
			-webkit-transform: rotate(-7deg); /* Chrome, Safari, Opera */
			transform: rotate(-45deg);
			}
			
			.chartBox #bar_container
			{
				position: relative;
				height: 100%;
			}
			
			.chartBox #bar
			{
				background-color: blue;
				position: absolute; 
				bottom: 0px;
				width: 100%;
			}
			
			.outerBox
			{
				padding: 20px;
				padding-bottom:30px;
				background-color: #dbdbdb;
				min-width: 700px; 
			}
			
		</style>
		<div class="outerBox">
			<p style = "margin:0px;"><?php echo $row_Deadlines['name']; ?></p>
		
			<ul class="chartBox">
			 <?php
				
				$stmt_link = $db->query('SELECT deadline_id, amount, date FROM deadlines_link WHERE deadline_id = "'.$row_Deadlines['id'].'"');
				while($row_link = $stmt_link->fetch())
				{	
					echo "<li>
					<div id='bar_container'>
						<div id='bar' style='height:".($row_link['amount']/$total_deadline_count*100)."%;'>
							<p id='value'>".$row_link['amount']."</p>
							<p id='date'>";
							if(!$row_link['date'])
							{
								echo "date";
							}
							else
							{
								echo date("m/d",strtotime($row_link['date']));
							}
							echo "</p>
						</div>
						
					</div>
					</li>";
					
				}

			 ?>
			 </ul>
		
		</div>
		
		
	
		<?php
		
		
		//make a box as tall as needed.  devide the current_left by the total count to get the percent. Make each column as tall as that percent
		if($_SESSION['username'] == 'drnwltn')
		{
			echo "<form action='' method='post'>";
			echo '<input type="hidden" name = "deadlines_id" id="deadlines_id" value="'.$idnumber.'"></p>';
			echo '<input type="hidden" name = "current_left" id="current_left" value="'.$current_left.'"></p>';
			echo "<p><input type='submit' name='update' value='Update'></p>";
			echo "<p><input type='submit' name='submit' value='Add Date'></p>";
			echo "</form>";
			$idnumber++;
			
		}
		
	}
	?>