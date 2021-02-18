<?php
/*
Template Name: Home
*/

get_header();
?>
<section id="intro" class="middle">
    <div class="boite">
        <div class="petite-boite">
            <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bienvenue sur Sably ", "CV-thèque en ligne ", "100% gratuit "]'></span>|</h1>
        </div>
        <div class="logo-play">
            <a href="https://youtu.be/35WJCcbp6a0"><i class="fas fa-play" style="color: #000;"></i></a>
        </div>
    </div>

</section>
<div class="wrap-sheet">
    <div id="sheet" class="sheet">
        <div class="logo-seul"><img src="<?php echo get_template_directory_uri() ?>/assets/img/pelican_seul.png"></div>
        <section id="home" class="tab tab-1">
            <h2 class="titleSection">accueil</h2>
            <div class="blocHome textHome1">
                <div class="boxHome imageHome">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/svg/sub.svg" alt="image CV">
                </div>
                <div class="boxHome descriptionHome1">
                    <p>Vous êtes recruteur ? 💼 <br> Nous mettons à votre disposition un catalogue de candidats dévoués et prêts à travailler. <br> Selectionnez les profils qui correspondent à vos attentes.🎯 <br><br><br>Vous recherchez un emploi ? 👔<br>Alors, n'attendez plus ! <br>Inscrivez-vous et créez, importez ou modifiez votre CV. 📝</h1>
                </div>
            </div>
            <div class="blocHome textHome2">
                <div class="boxHome descriptionHome2">
                    <p>La plateforme SABLY est recommandée et appréciée pas de nombreux utilisateurs. 👍 <br><br> Les candidats comme les recruteurs approuvent ce site. <br> ⭐⭐⭐⭐⭐
                    </p>
                </div>
                <div class="boxHome imageHome">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/svg/review.svg" alt="image CV">
                </div>
            </div>
            <div class="blocHome textHome3">
                <div class="boxHome imageHome">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/svg/Eiffel_tower.svg" alt="image CV">
                </div>
                <div class="boxHome descriptionHome1">
                    <p>SABLY a été pensé et créé par notre équipe de développeurs et designers français ! 🇫🇷 </p>
                </div>
            </div>
        </section>

        <section id="about" class="tab tab-2 hidden">
            <h2 class="titleSection">à propos de nous</h2>
            <div class="blocHome">
                <div class="boxHome">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/selection.svg" alt="">
                </div>
                <div class="boxHome">
                    <h2 class="souligne">SABLY, QU'EST-CE QUE C'EST ?</h2><br><br>
                    <p>SABLY est une CVthèque, une base de données en ligne contenant le Curriculum vitae des candidats à la recherche d’un emploi.<br><br>Nous permettons à ces candidats de créer ou de déposer eux-mêmes leurs CV sur la plateforme via un outil dédié et nous donnons ensuite la possibilité aux recruteurs d'effectuer des recherches dans notre base de données dans le cadre de leur sourcing.</p>
                </div>
            </div>
            <div class="blocHome">
                <div class="boxHome">
                    <h2 class="souligne">NOTRE PRIORITE : OPTIMISER LE TEMPS DE RECRUTEMENT</h2><br>
                    <p>Optimiser ce temps est notre priorité. Nous sommes conscient que le processus de recrutement peut-être chronophage.<br><br>
                        C'est pourquoi, en tant que développeurs, nous nous engageons à vous fournir un outil qui améliorera significativement la gestion des CVs au sein de votre entreprise.
                    </p>
                </div>

                <div class="boxHome">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/contrat.svg" alt="">
                </div>
            </div>
            <div class="blocHome">
                <div class="boxHome">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/recrutement.svg" alt="">
                </div>
                <div class="boxHome">
                    <h2 class="souligne">SIMPLIFICATION DU SUIVI DES CV :</h2><br>
                    <p>SABLY deviendra rapidement la solution incontournable à votre service ou dans votre entreprise pour simplifier le suivi des CV et pour établir une base de données de vos candidats.
                    </p>
                </div>
            </div>
            <div class="blocHome">
                <div class="boxHome">
                    <h2 class="souligne">CONTACTEZ-NOUS :</h2><br>
                    <p>Totalement personnalisable, SABLY permet de doter votre entreprise d’un outil de communication professionnel vers le marché de l’emploi et un pilotage complet de votre plateforme.
                    </p>
                </div>
                <div class="boxHome">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/contact.svg" alt="">
                </div>
            </div>
            <div class="pad">
                <div class="blocHome">
                    <div class="boxHome">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/place.svg" alt="">
                    </div>
                    <div class="boxHome">
                        <h2 class="souligne">TÉLÉPHONE ET MAIL :</h2><br>
                        <p>Tél: +33(0)1.35.28.31.61 <br>
                            Email: contact@sably.com <br>
                            Siège social :<br>
                            24 Place Saint-Marc, 76000 Rouen, France
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
get_footer();
