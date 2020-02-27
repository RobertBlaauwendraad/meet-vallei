<?php
// Removes admin bar for non-administrators
function remove_admin_bar() {
    if (current_user_can('patient') && !is_admin()) {
    show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'remove_admin_bar');

// Redirects to login if not logged in
function redirect_to_login() {
    if ( !is_user_logged_in() ) {
        auth_redirect();
    }
}
add_action( 'template_redirect', 'redirect_to_login' );

// Disables dashboard for non-administators
function disable_dashboard() { 
    if (!is_user_logged_in()) { 
        return null; 
    } 
    if (current_user_can('patient') && is_admin()) { 
        wp_redirect(home_url()); 
        exit; 
    } 
}
add_action('admin_init', 'disable_dashboard');

// Adds new role
add_action('init', function() {
    remove_role( 'patient' );
    add_role( 
        'patient',
        __('Patiënt', 'meetvallei'),
        array(
            'read' => true,
        )
    );
});

// Adds new role
add_action('init', function() {
    remove_role( 'dietist' );
    add_role( 
        'dietist',
        __( 'Diëtist(e)', 'meetvallei'),
        array(
            'read' => true,
            'list_users' => true,
            'create_users' => true,
            'edit_users' => true,
            'promote_users' => true,
            'delete_users' => true,
            'read_product' => true,
            'read_producten' => true,
            'edit_product' => true,
            'read_product' => true,
            'delete_product' => true,
            'edit_producten' => true,
            'edit_others_producten' => true,
            'publish_producten' => true,
            'read_private_producten' => true,
            'edit_producten' => true,
            'manage_productgroepen' => true,
            'edit_productgroepen' => true,
            'delete_productgroepen' => true,
            'assign_productgroepen' => true,
        )
    );
});