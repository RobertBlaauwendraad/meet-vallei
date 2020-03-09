<?php
add_filter( 'block_categories', function ($categories, $post) {
  return array_merge(
		array(
			array(
				'slug' => 'meetvallei',
				'title' => __( 'MeetVallei', 'meetvallei' ),
			),
		),
    $categories
	);
}, 10, 2);
