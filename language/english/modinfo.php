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
 * @version        $Id: 1.0 modinfo.php 1 Thu 2016-05-05 08:16:09Z Wedega - Webdesign Gabor $
 */
// ---------------- Admin Main ----------------
\define('_MI_WGBACKLINKS_NAME', "wgBacklinks");
\define('_MI_WGBACKLINKS_DESC', "This module is adding and updating backlinks to your websites. The administration will be done by central website.");
// ---------------- Admin Menu ----------------
\define('_MI_WGBACKLINKS_ADMENU1', "Dashboard");
\define('_MI_WGBACKLINKS_ADMENU2', "Providers");
\define('_MI_WGBACKLINKS_ADMENU3', "Sites");
\define('_MI_WGBACKLINKS_ADMENU4', "Clients");
\define('_MI_WGBACKLINKS_ABOUT', "About");
// ---------------- Admin Nav ----------------
\define('_MI_WGBACKLINKS_ADMIN_PAGER', "Admin pager");
\define('_MI_WGBACKLINKS_ADMIN_PAGER_DESC', "Admin per page list");
\define('_MI_WGBACKLINKS_USER_PAGER', 'User pager');
\define('_MI_WGBACKLINKS_USER_PAGER_DESC', 'User per page list');
// User
// Blocks
// Config
\define('_MI_WGBACKLINKS_KEYWORDS', "Keywords");
\define('_MI_WGBACKLINKS_KEYWORDS_DESC', "Insert here the keywords (separate by comma)");
\define('_MI_WGBACKLINKS_MODTYPE', "Module type");
\define('_MI_WGBACKLINKS_MODTYPE_DESC', "Please decide, whether this module should be used as provider or as client");
\define('_MI_WGBACKLINKS_MODTYPE_1', "Provider");
\define('_MI_WGBACKLINKS_MODTYPE_2', "Client");
\define('_MI_WGBACKLINKS_MODKEY', "Unique key");
\define('_MI_WGBACKLINKS_MODKEY_DESC', "Each provider/client needs a unique key to be identified<br/>This key normally is generated  by the module automatically");

// ---------------- End ----------------