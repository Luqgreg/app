<?php
/**
 * PageShare
 *
 * @author Bartosz "V." Bentkowski
 */

$wgExtensionCredits[ 'specialpage' ][] = [
	'name' => 'PageShare',
	'author' => 'Bartosz "V." Bentkowski',
	'url' => 'https://github.com/Wikia/app/tree/dev/extensions/wikia/PageShare',
	'version' => 1
];


//i18n

// controller classes
$wgAutoloadClasses[ 'PageShareController' ] =  __DIR__ . '/PageShareController.class.php';
$wgAutoloadClasses[ 'PageShareHelper' ] =  __DIR__ . '/PageShareHelper.class.php';
$wgAutoloadClasses[ 'PageShareHooks' ] =  __DIR__ . '/PageShareHooks.class.php';

$wgHooks['AfterPageHeaderButtons'][] = 'PageShareHooks::onAfterPageHeaderButtons';
