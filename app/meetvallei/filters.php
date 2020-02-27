<?php

namespace App;

/**
 * Modify end of the excerpt
 */
add_filter('excerpt_more', function () {
  return '';
});


/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    $classes[] = 'suite7';
    return $classes;
});

/**
 * Edit excerpt length
 */
add_filter('excerpt_length', function ($length) {
	return 20; //default 40
});
