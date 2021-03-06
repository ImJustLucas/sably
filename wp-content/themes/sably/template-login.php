<?php
/*
Template Name: login
*/

if (is_user_logged_in()) {
    wp_redirect(site_url() . "/profile");
}

require get_template_directory() . '/inc/function_mail.php';
global $wpdb;
global $current_user;


//CONNEXION :
$errors = array();

if(!empty($_POST['submittedlogin']))
{
    $username = cleanXSS($_POST['username-login']);
    $password = cleanXSS($_POST['password-login']);

    $user_data = array();
    $user_data['user_login'] = $username;
    $user_data['user_password'] = $password;

    $verify_user = wp_signon($user_data, true);
    if (!is_wp_error($verify_user)) {
        $user_meta=get_userdata($verify_user->ID);
        $user_roles=$user_meta->roles;
        //die(debug($user_roles));
        if ($user_roles[0] === 'recruiter' ) {
            wp_redirect(site_url() . "/recruiter");
        } elseif($user_roles[0] === 'client' || $user_roles[0] === 'administrator'){
            wp_redirect(site_url() . "/profile");
        }

    } else {
        $errors['error-login'] = 'Identifiant ou mot de passe invalide';

    }


}






get_header();
?>

<section id="intro">

    <div class="petite-boite">
        <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["Connectez-vous dès maintenant ! ", "SABLY, la CVthèque numéro un ! ", "Simple et rapide ! "]'></span>|</h1>
    </div>


    <?php
    if (!empty($_GET['id'])) {
      if ($_GET['id'] == 'new') { ?>
        <p class="welcome">Vous venez de valider votre compte</p>
      <?php }
      if($_GET['id'] == 'reset') { ?>
        <p class="welcome">Mot de passe modifié avec succès</p>
      <?php } ?>

    <?php } ?>
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <form id="formlogin" method="post" action="">
            <section id="login">
                <h2 class="titleSection">Connexion</h2>

                <div class="input-area-login">
                    <label for="username-login">Pseudo ou Email</label>
                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                    <input type="text" name="username-login" id="username-login">
                </div>

                <span class="error-login error error-password-login"><?php if(!empty($errors['error-login'])) { echo $errors['error-login']; } ?></span>

                <div class="input-area-login">
                    <label for="password-login">Mot de passe</label>
                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                    <input type="password" name="password-login" id="password-login">
                </div>

                <div class="submitButtonlogin">
                    <input class="btn-submit-userInfo loginbutton" type="submit" name="submittedlogin" value="Se connecter">
                </div>

                <div class="buttonForSignin">
                    <a href="<?php echo esc_url(home_url('forgot')) ?>" class="button-forgot">Mot de passe oublié ?</a>
                    <p>Vous n'avez pas encore de compte ? <a href="<?php echo esc_url(home_url('signin')) ?>" class="button-signin"> Inscrivez-vous dès maintenant ! </a></p>
                </div>
            </section>
        </form>
    </div>
</div>

<?php
get_footer();
