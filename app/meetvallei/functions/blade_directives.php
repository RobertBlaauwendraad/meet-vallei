<?php

namespace App;

use Roots\Sage\Container;

add_action('after_setup_theme', function () {

	/*
	 * php var_dump() function.
	 *
	 * Usage: @var_dump($variableToDump)
	 */
	sage('blade')->compiler()->directive('varDump', function ($expression) {
		return "<?php var_dump(with{$expression}); ?>";
	});

	/*
	 * Usage: @svg($fileName, $filePath);
	 *
	 * @default $filePath = 'images/icons'
	 */
	 sage('blade')->compiler()->directive('svg', function ($expression) {
		 $file = stripExpression($expression);

		 // Check if path exists
		 if (!isset($file[1]) || (isset($file[1]) && $file[1] == '')) $file[1] = 'images/icons';

		 // Check if file exists
		 if (empty($file[0])) return false;

		 return "<?= file_get_contents(App\asset_path('{$file[1]}/{$file[0]}.svg')); ?>";
	 });

});

/**
 * Register component aliases.
 */
add_action('after_setup_theme', function () {
    $template_directory = "views/components/";
    $path = get_stylesheet_directory() . '/' . $template_directory;

    if (!is_dir($path)) {
        return;
    }
    $dir = new \DirectoryIterator(\locate_template($template_directory));

    foreach ($dir as $fileinfo) {
        if ($fileinfo->isDot()) {
            continue;
        }
        $slug = str_replace('.blade.php', '', $fileinfo->getFilename());
        $alias = preg_replace('/[^\da-z]/i', '', $slug);
        sage('blade')->compiler()->component("components.$slug", $alias);
    }
});
