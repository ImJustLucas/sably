<?php
?>

  <div class="modal micromodal-slide" id="modal-delete" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-delete">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-delete">
            Êtes-vous sûr ? 
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form action="<?php echo esc_url(home_url('profile'))?>" method="post">
            <input id="deleteDataInCv1" class="hidden" name="data-delete-type" type="text" value="">
            <input id="deleteDataInCv2" class="hidden" name="data-delete-id" type="text" value="">
            <input class="boutonsupprimer" type="submit" name="delete-data-cv" value="Supprimer">
          </form>
        </main>
      </div>
    </div>
  </div>

  <div class="modal micromodal-slide" id="modal-deleteCv" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-deleteCv">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-deleteCv">
            Êtes-vous sûr ? 
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form method="post" action="<?php echo esc_url(home_url('profile'))?>" id="formDeleteCV">
            <input class="boutonsupprimer" type="submit" name="delete-cv" value="Supprimer">
          </form>
        </main>
      </div>
    </div>
  </div>

  <div class="modal micromodal-slide" id="modal-download" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-download">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-download">
            Cliquez pour télécharger 
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form method="post" action="<?php echo esc_url(home_url('profile'))?>" id="formDownload">
            <input class="boutondownload" type="submit" name="download-cv" value="Télécharger">
          </form>
        </main>
      </div>
    </div>
  </div>

  <div class="modal micromodal-slide" id="modal-download-recruiter" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-download-recruiter">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-download-recruiter">
            Cliquez pour télécharger 
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form method="post" action="<?php echo esc_url(home_url('recruiter'))?>" id="formDownload">
            <input class="boutondownload" type="submit" name="download-cv-recruiter" value="Télécharger">
          </form>
        </main>
      </div>
    </div>
  </div>

  <div class="modal micromodal-slide" id="modal-apercu" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-apercu">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-apercu">
            Cliquez pour lancer l'apperçu 
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form method="post" action="<?php echo esc_url(home_url('profile'))?>" id="formApercu">
            <input class="boutondownload" type="submit" name="apercu-cv" value="Lancer l'aperçu">
          </form>
        </main>
      </div>
    </div>
  </div>

  <div class="modal micromodal-slide" id="modal-apercu-recruiter" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-apercu-recruiter">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-apercu-recruiter">
            Cliquez pour lancer l'apperçu 
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form method="post" action="<?php echo esc_url(home_url('recruiter'))?>" id="formApercu">
            <input class="boutondownload" type="submit" name="apercu-cv-recruiter" value="Lancer l'aperçu">
          </form>
        </main>
      </div>
    </div>
  </div>

   

<footer id="colophon" class="site-footer">
	<div class="footerwrap"></div>
	<div class="contentfooter">
		<p class="copyrights">Copyright 2021 | SABLY. Tous droits réservés. <a class="rights" href="Mentions legales">Mentions légales</a></p>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
</div><!-- END WRAP-->

<?php wp_footer(); ?>

</body>

</html>