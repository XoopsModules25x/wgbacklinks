<?php
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
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         Goffy - Wedega.com - Email:<webmaster@wedega.com> - Website:<http://wedega.com>
 * @version        $Id: 1.0 header.php 1 Thu 2016-05-05 08:16:09Z Wedega - Webdesign Gabor $
 */
include dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
include_once dirname(__DIR__) . '/include/common.php';
$sysPathIcon16    = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32    = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin  = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16    = $GLOBALS['xoopsModule']->getInfo('modicons16');
$modPathIcon32    = $GLOBALS['xoopsModule']->getInfo('modicons32');
// Get instance of module
$wgbacklinks      = WgbacklinksHelper::getInstance();
$providersHandler = $wgbacklinks->getHandler('providers');
$sitesHandler     = $wgbacklinks->getHandler('sites');
$clientsHandler   = $wgbacklinks->getHandler('clients');
$myts = MyTextSanitizer::getInstance();
// 
if(!isset($xoopsTpl) || !is_object($xoopsTpl)) {
include_once XOOPS_ROOT_PATH . '/class/template.php';
	$xoopsTpl = new XoopsTpl();
}
// System icons path
$GLOBALS['xoopsTpl']->assign('sysPathIcon16', $sysPathIcon16);
$GLOBALS['xoopsTpl']->assign('sysPathIcon32', $sysPathIcon32);
$GLOBALS['xoopsTpl']->assign('modPathIcon16', $modPathIcon16);
$GLOBALS['xoopsTpl']->assign('modPathIcon32', $modPathIcon32);
// Load languages
xoops_loadLanguage('admin');
xoops_loadLanguage('modinfo');
// Local admin menu class
if(file_exists($GLOBALS['xoops']->path($pathModuleAdmin . '/moduleadmin.php'))) {
    include_once $GLOBALS['xoops']->path($pathModuleAdmin . '/moduleadmin.php');
} else {
    redirect_header('../../../admin.php.php', 5, _AM_MODULEADMIN_MISSING);
}
xoops_cp_header();
$adminMenu = new ModuleAdmin();
$style = WGBACKLINKS_URL . '/assets/css/admin/style.css';
