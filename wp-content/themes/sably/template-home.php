<?php
/*
Template Name: Home
*/

get_header();
?>
<section id="intro" class="middle">
    <div class="boite">
        <div class="petite-boite">
            <h1>bienvenue sur notre site</h1>
        </div>
        <div class="logo-play">
            <a href="https://www.youtube.com/watch?v=T42fbYP3mzg"> <i class="fas fa-play" style="color: #000;"></i> </a>
        </div>
    </div>

</section>
<div class="wrap-sheet">
    <div id="sheet" class="sheet">
        <section id="home" class="tab tab-1">
            <h2>Home</h2>
        </section>
        <section id="about" class="tab tab-2 hidden">
            <h2>About us</h2>
        </section>
        <section id="contact" class="tab tab-3 hidden">
            <h2>Contact</h2>
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
