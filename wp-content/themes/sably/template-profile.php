<?php
/*
Template Name: profile
*/
global $current_user;
wp_get_current_user();
$user = wp_get_current_user();

if (!is_user_logged_in()) {
    wp_redirect(site_url() . "/login");
}

if(in_array( 'recruiter', (array) $user->roles )){
    wp_redirect(site_url() . "/403");
  }
$errors = array();

//---------------------------
//Change personal data
//---------------------------

if (!empty($_POST['submittedInfoUser'])) {

    $where = ['ID' => get_current_user_id()];
    $whereMeta = ['user_id' => get_current_user_id()];

    $preDataUser = array();
    $preDataUserEmail = array();

    if (!empty($_POST['name-infoUser'])) {
        $preDataUser['meta_value'] = cleanXSS($_POST['name-infoUser']);
        if ($preDataUser['meta_value'] !== $current_user->last_name) {
            $errors = validText($errors, $preDataUser['meta_value'], 'name-infoUser', 2, 30);
            if (count($errors) == 0) {
                $whereMeta['meta_key'] = 'last_name';
                $wpdb->update($wpdb->prefix . 'usermeta', $preDataUser, $whereMeta);
            }
        }
    }

    if (!empty($_POST['firstname-infoUser'])) {
        $preDataUser['meta_value'] = cleanXSS($_POST['firstname-infoUser']);
        if ($preDataUser['meta_value'] !== $current_user->first_name) {
            $errors = validText($errors, $preDataUser['meta_value'], 'firstname-infoUser', 2, 30);
            if (count($errors) == 0) {
                $whereMeta['meta_key'] = 'first_name';
                $wpdb->update($wpdb->prefix . 'usermeta', $preDataUser, $whereMeta);
            }
        }
    }

    if (!empty($_POST['email-infoUser'])) {
        $preDataUserEmail['user_email'] = cleanXSS($_POST['email-infoUser']);
        if ($preDataUserEmail['user_email'] !== $current_user->user_email) {
            $errors = validMail($errors, $preDataUserEmail['user_email'], 'email-infoUser');
            if (count($errors) == 0) {
                $wpdb->update($wpdb->prefix . 'user', $preDataUserEmail, $where);
            }
        }
    }


    if (!empty($_POST['age-infoUser'])) {
        $preDataUser['meta_value'] = cleanXSS($_POST['age-infoUser']);
        if ($preDataUser['meta_value'] != $current_user->age) {
            if (!is_int(intval($preDataUser['meta_value']))) {
                $errors['age-infoUser'] = 'Veuillez saisir un chiffre';
            } else {
                if (count($errors) == 0) {
                    $whereMeta['meta_key'] = 'age';
                    $wpdb->update($wpdb->prefix . 'usermeta', $preDataUser, $whereMeta);
                }
            }
        }
    }

    if (!empty($_POST['adresse-infoUser'])) {
        $preDataUser['meta_value'] = cleanXSS($_POST['adresse-infoUser']);
        if ($preDataUser['meta_value'] !== $current_user->adresse) {
            $errors = validText($errors, $preDataUser['meta_value'], 'adresse-infoUser', 2, 30);
            if (count($errors) == 0) {
                $whereMeta['meta_key'] = 'adresse';
                $wpdb->update($wpdb->prefix . 'usermeta', $preDataUser, $whereMeta);
            }
        }
    }

    if (!empty($_POST['telephone-infoUser'])) {
        $preDataUser['meta_value'] = cleanXSS($_POST['telephone-infoUser']);
        if ($preDataUser['meta_value'] != $current_user->telephone) {
            if (!is_int(intval($preDataUser['telephone']))) {
                $errors['telephone-infoUser'] = 'Veuillez saisir un chiffre';
            } else {
                if (count($errors) == 0) {
                    $whereMeta['meta_key'] = 'telephone';
                    $wpdb->update($wpdb->prefix . 'usermeta', $preDataUser, $whereMeta);
                }
            }
        }
    }

    if (!empty($_POST['newPassword-infoUser'])) {
        $newPassword = cleanXSS($_POST['newPassword-infoUser']);
        if (!empty($_POST['newPasswordConfirm-infoUser'])) {
            $newPasswordConfirm = cleanXSS($_POST['newPasswordConfirm-infoUser']);
            $errors = validPass($errors, $newPassword, 'newPassword', $newPasswordConfirm, 4, 30);
            $preDataUser['user_pass'] = wp_hash_password($newPassword);
            if (count($errors) == 0) {
                $wpdb->update($wpdb->prefix . 'users', $preDataUser, $where);
            }
        }
    }

    if (count($errors) === 0) {
        wp_redirect(site_url() . "/profile");
    }
}

//---------------
//Create CV
//---------------
if (!empty($_POST['submit_create_CV'])) {
    $data = ['id_user' => get_current_user_id()];
    $wpdb->insert('sbl_cv', $data);

    //ENVOIE MAIL
}

//----------------------
//USER HAS CV  ?
//----------------------
$userHasCV = false;
$idUser = get_current_user_id();
$sql = "SELECT * FROM sbl_cv WHERE id_user = $idUser AND status = 1; ";
$userCV = $wpdb->get_results($sql);
if (!empty($userCV[0])) {
    $userCV = $userCV[0];
    $userHasCV = true;
}

//------------------------
//delete CV
//------------------------

if(!empty($_POST['delete-cv'])){
    $data = ['status' => '0'];
    $where = ['id' => $userCV->id];
    $wpdb->update('sbl_cv', $data, $where);
    wp_redirect(site_url() . "/profile");
}

//-----------------------
//GET CV INFO
//-----------------------

if ($userHasCV) {

    //Get experience
    $sql = "SELECT * FROM sbl_experience WHERE id_cv = $userCV->id AND status = 1; ";
    $userCvExperiences = $wpdb->get_results($sql);

    //Get formation
    $sql = "SELECT * FROM sbl_formation WHERE id_cv = $userCV->id AND status = 1;";
    $userCvFormations = $wpdb->get_results($sql);

    //Get skill
    $sql = "SELECT * FROM sbl_skill WHERE id_cv = $userCV->id AND status = 1;";
    $userCvSkills = $wpdb->get_results($sql);

    //Get loisir
    $sql = "SELECT * FROM sbl_loisir WHERE id_cv = $userCV->id AND status = 1;";
    $userCvLoisirs = $wpdb->get_results($sql);

    //Get reward
    $sql = "SELECT * FROM sbl_reward WHERE id_cv = $userCV->id AND status = 1;";
    $userCvRewards = $wpdb->get_results($sql);
}

//---------------------------
//INSERT DATA INTO CV
//---------------------------

//ADD EXPERIENCE

if (!empty($_POST['submitted-AddExperience'])) {
    //initialize array
    $addExperience = array();
    $addExperience['id_cv'] = $userCV->id;
    //Clean XSS
    $addExperience['title'] = cleanXSS($_POST['title-AddExperience']);
    $addExperience['subtitle'] = cleanXSS($_POST['subtitle-AddExperience']);
    $addExperience['description'] = cleanXSS($_POST['desc-AddExperience']);

    //Check if text is long enough

    $errors = validText($errors, $addExperience['title'], 'title-AddExperience', 2, 100);
    $errors = validText($errors, $addExperience['subtitle'], 'subtitle-AddExperience', 2, 100);
    $errors = validText($errors, $addExperience['description'], 'desc-AddExperience', 2, 10000);

    if (count($errors) == 0) {
        $format = array('%s', '%s', '%s');
        $wpdb->insert('sbl_experience', $addExperience, $format);
        wp_redirect(site_url() . "/profile");
    }
}

//ADD FORMATION

if (!empty($_POST['submitted-addFormation'])) {
    //initialize array
    $addFormation = array();
    $addFormation['id_cv'] = $userCV->id;
    //Clean XSS
    $addFormation['title'] = cleanXSS($_POST['title-addFormation']);
    $addFormation['subtitle'] = cleanXSS($_POST['subtitle-addFormation']);
    $addFormation['description'] = cleanXSS($_POST['desc-addFormation']);

    //Check if text is long enough

    $errors = validText($errors, $addFormation['title'], 'title-addFormation', 2, 100);
    $errors = validText($errors, $addFormation['subtitle'], 'subtitle-addFormation', 2, 100);
    $errors = validText($errors, $addFormation['description'], 'desc-addFormation', 2, 10000);

    if (count($errors) == 0) {
        $format = array('%s', '%s', '%s');
        $wpdb->insert('sbl_formation', $addFormation, $format);
        wp_redirect(site_url() . "/profile");
    }
}

//ADD SKILL

if (!empty($_POST['submitted-addSkill'])) {
    //initialize array
    $addSkill = array();
    $addSkill['id_cv'] = $userCV->id;
    //Clean XSS
    $addSkill['title'] = cleanXSS($_POST['title-addSkill']);
    //Check if text is long enough

    $errors = validText($errors, $addSkill['title'], 'title-addSkill', 2, 100);

    //optionnal option
    if (!empty($_POST['subtitle-addSkill'])) {
        //Clean XSS
        $addSkill['subtitle'] = cleanXSS($_POST['subtitle-addSkill']);

        //Check if text is long enough
        $errors = validText($errors, $addSkill['subtitle'], 'subtitle-addSkill', 2, 100);
    }

    if (!empty($_POST['desc-addSkill'])) {
        //Clean XSS
        $addSkill['description'] = cleanXSS($_POST['desc-addSkill']);

        //Check if text is long enough
        $errors = validText($errors, $addSkill['description'], 'desc-addSkill', 2, 10000);
    }

    if (count($errors) == 0) {
        $format = array('%s', '%s', '%s');
        $wpdb->insert('sbl_skill', $addSkill, $format);
        wp_redirect(site_url() . "/profile");
    }
}

//ADD LOISIR

if (!empty($_POST['submitted-addLoisir'])) {
    //initialize array
    $addLoisir = array();
    $addLoisir['id_cv'] = $userCV->id;

    //required option

    //Clean XSS
    $addLoisir['title'] = cleanXSS($_POST['title-addLoisir']);

    //check is text is long enough
    $errors = validText($errors, $addLoisir['title'], 'title-addLoisir', 2, 100);

    //optionnal option
    if (!empty($_POST['subtitle-addLoisir'])) {
        //Clean XSS
        $addLoisir['subtitle'] = cleanXSS($_POST['subtitle-addLoisir']);
        //Check if text is long enough
        $errors = validText($errors, $addLoisir['subtitle'], 'subtitle-addLoisir', 2, 100);
    }

    if (count($errors) == 0) {
        $format = array('%s', '%s', '%s');
        $wpdb->insert('sbl_loisir', $addLoisir, $format);
        wp_redirect(site_url() . "/profile");
    }
}

//ADD REWARD

if (!empty($_POST['submitted-addReward'])) {
    //initialize array
    $addReward = array();
    $addReward['id_cv'] = $userCV->id;
    //Clean XSS
    $addReward['title'] = cleanXSS($_POST['title-addReward']);
    $addReward['date'] = cleanXSS($_POST['date-addReward']);
    //Check if text is long enough

    $errors = validText($errors, $addReward['title'], 'title-addReward', 2, 100);
    $errors = validText($errors, $addReward['date'], 'date-addReward', 2, 30);

    //optionnal option
    if (!empty($_POST['desc-addReward'])) {
        //Clean XSS
        $addReward['description'] = cleanXSS($_POST['desc-addReward']);

        //Check if text is long enough
        $errors = validText($errors, $addReward['description'], 'desc-addReward', 2, 10000);
    }

    if (count($errors) == 0) {
        $format = array('%s', '%s', '%s');
        $wpdb->insert('sbl_reward', $addReward, $format);
        wp_redirect(site_url() . "/profile");
    }
}

//Delete data
if (!empty($_POST['delete-data-cv'])) {

    $id = cleanXSS($_POST['data-delete-type']);
    $type = cleanXSS($_POST['data-delete-id']);

    if (is_int(intval($id))) {
        $data = ['status' => '0'];
        $where = ['id' => $id];
        $wpdb->update('sbl_' . $type, $data, $where);
        wp_redirect(site_url() . "/profile");
    } else {
        wp_redirect(site_url() . "/profile");
    }
}

//DOWNLOAD CV
if(!empty($_POST['download-cv'])){

    createCv('D', $current_user, $userCvExperiences, $userCvFormations, $userCvSkills, $userCvLoisirs, $userCvRewards);

}

//Lancer un aperçu du CV

if(!empty($_POST['apercu-cv'])){

    createCv('I', $current_user, $userCvExperiences, $userCvFormations, $userCvSkills, $userCvLoisirs, $userCvRewards);

}
get_header();
?>

<section id="intro">
    <div class="petite-boite">
        <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bonjour <?php if (!empty($current_user->first_name) && $current_user->first_name != '') { echo $current_user->first_name;} else { echo $current_user->user_login;} ?> ! ", "Voici votre profil ", "retrouvez votre cv plus bas !"]'></span>|</h1>
    </div>
    <p class="subTitleWebSite">Bienvenue sur votre espace candidat</p>
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <h2 class="titleSection">Mon profil</h2>
        <h3 class="featuredInformation">Informations complémentaires</h3>
        <form id="formInfoUser" method="post" action="<?php echo esc_url(home_url('profile')) ?>">
            <section id="infoUser">
                <div class="leftColumnUser">

                    <div class="input-area-infoUser">
                        <label for="name-infoUser">nom</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="name-infoUser" id="name-infoUser" <?php if (!empty($current_user->last_name) && $current_user->last_name != '') {
                                                                                        echo 'value="' . $current_user->last_name . '"';
                                                                                    } else {
                                                                                        echo 'placeholder="Doe"';
                                                                                    } ?>>
                    </div>
                    <span class="error-infoUser error-name-infoUser"><?php if (!empty($errors['name-infoUser']) && $errors['name-infoUser'] != '') {
                                                                            echo $errors['name-infoUser'];
                                                                        } ?></span>


                    <div class="input-area-infoUser">
                        <label for="firstname-infoUser">prénom</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="firstname-infoUser" id="firstname-infoUser" <?php if (!empty($current_user->first_name) && $current_user->first_name != '') {
                                                                                                    echo 'value="' . $current_user->first_name . '"';
                                                                                                } else {
                                                                                                    echo 'placeholder="John"';
                                                                                                } ?>>
                    </div>
                    <span class="error-infoUser error-firstname-infoUser"><?php if (!empty($errors['firstname-infoUser']) && $errors['firstname-infoUser'] != '') {
                                                                                echo $errors['firstname-infoUser'];
                                                                            } ?></span>


                    <div class="input-area-infoUser">
                        <label for="email-infoUser">email</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="email-infoUser" id="email-infoUser" <?php if (!empty($current_user->user_email) && $current_user->user_email != '') {
                                                                                            echo 'value="' . $current_user->user_email . '"';
                                                                                        } else {
                                                                                            echo 'placeholder="Votre email"';
                                                                                        } ?>>
                    </div>
                    <span class="error-infoUser error-email-infoUser"><?php if (!empty($errors['email-infoUser']) && $errors['email-infoUser'] != '') {
                                                                            echo $errors['email-infoUser'];
                                                                        } ?></span>


                    <div class="input-area-infoUser">
                        <label for="age-infoUser">age</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="number" name="age-infoUser" id="age-infoUser" <?php if (!empty($current_user->age) && $current_user->age != '' && $current_user->age != 'default') {
                                                                                        echo 'value="' . $current_user->age . '"';
                                                                                    } else {
                                                                                        echo 'placeholder="Votre age"';
                                                                                    } ?>>
                    </div>
                    <span class="error-infoUser error-age-infoUser"><?php if (!empty($errors['age-infoUser']) && $errors['age-infoUser'] != '') {                                                                       echo $errors['age-infoUser'];
                                                                    } ?></span>


                </div>

                <div class="dividerUser"></div>

                <div class="rightColumnUser">

                    <div class="input-area-infoUser">
                        <label for="adresse-infoUser">adresse</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="adresse-infoUser" id="adresse-infoUser" <?php if (!empty($current_user->adresse) && $current_user->adresse != '' && $current_user->adresse != 'default') {
                                                                                                echo 'value="' . $current_user->adresse . '"';
                                                                                            } else {
                                                                                                echo 'placeholder="Votre email"';
                                                                                            } ?>>
                    </div>
                    <span class="error-infoUser error-adresse-infoUser"><?php if (!empty($errors['adresse-infoUser']) && $errors['adresse-infoUser'] != '') {
                                                                            echo $errors['adresse-infoUser'];
                                                                        } ?></span>

                    <div class="input-area-infoUser">
                        <label for="telephone-infoUser">Téléphone</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="tel" name="telephone-infoUser" id="telephone-infoUser" <?php if (!empty($current_user->telephone) && $current_user->telephone != '' && $current_user->telephone != 'default') {
                                                                                                echo 'value="' . $current_user->telephone . '"';
                                                                                            } else {
                                                                                                echo 'placeholder="Votre numéro téléphone"';
                                                                                            } ?>>
                    </div>
                    <span class="error-infoUser error-telephone-infoUser"><?php if (!empty($errors['telephone-infoUser']) && $errors['telephone-infoUser'] != '') {
                                                                                echo $errors['telephone-infoUser'];
                                                                            } ?></span>

                    <div class="input-area-infoUser">
                        <label for="newPassword-infoUser">Nouveau MDP</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="password" name="newPassword-infoUser" id="newPassword-infoUser">
                    </div>
                    <span class="error-infoUser error-newPassword-infoUser"><?php if (!empty($errors['newPassword-infoUser']) && $errors['newPassword-infoUser'] != '') {
                                                                                echo $errors['newPassword-infoUser'];
                                                                            } ?></span>

                    <div class="input-area-infoUser">
                        <label for="newPasswordConfirm-infoUser">Confirmer MDP</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="password" name="newPasswordConfirm-infoUser" id="newPasswordConfirm-infoUser">
                    </div>

                </div>

            </section>

            <div class="submitButtonInfoUser">
                <input class="btn-submit-userInfo loginbutton" type="submit" name="submittedInfoUser" value="Sauvegarder">
            </div>
        </form>

        <section class="divider">
            <div class="dividerHorizontale"></div>
        </section>

        <section id="myCV">
            <h2 class="titleSection">Mon CV</h2>
            <?php if($userHasCV) { ?>

                <div class="optionCV">

                    <div class="parametreButton2">
                        <div class="apercuButton hvr-underline-from-left"><i class="far fa-eye"></i> Aperçu</div>
                        <div class="downloadButton hvr-underline-from-center"><i class="fas fa-file-download"></i> Télécharger</div>
                        <div class="deleteButtonCV hvr-underline-from-right"><i class="far fa-trash-alt"></i> Supprimer</div>
                    </div>

                </div>

                <div class="infosCvUser">

                    <?php if (!empty($current_user->last_name) && $current_user->last_name != '' && !empty($current_user->last_name) && $current_user->last_name != '') { ?>

                        <div class="infoCvContent">
                            <div class="titleInfo">
                                Nom :
                            </div>
                            <div class="contentInfo">
                                <?php echo ucfirst($current_user->last_name) . ' ' . ucfirst($current_user->first_name); ?>
                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="infoCvContent">
                            <div class="contentInfo">
                                <?php echo $current_user->user_login; ?>
                            </div>
                        </div>

                    <?php } ?>

                    <?php if (!empty($current_user->user_email) && $current_user->user_email != '') { ?>

                        <div class="infoCvContent">
                            <div class="titleInfo">
                                Email :
                            </div>
                            <div class="contentInfo">
                                <?php echo $current_user->user_email; ?>
                            </div>
                        </div>

                    <?php } ?>

                    <?php if (!empty($current_user->age) && $current_user->age != '') { ?>

                        <div class="infoCvContent">
                            <div class="titleInfo">
                                Age :
                            </div>
                            <div class="contentInfo">
                                <?php echo $current_user->age; ?>
                            </div>
                        </div>

                    <?php } ?>

                    <?php if (!empty($current_user->adresse) && $current_user->adresse != '') { ?>

                        <div class="infoCvContent">
                            <div class="titleInfo">
                                Adresse :
                            </div>
                            <div class="contentInfo">
                                <?php echo $current_user->adresse; ?>
                            </div>
                        </div>

                    <?php } ?>

                    <?php if (!empty($current_user->telephone) && $current_user->telephone != '') { ?>

                        <div class="infoCvContent">
                            <div class="titleInfo">
                                Téléphone :
                            </div>
                            <div class="contentInfo">
                                <?php echo $current_user->telephone; ?>
                            </div>
                        </div>

                    <?php } ?>

                </div>

                <section class="divider">
                    <div class="dividerHorizontale"></div>
                </section>

                <!--  EXPERIENCES-->
                <h3 class="titleCvSection">Mes expériences :</h3>
                <section id="MyExperience">

                    <!--LISTING DES EXPERIENCES-->
                    <div class="listingExperience listing">
                        <?php foreach ($userCvExperiences as $experience) { ?>
                            <div class="singleContent singleExperience" data-type="experience" data-id="<?php echo $experience->id; ?>">
                                <div class="titleContent titleExperience">
                                    <?php echo $experience->title; ?>
                                </div>
                                <div class="subtitleContent titleExperience">
                                    <?php echo $experience->subtitle; ?>
                                </div>
                                <div class="descContent titleExperience">
                                    <?php echo $experience->description; ?>
                                </div>
                                <div class="parametreButton">
                                    <div class="deleteButton hvr-underline-from-right"><i class="far fa-trash-alt"></i> Supprimer</div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- AJOUTER DES EXPERIENCES-->
                    <div class="addExperienceContainer formContainer">

                        <div id="AddExperience-Button" class="showFormButton">
                            Ajouter une expérience
                        </div>

                        <form action="<?php echo esc_url(home_url('profile')) ?>" class="formSlideEffect hidden" method="post" id="formAddExperience">

                            <div class="row">
                                <!-- TITLE SECTION-->
                                <div class="input-area input-area-AddExperience">
                                    <label for="title-AddExperience">Titre</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="title-AddExperience" id="title-AddExperience" placeholder="Ajoutez un titre">
                                </div>

                                <div class="dividerUser"></div>

                                <!-- SUBTITLE SECTION-->
                                <div class="input-area input-area-AddExperience">
                                    <label for="subtitle-AddExperience">Sous-titre</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="subtitle-AddExperience" id="subtitle-AddExperience" placeholder="Ajoutez un sous-titre">
                                </div>

                            </div>

                            <div class="textArea">
                                <div class="titleTextArea">Description</div>
                                <div class="textContent">
                                    <textarea name="desc-AddExperience" id="descExperience"></textarea>
                                </div>
                            </div>

                            <div class="submitButtonAdd submitButtonAddExperience">
                                <input class="btn-submit-AddExperience" type="submit" name="submitted-AddExperience" value="Sauvegarder">
                            </div>
                        </form>
                    </div>
                </section>

                <section class="divider">
                    <div class="dividerHorizontale"></div>
                </section>

                <!--  FORMATION-->
                <h3 class="titleCvSection">Ma Formation :</h3>
                <section id="MyFormation">

                    <!--LISTING DES FORMATIONS-->
                    <div class="listingFormation listing">
                        <?php foreach ($userCvFormations as $formation) { ?>
                            <div class="singleContent singleFormation" data-type="formation" data-id="<?php echo $formation->id; ?>">
                                <div class="titleContent titleFormation">
                                    <?php echo $formation->title; ?>
                                </div>
                                <div class="subtitleContent subtitleFormation">
                                    <?php echo $formation->subtitle; ?>
                                </div>
                                <div class="descContent descFormation">
                                    <?php echo $formation->description; ?>
                                </div>
                                <div class="parametreButton">
                                    <div class="deleteButton hvr-underline-from-right"><i class="far fa-trash-alt"></i> Supprimer</div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- AJOUTER DES FORMATIONS-->
                    <div class="addFormation-Container formContainer">

                        <div id="AddFormation-Button" class="showFormButton">
                            Ajouter une formation
                        </div>

                        <form action="<?php echo esc_url(home_url('profile')) ?>" class="formSlideEffect hidden" method="post" id="formAddFormation">

                            <div class="row">
                                <!-- TITLE SECTION-->
                                <div class="input-area input-area-addFormation">
                                    <label for="title-addFormation">Titre</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="title-addFormation" id="title-addFormation" placeholder="Ajoutez un titre">
                                </div>

                                <div class="dividerUser"></div>

                                <!-- SUBTITLE SECTION-->
                                <div class="input-area input-area-addFormation">
                                    <label for="subtitle-addFormation">Sous-titre</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="subtitle-addFormation" id="subtitle-addFormation" placeholder="Ajoutez un sous-titre">
                                </div>

                            </div>

                            <div class="textArea">
                                <div class="titleTextArea">Description</div>
                                <div class="textContent">
                                    <textarea name="desc-addFormation" id="descFormation"></textarea>
                                </div>
                            </div>

                            <div class="submitButtonAdd submitButtonAddFormation">
                                <input class="btn-submit-addFormation" type="submit" name="submitted-addFormation" value="Sauvegarder">
                            </div>
                        </form>
                    </div>
                </section>

                <section class="divider">
                    <div class="dividerHorizontale"></div>
                </section>

                <!--  SKILLS -->
                <h3 class="titleCvSection">Mes compétences :</h3>
                <section id="MySkill">

                    <!--LISTING DES SKILLS-->
                    <div class="listingSkill listing">
                        <?php foreach ($userCvSkills as $skill) { ?>
                            <div class="singleContent singleSkill" data-type="skill" data-id="<?php echo $skill->id; ?>">
                                <div class="titleContent titleSkill">
                                    <?php echo $skill->title; ?>
                                </div>
                                <?php if (!empty($skill->subtitle) && $skill->subtitle != '') { ?>
                                    <div class="subtitleContent subtitleSkill">
                                        <?php echo $skill->subtitle; ?>
                                    </div>
                                <?php }; ?>
                                <?php if (!empty($skill->description) && $skill->description != '') { ?>
                                    <div class="descContent descSkill">
                                        <?php echo $skill->description; ?>
                                    </div>
                                <?php }; ?>
                                <div class="parametreButton">
                                    <div class="deleteButton hvr-underline-from-right"><i class="far fa-trash-alt"></i> Supprimer</div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- AJOUTER DES SKILLS-->
                    <div class="addSkillContainer formContainer">

                        <div id="AddSkill-Button" class="showFormButton">
                            Ajouter une compétence
                        </div>

                        <form action="<?php echo esc_url(home_url('profile')) ?>" class="formSlideEffect hidden" method="post" id="formAddSkill">

                            <div class="row">
                                <!-- TITLE SECTION-->
                                <div class="input-area input-area-addSkill">
                                    <label for="title-addSkill">Titre</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="title-addSkill" id="title-addSkill" placeholder="Ajoutez un titre">
                                </div>

                                <div class="dividerUser"></div>

                                <!-- SUBTITLE SECTION-->
                                <div class="input-area input-area-addSkill">
                                    <label for="subtitle-addSkill">Sous-titre</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="subtitle-addSkill" id="subtitle-addSkill" placeholder="Ajoutez un sous-titre (optionnel)">
                                </div>

                            </div>

                            <div class="textArea">
                                <div class="titleTextArea">Description (optionnel) :</div>
                                <div class="textContent">
                                    <textarea name="desc-addSkill" id="descSkill"></textarea>
                                </div>
                            </div>

                            <div class="submitButtonAdd submitButtonAddSkill">
                                <input class="btn-submit-addSkill" type="submit" name="submitted-addSkill" value="Sauvegarder">
                            </div>
                        </form>
                    </div>
                </section>

                <section class="divider">
                    <div class="dividerHorizontale"></div>
                </section>

                <!--  LOISIRS -->
                <h3 class="titleCvSection">Mes loisirs :</h3>
                <section id="MyLoisir">

                    <!--LISTING DES LOISIRS-->
                    <div class="listingLoisir listing">
                        <?php foreach ($userCvLoisirs as $loisir) { ?>
                            <div class="singleContent singleLoisir" data-type="loisir" data-id="<?php echo $loisir->id; ?>">
                                <div class="titleContent titleLoisir">
                                    <?php echo $loisir->title; ?>
                                </div>
                                <?php if (!empty($loisir->subtitle) && $loisir->subtitle != '') { ?>
                                    <div class="subtitleContent subtitleLoisir">
                                        <?php echo $loisir->subtitle; ?>
                                    </div>
                                <?php }; ?>
                                <div class="parametreButton">
                                    <div class="deleteButton hvr-underline-from-right"><i class="far fa-trash-alt"></i> Supprimer</div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- AJOUTER DES LOISIRS-->
                    <div class="addLoisirContainer formContainer">

                        <div id="AddLoisir-Button" class="showFormButton">
                            Ajouter un loisir
                        </div>

                        <form action="<?php echo esc_url(home_url('profile')) ?>" class="formSlideEffect hidden" method="post" id="formAddLoisir">

                            <div class="row">
                                <!-- TITLE SECTION-->
                                <div class="input-area input-area-addLoisir">
                                    <label for="title-addLoisir">Titre</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="title-addLoisir" id="title-addLoisir" placeholder="Ajoutez un titre">
                                </div>

                                <div class="dividerUser"></div>

                                <!-- SUBTITLE SECTION-->
                                <div class="input-area input-area-addLoisir">
                                    <label for="subtitle-addLoisir">Sous-titre</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="subtitle-addLoisir" id="subtitle-addLoisir" placeholder="Ajoutez un sous-titre (optionnel)">
                                </div>

                            </div>


                            <div class="submitButtonAdd submitButtonAddLoisir">
                                <input class="btn-submit-addLoisir" type="submit" name="submitted-addLoisir" value="Sauvegarder">
                            </div>
                        </form>
                    </div>
                </section>

                <section class="divider">
                    <div class="dividerHorizontale"></div>
                </section>

                <!--  REWARDS -->
                <h3 class="titleCvSection">Mes récompenses :</h3>
                <section id="MyReward">

                    <!--LISTING DES REWARDS-->
                    <div class="listingReward listing">
                        <?php foreach ($userCvRewards as $reward) { ?>
                            <div class="singleContent singleReward" data-type="reward" data-id="<?php echo $reward->id; ?>">
                                <div class="titleContent titleReward">
                                    <?php echo $reward->title; ?>
                                </div>
                                <div class="dateContent dateReward">
                                    <?php echo $reward->date; ?>
                                </div>
                                <?php if (!empty($reward->description) && $reward->description != '') { ?>
                                    <div class="descContent descReward">
                                        <?php echo $reward->description; ?>
                                    </div>
                                <?php }; ?>
                                <div class="parametreButton">
                                    <div class="deleteButton hvr-underline-from-right"><i class="far fa-trash-alt"></i> Supprimer</div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- AJOUTER DES REWARDS-->
                    <div class="addRewardContainer formContainer">

                        <div id="AddReward-Button" class="showFormButton">
                            Ajouter une récompense
                        </div>

                        <form action="<?php echo esc_url(home_url('profile')) ?>" class="formSlideEffect hidden" method="post" id="formAddReward">

                            <div class="row">
                                <!-- TITLE SECTION-->
                                <div class="input-area input-area-addReward">
                                    <label for="title-addReward">Titre</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="title-addReward" id="title-addReward" placeholder="Ajoutez un titre">
                                </div>

                                <div class="dividerUser"></div>

                                <!-- DATE SECTION-->
                                <div class="input-area input-area-addReward">
                                    <label for="date-addReward">Date</label>
                                    <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                                    <input type="text" name="date-addReward" id="date-addReward" placeholder="Ajoutez une date">
                                </div>

                            </div>

                            <div class="textArea">
                                <div class="titleTextArea">Description (optionnel) :</div>
                                <div class="textContent">
                                    <textarea name="desc-addReward" id="descReward"></textarea>
                                </div>
                            </div>

                            <div class="submitButtonAdd submitButtonaddReward">
                                <input class="btn-submit-addReward" type="submit" name="submitted-addReward" value="Sauvegarder">
                            </div>
                        </form>
                    </div>
                </section>


                <!-- if user dont have cv -->
            <?php } else { ?>
                <p class="uDontHaveCv">Vous n'avez toujours pas de CV ? Créez en un dès maintenant !</p>
                <form id="formCreateCV" action="<?php echo esc_url(home_url('profile#myCV'))?>" method="post">
                    <input type="submit" id="submit_create_CV" name="submit_create_CV" value="Créer mon CV">
                </form>
            <?php } ?>
        </section>
    </div>
</div>


<?php
get_footer();
