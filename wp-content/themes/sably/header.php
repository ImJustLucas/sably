<!doctype html>
<html <?php language_attributes(); 
global $post;
?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php if($post->post_name === 'recruiter') {?>
	<div class="wrap-recruiter">
	<?php } else { ?>
	<div class="wrap">
	<?php } ?>
		<div id="page" class="site">
			<header id="masthead" class="site-header">
				<div class="header-wrap">
					<div class="nav_logo">
					<?php if($post->post_name === 'home') {?>
						<div class="logoSably tabButton">
							<a id="home"><img class="image_on" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune1.png" alt="logo" /><img class="image_off" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune2.png" alt="logo" /></a>
						</div>
					<?php } else {?>
						<div class="logoSably tabButton button-home">
							<a href="<?php echo esc_url(home_url('home')) ?>" id="home"><img class="image_on" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune1.png" alt="logo" /><img class="image_off" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune2.png" alt="logo" /></a>
						</div>
					<?php } ?>
					</div>
					<div class="nav_buttons">
						<?php if($post->post_name === 'home') {?>
						<div><a class="tabButton button-home" >Accueil</a></div>
						<div><a class="tabButton button-about" >A propos</a></div>
						<div><a class="tabButton button-contact" href="<?php echo wp_logout_url( home_url('contact') ); ?>">Contact</a></div>
						<?php } else {?>
						<div><a class="tabButton button-home" href="<?php echo esc_url(home_url('home')) ?>">Accueil</a></div>
						<?php }
						if(is_user_logged_in()){?>
						<div><a class="tabButton button-logout" href="<?php echo wp_logout_url( home_url() ); ?>">Deconnexion</a></div>
						<?php }; ?>
					</div>
					<div class="nav_login">
						<?php
						if(is_user_logged_in()){?>
							<a class="tabButton button-login" href="<?php echo esc_url(home_url('profile')) ?>"> <i class="fas fa-user" style="color: #fff;"></i> | Mon profil</a>
						<?php } else {
						?>
						<a class="tabButton button-login" href="<?php echo esc_url(home_url('login')) ?>">Connexion/Inscription</a>
						<?php }; ?>
					</div>
				</div>
			</header><!-- #masthead -->