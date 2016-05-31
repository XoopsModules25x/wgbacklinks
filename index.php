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
 * @version        $Id: 1.0 index.php 1 Thu 2016-05-05 08:16:10Z Wedega - Webdesign Gabor $
 */
include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgbacklinks_index.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );
$keywords = array();
// 
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wgbacklinks_url', WGBACKLINKS_URL);
// 
$crit_sites = new CriteriaCompo();
$crit_sites->add(new Criteria('site_active', 1));
$sitesCount = $sitesHandler->getCount($crit_sites);

if($sitesCount > 0) {
	$sitesAll = $sitesHandler->getall($crit_sites);
	// Get All Sites
	$sites = array();
	foreach(array_keys($sitesAll) as $i) {
		$sites[] = $sitesAll[$i]->getValuesSites();
        $keywords[] = $sitesAll[$i]->getVar('site_name');
        $keywords[] = $sitesAll[$i]->getVar('site_desc');
        $keywords[] = $sitesAll[$i]->getVar('site_url');
	}
	$GLOBALS['xoopsTpl']->assign('sites', $sites);
	unset($sites);
}

$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
// Keywords
wgbacklinksMetaKeywords($wgbacklinks->getConfig('keywords').', '. implode(',', $keywords));
unset($keywords);
// Description
wgbacklinksMetaDescription(_MA_WGBACKLINKS_INDEX_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGBACKLINKS_URL.'/index.php');

include __DIR__ . '/footer.php';
