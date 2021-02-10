<?php

add_role(
    'recruiter', //  System name of the role.
    __( 'Recruteur'  ), // Display name of the role.
    array(
        'read'  => true,
        'delete_posts'  => false,
        'delete_published_posts' => false,
        'edit_posts'   => false,
        'publish_posts' => false,
        'upload_files'  => false,
        'edit_pages'  => false,
        'edit_published_pages'  =>  false,
        'publish_pages'  => false,
        'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
    )
);

add_role(
    'client', //  System name of the role.
    __( 'Client'  ), // Display name of the role.
    array(
        'read'  => true,
        'delete_posts'  => false,
        'delete_published_posts' => false,
        'edit_posts'   => false,
        'publish_posts' => false,
        'upload_files'  => false,
        'edit_pages'  => false,
        'edit_published_pages'  =>  false,
        'publish_pages'  => false,
        'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
    )
);
