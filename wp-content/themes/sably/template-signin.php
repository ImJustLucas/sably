<?php
/*
Template Name: signin
*/
if (is_user_logged_in()) {
    wp_redirect(site_url() . "/profile");
}

require get_template_directory() . '/inc/function_mail.php';
global $wpdb;
$errors = array();

// REGISTER PROCESS
if (!empty($_POST['submitted-reg'])) {
    $username = cleanXss($_POST['username-signin']);
    $email = cleanXss($_POST['email-signin']);
    $password = cleanXss($_POST['password-signin']);
    $password2 = cleanXss($_POST['password2-signin']);

    $errors = validText($errors, $username, 'username-signin', 3, 10);
    $errors = validMail($errors, $email, 'email-signin');
    $errors = validPass($errors, $password, 'password-signin', $password2, 3, 10);

    if (empty($errors)) {


        $wpdb_prefix = $wpdb->prefix;
        $wpdb_tablename = $wpdb_prefix . 'users';
        //$result = $wpdb->get_results(sprintf('SELECT `ID` FROM `%2$s` WHERE user_email = %s LIMIT 1', $email, $wpdb_tablename));

        $sql = "SELECT ID FROM $wpdb_tablename WHERE user_email = %s";
        $result_user = $wpdb->get_var($wpdb->prepare($sql, $email));

        if (empty($result_user)) {
            $userdata = array(
                'ID'                    => 0,    //(int) User ID. If supplied, the user will be updated.
                'user_pass'             => $password,   //(string) The plain-text user password.
                'user_login'            => $username,   //(string) The user's login username.
                'user_nicename'         => '',   //(string) The URL-friendly user name.
                'user_url'              => '',   //(string) The user URL.
                'user_email'            => $email,   //(string) The user email address.
                'display_name'          => '',   //(string) The user's display name. Default is the user's username.
                'nickname'              => '',   //(string) The user's nickname. Default is the user's username.
                'first_name'            => '',   //(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
                'last_name'             => '',   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
                'description'           => '',   //(string) The user's biographical description.
                'rich_editing'          => '',   //(string|bool) Whether to enable the rich-editor for the user. False if not empty.
                'syntax_highlighting'   => '',   //(string|bool) Whether to enable the rich code editor for the user. False if not empty.
                'comment_shortcuts'     => '',   //(string|bool) Whether to enable comment moderation keyboard shortcuts for the user. Default false.
                'admin_color'           => '',   //(string) Admin color scheme for the user. Default 'fresh'.
                'use_ssl'               => '',   //(bool) Whether the user should always access the admin over https. Default false.
                'user_registered'       => '',   //(string) Date the user registered. Format is 'Y-m-d H:i:s'.
                'show_admin_bar_front'  => '',   //(string|bool) Whether to display the Admin Bar for the user on the site's front end. Default true.
                'role'                  => 'client',   //(string) User's role.
                'locale'                => '',   //(string) User's locale. Default empty.

            );
            wp_insert_user($userdata);


            //$result = $wpdb->get_results(sprintf('SELECT `ID` FROM `%2$s` WHERE user_email = %s LIMIT 1', $email, $wpdb_tablename));

            $sql = "SELECT ID FROM $wpdb_tablename WHERE user_email = %s";
            $id = $wpdb->get_var($wpdb->prepare($sql, $email));
            $token = generateRandomString(120);
            update_user_meta($id, 'valid_mail', 'no_valid');
            update_user_meta($id, 'token', $token);
            $date = new DateTime("now");
            update_user_meta($id, 'token_at', $date);
            update_user_meta($id, 'age', 'default');
            update_user_meta($id, 'adresse', 'default');
            update_user_meta($id, 'telephone', 'default');


            $wpdb_tablename = $wpdb_prefix . 'usermeta';
            $sql = "SELECT meta_value FROM $wpdb_tablename WHERE meta_value = %s";
            $result_usermeta = $wpdb->get_var($wpdb->prepare($sql, $token));


            $link = '<a href="http://localhost' . dirname($_SERVER['PHP_SELF']) . '/validmail?id=' . $result_usermeta . '">Lien</a>';

            $date = new DateTime("now");
            $date->add(new DateInterval('PT3M'));

            $mailexpediteur = 'vacbook@laposte.net';
            $passwordmail = 'PoLhUUHG@56dqsdq9Saf';
            $mailrecepteur = 'baz.martin42@gmail.com';
            $object = 'Création de votre compte';
            $message = 'Veuillez cliquer sur ce ' . $link . ' pour valider votre compte<br>Attention, le lien expire le ' . $date->format('d-m-Y à H:i:s') . '';


            sendMailer($mailexpediteur, $passwordmail, $mailrecepteur, $object, $message);


            /*header('Location: z_mail_inscription.php?id='.$token.'');
      exit();*/
        } else {
            $errors['email-signin'] = 'Un compte attaché à cette adresse existe déjà';
        }
    }
}

get_header();
?>

<section id="intro">
    <div class="petite-boite">
        <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["rejoingnez nous !", "tout est gratuit"]'></span>|</h1>
    </div>
    <!-- <p class="subTitleWebSite">Inscription sur SABLY</p> -->
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <form id="formsignin" action="" method="post">
            <h2 class="titleSection">Inscription</h2>
            <section id="signin">
                <div class="columnUser">

                    <!-- USERNAME -->
                    <div class="input-area-signin">
                        <label for="username-signin">Nom d'utilisateur</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="username-signin" id="username-signin" value="<?php if (!empty($_POST['username-signin'])) {
                            echo $_POST['username-signin'];
                        } ?>">
                        <span class="error-username-signin"><?php if (!empty($errors['username-signin'])) {
                            echo $errors['username-signin'];
                        } ?></span>
                    </div>

                    <!-- EMAIL -->
                    <div class="input-area-signin">
                        <label for="username-signin">Email</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="email" name="email-signin" id="email-signin" value="<?php if (!empty($_POST['email-signin'])) {
                            echo $_POST['email-signin'];
                        } ?>">
                        <span class="error-email-signin"><?php if (!empty($errors['email-signin'])) {
                            echo $errors['email-signin'];
                        } ?></span>
                    </div>

                    <!-- MOT DE PASSE -->
                    <div class="input-area-signin">
                        <label for="username-signin">Mot de passe</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="password" name="password-signin" id="password-signin">
                        <span class="error-password-signin"><?php if (!empty($errors['password-signin'])) {
                            echo $errors['password-signin'];
                        } ?></span>
                    </div>

                    <!-- CONFIRAMATION DE MOT DE PASSE -->
                    <div class="input-area-signin">
                        <label for="password2-signin">Confirmer mot de passe</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="password" name="password2-signin" id="password2-signin">
                    </div>

                    <!-- SUBMIT -->
                    <div class="submitButtonsignin">
                        <input type="submit" name="submitted-reg" id="submitted-reg" value="S'inscrire">
                        <!-- <label for="username-signin">S'inscrire</label> -->
                    </div>
                </div>
            </section>
        </form>
        </section>
    </div>
</div>
<?php
get_footer();
