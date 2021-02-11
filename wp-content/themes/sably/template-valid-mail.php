<?php
/*
Template Name: validmail
*/


if (!empty($_GET['id'])){
  $token = $_GET['id'];
  $token = cleanXss($token);
  global $wpdb;
  $wpdb_prefix = $wpdb->prefix;
  $wpdb_tablename = $wpdb_prefix.'usermeta';
  $sql = "SELECT user_id FROM $wpdb_tablename WHERE meta_value = %s";
  $id = $wpdb->get_var( $wpdb->prepare( $sql, $token ));
  $sql = "SELECT * FROM $wpdb_tablename WHERE user_id = %d";
  $results_usermeta = $wpdb->get_results($wpdb->prepare( $sql, $id));




  if(!empty($id) && !empty($results_usermeta)) {

              $wpdb->update(
                'wp_sbl_usermeta',
                array(
                    'meta_value' => 'bonjour'
                ),
                array( 'user_id' => $id, 'meta_key' => 'token' ),
                array(
                    '%s'
                ),
                array( '%d', '%s' )
              );
              $wpdb->update(
                'wp_sbl_usermeta',
                array(
                    'meta_value' => 'valid'
                ),
                array( 'user_id' => $id, 'meta_key' => 'valid_mail' ),
                array(
                    '%s'
                ),
                array( '%d', '%s' )
              );


      $link = esc_url(home_url('login'));
      echo $link;
      header('Location: '.$link.'?id=new');
      exit();
    }
    else {
      die('rate');
    }
    /*else {
      get_header(); ?>
        <p>Le lien de validation a expiré...</p>
        <p>Pour obtenir un nouveau lien, veuillez renseigner votre adresse mail et mot de passe<a href="valid_register.php?id=<?= $user['token'] ?>">ICI</a></p>
        <p>Mot de passe oublié ? <a href="forgot_form_auth.php">Demander un nouveau mot de passe</a></p>
      <?php
      get_footer();
    }*/
  }
  else {
    die('404');
  }



?>
