<?php

add_action('wp_enqueue_scripts', function () {
	wp_localize_script(
		'sage/main.js', 'autocomplete', array(
			'url' => admin_url('admin-ajax.php')
		)
	);
}, 100);

/**
 * AJAX autocomplete callback
 */
function s7_autocomplete() {
	global $wpdb;
	$json_array = array();

	$keyword = esc_sql( $_GET['query'] );

	$query = "
		SELECT SQL_CALC_FOUND_ROWS wp_posts.ID
		FROM wp_posts
		WHERE 1=1
		AND (((wp_posts.post_title LIKE '%{$keyword}%')
		OR (wp_posts.post_excerpt LIKE '%{$keyword}%')
		OR (wp_posts.post_content LIKE '%{$keyword}%')))
		AND wp_posts.post_type IN ('post', 'page')
		AND (wp_posts.post_status = 'publish'
		OR wp_posts.post_status = 'acf-disabled'
		OR wp_posts.post_author = 1
		AND wp_posts.post_status = 'private')
		ORDER BY wp_posts.post_title LIKE '%{$keyword}%' DESC, wp_posts.post_date DESC
		LIMIT 20
	";
	// Get all the products
	$suggestions = $wpdb->get_results( $query, ARRAY_A );
var_dump('test');
	foreach ( $suggestions as $suggestion ) {
		$item = get_post( $suggestion['ID'] );

		$post_type = get_post_type( $suggestion['ID'] );
		$post_object = get_post_type_object( $post_type );

		$json_array[] = array(
			"value" => $item->post_title,
			"data" => array(
				"post_title" => $item->post_title,
				"permalink" => get_permalink( $suggestion['ID'] ),
				"post_type" => $post_object->labels->singular_name
			)
		);
	}

	$json_arr['suggestions'] = $json_array;
	echo json_encode( $json_arr );
	exit;
}

add_action( 'wp_ajax_s7_autocomplete', __NAMESPACE__ . '\\s7_autocomplete' );
add_action( 'wp_ajax_nopriv_s7_autocomplete', __NAMESPACE__ . '\\s7_autocomplete' );
