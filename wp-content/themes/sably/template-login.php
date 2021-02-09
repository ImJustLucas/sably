<?php
/*
Template Name: login
*/

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
            
                <div class="input-area">
                    <label for="username-signin">Votre nom d'utilisateur :</label>
                    <input type="text" name="username-signin" id="username-signin" placeholder="Username">
                    <span class="error-username-signin"></span>
                </div>
            
            </form>
        </section>
    </div>
</div>

<?php
get_footer();
