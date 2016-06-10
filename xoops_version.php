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
 * @version        $Id: 1.0 xoops_version.php 1 Thu 2016-05-05 08:16:11Z Wedega - Webdesign Gabor $
 */

// 
$dirname  = basename(__DIR__);
// ------------------- Informations ------------------- //
$modversion['name']                 = _MI_WGBACKLINKS_NAME;
$modversion['version']              = '1.00';
$modversion['description']          = _MI_WGBACKLINKS_DESC;
$modversion['author']               = 'Goffy - Wedega.com';
$modversion['author_mail']          = 'webmaster@wedega.com';
$modversion['author_website_url']   = 'http://wedega.com';
$modversion['author_website_name']  = 'Wedega - Webdesign Gabor';
$modversion['credits']              = 'Wedega - Webdesign Gabor';
$modversion['license']              = 'GPL 2.0 or later';
$modversion['license_url']          = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['help']                 = 'page=help';
$modversion['release_info']         = 'release_info';
$modversion['release_file']         = XOOPS_URL . '/modules/wgbacklinks/docs/release_info file';
$modversion['release_date']         = '05.05.2016';
$modversion['manual']               = 'link to manual file';
$modversion['manual_file']          = XOOPS_URL . '/modules/wgbacklinks/docs/install.txt';
$modversion['min_php']              = '5.3';
$modversion['min_xoops']            = '2.5.7';
$modversion['min_admin']            = '1.1';
$modversion['min_db']               = array('mysql' => '5.0.7', 'mysqli' => '5.0.7');
$modversion['image']                = 'assets/images/wgbacklinks_logo.png';
$modversion['dirname']              = basename(__DIR__);
$modversion['dirmoduleadmin']       = 'Frameworks/moduleclasses/moduleadmin';
$modversion['sysicons16']           = '../../Frameworks/moduleclasses/icons/16';
$modversion['sysicons32']           = '../../Frameworks/moduleclasses/icons/32';
$modversion['modicons16']           = 'assets/icons/16';
$modversion['modicons32']           = 'assets/icons/32';
$modversion['demo_site_url']        = 'http://xoops.wedega.com';
$modversion['demo_site_name']       = 'XOOPS on Wedega';
$modversion['support_url']          = 'http://xoops.wedega.com';
$modversion['support_name']         = '';
$modversion['module_website_url']   = 'http://xoops.wedega.com';
$modversion['module_website_name']  = 'XOOPS on Wedega';
$modversion['release']              = '2016-02-03';
$modversion['module_status']        = 'Alpha 1';
$modversion['system_menu']          = 1;
$modversion['hasAdmin']             = 1;
$modversion['hasMain']              = 0;
$modversion['adminindex']           = 'admin/index.php';
$modversion['adminmenu']            = 'admin/menu.php';
$modversion['onInstall']            = 'include/install.php';
$modversion['onUpdate']             = 'include/update.php';
// ------------------- Templates ------------------- //
// Admin
$modversion['templates'][] = array('file' => 'wgbacklinks_admin_about.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgbacklinks_admin_header.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgbacklinks_admin_index.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgbacklinks_admin_providers.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgbacklinks_admin_sites.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgbacklinks_admin_shares.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgbacklinks_admin_clients.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgbacklinks_admin_footer.tpl', 'description' => '', 'type' => 'admin');
// User
$modversion['templates'][] = array('file' => 'wgbacklinks_header.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgbacklinks_index.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgbacklinks_footer.tpl', 'description' => '');
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'][1] = 'wgbacklinks_providers';
$modversion['tables'][2] = 'wgbacklinks_sites';
$modversion['tables'][3] = 'wgbacklinks_clients';
// ------------------- Blocks ------------------- //

// ------------------- Config ------------------- //
$c = 1;
// Keywords
$modversion['config'][$c]['name']        = 'keywords';
$modversion['config'][$c]['title']       = '_MI_WGBACKLINKS_KEYWORDS';
$modversion['config'][$c]['description'] = '_MI_WGBACKLINKS_KEYWORDS_DESC';
$modversion['config'][$c]['formtype']    = 'textbox';
$modversion['config'][$c]['valuetype']   = 'text';
$modversion['config'][$c]['default']     = 'wgbacklinks, wedega, webdesign gabor';
++$c;
// Admin pager
$modversion['config'][$c]['name']        = 'adminpager';
$modversion['config'][$c]['title']       = '_MI_WGBACKLINKS_ADMIN_PAGER';
$modversion['config'][$c]['description'] = '_MI_WGBACKLINKS_ADMIN_PAGER_DESC';
$modversion['config'][$c]['formtype']    = 'textbox';
$modversion['config'][$c]['valuetype']   = 'int';
$modversion['config'][$c]['default']     = 10;
++$c;
// Module type
include_once XOOPS_ROOT_PATH . '/modules/wgbacklinks/include/common.php';
$modversion['config'][$c]['name']        = 'wgbacklinks_modtype';
$modversion['config'][$c]['title']       = '_MI_WGBACKLINKS_MODTYPE';
$modversion['config'][$c]['description'] = '_MI_WGBACKLINKS_MODTYPE_DESC';
$modversion['config'][$c]['formtype']    = 'select';
$modversion['config'][$c]['valuetype']   = 'int';
$modversion['config'][$c]['default']     = 1;
$modversion['config'][$c]['options']     = array('_MI_WGBACKLINKS_MODTYPE_1' => WGBACKLINKS_MODTYPE_1, '_MI_WGBACKLINKS_MODTYPE_2' => WGBACKLINKS_MODTYPE_2);
++$c;
// Unique Key for this module
$modversion['config'][$c]['name']        = 'wgbacklinks_modkey';
$modversion['config'][$c]['title']       = '_MI_WGBACKLINKS_MODKEY';
$modversion['config'][$c]['description'] = '_MI_WGBACKLINKS_MODKEY_DESC';
$modversion['config'][$c]['formtype']    = 'textbox';
$modversion['config'][$c]['valuetype']   = 'text';
$modversion['config'][$c]['default']     = md5(substr(str_shuffle("!$%&/=?_-;:,.0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50));
++$c;
// Maintained by
$modversion['config'][$c]['name']        = 'maintainedby';
$modversion['config'][$c]['title']       = '_MI_WGBACKLINKS_MAINTAINEDBY';
$modversion['config'][$c]['description'] = '_MI_WGBACKLINKS_MAINTAINEDBY_DESC';
$modversion['config'][$c]['formtype']    = 'textbox';
$modversion['config'][$c]['valuetype']   = 'text';
$modversion['config'][$c]['default']     = 'http://xoops.wedega.com';
unset($c);
