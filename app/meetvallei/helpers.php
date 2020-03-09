<?php

namespace App;

use Roots\Sage\Container;

/**
  * Retrieve blade directive input and convert into array
  */
function stripExpression($expression) {
  if( !isset($expression) ) return false;
  
	$array = collect(explode(',', $expression))->map(function($item) {
	  return trim(str_replace("'", '', $item));
	});

	return $array;
}
