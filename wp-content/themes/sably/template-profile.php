<?php
/*
Template Name: profile
*/

get_header();
?>

<section id="intro">
    <div class="petite-boite">
        <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bienvenue <?php if(!empty($current_user->first_name) && $current_user->first_name != ''){ echo $current_user->first_name ;} else { echo $current_user->user_login ;}?>", "Voici votre profil", "retrouvez votre cv plus bas !"]'></span>|</h1>
    </div>
    <p class="subTitleWebSite">Bienvenue sur votre espace membre</p>
</section>

<div class="wrap-sheet">
    <div id="sheet">
        <h2 class="titleSection">Mon profil</h2>
        <h3 class="featuredInformation">Informations complémentaire</h3>
        <form id="formInfoUser" method="" action="">
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
                        <input type="number" name="age-infoUser" id="age-infoUser" placeholder="age">
                    </div>
                    <span class="error-infoUser error-age-infoUser"></span>


                </div>

                <div class="dividerUser"></div>

                <div class="rightColumnUser">

                    <div class="input-area-infoUser">
                        <label for="adresse-infoUser">adresse</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="text" name="adresse-infoUser" id="adresse-infoUser" placeholder="Doe">
                    </div>
                    <span class="error-infoUser error-adresse-infoUser"></span>

                    <div class="input-area-infoUser">
                        <label for="telNumber-infoUser">Téléphone</label>
                        <i class="fas fa-arrow-right" style="color: #ffc045"></i>
                        <input type="tel" name="telNumber-infoUser" id="telNumber-infoUser" placeholder="0102030405">
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
                <input class="btn-submit-userInfo loginbutton" type="submit" name="submitted" value="Sauvegarder">
            </div>
        </form>

        <section id="myCV"></section>
    </div>
</div>


<?php
get_footer();
