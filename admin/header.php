<?php
ob_start();
session_start();
include("config.php");
include("../includes/functions.php");
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

// Check if the user is logged in or not
if(!isset($_SESSION['user'])) {
	header('location: login.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AJ Artist - Main Admin Panel</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/datepicker3.css">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="css/jquery.fancybox.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" href="css/_all-skins.min.css">
	<link rel="stylesheet" href="style.css">
	<style type="text/css">
		.lll{
			height: 50px;
			width: 150px;
		}
	</style>
</head>

<body class="hold-transition fixed skin-blue sidebar-mini">

	<div class="wrapper">

		<header class="main-header">

			<a href="index.php" class="logo">
				<!-- <span class="logo-lg">Arewa Global</span> -->
				<img align="middle" class="lll" src="img/logo1.png" alt="Arewa Global Admin Panel">
			</a>

			<nav class="navbar navbar-static-top">
				
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<span style="float:left;line-height:50px;color:#fff;padding-left:15px;font-size:18px;">Admin Panel</span>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="../assets/uploads/<?php echo $_SESSION['user']['photo']; ?>" class="user-image" alt="User Image">
								<span class="hidden-xs"><?php echo $_SESSION['user']['full_name']; ?></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-footer">
									<div>
										<a href="profile-edit.php" class="btn btn-default btn-flat">Edit Profile</a>
									</div>
									<div>
										<a href="logout.php" class="btn btn-default btn-flat">Log out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>

			</nav>
		</header>

  		<?php $cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>

  		<aside class="main-sidebar">
    		<section class="sidebar">
      
      			<ul class="sidebar-menu">

			        <li class="treeview <?php if($cur_page == 'index.php') {echo 'active';} ?>">
			          <a href="index.php">
			            <i class="fa fa-laptop"></i> <span>Dashboard</span>
			          </a>
			        </li>

					<?php if($_SESSION['user']['role'] == 'Admin'): ?>
			        <li class="treeview <?php if( ($cur_page == 'user-add.php')||($cur_page == 'user.php')||($cur_page == 'user-edit.php') ) {echo 'active';} ?>">
			          <a href="user.php">
			            <i class="fa fa-user-plus"></i> <span>User</span>
			          </a>
			        </li>
			    	<?php endif; ?>

			        <?php 
						if($_SESSION['user']['role'] == 'Admin'):
					?>
					<li class="treeview <?php if( ($cur_page == 'add-art-cat.php')||($cur_page == 'art-cat.php')||($cur_page == 'edit-art-cat.php') ) {echo 'active';} ?>">
			          <a href="art-cat.php">
			            <i class="fa fa-sliders"></i> <span>Art Category</span>
			          </a>
			        </li>
			        <?php endif; ?>

			        <?php 
						if($_SESSION['user']['role'] == 'Admin'):
					?>
					<li class="treeview <?php if( ($cur_page == 'upload-art.php')||($cur_page == 'art.php')||($cur_page == 'edit-art.php') ) {echo 'active';} ?>">
			          <a href="art.php">
			            <i class="fa fa-picture-o"></i> <span>Art</span>
			          </a>
			        </li>
			        <?php endif; ?>

					
			         <?php 
						if($_SESSION['user']['role'] == 'Admin'):
					?>
			        <li class="treeview <?php if( ($cur_page == 'articles-add.php')||($cur_page == 'articles.php')||($cur_page == 'articles-edit.php') ) {echo 'active';} ?>">
			          <a href="articles.php">
			            <i class="fa fa-newspaper-o"></i> <span>Articles</span>
			          </a>
			        </li>
			        <?php endif; ?>
					
					<?php 
						if($_SESSION['user']['role'] == 'Admin'):
					?>
			        <li class="treeview <?php if( ($cur_page == 'social-media.php') ) {echo 'active';} ?>">
			          <a href="social-media.php">
			            <i class="fa fa-address-book"></i> <span>Social Media</span>
			          </a>
			        </li>
			        <?php endif; ?>

					<?php 
						if($_SESSION['user']['role'] == 'Admin'):
					?>
			        <li class="treeview <?php if( ($cur_page == 'settings.php') ) {echo 'active';} ?>">
			          <a href="settings.php">
			            <i class="fa fa-cog"></i> <span>Settings</span>
			          </a>
			        </li>
			        <?php endif; ?>
        
      			</ul>
    		</section>
  		</aside>

  		<div class="content-wrapper">