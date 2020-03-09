<?php

// Remove plugin update count for admins
add_action('admin_head', function () {
	$current_user = wp_get_current_user();
	if ($current_user->user_login !== 'suite7') {
		?>
		<style>
			/* plugin update count */
			#adminmenu li span.update-plugins,
			li#wp-admin-bar-updates,
			li#wp-admin-bar-comments,
			/* yoast widget box section */
			#wpseo-dashboard-overview #yoast-seo-ryte-assessment,
			#wpseo-dashboard-overview .wordpress-feed {
				display: none !important;
			}
		</style>
		<?php
	}
});

// Remove yoast widget box section
add_action('admin_head', function () {
	?>
	<style>
		#wpseo-dashboard-overview #yoast-seo-ryte-assessment,
		#wpseo-dashboard-overview .wordpress-feed {
			display: none !important;
		}
	</style>
	<?php
});

// Removes dashboard widgets
add_action('wp_dashboard_setup', function() {
	global $wp_meta_boxes;

	$current_user = wp_get_current_user();
	if ($current_user->user_login !== 'suite7') {
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
		unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
		// unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
		// unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
		// unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
		// unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
		// unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts'] );
		// unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
		// unset( $wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview'] );

		remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal' );
		remove_action('welcome_panel', 'wp_welcome_panel');
		// remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
	}
});
