<?php
/*
Template Name: login
*/

// REGISTER PROCESS
$errors = array();
if (!empty($_POST['submitted-reg'])) {
  $username = cleanXss($_POST['username-signin']);
  $email = cleanXss($_POST['email-signin']);
  $password = cleanXss($_POST['password-signin']);
  $password2 = cleanXss($_POST['password2-signin']);

  $errors = validText($errors,$username,'username-signin', 3,10);
  $errors = validMail($errors,$email,'email-signin');
  $errors = validPass($errors,$password,'password-signin',$password2,3,10);
  debug($errors);

  if (empty($errors)) {

    echo 'bravo';

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

            <form action="" id="fromLogin">

            <div class="input-area">
                <label for="username-login">Votre nom d'utilisateur :</label>
                <input type="text" name="username-login" id="username-login" placeholder="Username">
                <span class="error-username-login"></span>
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
                <button class="loginbutton">S'inscrire</button>
            </div>
        </section>

        <section id="signin">
            <h2>S'inscrire</h2>

            <form id="fromSignin" action="" method="post">

                <!-- USERNAME -->
                <div class="input-area">
                    <label for="username-signin">Nom d'utilisateur</label>
                    <input type="text" name="username-signin" id="username-signin" placeholder="Nom d'utilisateur">
                    <span class="error-username-signin"></span>
                </div>
                <!-- EMAIL -->
                <div class="input-area">
                    <label for="username-signin">Email</label>
                    <input type="text" name="email-signin" id="email-signin" placeholder="Email">
                    <span class="error-email-signin"></span>
                </div>
                <!-- MOT DE PASSE -->
                <div class="input-area">
                    <label for="username-signin">Mot de passe</label>
                    <input type="text" name="password-signin" id="password-signin" placeholder="Password">
                    <span class="error-password-signin"></span>
                </div>
                <!-- MOT DE PASSE -->
                <div class="input-area">
                    <label for="username-signin">Confirmer mot de passe</label>
                    <input type="text" name="password2-signin" id="password2-signin" placeholder="Confirmer password">
                    <span class="error-password-signin"></span>
                </div>
                <!-- SUBMIT -->
                <div class="input-area">
                    <input type="submit" name="submitted-reg" id="submitted-reg" placeholder="S'inscrire">
                </div>

            </form>
        </section>
    </div>
</div>

<?php
get_footer();
