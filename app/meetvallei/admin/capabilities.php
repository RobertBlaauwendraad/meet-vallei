<?php

/**
 * Modify WP Rocket plugin capabilities for editor (purging cache)
 */
add_filter( 'rocket_capacity', function($user_capability) {
	if ( current_user_can( 'editor' ) ) {
		$user_capability = 'editor';
	}
	return $user_capability;
});

/**
 * Edit capabilities for editor role
 */
$role_editor = get_role( 'editor' );
if ( !$role_editor->has_cap('edit_theme_options') ) {	$role_editor->add_cap('edit_theme_options');	}
if ( !$role_editor->has_cap('wpseo_manage_options') ) {	$role_editor->add_cap('wpseo_manage_options');	}
if ( !$role_editor->has_cap('wpseo_manage_options_capability') ) { $role_editor->add_cap('wpseo_manage_options_capability');	}
add_filter( 'ninja_forms_admin_parent_menu_capabilities', function() { return 'edit_posts'; } );
add_filter( 'ninja_forms_admin_all_forms_capabilities', function() { return 'edit_posts'; } );
add_filter( 'ninja_forms_admin_submissions_capabilities', function() { return 'edit_posts'; } );

/**
 * Change capabilities for editors
 */
$user = wp_get_current_user();
if ( in_array( 'editor', $user->roles ) ) {
  add_action( 'admin_menu', function() {
    remove_menu_page( 'tools.php' );
		remove_menu_page( 'monsterinsights_settings' );
    remove_submenu_page( 'customize.php', 'themes.php' );
    remove_submenu_page( 'themes.php', 'themes.php' );

		// no default way to remove/hide customizer, so this 'hack' works:
		global $submenu;
		if ( isset( $submenu[ 'themes.php' ] ) ) {
			foreach ( $submenu[ 'themes.php' ] as $index => $menu_item ) {
				foreach ($menu_item as $value) {
					if (strpos($value,'customize') !== false) {
						unset( $submenu[ 'themes.php' ][ $index ] );
					}
				}
			}
		}
  });

  add_action( 'admin_head', function() {
    // @TODO: remove unneeded meta boxes (or Gutenberg blocks) here
  });

  add_action( 'admin_bar_menu', function($admin_bar_menu) {
  	$admin_bar_menu->remove_node( 'comments' );
  	$admin_bar_menu->remove_node( 'updates' );
  	return $admin_bar_menu;
  });
}
