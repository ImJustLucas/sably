<?php
/*
Template Name: e404
*/

get_header();
?>

	<main id="primary" class="site-main">

	<div class="wrap-sheet">
	<div id="sheet">
		<section class="error-404 not-found">

			<div class="page-content-404">
					<img class="notfoundsvg" src="<?php echo get_template_directory_uri() ?>/assets/img/svg/404.svg" alt="erreur 404">
					<h1 class="introuvable">ERREUR 404 : PAGE INTROUVABLE</h1>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->
		</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
