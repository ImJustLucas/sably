<?php
/*
Template Name: Home recruiter
*/

get_header();
?>

<div id="recruiterBackground">

  <section id="intro">
    <div class="petite-boite">
      <h1 class="titleWebSite"><span class="txt-type" data-wait="3000" data-words='["bonjour <?php if (!empty($current_user->first_name) && $current_user->first_name != '') {
                                                                                                echo $current_user->first_name;
                                                                                              } else {
                                                                                                echo $current_user->user_login;
                                                                                              } ?> ! ", "Voici la liste des CVs", "Trouvez le bon candidat"]'></span>|</h1>
    </div>
    <p class="subTitleWebSite">Bienvenue sur votre espace recruteur</p>
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
      <table class="table">
        <thead>
          <tr>
            <th class="cellule">Id</th>
            <th class="cellule">Prénom</th>
            <th class="cellule">Nom</th>
            <th class="cellule">Date</th>
            <th class="cellule">Voir détail</th>
          </tr>
        </thead>
        <?php
        foreach ($cvs as $cv) { ?>
          <tbody>
            <tr>
              <?php
              $id = $cv->id_user;
              $wpdb_tablename2 = 'wp_sbl_usermeta';
              $sql = "SELECT * FROM $wpdb_tablename2 WHERE user_id = $id AND meta_key = 'first_name'";
              $sql2 = "SELECT * FROM $wpdb_tablename2 WHERE user_id = $id AND meta_key = 'last_name'";
              $user_prenom = $wpdb->get_results($sql);
              $user_nom = $wpdb->get_results($sql2);
              ?>
              <td class="cellule"><?php $cvid = $cv->id;
                  echo $cvid; ?></td>
              <?php if (!empty($user_prenom[0]->meta_value) && $user_nom[0]->meta_value) { ?>
                <td class="cellule"><?= $user_prenom[0]->meta_value;  ?></td>
                <td class="cellule"><?= $user_nom[0]->meta_value;  ?></td>
              <?php  } else { ?>
                <td class="cellule"><?php $wpdb_tablename = 'wp_sbl_users';
                    $sql = "SELECT user_login FROM $wpdb_tablename WHERE ID = $id";
                    $user_login = $wpdb->get_var($sql);
                    echo $user_login ?></td>
              <?php } ?>
              <td class="cellule"><?= formatageDate($cv->created_at);  ?></td>
              <td class="cellule"><a href="<?php echo esc_url(home_url('recruitersingle')) . '?id=' . $cvid . '/' . $id . ''; ?>">Détail</a></td>

            </tr>
          </tbody>
        <?php }
        ?>
      </table>
    </div>


  </div>
</div>

<?php
get_footer();
