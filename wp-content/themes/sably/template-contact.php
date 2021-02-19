<?php
/*
Template Name: Contact
*/
$errors = array();
$success = false;

if(!empty($_POST['submitted'])) {
  $lastname = cleanXss($_POST['lastname']);
  $firstname = cleanXss($_POST['firstname']);
  $mail = cleanXss($_POST['mail']);
  $subject = cleanXss($_POST['subject']);
  $message = cleanXss($_POST['message']);

  $errors = validText($errors,$lastname,'lastname',3,10);
  $errors = validText($errors,$firstname,'firstname',3,10);
  $errors = validText($errors,$subject,'subject',3,10);
  $errors = validText($errors,$message,'message',3,10);
  $errors = validMail($errors,$mail,'mail');

  if(empty($errors)){
    global $wpdb;
    $table = $wpdb->prefix.'contact';
    $data = array('lastname' => $lastname, 'firstname' => $firstname, 'email' => $mail, 'subject' => $subject, 'message' => $message);
    $format = array('%s','%s','%s','%s','%s');
    $wpdb->insert($table,$data,$format);
    $success = true;
  }
}
get_header();
?>



  <section id="intro">
      <div class="petite-boite-contact">
          <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bonjour <?php if(!empty($current_user->first_name) && $current_user->first_name != ''){ echo $current_user->first_name ;} else { echo $current_user->user_login ;}?> ! ", "Comment pouvons-nous vous aider ?", "Contactez-nous !"]'></span>|</h1>
      </div>
  </section>

  <div class="wrap-sheet">
      <div id="sheet" class="sheet">
          <section id="contact" class="tab tab-3">
              <h2 class="titleSection">Contact</h2>
              <?php if($success === true) { ?>
                <p>Bravo</p>
                <p><a href="<?php esc_url(home_url('login')); ?>">Envoyer un nouveau message</a></p>
              <?php  } else { ?>
                <div class="formContainer">
                  <form id="formContact" action="" method="POST" class="formSlideEffect">
                        <div class="row-contact">

                            <div class="input-area input-area-contact">
                                <label for="name-infoUser">nom</label>
                                <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                <input class="input" type="text" name="lastname" placeholder="Nom" value="<?php if(!empty($_POST['lastname'])) {echo $_POST['lastname']; } ?>">
                                <span class="error"><?php if(!empty($errors['lastname'])) { echo $errors['lastname'];} ?></span>
                            </div>

                            <div class="input-area input-area-contact">
                                <label for="name-infoUser">prénom</label>
                                <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                <input class="input" type="text" name="firstname" placeholder="Prénom" value="<?php if(!empty($_POST['firstname'])) {echo $_POST['firstname']; } ?>">
                                <span class="error"><?php if(!empty($errors['firstname'])) { echo $errors['firstname'];} ?></span>
                            </div>

                            <div class="input-area input-area-contact">
                                <label for="name-infoUser">mail</label>
                                <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                <input class="input" type="mail" name="mail" placeholder="Mail" value="<?php if(!empty($_POST['mail'])) {echo $_POST['mail']; } ?>">
                                <span class="error"><?php if(!empty($errors['mail'])) { echo $errors['mail'];} ?></span>
                            </div>

                            <div class="input-area input-area-contact">
                                <label for="name-infoUser">objet</label>
                                <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                <input class="input" type="text" name="subject" placeholder="Objet" value="<?php if(!empty($_POST['subject'])) {echo $_POST['subject']; } ?>">
                                <span class="error"><?php if(!empty($errors['subject'])) { echo $errors['subject'];} ?></span>
                            </div>
                        </div>
                        <div class="textArea">
                            <div class="titleTextArea">Message</div>
                            <div class="textContent">
                                <textarea id="message" class="text" name="message" placeholder=""><?php if(!empty($_POST['message'])) { echo $_POST['message'];} ?></textarea>
                                <span class="error"><?php if(!empty($errors['message'])) { echo $errors['message'];} ?></span>
                            </div>
                        </div>
                        <div class="submitButtonContact">
                            <input type="submit" name="submitted" class="btn-submit-Contact" value="Envoyer">
                        </div>
                  </form>
              </div>
              <?php } ?>
          </section>

      </div>
  </div>


<?php
get_footer();
