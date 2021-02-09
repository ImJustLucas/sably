<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/ceee3d5b7f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="wrap">
		<div id="page" class="site">
			<header id="masthead" class="site-header">
				<div class="header-wrap">
					<div class="nav_logo">
						<div class="logoSably">
							<a class="logobutton" href="#">
								<img class="logo1" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune1.png" alt="Logo Sably 1">
							</a>
						</div>
					</div>
					<div class="nav_buttons">
						<div><a class="aboutbutton" href="#">A propos</a></div>
						<div><a class="contactbutton" href="#">Contact</a></div>
					</div>
					<div class="nav_login">
						<a class="loginbutton" href="#">Connexion/Inscription </a>
					</div>
				</div>
			</header><!-- #masthead -->