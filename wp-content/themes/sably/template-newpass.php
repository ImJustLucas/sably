<?php
/*
Template Name: newpass
*/

if (is_user_logged_in()) {
    wp_redirect(site_url() . "/profile");
}
if(!empty($_GET['id'])) {
  $token = $_GET['id'];
}
else {
  die('404');
}

global $wpdb;
$errors = array();
$wpdb_tablename = 'wp_sbl_usermeta';
$sql = "SELECT user_id FROM $wpdb_tablename WHERE meta_value = %s";
$user = $wpdb->get_var($wpdb->prepare($sql, $token));



// Mot de passe oublié :

if (!empty($_POST['submitted'])) {

    $password = cleanXSS($_POST['password']);
    $password1 = cleanXSS($_POST['password1']);

    $errors = validPass($errors,$password,'password',$password1,3,10);
    if(empty($errors)) {
      // on enlève token
      $wpdb->update(
        'wp_sbl_usermeta',
        array(
            'meta_value' => ''
        ),
        array('meta_key' => 'token', 'meta_value' => $token),
        array(
            '%s'
        ),
        array('%s', '%s')
      );

      // on change mot de passe
      $password = password_hash($password, PASSWORD_DEFAULT);
      $wpdb->update(
        'wp_sbl_users',
        array(
            'user_pass' => $password
        ),
        array('ID' => $user),
        array(
            '%s'
        ),
        array('%d')
      );

      $link = esc_url(home_url('login'));
      header('Location: '.$link.'?id=reset');
    }

}

get_header();
?>

<section id="intro">
        <p class="welcome">Nouveau mot de passe</p>
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <form id="formlogin" method="post" action="">
            <section id="login">
                <h2 class="titleSection">Nouveau mot de passe</h2>

                <div class="input-area-login">
                    <label for="user-password">Password</label>
                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                    <input type="password" name="password" id="user-password" value="">
                </div>
                <div class="input-area-login">
                    <label for="user-password1">Password confirmation</label>
                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                    <input type="password" name="password1" id="user-password1" value="">
                </div>
                <!-- ERROR -->
                <span class="error-login error-username-login"><?php if(!empty($errors['password'])) { echo $errors['password'];} ?></span>

                <!-- SUBMIT -->
                <div class="submitButtonlogin">
                    <input class="btn-submit-userInfo loginbutton" type="submit" name="submitted" value="Envoyer">
                </div>

            </section>
        </form>
    </div>
</div>

<?php
get_footer();
