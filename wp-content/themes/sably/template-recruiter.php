<?php
/*
Template Name: Home recruiter
*/
if(in_array( 'client', (array) $user->roles )){
  wp_redirect(site_url() . "/403");
}

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
								<a style="background-color: #1dd1a1;" class="tabButton button-login" href="<?php echo esc_url(home_url('Recrutement')) ?>"> <i class="fas fa-user" style="color: #fff;"></i> | Espace Recrutement</a>
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
      <h2 class="titleSection">Espace recruteur</h2>
      <?php
      global $wpdb;
      $wpdb_tablename = 'sbl_cv';
      $sql = "SELECT * FROM $wpdb_tablename";
      $cvs = $wpdb->get_results($sql);

      ?>
      <table class="table">
        <thead>
          <tr>
            <th class="cellule">Id</th>
            <th class="cellule">Prénom</th>
            <th class="cellule">Nom</th>
            <th class="cellule">Date</th>
            <th class="cellule">Voir détail</th>
          </tr>
        </thead>
        <?php
        foreach ($cvs as $cv) { ?>
          <tbody>
            <tr>
              <?php
              $id = $cv->id_user;
              $wpdb_tablename2 = 'wp_sbl_usermeta';
              $sql = "SELECT * FROM $wpdb_tablename2 WHERE user_id = $id AND meta_key = 'first_name'";
              $sql2 = "SELECT * FROM $wpdb_tablename2 WHERE user_id = $id AND meta_key = 'last_name'";
              $user_prenom = $wpdb->get_results($sql);
              $user_nom = $wpdb->get_results($sql2);
              ?>
              <td class="cellule"><?php $cvid = $cv->id;
                  echo $cvid; ?></td>
              <?php if (!empty($user_prenom[0]->meta_value) && $user_nom[0]->meta_value) { ?>
                <td class="cellule"><?= $user_prenom[0]->meta_value;  ?></td>
                <td class="cellule"><?= $user_nom[0]->meta_value;  ?></td>
              <?php  } else { ?>
                <td class="cellule"><?php $wpdb_tablename = 'wp_sbl_users';
                    $sql = "SELECT user_login FROM $wpdb_tablename WHERE ID = $id";
                    $user_login = $wpdb->get_var($sql);
                    echo $user_login ?></td>
              <?php } ?>
              <td class="cellule"><?= formatageDate($cv->created_at);  ?></td>
              <td class="cellule"><a href="<?php echo esc_url(home_url('recruitersingle')) . '?cvid=' . $cvid . '&id=' . $id . ''; ?>">Détail</a></td>

            </tr>
          </tbody>
        <?php }
        ?>
      </table>
    </div>


  </div>
</div>

<?php
get_footer();
