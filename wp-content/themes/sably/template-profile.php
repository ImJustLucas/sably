<?php
/*
Template Name: profile
*/

if(!is_user_logged_in()){
    wp_redirect(site_url() . "/profile");
}
$errors = array();
$postDateUser = array();

if(!empty($_POST['submittedInfoUser'])){

    $preDataUser = array();
    if(!empty($_POST['name-infoUser'])){
        $preDataUser['name'] = cleanXSS($_POST['name-infoUser']);
        $errors = validText($errors, $preDataUser['name'] , 'name-infoUser' , 2 , 30);
    }

    if(!empty($_POST['email-infoUser'])){
        $preDataUser['firstname'] = cleanXSS($_POST['firstname-infoUser']);
        $errors = validText($errors, $preDataUser['firstname'] , 'firstname-infoUser' , 2 , 30);
    }

    if(!empty($_POST['email-infoUser'])){
        $preDataUser['email'] = cleanXSS($_POST['email-infoUser']);
        $errors = validMail($errors, $preDataUser['email'], 'email-infoUser');
    }

    if(!empty($_POST['age-infoUser'])){
        $preDataUser['age'] = cleanXSS($_POST['age-infoUser']);
        if(!is_int($preDataUser['age'])){
            $errors['age-infoUser'] = 'Veuillez saisir un chiffre';
        }
    }

    if(!empty($_POST['adresse-infoUser'])){
        $preDataUser['adresse'] = cleanXSS($_POST['adresse-infoUser']);
        $errors = validText($errors, $preDataUser['adresse'] , 'adresse-infoUser' , 2 , 60);
    }
    
    if(!empty($_POST['telephone-infoUser'])){
        $preDataUser['telephone'] = cleanXSS($_POST['telephone-infoUser']);
        if(!is_int($preDataUser['telephone'])){
            $errors['telephone-infoUser'] = 'Veuillez saisir un chiffre';
        }
    }

    if(!empty($_POST['newPassword-infoUser'])){
        $preDataUser['newPassword'] = cleanXSS($_POST['newPassword-infoUser']);
        if(!empty($_POST['newPasswordConfirm-infoUser'])){
            $preDataUser['newPasswordConfirm'] = cleanXSS($_POST['newPasswordConfirm-infoUser']);
            $errors = validPass($errors, $preDataUser['newPassword'], 'newPassword', $preDataUser['newPasswordConfirm'], 4, 30);
        }
    }

    die(debug($preDataUser));
    //die(debug(array_filter($preDataUser)));

}

get_header();
?>

<section id="intro">
    <div class="petite-boite">
        <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bonjour <?php if(!empty($current_user->first_name) && $current_user->first_name != ''){ echo $current_user->first_name ;} else { echo $current_user->user_login ;}?> ! ", "Voici votre profil", "retrouvez votre cv plus bas"]'></span>|</h1>
    </div>
    <p class="subTitleWebSite">Bienvenue sur votre espace membre</p>
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <h2 class="titleSection">Mon profil</h2>
        <h3 class="featuredInformation">Informations complémentaires</h3>
        <form id="formInfoUser" method="post" action="">
            <section id="infoUser">
                <div class="leftColumnUser">

                    <div class="input-area-infoUser">
                        <label for="name-infoUser">nom</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="name-infoUser" id="name-infoUser" <?php if(!empty($current_user->last_name) && $current_user->last_name != ''){ echo 'value="' . $current_user->last_name . '"';} else { echo 'placeholder="Doe"' ;}?>>
                    </div>
                    <span class="error-infoUser error-name-infoUser"></span>


                    <div class="input-area-infoUser">
                        <label for="firstname-infoUser">prénom</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="firstname-infoUser" id="firstname-infoUser" <?php if(!empty($current_user->first_name) && $current_user->first_name != ''){ echo 'value="' . $current_user->first_name . '"';} else { echo 'placeholder="John"' ;}?>>
                    </div>
                    <span class="error-infoUser error-firstname-infoUser"></span>


                    <div class="input-area-infoUser">
                        <label for="email-infoUser">email</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="email-infoUser" id="email-infoUser" <?php if(!empty($current_user->user_email) && $current_user->user_email != ''){ echo 'value="' . $current_user->user_email . '"';} else { echo 'placeholder="Votre email"' ;}?>>
                    </div>
                    <span class="error-infoUser error-email-infoUser"></span>


                    <div class="input-area-infoUser">
                        <label for="age-infoUser">age</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="number" name="age-infoUser" id="age-infoUser" <?php if(!empty($current_user->age) && $current_user->age != ''){ echo 'value="' . $current_user->age . '"';} else { echo 'placeholder="Votre age"' ;}?>>
                    </div>
                    <span class="error-infoUser error-age-infoUser"></span>


                </div>

                <div class="dividerUser"></div>

                <div class="rightColumnUser">

                    <div class="input-area-infoUser">
                        <label for="adresse-infoUser">adresse</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="adresse-infoUser" id="adresse-infoUser" <?php if(!empty($current_user->adresse) && $current_user->adresse != ''){ echo 'value="' . $current_user->adresse . '"';} else { echo 'placeholder="Votre email"' ;}?>>
                    </div>
                    <span class="error-infoUser error-adresse-infoUser"></span>

                    <div class="input-area-infoUser">
                        <label for="telNumber-infoUser">Téléphone</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="tel" name="telNumber-infoUser" id="telNumber-infoUser" <?php if(!empty($current_user->telephone) && $current_user->telephone != ''){ echo 'value="' . $current_user->telephone . '"';} else { echo 'placeholder="Votre numéro téléphone"' ;}?>>
                    </div>
                    <span class="error-infoUser error-telNumber-infoUser"></span>

                    <div class="input-area-infoUser">
                        <label for="newPassword-infoUser">Nouveau MDP</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="password" name="newPassword-infoUser" id="newPassword-infoUser">
                    </div>
                    <span class="error-infoUser error-newPassword-infoUser"></span>

                    <div class="input-area-infoUser">
                        <label for="newPasswordConfirm-infoUser">Confirmer MDP</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="password" name="newPasswordConfirm-infoUser" id="newPasswordConfirm-infoUser">
                    </div>
                    <span class="error-infoUser error-newPasswordConfirm-infoUser"></span>

                </div>

            </section>

            <div class="submitButtonInfoUser">
                <input class="btn-submit-userInfo loginbutton" type="submit" name="submittedInfoUser" value="Sauvegarder">
            </div>
        </form>

        <section id="myCV"></section>
    </div>
</div>


<?php
get_footer();
