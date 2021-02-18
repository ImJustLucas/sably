<?php
/*
Template Name: recruitersingle
*/
$user = wp_get_current_user();
if(in_array( 'client', (array) $user->roles )){
  wp_redirect(site_url() . "/profile");
}

global $wpdb;
// id user
if (empty($_GET['id'])) {
  $link = esc_url(home_url('404'));
  header('Location: '.$link);
}
$get = explode("@", $_GET['id']);
if(!empty($get[0])) {
  $cvid = $get[0];
}
if(!empty($get[1])) {
  $cvuser = $get[1];
}

$cvid = $_GET['cvid'];
$cvuser = $_GET['id'];

if (!is_numeric($cvid)) {
  die('CV introuvable');
}
if (!is_numeric($cvid)) {
  die('Utilisateur introubable');
}

$wpdb_tablename = 'wp_sbl_usermeta';
$sql = "SELECT * FROM $wpdb_tablename WHERE user_id = $cvuser AND meta_key = 'first_name'";
$sql2 = "SELECT * FROM $wpdb_tablename WHERE user_id = $cvuser AND meta_key = 'last_name'";
$user_prenom = $wpdb->get_results($sql);
$user_nom = $wpdb->get_results($sql2);


// HTML
global $post; ?>


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

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
		<div class="wrap-recruiter">
			<div id="page" class="site">
				<header id="masthead" class="site-header">
					<div class="header-wrap">
						<div class="nav_logo">
								<div class="logoSably tabButton button-home">
									<a id="home"><img class="image_on" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_bleu1.png" alt="logo" /><img class="image_off" src="<?php echo get_template_directory_uri() ?>/assets/img/logo_bleu2.png" alt="logo" /></a>
								</div>
						</div>
						<div class="nav_buttons">
								<div><a class="tabButton button-home" href="<?php echo esc_url(home_url('home')) ?>">Accueil</a></div>
								<div><a class="tabButton button-contact" href="<?php echo esc_url(home_url('contact')) ?>">Contact</a></div>
								<div><a class="tabButton button-logout" href="<?php echo wp_logout_url(home_url()); ?>">Deconnexion</a></div>
						</div>
						<div class="nav_login">
								<a style="background-color: #1dd1a1;" class="tabButton button-login" href="<?php echo esc_url(home_url('recruiter')) ?>"> <i class="fas fa-user" style="color: #fff;"></i> | Espace Recrutement</a>
						</div>
					</div>
				</header><!-- #masthead -->

<div id="recruiterBackground">

  <section id="intro">
    <div class="petite-boite">
      <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bonjour <?php if (!empty($current_user->first_name) && $current_user->first_name != '') {
                                                                                                echo $current_user->first_name;
                                                                                              } else {
                                                                                                echo $current_user->user_login;
                                                                                              } ?> ! ", "Voici la liste des CVs", "Trouvez le bon candidat"]'></span>|</h1>
    </div>
    <p class="subTitleWebSite">Bienvenue sur votre espace membre</p>
  </section>

  <div class="wrap-sheet">
    <div id="sheet">
      <div class="detail">
        <h2 class="titleSection">Detail CV</h2>


        <?php if (!empty($user_prenom[0]->meta_value) && $user_nom[0]->meta_value) { ?>
          <p class="nomcv"><?= $user_prenom[0]->meta_value;  ?></p>
          <p class="nomcv"><?= $user_nom[0]->meta_value;  ?></p>
        <?php  } else { ?>
          <p><?php $wpdb_tablename = 'wp_sbl_users';
              $sql = "SELECT user_login FROM $wpdb_tablename WHERE ID = $cvuser";
              $user_login = $wpdb->get_var($sql);
              echo $user_login ?></p>
        <?php }

        $wpdb_experience = 'sbl_experience';
        $wpdb_formation = 'sbl_formation';
        $wpdb_loisir = 'sbl_loisir';
        $wpdb_reward = 'sbl_reward';
        $wpdb_skill = 'sbl_skill';


        // Experience
        $sql1 = "SELECT * FROM $wpdb_experience WHERE id_cv = $cvid";
        $user_experiences = $wpdb->get_results($sql1);
        // Formation
        $sql2 = "SELECT * FROM $wpdb_formation WHERE id_cv = $cvid";
        $user_formations = $wpdb->get_results($sql2);
        // Loisir
        $sql3 = "SELECT * FROM $wpdb_loisir WHERE id_cv = $cvid";
        $user_loisirs = $wpdb->get_results($sql3);
        // Reward
        $sql4 = "SELECT * FROM $wpdb_reward WHERE id_cv = $cvid";
        $user_rewards = $wpdb->get_results($sql4);
        // Skill
        $sql5 = "SELECT * FROM $wpdb_skill WHERE id_cv = $cvid";
        $user_skills = $wpdb->get_results($sql5);

        ?>
        <h1>Expériences:</h1>
        <br>
        <?php
        foreach ($user_experiences as $user_experience) {
        ?>
          <p><?php if (!empty($user_experience->title)) {
                echo $user_experience->title;
              }  ?></p>
          <p><?php if (!empty($user_experience->subtitle)) {
                echo $user_experience->subtitle;
              }  ?></p>
          <p><?php if (!empty($user_experience->description)) {
                echo $user_experience->description;
              }  ?></p>
        <?php }

        ?>
        <br>
        <h1>Formations:</h1>
        <br>
        <?php
        foreach ($user_formations as $user_formation) {
        ?>
          <p><?php if (!empty($user_formation->title)) {
                echo $user_formation->title;
              }  ?></p>
          <p><?php if (!empty($user_formation->subtitle)) {
                echo $user_formation->subtitle;
              }  ?></p>
          <p><?php if (!empty($user_formation->description)) {
                echo $user_formation->description;
              }  ?></p>
        <?php }

        ?>
        <br>
        <h1>Loisirs:</h1>
        <br>
        <?php
        foreach ($user_loisirs as $user_loisir) {
        ?>
          <p><?php if (!empty($user_loisir->title)) {
                echo $user_loisir->title;
              }  ?></p>
          <p><?php if (!empty($user_loisir->subtitle)) {
                echo $user_loisir->subtitle;
              }  ?></p>
        <?php }

        ?>
        <br>
        <h1>Rewards:</h1>
        <br>
        <?php
        foreach ($user_rewards as $user_reward) {
        ?>
          <p><?php if (!empty($user_reward->title)) {
                echo $user_reward->title;
              } ?></p>
          <p><?php if (!empty($user_reward->date)) {
                echo $user_reward->date;
              } ?></p>
          <p><?php if (!empty($user_reward->description)) {
                echo $user_reward->description;
              } ?></p>
        <?php }

        ?>
        <br>
        <h1>Skills:</h1>
        <br>
        <?php
        foreach ($user_skills as $user_skill) {
        ?>
          <p><?php if (!empty($user_skill->title)) {
                echo $user_skill->title;
              } ?></p>
          <p><?php if (!empty($user_skill->subtitle)) {
                echo $user_skill->subtitle;
              } ?></p>
          <p><?php if (!empty($user_skill->description)) {
                echo $user_skill->description;
              } ?></p>

        <?php }

        ?>

      </div>

    </div>


  </div>
</div>





<?php
get_footer();
