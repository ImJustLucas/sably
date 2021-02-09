<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/ceee3d5b7f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="wrap">
		<div id="page" class="site">

			<header id="header" class="site-header">
				<div class="nav_logo">
					<img class="logo" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune1.png" alt="Logo Sably">
				</div>
				<div class="nav_buttons">
				</div>
				<div class="nav_login">
				</div>
			</header><!-- #masthead -->