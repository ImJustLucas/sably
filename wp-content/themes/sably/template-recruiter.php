<?php
/*
Template Name: Home recruiter
*/

get_header();
?>

<div id="recruiterBackground">

    <section id="intro">
        <div class="petite-boite">
            <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bonjour <?php if(!empty($current_user->first_name) && $current_user->first_name != ''){ echo $current_user->first_name ;} else { echo $current_user->user_login ;}?> ! ", "Voici la liste des CVs", "Trouvez le bon candidat"]'></span>|</h1>
        </div>
        <p class="subTitleWebSite">Bienvenue sur votre espace membre</p>
    </section>

    <div class="wrap-sheet">
        <div id="sheet">
            <h2 class="titleSection">Espace recruteur</h2>

        </div>
    </div>
</div>

<?php
get_footer();
