<?php
/*
Template Name: Home recruiter
*/

get_header();
?>

<div id="recruiterBackground">

    <section id="intro">
        <div class="petite-boite">
            <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bonjour <?php if(!empty($current_user->first_name) && $current_user->first_name != ''){ echo $current_user->first_name ;} else { echo $current_user->user_login ;}?> ! ", "Voici la liste des CVs", "Trouvez le bon candidat"]'></span>|</h1>
        </div>
        <p class="subTitleWebSite">Bienvenue sur votre espace membre</p>
    </section>

    <div class="wrap-sheet">
        <div id="sheet">
            <h2 class="titleSection">Espace recruteur</h2>
            <?php
            global $wpdb;
            $wpdb_tablename = 'sbl_cv';
            $sql = "SELECT * FROM $wpdb_tablename";
            $cvs = $wpdb->get_results($sql);

            ?>
              <table>
                <tr>
                  <td>Id</td>
                  <td>Prénom</td>
                  <td>Nom</td>
                  <td>Date</td>
                  <td>Voir détail</td>
                </tr>
            <?php
            foreach ($cvs as $cv) { ?>
              <tr>
                <?php
                $id = $cv->id_user;
                $wpdb_tablename2 = 'wp_sbl_usermeta';
                $sql = "SELECT * FROM $wpdb_tablename2 WHERE user_id = $id AND meta_key = 'first_name'";
                $sql2 = "SELECT * FROM $wpdb_tablename2 WHERE user_id = $id AND meta_key = 'last_name'";
                $user_prenom = $wpdb->get_results($sql);
                $user_nom = $wpdb->get_results($sql2);
                 ?>
                 <td><?php $cvid = $cv->id; echo $cvid; ?></td>
                <?php if(!empty($user_prenom[0]->meta_value) && $user_nom[0]->meta_value ) { ?>
                  <td><?= $user_prenom[0]->meta_value ;  ?></td>
                  <td><?= $user_nom[0]->meta_value ;  ?></td>
                <?php  } else { ?>
                  <td><?php $wpdb_tablename = 'wp_sbl_users'; $sql = "SELECT user_login FROM $wpdb_tablename WHERE ID = $id";
                  $user_login = $wpdb->get_var($sql); echo $user_login ?></td>
                <?php } ?>
                <td><?= formatageDate($cv->created_at);  ?></td>
                <td><a href="<?php echo esc_url(home_url('recruitersingle')).'?id='.$cvid.'/'.$id.''; ?>">Détail</a></td>

              </tr>
            <?php }
            ?>
              </table>
        </div>


        </div>
    </div>

<?php
get_footer();
