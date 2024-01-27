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
 * @author         Goffy - Wedega.com - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 */

use XoopsModules\Wgbacklinks\Helper;

$dirname = \basename(\dirname(__DIR__));
$moduleHandler = xoops_gethandler('module');
$xoopsModule = \XoopsModule::getByDirname($dirname);
$moduleInfo = $moduleHandler->get($xoopsModule->getVar('mid'));
$sysPathIcon32 = $moduleInfo->getInfo('sysicons32');

// Get instance of module
$helper = Helper::getInstance();

$i = 1;
$adminmenu[$i]['title'] = \_MI_WGBACKLINKS_ADMENU1;
$adminmenu[$i]['link'] = 'admin/index.php';
$adminmenu[$i]['icon'] = $sysPathIcon32.'/dashboard.png';
if ($helper->getConfig('wgbacklinks_modtype') == \WGBACKLINKS_MODTYPE_1) {
    ++$i;
    $adminmenu[$i]['title'] = \_MI_WGBACKLINKS_ADMENU4;
    $adminmenu[$i]['link'] = 'admin/clients.php';
    $adminmenu[$i]['icon'] = 'assets/icons/32/addlink.png';
}
if ($helper->getConfig('wgbacklinks_modtype') == \WGBACKLINKS_MODTYPE_2) {
    ++$i;
    $adminmenu[$i]['title'] = \_MI_WGBACKLINKS_ADMENU2;
    $adminmenu[$i]['link'] = 'admin/providers.php';
    $adminmenu[$i]['icon'] = 'assets/icons/32/globe.png';
}
++$i;
$adminmenu[$i]['title'] = \_MI_WGBACKLINKS_ADMENU3;
$adminmenu[$i]['link'] = 'admin/sites.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/fileshare.png';
++$i;
$adminmenu[$i]['title'] = \_MI_WGBACKLINKS_ABOUT;
$adminmenu[$i]['link'] = 'admin/about.php';
$adminmenu[$i]['icon'] = $sysPathIcon32.'/about.png';
unset($i);
