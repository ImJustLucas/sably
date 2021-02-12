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
    echo 'go to sql';
    global $wpdb;
    $table = $wpdb->prefix.'contact';
    $data = array('lastname' => $lastname, 'firstname' => $firstname, 'email' => $mail, 'subject' => $subject, 'message' => $message);
    $format = array('%s','%s','%s','%s','%s');
    $wpdb->insert($table,$data,$format);
  }
}
get_header();
?>



  <section id="intro">
      <div class="petite-boite">
          <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bonjour <?php if(!empty($current_user->first_name) && $current_user->first_name != ''){ echo $current_user->first_name ;} else { echo $current_user->user_login ;}?> ! ", "Voici la liste des CVs", "Trouvez le bon candidat"]'></span>|</h1>
      </div>
      <p class="subTitleWebSite">Bienvenue sur votre espace membre</p>
  </section>

  <div class="wrap-sheet">
      <div id="sheet" class="sheet">
          <section id="contact" class="tab tab-3">
              <h2 class="titleSection">Contact</h2>
              <div class="form">
                  <form id="formContact" action="" method="POST">
                      <div class="inputs-container">
                          <input class="input" type="text" name="lastname" placeholder="Nom" value="<?php if(!empty($_POST['lastname'])) {echo $_POST['lastname']; } ?>">
                          <span class="error"><?php if(!empty($errors['lastname'])) { echo $errors['lastname'];} ?></span>
                          <input class="input" type="text" name="firstname" placeholder="Prénom" value="<?php if(!empty($_POST['firstname'])) {echo $_POST['firstname']; } ?>">
                          <span class="error"><?php if(!empty($errors['firstname'])) { echo $errors['firstname'];} ?></span>
                      </div>
                      <div class="inputs-container">
                          <input class="input" type="mail" name="mail" placeholder="Mail" value="<?php if(!empty($_POST['mail'])) {echo $_POST['mail']; } ?>">
                          <span class="error"><?php if(!empty($errors['mail'])) { echo $errors['mail'];} ?></span>
                          <input class="input" type="text" name="subject" placeholder="Objet" value="<?php if(!empty($_POST['subject'])) {echo $_POST['subject']; } ?>">
                          <span class="error"><?php if(!empty($errors['subject'])) { echo $errors['subject'];} ?></span>
                      </div>
                      <textarea class="text" name="message" placeholder="Message"><?php if(!empty($_POST['message'])) { echo $_POST['message'];} ?></textarea>
                      <span class="error"><?php if(!empty($errors['message'])) { echo $errors['message'];} ?></span>
                      <input type="submit" name="submitted" class="btn btn-purple" value="Envoyer">
                  </form>
              </div>

          </section>

      </div>
  </div>


<?php
get_footer();
