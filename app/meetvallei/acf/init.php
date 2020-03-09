<?php

/**
 * ACF config for theme options
 */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'    => __('Thema opties', 'meetvallei'),
		'menu_title'    => __('Themaopties', 'meetvallei'),
		'menu_slug'     => 'theme-general-settings',
		'capability'    => 'edit_posts',
	));

	/*acf_add_options_sub_page(array(
 		'page_title' 	=> __('Thema Home Opties', 'meetvallei'),
 		'menu_title'	=> __('Home', 'meetvallei'),
 		'parent_slug'	=> 'theme-general-settings',
 	));

  acf_add_options_sub_page(array(
 		'page_title' 	=> __('Thema Header Opties', 'meetvallei'),
 		'menu_title'	=> __('Header', 'meetvallei'),
 		'parent_slug'	=> 'theme-general-settings',
 	));

 	acf_add_options_sub_page(array(
 		'page_title' 	=> __('Thema Footer Opties', 'meetvallei'),
 		'menu_title'	=> __('Footer', 'meetvallei'),
 		'parent_slug'	=> 'theme-general-settings',
 	));*/
}
