<?php global $post;
global $current_user;
?>
<!doctype html>
<html <?php echo language_attributes();?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); //die(debug($current_user->roles[0])) ?>>
	<?php wp_body_open(); ?>
	<?php if (get_page_template_slug() === 'recruiter' ) { ?>
		<div class="wrap-recruiter">
		<?php } else { ?>
			<div class="wrap">
			<?php } ?>
			<div id="page" class="site">
				<header id="masthead" class="site-header">
					<div class="header-wrap">
						<div class="nav_logo">
							<?php if (get_page_template_slug() === 'home') { die('home'); ?>
								<div class="logoSably tabButton">
									<a id="home"><img class="image_on" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune1.png" alt="logo" /><img class="image_off" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune2.png" alt="logo" /></a>
								</div>
							<?php } elseif (get_page_template_slug() === 'recruiter' || get_page_template_slug() === 'recruitersingle' ) { die('recrute'); ?>
								<div class="logoSably tabButton button-home">
									<a id="home"><img class="image_on" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_bleu1.png" alt="logo" /><img class="image_off" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_bleu2.png" alt="logo" /></a>
								</div>
							<?php } else{ ?>
								<div class="logoSably tabButton button-home">
									<a href="<?php echo esc_url(home_url('home')) ?>" id="home"><img class="image_on" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune1.png" alt="logo" /><img class="image_off" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_jaune2.png" alt="logo" /></a>
								</div>
							<?php } ?>
						</div>
						<div class="nav_buttons">
							<?php if ($post->post_name === 'home') { ?>
								<div><a class="tabButton button-home">Accueil</a></div>
								<div><a class="tabButton button-about">A propos</a></div>
								<div><a class="tabButton button-contact" href="<?php echo esc_url(home_url('contact')) ?>">Contact</a></div>
							<?php } else { ?>
								<div><a class="tabButton button-home" href="<?php echo esc_url(home_url('home')) ?>">Accueil</a></div>
							<?php }
							if (is_user_logged_in()) { ?>
								<div><a class="tabButton button-logout" href="<?php echo wp_logout_url(home_url()); ?>">Déconnexion</a></div>
							<?php }; ?>
							<?php
        					$user = wp_get_current_user();?>
						</div>
						<div class="nav_login">
							<?php
							if (is_user_logged_in() && (in_array( 'client', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ))) { ?>
								<a class="tabButton button-login" href="<?php echo esc_url(home_url('profile')) ?>"> <i class="fas fa-user" style="color: #fff;"></i> | Mon profil</a>
							<?php } elseif(in_array( 'recruiter', (array) $user->roles ) && is_user_logged_in() ){
										//if($current_user->roles[0] != '' && $current_user->roles[0] == 'recruiter'){ ?>
									<a <?php if($post->post_name === 'home' || $post->post_name === 'contact'){ echo 'style="background-color: #ffc045;"'; } else {echo 'style="background-color: #1dd1a1;"';} ?> class="tabButton button-login" href="<?php echo esc_url(home_url('recruiter')) ?>"> <i class="fas fa-user" style="color: #fff;"></i> | Espace recruteur</a>
								<?php// }?>
							<?php } else { ?>
								<a class="tabButton button-login" href="<?php echo esc_url(home_url('login')) ?>">Connexion/Inscription</a>
							<?php }; ?>
						</div>
					</div>
				</header><!-- #masthead -->
