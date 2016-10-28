<?php
/**
 * http://nginxlibrary.com/enable-directory-listing/
 * Example http://animorphsfanforum.com/fanart/2064/
 *
 */
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

use  GuzzleHttp\Client;
use Schmiddim\Nginx\DirectoryListing\Parse;

//download list
$releaseUrl = 'http://milhouse.libreelec.tv/builds/master/RPi2/';
$client = new Client([
	'base_uri' => $releaseUrl
]);
$r = $client->request('GET');
$parse = new Parse($releaseUrl, (string)$r->getBody());
$items = $parse->getItems();



function getLatestReleaseFromList($items, DateTime $date)
{
	#http://milhouse.libreelec.tv/builds/master/RPi2/LibreELEC-RPi2.arm-8.0-Milhouse-20161027210429-%231027-g43e4f93.tar
	$y = $date->format('Y');
	$m = $date->format('m');
	$d = $date->format('d');
	foreach ($items as $item) {
		if (preg_match_all("/$y$m$d/", $item)) {
			return $item;
		}
	}
	return getLatestReleaseFromList($items, $date->sub(new DateInterval('P1D')));


}
$datetime = new DateTime();
echo getLatestReleaseFromList($items, new \DateTime());
echo PHP_EOL;


