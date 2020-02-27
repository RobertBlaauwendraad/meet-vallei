<?php
add_action('init', function () {

// Add new taxonomy, make it hierarchical like categories

// Set UI labels for Custom Post Type
$custom_taxonomy			  = 'post_category';
$singular                   = __('productgroep');
$plural 					  = __('productgroepen');
$slug 					  = __('productgroep');
$connected_cpt              = array('product');

//first do the translations part for GUI
$labels = array(
'name'                => ucfirst($plural),
'singular_name'       => ucfirst($singular),
'menu_name'           => ucfirst($plural),
'all_items'           => ucfirst($plural),
'parent_item'         => sprintf(__('Hoofd %s'), $singular),
'parent_item_colon'   => sprintf(__('Hoofd %s'), $singular),
'view_item'           => sprintf(__('Bekijk %s'), $singular),
'add_new_item'        => sprintf(__('Voeg nieuwe %s toe'), $singular),
'new_item_name'       => sprintf(__('Nieuwe %s naam'), $singular ),
'add_new'             => sprintf(__('Nieuwe %s'), $singular),
'edit_item'           => sprintf(__('Bewerk %s'), $singular),
'update_item'         => sprintf(__('Update %s'), $singular),
'search_items'        => sprintf(__('Zoek %s'), $singular),
);

// Now register the taxonomy
register_taxonomy( $custom_taxonomy , $connected_cpt, array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_rest'      => true,
    'query_var'         => true,
    'has_archive'       => true,
    'public'     			  => true,
    'rewrite' => array( 'slug' => $slug ),
    'capabilities' => array(
        'manage_terms' => 'manage_productgroepen',
        'edit_terms' => 'edit_productgroepen',
        'delete_terms' => 'delete_productgroepen',
        'assign_terms' => 'assign_productgroepen'
    ),
    'map_meta_cap' => true
));

// Make sure to add the taxonomie to the custom-post-type $args array !!!
});