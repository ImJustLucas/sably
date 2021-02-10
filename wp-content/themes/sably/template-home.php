<?php
/*
Template Name: Home
*/

get_header();
?>
<section id="intro" class="middle">
    <div class="boite">
        <div class="petite-boite">
            <h1>bienvenue sur Sably</h1>
            <!-- <p class="accueil">Bonjour <span class="hello-user"><?php echo ucfirst($_SESSION['user']['prenom']); ?></span>, vous pouvez accéder à vos CV en cliquant sur le bouton "Mon profil" ! En cas de question, rendez-vous sur la page "contact".</p> -->
            <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bienvenue sur Sably", "CV-thèque en ligne", "100% gratuit"]'></span>|</h1>
        </div>
        <div class="logo-play">
            <a href="https://www.youtube.com/watch?v=0hLxDYmuYw4"> <i class="fas fa-play" style="color: #000;"></i> </a>
        </div>
    </div>

</section>
<div class="wrap-sheet">
    <div id="sheet" class="sheet">
        <div class="logo-seul" ><img src="<?php echo get_template_directory_uri() ?>/assets/img/pelican_seul.png" ></div>
        <section id="home" class="tab tab-1">
            <h2>Home</h2>
        </section>
        <section id="about" class="tab tab-2 hidden">
            <h2>About us</h2>
        </section>
        <section id="contact" class="tab tab-3 hidden">
            <h2>Contact</h2>
            <div class="form">
                <form action="" method="POST">
                    <div class="inputs-container">
                        <input class="name" type="text" name="lastname" placeholder="Nom" value="">
                        <input type="text" name="firstname" placeholder="Prénom" value="">
                    </div>
                    <div class="inputs-container">
                        <input type="mail" name="mail" placeholder="Mail" value="">
                        <input type="text" name="subject" placeholder="Objet" value="">
                    </div>
                    <textarea name="message" placeholder="Message"></textarea>
                    <input type="submit" name="submit" class="btn btn-purple" value="Envoyer">
                </form>
            </div>
        </section>
        <section id="login" class="tab tab-4 hidden">
            <h2>Login</h2>
            <div class="buttonForSignin">
                <p>Pas encore de compte ? Inscrivez-vous dès maintenant !</p>
                <button class="tabButton button-signin">S'inscrire</button>
            </div>
        </section>
        <section id="signin" class="tab tab-5 hidden">
            <h2>Signin</h2>
        </section>

    </div>
</div>

<?php
get_footer();
