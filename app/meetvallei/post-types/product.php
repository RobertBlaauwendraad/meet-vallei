<?php
add_action('init', function(){
    $custom_post_type   = 'product';
    $singular           = ('product');
    $plural             = ('producten');
    $icon               = 'dashicons-carrot';
    $slug               = ('producten');
    $menuorder          = 25;

    $labels = array(
        'name'                => ucfirst($plural),
        'singular_name'       => ucfirst($singular),
        'menu_name'           => ucfirst($plural),
        'parent_item_colon'   => sprintf(__('Hoofd %s'), $singular),
        'all_items'           => ucfirst($plural),
        'view_item'           => sprintf(__('Bekijk %s'), $singular),
        'add_new_item'        => sprintf(__('Voeg nieuwe %s toe'), $singular),
        'add_new'             => sprintf(__('Nieuwe %s'), $singular),
        'edit_item'           => sprintf(__('Bewerk %s'), $singular),
        'update_item'         => sprintf(__('Update %s'), $singular),
        'search_items'        => sprintf(__('Zoek %s'), $singular),
        'not_found'           => __('Niet gevonden'),
        'not_found_in_trash'  => __('Niet gevonden in prullenbak'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label'               => $plural,
        'description'         => $plural,
        'labels'              => $labels,
        'menu_icon'           => $icon,
        'rewrite'             => array('slug' => $slug),
        'supports'            => array('title', 'custom-fields'),
        'taxonomies'          => array( 'productgroep' ),
        'capability_type'     => 'page',
        'menu_position'       => $menuorder,
        'can_export'          => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'hierarchical'        => false,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_in_admin_bar'   => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_rest'		  => true,
        'show_ui'             => true,
        'capabilities' => array(
            'read_post' => 'read_product',
            'read_posts' => 'read_producten',
            'edit_post' => 'edit_product',
            'edit_posts' => 'edit_producten',
            'edit_others_posts' => 'edit_others_producten',
            'delete_post' => 'delete_product',
            'delete_posts' => 'delete_producten',
            'publish_posts' => 'publish_producten',
            'read_private_posts' => 'read_private_producten',
        ),
        'map_meta_cap' => true
    );

    // Registering your Custom Post Type
    register_post_type($custom_post_type, $args);
    flush_rewrite_rules(false);
});
