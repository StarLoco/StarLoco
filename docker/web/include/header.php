<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- Meta -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0; user-scalable=0;">

	<title><?php echo TITLE; ?></title>
	
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">
	
	<!-- Core CSS -->
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
	<link href="css/themes/blue.css" rel="stylesheet" id="themes" />
	
	<!-- Plugins -->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="plugins/animate/animate.min.css" rel="stylesheet" >
	<link href="plugins/bxslider/bxslider.css" rel="stylesheet"  />
	<link href="plugins/notification/css/ns-default.css" rel="stylesheet" />
	<link href="plugins/notification/css/ns-style-other.css" rel="stylesheet" />
	<script src="plugins/twitter/twitter.js"></script>
				
	<!-- Demo -->
	<link rel="stylesheet" href="css/demo.css">
</head>

<body>
	<header>
		<!-- top -->
		<div id="top">
			<div class="container">
				<ul>
					<li><a href="?page=index" class="active"> <i class="fa fa-home"></i> Accueil</a></li>
					<li><a href="<?php echo URL_FORUM; ?>">Forum</a></li>
					<li><a href="<?php echo URL_BARBOK; ?>">Barbok</a></li>
					<li><a href="<?php echo URL_TEAMSPEAK; ?>">Teamspeak</a></li>
					<?php if(isset($_SESSION['user']) && ($_SESSION['data'] -> account == "locos975" || $_SESSION['data'] -> account == "mimikg29pvphl")) echo '<li><a href="?page=administration">Administration' . $_SESSION['data'] -> admin . '</a></li>'; ?>
				</ul>
				
				<?php
				if(isset($_SESSION['user'])) { ?>
					<div class="btn-group pull-right hidden-xs">
						<a href="?page=profile" class="btn" ><i class="fa fa-user"></i> Mon compte</a>
						<a href="?page=signin&ok=2" class="btn" ><i class="fa fa-user"></i> Déconnexion</a>
					</div><?php
				} else { ?>
					<div class="btn-group pull-right hidden-xs">
						<a href="#signin" data-toggle="modal" class="btn"><i class="fa fa-user"></i> Connexion</a>
						<a href="#register" data-toggle="modal" class="btn"><i class="fa fa-plus"></i> Inscription</a>
					</div>
				<?php
				} ?>
			</div>
		</div>
		<!-- ./top -->
		
		<!-- header -->
		<div class="header">
			<div class="container">
				<span class="bar hide"></span>
				<a href="?page=index" class="logo pull-left"><i class="fa fa-bolt"></i> <?php echo TITLE; ?></a>

				<!--Pub ici 
				<div class="advertisement advertisement-sm pull-left">
					<a href="index-2.html"><img src="img/468.png" alt="" /></a>
				</div>-->
				
				<ul class="list-inline pull-right hidden-xs">
					<li><a href="<?php echo URL_TWITTER; ?>" class="btn btn-social-icon btn-circle" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="<?php echo URL_FACEBOOK; ?>" class="btn btn-social-icon btn-circle" data-toggle="tooltip" data-placement="bottom"  title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="<?php echo URL_GOOGLE; ?>" class="btn btn-social-icon btn-circle" data-toggle="tooltip" data-placement="bottom"  title="Google"><i class="fa fa-google-plus"></i></a></li>
				</ul>
			</div>
		</div>
		<!-- ./header -->
		
		<!-- navigation -->
		<nav>
			<div class="container">
				<ul>
					<li><a href="?page=index">Accueil</a></li>
					<li><a href="<?php echo URL_FORUM; ?>">Forum</a></li>
					<li><a href="?page=join">Nous rejoindre</a></li>
					<?php if(isset($_SESSION['user'])) {
								echo '<li><a href="?page=shop">Boutique</a></li>';
							} ?>
					<li class="dropdown">
						<a href="#">Autres<i class="ion-chevron-down"></i></a>
						<!-- dropdown menu -->
						<ul class="dropdown-menu default">
							<li><a href="?page=ladder">Classement</a></li>
							<li><a href="?page=viewdrop">Visualisateur de drop</a></li>							
						</ul>
					</li>
				</ul>
				<!-- search -->
				<div class="pull-right">
					<ul>
						<?php
						if(isset($_SESSION['user'])) { ?>
							<li><a href="?page=profile">Mon compte </a></li>
							<li><a href="?page=signin&ok=2">Déconnexion</a></li>
							<?php
						} else { ?>
							<li><a href="?page=signin">Connexion</a></li>
							<li><a href="?page=register">Inscription</a></li>
						<?php
						} ?>
					</ul>
				</div>
			</div>
		</nav>
		<!-- ./navigation -->
	</header>
	
	<div class="container">
		<!-- wrapper-->
		<div id="wrapper">
