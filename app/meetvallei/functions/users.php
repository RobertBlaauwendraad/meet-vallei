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
            // Users
            'list_users' => true,
            'create_users' => true,
            'edit_users' => true,
            'promote_users' => true,
            'delete_users' => true,
            // Producten
            'read_product' => true,
            'read_producten' => true,
            'edit_product' => true,
            'edit_producten' => true,
            'edit_others_producten' => true,
            'delete_product' => true,
            'delete_producten' => true,
            'publish_producten' => true,
            'read_private_producten' => true,
            // Productgroepen
            'manage_productgroepen' => true,
            'edit_productgroepen' => true,
            'delete_productgroepen' => true,
            'assign_productgroepen' => true,
        )
    );
});

// Edits admin role
add_action( 'admin_init', function(){
    $admins = get_role( 'administrator' );
    
    $admins->add_cap( 'read_product' );
    $admins->add_cap( 'read_producten' );
    $admins->add_cap( 'edit_product' );
    $admins->add_cap( 'edit_producten' );
    $admins->add_cap( 'edit_others_producten' );
    $admins->add_cap( 'delete_product' );
    $admins->add_cap( 'delete_producten' );
    $admins->add_cap( 'publish_producten' );
    $admins->add_cap( 'read_private_producten' );

    $admins->add_cap( 'manage_productgroepen' );
    $admins->add_cap( 'edit_productgroepen' );
    $admins->add_cap( 'delete_productgroepen' );
    $admins->add_cap( 'assign_productgroepen' );
});

add_filter('editable_roles', function($all_roles){
    global $pagenow;
    if( current_user_can('dietist') && $pagenow == 'user-edit.php' ) {
        unset($all_roles['administrator']);
        unset($all_roles['editor']);
        unset($all_roles['author']);
        unset($all_roles['contributor']);
        unset($all_roles['subscriber']);
    }
    return $all_roles;
});

// removes the `profile.php` admin color scheme options
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

        //Removes the leftover 'Visual Editor', 'Keyboard Shortcuts' and 'Toolbar' options.

        add_action( 'admin_head', function () {

            ob_start( function( $subject ) {

                $subject = preg_replace( '#<h[0-9]>'.__("Personal Options").'</h[0-9]>.+?/table>#s', '', $subject, 1 );
                return $subject;
            });
        });

        add_action( 'admin_footer', function(){

            ob_end_flush();
        });     