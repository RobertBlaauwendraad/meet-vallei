<?php

namespace App;

/**
 * Add extra optional css/js
 */
add_action('wp_enqueue_scripts', function () {
	if (basename(get_page_template()) == "template-contact.blade.php") { // only load google maps on contact page
		wp_enqueue_script(
				'meetvallei/googlemaps',
				'https://maps.googleapis.com/maps/api/js?key=AIzaSyA73hAl_rUEa7pfIicVdRNOIls-FDxHorw', //@TODO: change default API key to client-key
				null,
				true
		);
	}
	if(get_field('cookiebanner', 'options')) {
		wp_enqueue_script('sage/cookies/lib/js', 'https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js', [], null, false);
	  wp_enqueue_style('sage/cookies/lib/css', 'https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css',false, null);
	}
	//wp_enqueue_style('googlefont_oswald', 'https://fonts.googleapis.com/css?family=Oswald:700', false, null );
}, 100);

/**
 * Insert google maps api key for ACF backend
 */
add_action('acf/init', function () {
	acf_update_setting('google_api_key', 'AIzaSyA73hAl_rUEa7pfIicVdRNOIls-FDxHorw'); //@TODO: change default API key to client-key
});

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {

	// Soil features, see: https://roots.io/plugins/soil/
    add_theme_support('soil-clean-up');
    add_theme_support('soil-disable-trackbacks');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-relative-urls');
    // add_theme_support('soil-disable-rest-api');
	remove_theme_support('soil-jquery-cdn');
    remove_theme_support('soil-nice-search');
    remove_theme_support('soil-js-to-footer');
    // add_theme_support('soil-disable-asset-versioning');
	// add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');
	
	// Gutenberg theme features
	remove_theme_support('wp-block-styles'); // 2.2kb

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Hoofdmenu', 'meetvallei')
    ]);

	// see https://developer.wordpress.org/reference/functions/add_image_size/
	add_image_size('meetvallei_large', 1920, 9999);

	add_post_type_support( 'page', 'excerpt' );
}, 20);

/**
 * Widgets init
 */
add_action('widgets_init', function () {
  // unregister default sage sidebars
  unregister_sidebar('sidebar-primary');
  unregister_sidebar('sidebar-footer');

	$config = [
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
	];
	register_sidebar([
			'name'          => __('Footer kolom 1', 'meetvallei'),
			'id'            => 'footer-col-1'
	] + $config);
	register_sidebar([
			'name'          => __('Footer kolom 2', 'meetvallei'),
			'id'            => 'footer-col-2'
	] + $config);
	register_sidebar([
			'name'          => __('Footer kolom 3', 'meetvallei'),
			'id'            => 'footer-col-3'
	] + $config);
	register_sidebar([
			'name'          => __('Footer kolom 4', 'meetvallei'),
			'id'            => 'footer-col-4'
	] + $config);
});

/**
 * Remove Customizer js from sage
 */
add_action('customize_preview_init', function () {
    wp_dequeue_script('sage/customizer.js');
});

/**
 * Enqueue gutenberg.js in editor
 */
add_action('enqueue_block_editor_assets', function() {
	wp_enqueue_script('sage/gutenberg.js', asset_path('scripts/gutenberg.js'), [ 'wp-dom-ready', 'wp-blocks'], 1, true);
	wp_enqueue_script('sage/flickity.js', asset_path('scripts/flickity.js'), [], 1, true);
});

// dequeue default WP block styles
add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'wp-block-library' ); // 41kb
}, 100 );

// // search for multiple posttypes
// add_action('pre_get_posts', function ($query) {
//     if (is_admin()) {
//         return;
//     }
//     if (is_search() && $query->is_main_query()) {
//         $query->set('post_type', array('page', 'post', 'service'));
//         $query->set('posts_per_page', 20);
//     }
// });
