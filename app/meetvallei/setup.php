<?php

/**
 * Activate/deactive default theme functions
 */

$MeetVallei = [
  // Must have
  'helpers',
  'actions',
  'filters',

  // Could have
  'admin/login',
  'admin/dashboard',
  'admin/capabilities',

  // Extras
  'functions/disable_comments',
  'functions/autocomplete',
  'functions/blade_directives',
  'functions/users',
  'functions/profiel',
  'post-types/product',
  'taxonomies/productgroep',

  // ACF groups
  'acf/init', // initialize options page
  'acf/actions', // hook wp functions to include acf fields

  // Gutenberg @see https://github.com/MWDelaney/sage-acf-wp-blocks
  'gutenberg/sage-acf-gutenberg-blocks', // overwrite of MWdelaney composer package for registering custom ACF block
  'gutenberg/categories', // register custom block category
  'gutenberg/colors', // custom gutenberg colors
];

array_map(function ($file) {
  $file = "../app/meetvallei/{$file}.php";
  if (!locate_template($file, true, true)) {
    echo sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file);
  }
}, $MeetVallei);
