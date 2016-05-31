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
 * @version        $Id: 1.0 main.php 1 Thu 2016-05-05 08:16:10Z Wedega - Webdesign Gabor $
 */
// ---------------- Main ----------------
define('_MA_WGBACKLINKS_INDEX', "Home");
define('_MA_WGBACKLINKS_TITLE', "wgBacklinks");
define('_MA_WGBACKLINKS_DESC', "This module is adding and updating backlinks to your websites. The administration will be done by central website.");
define('_MA_WGBACKLINKS_INDEX_DESC', "wgBacklinks, your Xoops-Module for admin your backlinks - provides by Wedega Webdesign Gabor (wedega. com)");

// ---------------- Contents ----------------
// Caption of Site
define('_MA_WGBACKLINKS_SITE_NAME', "Name");
define('_MA_WGBACKLINKS_SITE_URL', "Link to website");
define('_MA_WGBACKLINKS_SITE_DESCR', "Additional information");
// Admin link
define('_MA_WGBACKLINKS_ADMIN', "Admin");

// Elements of exchange-data
define('_MA_WGBACKLINKS_EXCHANGE_ERR_ADD_SITE', "Error: adding site '%s' to table site failed");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_DELETE_SITE', "Error: deleting site '%s' from table site failed");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_CKEY', "Error: invalid client key");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_PKEY', "Error: invalid provider key");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_ADD_PROVIDER', "Error when adding provider '%p' to client '%c'.<br/>Error: %e");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_DEL_PROVIDER', "Error when deleting provider '%p' from client '%c'.<br/>Error: %e");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_ADD_CLIENT', "Error when adding client '%c' to provider '%p'.<br/>Error: %e");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_DEL_CLIENT', "Error when deleting client '%c' from provider '%p'.<br/>Error: %e");

// ---------------- End ----------------