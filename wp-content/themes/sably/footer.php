<?php
?>

  <div class="modal micromodal-slide" id="modal-delete" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-delete">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-delete">
            Vous etes sur ? 
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form action="<?php echo esc_url(home_url('profile'))?>" method="post">
            <input id="deleteDataInCv1" class="hidden" name="data-delete-type" type="text" value="">
            <input id="deleteDataInCv2" class="hidden" name="data-delete-id" type="text" value="">
            <input type="submit" name="delete-data-cv" value="Supprimer">
          </form>
        </main>
      </div>
    </div>
  </div>

  <div class="modal micromodal-slide" id="modal-edit" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-edit">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-edit">
            Vous etes sur ? 
          </h2>
          <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <form action="<?php echo esc_url(home_url('profile'))?>" method="post">

          <div class="row">
            <!-- TITLE SECTION-->
            <div class="input-area input-area-edit">
                <label for="title-edit">Titre</label>
                <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                <input type="text" name="title-edit" id="title-edit" placeholder="Modifier le titre">
            </div>

            <div class="dividerUser"></div>

            <!-- SUBTITLE SECTION-->
            <div class="input-area input-area-edit">
                <label for="subtitle-edit">Sous-titre</label>
                <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                <input type="text" name="subtitle-edit" id="subtitle-edit" placeholder="Modfier le sous-titre">
            </div>

          </div>

          <div class="textArea">
            <div class="titleTextArea">Description</div>
            <div class="textContent">
              <textarea name="desc-addFormation" id="descFormation"></textarea>
            </div>
        </div>
            <input id="editDataInCv1" class="hidden" name="data-edit-type" type="text" value="">
            <input id="editDataInCv2" class="hidden" name="data-edit-id" type="text" value="">
            <input id="editDataInCv2" class="hidden" name="data-edit-id" type="text" value="">
            <input type="submit" name="edit-data-cv" value="Modifier">
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