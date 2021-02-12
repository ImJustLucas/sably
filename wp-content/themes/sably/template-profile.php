<?php
/*
Template Name: profile
*/
global $current_user;
wp_get_current_user();

if(!is_user_logged_in()){
    wp_redirect(site_url() . "/login");
}
$errors = array();

if(!empty($_POST['submittedInfoUser'])){

    $where = [ 'ID' => get_current_user_id()];
    $whereMeta = [ 'user_id' => get_current_user_id()];

    $preDataUser = array();
    $preDataUserEmail = array();

    if(!empty($_POST['name-infoUser'])){
        $preDataUser['meta_value'] = cleanXSS($_POST['name-infoUser']);
        if($preDataUser['meta_value'] !== $current_user->last_name){
            $errors = validText($errors, $preDataUser['meta_value'] , 'name-infoUser' , 2 , 30);
            if(count($errors) == 0){
                $whereMeta['meta_key'] = 'last_name';
                $wpdb->update( $wpdb->prefix . 'usermeta', $preDataUser, $whereMeta );
            }
        }
    }

    if(!empty($_POST['firstname-infoUser'])){
        $preDataUser['meta_value'] = cleanXSS($_POST['firstname-infoUser']);
        if($preDataUser['meta_value'] !== $current_user->first_name){
            $errors = validText($errors, $preDataUser['meta_value'] , 'firstname-infoUser' , 2 , 30);
            if(count($errors) == 0){
                $whereMeta['meta_key'] = 'first_name';
                $wpdb->update( $wpdb->prefix . 'usermeta', $preDataUser, $whereMeta );
            }
        }
    }

    if(!empty($_POST['email-infoUser'])){
        $preDataUserEmail['user_email'] = cleanXSS($_POST['email-infoUser']);
        if($preDataUserEmail['user_email'] !== $current_user->user_email){
            $errors = validMail($errors, $preDataUserEmail['user_email'], 'email-infoUser');
            if(count($errors) == 0){
                $wpdb->update( $wpdb->prefix . 'user', $preDataUserEmail, $where );
            }
        }
    }


    if(!empty($_POST['age-infoUser'])){
        $preDataUser['meta_value'] = cleanXSS($_POST['age-infoUser']);
        if($preDataUser['meta_value'] != $current_user->age){
            if(!is_int(intval($preDataUser['meta_value']))){
                $errors['age-infoUser'] = 'Veuillez saisir un chiffre';
            } else {
                if(count($errors) == 0){
                $whereMeta['meta_key'] = 'age';
                $wpdb->update( $wpdb->prefix . 'usermeta', $preDataUser, $whereMeta);
                }
            }
        }
    }

    if(!empty($_POST['adresse-infoUser'])){
        $preDataUser['meta_value'] = cleanXSS($_POST['adresse-infoUser']);
        if($preDataUser['meta_value'] !== $current_user->adresse){
            $errors = validText($errors, $preDataUser['meta_value'] , 'adresse-infoUser' , 2 , 30);
            if(count($errors) == 0){
                $whereMeta['meta_key'] = 'adresse';
                $wpdb->update( $wpdb->prefix . 'usermeta', $preDataUser, $whereMeta );
            }
        }
    }

    if(!empty($_POST['telephone-infoUser'])){
        $preDataUser['meta_value'] = cleanXSS($_POST['telephone-infoUser']);
        if($preDataUser['meta_value'] != $current_user->telephone){
            if(!is_int(intval($preDataUser['telephone']))){
                $errors['telephone-infoUser'] = 'Veuillez saisir un chiffre';
            } else {
                if(count($errors) == 0){
                $whereMeta['meta_key'] = 'telephone';
                $wpdb->update( $wpdb->prefix . 'usermeta', $preDataUser, $whereMeta );
                }
            }
        }
    }

    if(!empty($_POST['newPassword-infoUser'])){
        $newPassword = cleanXSS($_POST['newPassword-infoUser']);
        if(!empty($_POST['newPasswordConfirm-infoUser'])){
            $newPasswordConfirm = cleanXSS($_POST['newPasswordConfirm-infoUser']);
            $errors = validPass($errors, $newPassword, 'newPassword', $newPasswordConfirm, 4, 30);
            $preDataUser['user_pass'] = wp_hash_password($newPassword);
            if(count($errors) == 0){
                $wpdb->update( $wpdb->prefix . 'users', $preDataUser, $where );
            }
        }
    }

    if(count($errors) === 0) {
        wp_redirect(site_url() . "/profile");
    }

}

get_header();
?>

<section id="intro">
    <div class="petite-boite">
        <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bonjour <?php if(!empty($current_user->first_name) && $current_user->first_name != ''){ echo $current_user->first_name ;} else { echo $current_user->user_login ;}?> ! ", "Voici votre profil ", "retrouvez votre cv plus bas "]'></span>|</h1>
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
                    <span class="error-infoUser error-name-infoUser"><?php if(!empty($errors['name-infoUser']) && $errors['name-infoUser'] != ''){ echo $errors['name-infoUser']; } ?></span>


                    <div class="input-area-infoUser">
                        <label for="firstname-infoUser">prénom</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="firstname-infoUser" id="firstname-infoUser" <?php if(!empty($current_user->first_name) && $current_user->first_name != ''){ echo 'value="' . $current_user->first_name . '"';} else { echo 'placeholder="John"' ;}?>>
                    </div>
                    <span class="error-infoUser error-firstname-infoUser"><?php if(!empty($errors['firstname-infoUser']) && $errors['firstname-infoUser'] != ''){ echo $errors['firstname-infoUser']; } ?></span>


                    <div class="input-area-infoUser">
                        <label for="email-infoUser">email</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="email-infoUser" id="email-infoUser" <?php if(!empty($current_user->user_email) && $current_user->user_email != ''){ echo 'value="' . $current_user->user_email . '"';} else { echo 'placeholder="Votre email"' ;}?>>
                    </div>
                    <span class="error-infoUser error-email-infoUser"><?php if(!empty($errors['email-infoUser']) && $errors['email-infoUser'] != ''){ echo $errors['email-infoUser']; } ?></span>


                    <div class="input-area-infoUser">
                        <label for="age-infoUser">age</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="number" name="age-infoUser" id="age-infoUser" <?php if(!empty($current_user->age) && $current_user->age != '' && $current_user->age != 'default'){ echo 'value="' . $current_user->age . '"';} else { echo 'placeholder="Votre age"' ;}?>>
                    </div>
                    <span class="error-infoUser error-age-infoUser"><?php if(!empty($errors['age-infoUser']) && $errors['age-infoUser'] != ''){ echo $errors['age-infoUser']; } ?></span>


                </div>

                <div class="dividerUser"></div>

                <div class="rightColumnUser">

                    <div class="input-area-infoUser">
                        <label for="adresse-infoUser">adresse</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="adresse-infoUser" id="adresse-infoUser" <?php if(!empty($current_user->adresse) && $current_user->adresse != '' && $current_user->adresse != 'default'){ echo 'value="' . $current_user->adresse . '"';} else { echo 'placeholder="Votre email"' ;}?>>
                    </div>
                    <span class="error-infoUser error-adresse-infoUser"><?php if(!empty($errors['adresse-infoUser']) && $errors['adresse-infoUser'] != ''){ echo $errors['adresse-infoUser']; } ?></span>

                    <div class="input-area-infoUser">
                        <label for="telephone-infoUser">Téléphone</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="tel" name="telephone-infoUser" id="telephone-infoUser" <?php if(!empty($current_user->telephone) && $current_user->telephone != '' && $current_user->telephone != 'default'){ echo 'value="' . $current_user->telephone . '"';} else { echo 'placeholder="Votre numéro téléphone"' ;}?>>
                    </div>
                    <span class="error-infoUser error-telephone-infoUser"><?php if(!empty($errors['telephone-infoUser']) && $errors['telephone-infoUser'] != ''){ echo $errors['telephone-infoUser']; } ?></span>

                    <div class="input-area-infoUser">
                        <label for="newPassword-infoUser">Nouveau MDP</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="password" name="newPassword-infoUser" id="newPassword-infoUser">
                    </div>
                    <span class="error-infoUser error-newPassword-infoUser"><?php if(!empty($errors['newPassword-infoUser']) && $errors['newPassword-infoUser'] != ''){ echo $errors['newPassword-infoUser']; } ?></span>

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

        <section id="myCV"></section>
    </div>
</div>


<?php
get_footer();
