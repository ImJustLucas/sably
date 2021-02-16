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


// Mot de passe oublié :

if (!empty($_POST['submitted'])) {

    $useremail = cleanXSS($_POST['user-email']);

    $errors = validMail($errors, $useremail, 'user-email');
    if(empty($errors)) {
      echo 'bravo';
    }

}

get_header();
?>

<section id="intro">
    <?php
    if (!empty($_GET['id']) && $_GET['id'] == 'new') { ?>
        <p class="welcome">Vous venez de valider votre compte</p>
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
