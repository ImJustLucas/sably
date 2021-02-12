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

if (!empty($_POST['submitted'])) {

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
    <p>Se connecter</p>
    <?php
    if (!empty($_GET['id']) && $_GET['id'] == 'new') { ?>
        <p class="welcome">Vous venez de valider votre compte</p>
    <?php } ?>
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <form id="formInfoUser" method="post" action="">
            <section id="connexionUser">
                <div class="columnUser">
                    <h2 class="titleSection">Connexion</h2>

                    <div class="input-area-infoUser">
                        <label for="name-infoUser">Username</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="name-infoUser" id="name-infoUser" <?php if (!empty($current_user->last_name) && $current_user->last_name != '') {
                                                                                        echo 'value="' . $current_user->last_name . '"';
                                                                                    } else {
                                                                                        echo 'placeholder="Doe"';
                                                                                    } ?>>
                    </div>
                    <span class="error-infoUser error-name-infoUser"></span>

                    <div class="input-area-infoUser">
                        <label for="newPassword-infoUser">Mot de passe</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="password" name="newPassword-infoUser" id="newPassword-infoUser">
                    </div>
                    <span class="error-infoUser error-newPassword-infoUser"></span>

                    <div class="submitButtonInfoUser">
                        <input class="btn-submit-userInfo loginbutton" type="submit" name="submittedInfoUser" value="Se connecter">
                    </div>

                    <div class="buttonForSignin">
                        <p>Pas encore de compte ? Inscrivez-vous dès maintenant ! </p>
                        <a href="<?php echo esc_url(home_url('signin')) ?>" class="button-signin"> S'inscrire</a>
                    </div>
                </div>
            </section>
        </form>
    </div>
</div>

<?php
get_footer();
