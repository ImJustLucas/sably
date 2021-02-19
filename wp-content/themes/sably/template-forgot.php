<?php
/*
Template Name: forgot
*/

if (is_user_logged_in()) {
    wp_redirect(site_url() . "/profile");
}

require get_template_directory() . '/inc/function_mail.php';
global $wpdb;
$errors = array();
$success = false;


// Mot de passe oublié :

if (!empty($_POST['submitted'])) {

    $useremail = cleanXSS($_POST['user-email']);

    $errors = validMail($errors, $useremail, 'user-email');
    if(empty($errors)) {
      global $wpdb;
      $wpdb_tablename = 'wp_sbl_users';
      $sql = "SELECT ID FROM $wpdb_tablename WHERE user_email = %s";
      $user = $wpdb->get_var($wpdb->prepare($sql, $useremail));

      if(!empty($user)) {
        $success = true;
        $token = generateRandomString(120);
        update_user_meta($user, 'token', $token);
        $date = new DateTime("now");
        update_user_meta($user, 'token_at', $date);



        /*$wpdb_tablename = $wpdb_prefix . 'usermeta';
        $sql = "SELECT meta_value FROM $wpdb_tablename WHERE meta_value = %s";
        $result_usermeta = $wpdb->get_var($wpdb->prepare($sql, $token));*/


        $link = '<a href="http://localhost' . dirname($_SERVER['PHP_SELF']) . '/newpass?id=' . $token . '">Lien</a>';

        $date = new DateTime("now");
        $date->add(new DateInterval('PT3M'));

        $mailexpediteur = '';
        $passwordmail = '';
        $mailrecepteur = '';
        $object = 'Mot de passe oublié';
        $message = 'Veuillez cliquer sur ce ' . $link . ' pour demander un nouveau mot de passe<br>Attention, le lien expire le ' . $date->format('d-m-Y à H:i:s') . '';


        sendMailer($mailexpediteur, $passwordmail, $mailrecepteur, $object, $message);

      }
      else {
        $errors['user-email'] = 'Email non trouvé...';
      }
    }

}

get_header();
?>

<section id="intro">
    <?php


    if($success == true) { ?>
      <p class="success">Un email vient de vous être envoyé.<br>Vous ne l'avez pas reçu ? Veuillez soumettre de nouveau le formulaire.</p>
    <?php } ?>


</section>

<div class="wrap-sheet">
    <div id="sheet">
        <form id="formlogin" method="post" action="">
            <section id="login">
                <h2 class="titleSection">Mot de passe oublié</h2>

                <div class="input-area-login">
                    <label for="user-emauk">Email</label>
                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                    <input type="email" name="user-email" id="user-email" value="<?php if(!empty($_POST['user-email'])) { echo $_POST['user-email'];} ?>">
                </div>
                <span class="error-login error-username-login"><?php if(!empty($errors['user-email'])) { echo $errors['user-email'];} ?></span>


                <div class="submitButtonlogin">
                    <input class="btn-submit-userInfo loginbutton" type="submit" name="submitted" value="Envoyer">
                </div>

            </section>
        </form>
    </div>
</div>

<?php
get_footer();
