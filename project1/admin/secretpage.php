<?php

require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php');

global $wpdb;

?> 
<!DOCTYPE html>


<head>
	
	<?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php';


?>	
	
	<title>Portfolio | Just Darren</title>

	<link rel="stylesheet" href="/plugins/back-to-top/css/style.css"> <!-- Gem style -->
	<script src="/plugins/back-to-top/js/modernizr.js"></script> <!-- Modernizr -->
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
                    <h3>Portfolioish page</h3>
                    <hr class="star-light">
                </div>
            </div> 
			</br></br></br>

<style>

.taskBox
{
	background-color:#e2e4e6;
	
	
	margin:10px;
	padding: 15px;
	border-radius: 3px;
	box-shadow:  0px 0px 3px 0px rgba(0,0,0,1); 
}
.img-thumbnail
{
	margin-bottom:10px;
	
}
#game img
{
	width:45%;
}
footer
{
	margin-top:200px;
}

</style>
		<ul class="nav nav-tabs">
			 <li class="active"><a data-toggle="tab" href="#site">Website</a></li>
			 <li><a data-toggle="tab" href="#engine">Game Engine</a></li>
			 <li><a data-toggle="tab" href="#game">Mobile Game</a></li>
		</ul>	
		
		<div class="tab-content">
			<div id="site" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12 taskBox">
					<h2>Stray Pixel Games Website</h2>
					<p>I built this project management site for Stray Pixel Games. I designed the entire thing. It was bulit using CSS Bootstrap, Jquery and HTML with PHP and SQL to manage the backend.</p>
					<img class="img-responsive img-thumbnail" src="/images/dashboard.PNG" alt="one">
					<p>This is a dashboard page. This is the admin view so I can see everything at once.  I used Jquery and Ajax to make it all work. Bootstrap to help it all look nice.  The burndown chart was updated by a cron job everynight at midnight.</p>
					<img class="img-responsive img-thumbnail" src="/images/stats.PNG" alt="one">
					<p>This is the stats page.  I strucutred the database with linking tables so that I could easily access data based on relevant information.  Tasks linked to stories, stories iterations, iterations to releases, releases to projects.  Stats showed up based on what iteration you were currently working on.</p>
					<img class="img-responsive img-thumbnail" src="/images/store.PNG" alt="one">
					<p>I created this employee store based on the amount of work people completed during a week.  They could spend points on silly prizes.  It actually did help with motivation to track progress in case you were wondering.</p>
					<img class="img-responsive img-thumbnail" src="/images/planning.PNG" alt="one">
					<p>This was a release planning page.  I wanted it to be super easy to plan out a roadmap.  A release would be a month or two long.  As soon as the required stories were completed for a release goal, the item could be marked off.  Percentages were tracked in the stats page.</p>
					<img class="img-responsive img-thumbnail" src="/images/projectPlanning.PNG" alt="one">
					<p>This page could create and set which project was active.  This would be the current project of the company.  It was pretty small scoped, so we always had everyone working on the same project.</p>
					<p>I am in the process of learning and incorporating SCSS because it sounds amazing.  I am also looking into polymerJS and reactJS to help with dynamic html.  My current Jquery has become pretty cumbersome.  </p>
					</div>					
				</div>
			</div>
			<div id="engine" class="tab-pane fade">
					<div class="row">
						<div class="col-lg-12 taskBox">
						<h3>Pocket Game Developer</h3>
						<p>This is a mobile game engine that I built with a friend of mine.  I designed all of the screens by wireframe, and then used a C# GUI library to code them up.  The art assets were from an online source.</p>
					<img class="img-responsive img-thumbnail" src="/images/spriteEditor.png" alt="one">
						<p>We went through lots of iterations and redesigns based on user feedback.  </p>
					<img class="img-responsive img-thumbnail" src="/images/objectSelect.png" alt="one">
					<img class="img-responsive img-thumbnail" src="/images/editObject.png" alt="one">
					<img class="img-responsive img-thumbnail" src="/images/gameEditor.png" alt="one">
						</div>					
					</div>
			</div>
			<div id="game" class="tab-pane fade">
					<div class="row">
						<div class="col-lg-12 taskBox">
						<h3>A Kite's Tale</h3>
						<p>This game is currently in a prototyping phase.  I designed the layout of these screens.  The screens still don't have final art, so they don't look amazing yet.</p>
					<img class="img-responsive img-thumbnail" src="/images/homeScreen.png" alt="one">
					<img class="img-responsive img-thumbnail" src="/images/gameScreen.png" alt="one">
					<img class="img-responsive img-thumbnail" src="/images/abilitiesScreen.png" alt="one">
						</div>					
					</div>
			</div>
		</div>
	</div>

    
 
<a href="#0" class="cd-top">Top</a>


					
			
		

<?php 

			
			

	
			
		
?>



	
	</div>

</body>

		<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';?>
		<script src="/plugins/back-to-top/js/main.js"></script> <!-- Gem jQuery -->
</html>