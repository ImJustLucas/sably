<?php

function mainJs_delete_data_CV() {
  
    global $wpdb;
    //var_dump($_POST);
    $id = cleanXSS($_POST['id']);
    $type = cleanXSS($_POST['typeData']);
    //var_dump($id);
    //var_dump($type);


    if(is_int(intval($id))){
        $data = ['status' => '0'];
        $where = ['id' => $id];/*
        $wpdb->prepare($type);
        $wpdb->prepare($where);
        $wpdb->prwpepare($data);*/
	    //wp_die('sbl_' . $type);
        $wpdb->update('sbl_' . $type, $data, $where);
        wp_redirect(site_url() . "/profile");
    } else {
        wp_redirect(site_url() . "/profile");
    }

    wp_die('sbl_'.$type);
}

add_action( 'wp_ajax_delete_data_CV', 'mainJs_delete_data_CV' );
add_action( 'wp_ajax_nopriv_delete_data_CV', 'mainJs_delete_data_CV' );