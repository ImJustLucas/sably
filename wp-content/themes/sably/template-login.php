<?php
/*
Template Name: login
*/

if(is_user_logged_in()){
    wp_redirect(site_url() . "/profile");
}

require get_template_directory() . '/inc/function_mail.php';
global $wpdb;

//CONNEXION :

if(!empty($_POST['submitted'])){

    $username = cleanXSS($_POST['username-login']);
    $password = cleanXSS($_POST['password-login']);

    $user_data = array();
    $user_data['user_login'] = $username;
    $user_data['user_password'] = $password;

    $verify_user = wp_signon($user_data, true);


    if (!is_wp_error($verify_user)) {
        $email = $verify_user->user_email;
        $wpdb_prefix = $wpdb->prefix;
        $wpdb_tablename = $wpdb_prefix.'users';
        $sql = "SELECT ID FROM $wpdb_tablename WHERE user_email = %s";
        $id_user = $wpdb->get_var( $wpdb->prepare( $sql, $email ) );
        $wpdb_tablename = $wpdb_prefix.'usermeta';
        $sql = "SELECT user_id FROM $wpdb_tablename WHERE user_id = %d AND meta_key = %s AND meta_value = %s";
        $user_valid = $wpdb->get_var($wpdb->prepare($sql, $id_user, 'valid_mail' ,'valid'));

        if(!empty($user_valid)){
            wp_redirect(site_url() . "/profile");
        }
        else {
            $_POST['error-login'] = 'Veuillez valider votre compte';
        }


    } else {
        $_POST['error-login'] = 'Identifiant ou mot de passe invalide';
   }
}

get_header();
?>

<section id="intro">
    <p>Se connecter</p>
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <section id="login">
            <h2 class="titleSection">Connexion</h2>

            <form method="post" action="" id="formLogin">

            <div class="input-area">
                <label for="username-login">Votre nom d'utilisateur :</label>
                <input type="text" name="username-login" id="username-login" placeholder="Username">
                <span class="error-username-login"><?php if(!empty($_POST['error-login']) && $_POST['error-login'] != ''){echo $_POST['error-login'];} ?></span>
            </div>

            <div class="input-area">
                <label for="password-login">Votre mot de passe :</label>
                <input type="password" name="password-login" id="password-login">
                <span class="error-username-login"></span>
            </div>

            <input class="btn-submit-login loginbutton" type="submit" name="submitted" value="Se connecter">
            </form>

            <div class="divider"></div>

            <div class="buttonForSignin">
                <p>Pas encore de compte ? Inscrivez-vous dès maintenant !</p>
                <a href="<?php echo esc_url(home_url('signin')) ?>" class="button-signin">S'inscrire</a>
            </div>
        </section>
    </div>
</div>

<?php
get_footer();
