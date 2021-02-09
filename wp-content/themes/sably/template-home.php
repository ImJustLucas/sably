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
        <div class="logo-seul" ><img src="<?php echo get_template_directory_uri() ?>/assets/img/pelican_seul.png" ></div>
        <section id="home"></section>
        <section id="about"></section>
        <section id="contact"></section>

    </div>
</div>

<?php
get_footer();
