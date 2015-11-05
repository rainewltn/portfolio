<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
if(!is_user_logged_in())
{
header("Location: /wp-login.php");
die();
}
?>

<!doctype html>
<html lang="en">
<head>
<?php //include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php'; ?>
  <meta charset="utf-8">
  <title>Admin</title>
</head>
<body>
<nav><?php //include $_SERVER['DOCUMENT_ROOT'] . '/modules/navigation.php';?></nav>
 <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  
                    <div class="intro-text">
                        <span class="name">Admin Page</span>
                        <hr class="star-light">
                
                    </div>
                </div>
            </div>
        </div>
    </header>

	<style>
	.trackingBox
	{
		padding:20px;
		color:#2c3e50;
	}
	</style>
		<div class="container">
<section id ="portfolio">		
			<div class="row"> 
				<a class="col-sm-2 trackingBox" href="/index.php?p=19"><i class="fa fa-file-text-o fa-4x"></i><br /><br />Design Document </a>
				<a class="col-sm-2 trackingBox" href="/wp-admin/"><i class="fa fa-pencil fa-4x"></i><br /><br />Blog Admin </a>
				<a class="col-sm-2 trackingBox" href="/admin/project/project/"><i class="fa fa-line-chart fa-4x"></i><br /><br />Tracking </a>
				<?php
				if(get_current_user_id() == 7)
				{
					echo '<a class="col-sm-2 trackingBox" href="projectAdmin.php"><i class="fa fa-gears fa-4x"></i><br /><br />Project Admin </a>';
				}
			
				?>
			</div>
			</section>
			   <br/>
	   <br/><br/>   <br/>
	   <br/><br/>   <br/>
	   <br/><br/>
		</div>
		
	

		<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php';?>
			<?php include $_SERVER['DOCUMENT_ROOT']. '/admin/project/sidebar.php'; ?>
</body>
</html>
