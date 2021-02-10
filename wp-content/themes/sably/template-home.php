<?php
/*
Template Name: Home
*/

get_header();
?>
<section id="intro" class="middle">
    <div class="boite">
        <div class="petite-boite">
            <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bienvenue sur Sably", "CV-thèque en ligne", "100% gratuit"]'></span>|</h1>
        </div>
        <div class="logo-play">
            <a href="https://www.youtube.com/watch?v=oUhWsKMcoKY"> <i class="fas fa-play" style="color: #000;"></i> </a>
        </div>
    </div>

</section>
<div class="wrap-sheet">
    <div id="sheet" class="sheet">
        <div class="logo-seul" ><img src="<?php echo get_template_directory_uri() ?>/assets/img/pelican_seul.png" ></div>
        <section id="home" class="tab tab-1">
            <h2 class="titleSection">sably</h2>
            <div class="blocHome textHome1">     
                <div class="boxHome imageHome">
                    <img src="<?php echo get_template_directory_uri() ?> /assets/img/svg/sub.svg" alt="image CV">
                </div>
                <div class="boxHome descriptionHome1">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ad inventore expedita? Officiis fuga architecto accusamus dolorem id reiciendis velit perspiciatis mollitia, dolor fugiat cum odio, totam ipsa dolore tenetur!</p>
                </div>
            </div>
            <div class="blocHome textHome2">
                <div class="boxHome descriptionHome2">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ad inventore expedita? Officiis fuga architecto accusamus dolorem id reiciendis velit perspiciatis mollitia, dolor fugiat cum odio, totam ipsa dolore tenetur!</p>
                </div>
                <div class="boxHome imageHome">
                    <img src="<?php echo get_template_directory_uri() ?> /assets/img/svg/review.svg" alt="image CV">
                </div>
            </div>
            <div class="blocHome textHome3">
            <div class="boxHome imageHome">
                    <img src="<?php echo get_template_directory_uri() ?> /assets/img/svg/Eiffel_tower.svg" alt="image CV">
                </div>
                <div class="boxHome descriptionHome1">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus ad inventore expedita? Officiis fuga architecto accusamus dolorem id reiciendis velit perspiciatis mollitia, dolor fugiat cum odio, totam ipsa dolore tenetur!</p>
                </div>
            </div>
        </section>
        <section id="about" class="tab tab-2 hidden">
            <h2 class="titleSection">About us</h2>
        </section>
        <section id="contact" class="tab tab-3 hidden">
            <h2 class="titleSection">Contact</h2>
        </section>
        <section id="login" class="tab tab-4 hidden">
            <h2 class="titleSection">Login</h2>
            <div class="buttonForSignin">
                <p>Pas encore de compte ? Inscrivez-vous dès maintenant !</p>
                <button class="tabButton button-signin">S'inscrire</button>
            </div>
        </section>
        <section id="signin" class="tab tab-5 hidden">
            <h2 class="titleSection">Signin</h2>
        </section>

    </div>
</div>

<?php
get_footer();
