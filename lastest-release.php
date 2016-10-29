<?php
/**
 * http://nginxlibrary.com/enable-directory-listing/
 * Example http://animorphsfanforum.com/fanart/2064/
 *
 */
// Requiring composer autoloader (local or global)
use Schmiddim\Nginx\DirectoryListing\Parser\LibreElecTv;


foreach ([__DIR__ . '/../../autoload.php', __DIR__ . '/vendor/autoload.php'] as $file) {
	if (file_exists($file)) {
		define('COMPOSER_AUTOLOADER', $file);
		break;
	}
}
if (!defined('COMPOSER_AUTOLOADER')) {
	die(
		'You need to set up the project dependencies using the following commands:' . PHP_EOL .
		'php -r "readfile(\'https://getcomposer.org/installer\');" | php' . PHP_EOL .
		'php composer.phar install' . PHP_EOL
	);
}
require COMPOSER_AUTOLOADER;


$parse = new LibreElecTv();
echo $parse->getLatestReleaseFromList();
echo PHP_EOL;


