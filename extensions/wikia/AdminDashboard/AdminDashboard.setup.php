<?php
/**
 * AdminDashboard
 *
 * @author Hyun Lim
 *
 */

$wgExtensionCredits[ 'specialpage' ][] = [
	'name' => 'Admin Dashboard',
	'author' => 'Wikia',
	'descriptionmsg' => 'admindashboard-desc',
	'url' => 'https://github.com/Wikia/app/tree/dev/extensions/wikia/AdminDashboard',
];

//classes
$wgAutoloadClasses['AdminDashboardSpecialPageController'] =  __DIR__ . '/AdminDashboardSpecialPageController.class.php';
$wgAutoloadClasses['AdminDashboardController'] =  __DIR__ . '/AdminDashboardController.class.php';
$wgAutoloadClasses['AdminDashboardLogic'] =  __DIR__ . '/AdminDashboardLogic.class.php';
$wgAutoloadClasses['QuickStatsController'] =  __DIR__ . '/QuickStatsController.class.php';

// hooks
$wgHooks['BeforeToolbarMenu'][] = 'AdminDashboardLogic::onBeforeToolbarMenu';

// i18n mapping

// special pages
$wgSpecialPages[ 'AdminDashboard'] = 'AdminDashboardSpecialPageController';

// ResourceLoader module
$wgResourceModules['ext.AdminDashboard'] = [
	'messages' => [
		'admindashboard-loading'
	],
];
