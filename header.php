<?php
declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgBacklinks module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wgbacklinks
 * @author         Goffy - Wedega.com - Email:<webmaster@wedega.com> - Website:<http://wedega.com>
 */

use XoopsModules\Wgbacklinks\Helper;

include dirname(__DIR__, 2) . '/mainfile.php';
include __DIR__ . '/include/common.php';
$dirname  = \basename(__DIR__);
// Breadcrumbs
$xoBreadcrumbs = array();
$xoBreadcrumbs[] = array('title' => $GLOBALS['xoopsModule']->getVar('name'), 'link' => \WGBACKLINKS_URL . '/');
// Get instance of module
$helper = Helper::getInstance();
$providersHandler = $helper->getHandler('Providers');
$sitesHandler     = $helper->getHandler('Sites');
$clientsHandler   = $helper->getHandler('Clients');
// Permission
include_once \XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
$gpermHandler = xoops_gethandler('groupperm');
if(\is_object($xoopsUser)) {
	$groups  = $xoopsUser->getGroups();
} else {
	$groups  = \XOOPS_GROUP_ANONYMOUS;
}
// 
$myts = MyTextSanitizer::getInstance();
// Default Css Style
$style = \WGBACKLINKS_URL . '/assets/css/style.css';
if(!\file_exists($style)) {
	return false;
}
// Smarty Default
$sysPathIcon16 = $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32 = $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16 = $GLOBALS['xoopsModule']->getInfo('modicons16');
$modPathIcon32 = $GLOBALS['xoopsModule']->getInfo('modicons16');
// Load Languages
\xoops_loadLanguage('main');
\xoops_loadLanguage('modinfo');
