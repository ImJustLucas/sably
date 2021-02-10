<?php
/*
Template Name: profile
*/

get_header();
?>

<section id="intro">
<h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bienvenue <?php if(!empty($current_user->display_name) && $current_user->display_name != ''){ echo $current_user->display_name ;} else { echo $current_user->user_login ;}?>", "Voici votre profil", "retrouvez votre cv plus bas !"]'></span>|</h1>
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <h2 class="titleSection">Mon profil</h2>
    </div>
</div>


<?php
get_footer();
