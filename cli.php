<?php
// Requiring composer autoloader (local or global)
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

$releaseUrl='http://milhouse.libreelec.tv/builds/master/RPi2/';



use  GuzzleHttp\Client;
use Schmiddim\Nginx\DirectoryListing\Parse;

$client = new Client([
	// Base URI is used with relative requests
	'base_uri' => $releaseUrl
	// You can set any number of default request options.
]);

$r = $client->request('GET');

$breka = (string)$r->getBody();

return;