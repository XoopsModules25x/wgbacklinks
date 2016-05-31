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
 * @version        $Id: 1.0 index.php 1 Thu 2016-05-05 08:16:09Z Wedega - Webdesign Gabor $
 */
include __DIR__ . '/header.php';
// Count elements
$countProviders = $providersHandler->getCount();
$countSites = $sitesHandler->getCount();
$countClients = $clientsHandler->getCount();
// Template Index
$templateMain = 'wgbacklinks_admin_index.tpl';
// InfoBox Statistics
$adminMenu->addInfoBox(_AM_WGBACKLINKS_STATISTICS);
// Info elements
$adminMenu->addInfoBoxLine(_AM_WGBACKLINKS_STATISTICS, '<label>' . _AM_WGBACKLINKS_THEREARE_PROVIDERS . '</label>', $countProviders);
$adminMenu->addInfoBoxLine(_AM_WGBACKLINKS_STATISTICS, '<label>' . _AM_WGBACKLINKS_THEREARE_SITES . '</label>', $countSites);
$adminMenu->addInfoBoxLine(_AM_WGBACKLINKS_STATISTICS, '<label>' . _AM_WGBACKLINKS_THEREARE_CLIENTS . '</label>', $countClients);
// Upload Folders
$folder = array(
	WGBACKLINKS_UPLOAD_PATH
);
// Uploads Folders Created
foreach(array_keys($folder) as $i) {
	$adminMenu->addConfigBoxLine($folder[$i], 'folder');
	$adminMenu->addConfigBoxLine(array($folder[$i], '777'), 'chmod');
}

// Render Index
$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('index.php'));
$GLOBALS['xoopsTpl']->assign('index', $adminMenu->renderIndex());

// check module_read permission for anonymous
// this permission is necessary for exchange-data.php
$mid = $xoopsModule->getVar('mid');
$gpermHandler =& xoops_gethandler('groupperm');
$permModuleRead = $gpermHandler->checkRight('module_read', $mid, XOOPS_GROUP_ANONYMOUS) ? 1 : 0;
if ($permModuleRead == 0) {
    $sql = "INSERT INTO `" . $xoopsDB->prefix('group_permission') . "` (`gperm_id`, `gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`) VALUES 
    (NULL, '2', '" . $mid . "', '1', 'module_read'), 
    (NULL, '3', '" . $mid . "', '1', 'module_read');";
    $result = $xoopsDB->queryF($sql);
}

include __DIR__ . '/footer.php';
