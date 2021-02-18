<?php
/*
Template Name: login
*/

if (is_user_logged_in()) {
    wp_redirect(site_url() . "/profile");
}

require get_template_directory() . '/inc/function_mail.php';
global $wpdb;


//CONNEXION :

if (!empty($_POST['submittedlogin'])) {

    $username = cleanXSS($_POST['username-login']);
    $password = cleanXSS($_POST['password-login']);

    $user_data = array();
    $user_data['user_login'] = $username;
    $user_data['user_password'] = $password;

    $verify_user = wp_signon($user_data, true);


    if (!is_wp_error($verify_user)) {
        $email = $verify_user->user_email;
        $wpdb_prefix = $wpdb->prefix;
        $wpdb_tablename = $wpdb_prefix . 'users';
        $sql = "SELECT ID FROM $wpdb_tablename WHERE user_email = %s";
        $id_user = $wpdb->get_var($wpdb->prepare($sql, $email));
        $wpdb_tablename = $wpdb_prefix . 'usermeta';
        $sql = "SELECT user_id FROM $wpdb_tablename WHERE user_id = %d AND meta_key = %s AND meta_value = %s";
        $user_valid = $wpdb->get_var($wpdb->prepare($sql, $id_user, 'valid_mail', 'valid'));
        wp_redirect(site_url() . "/profile");

        if (!empty($user_valid)) {
            wp_redirect(site_url() . "/profile");
        } else {
            $_POST['error-login'] = 'Veuillez valider votre compte';
        }
    } else {
        $_POST['error-login'] = 'Identifiant ou mot de passe invalide';
    }
}

get_header();
?>

<section id="intro">

    <div class="petite-boite">
        <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["Connectez vous dès maintenant ", "Simple et rapide ! ", "SABLY, meilleur outil du monde pro "]'></span>|</h1>
    </div>

    <p class="subTitleWebSite">Bienvenue sur votre espace membre</p>

    <?php
    if (!empty($_GET['id']) && $_GET['id'] == 'new') { ?>
        <p class="welcome">Vous venez de valider votre compte</p>
    <?php } ?>
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <form id="formlogin" method="post" action="">
            <section id="login">
                <h2 class="titleSection">Connexion</h2>

                <div class="input-area-login">
                    <label for="username-login">Username</label>
                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                    <input type="text" name="username-login" id="username-login">
                </div>
                <span class="error-login error-username-login"></span>

                <div class="input-area-login">
                    <label for="password-login">Mot de passe</label>
                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                    <input type="password" name="password-login" id="password-login">
                </div>
                <span class="error-login error-password-login"></span>

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
