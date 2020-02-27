<?php

if (function_exists('acf_add_options_page')) {
  add_action( 'wp_head', function() {
    if(get_field('head_scripts', 'option')) {
      echo get_field('head_scripts', 'option');
    }
  }, 1);

  add_action( 'get_header', function() {
    if(get_field('body_scripts', 'option')) {
      echo get_field('body_scripts', 'option');
    }
  });

  add_action( 'wp_footer', function() {
    if(get_field('footer_scripts', 'option')) {
      echo get_field('footer_scripts', 'option');
    }
  }, 100);
};
