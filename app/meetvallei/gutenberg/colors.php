<?php

// Disables custom colors in block color palette.
add_theme_support( 'disable-custom-colors' );

// Adds support for editor color palette.
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Wit', 'meetvallei' ),
		'slug'  => 'white',
		'color'	=> '#fff',
	),
	array(
		'name'  => __( 'Zwart', 'meetvallei' ),
		'slug'  => 'black',
		'color'	=> '#000',
	),
	array(
		'name'  => __( 'Primair', 'meetvallei' ),
		'slug'  => 'primary',
		'color'	=> '#94d60a',
	),
));
