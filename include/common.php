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
if (!\defined('XOOPS_ICONS32_PATH')) \define('XOOPS_ICONS32_PATH', \XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
if (!\defined('XOOPS_ICONS32_URL')) \define('XOOPS_ICONS32_URL', \XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
\define('WGBACKLINKS_DIRNAME', 'wgbacklinks');
\define('WGBACKLINKS_PATH', \XOOPS_ROOT_PATH.'/modules/'.\WGBACKLINKS_DIRNAME);
\define('WGBACKLINKS_URL', \XOOPS_URL.'/modules/'.\WGBACKLINKS_DIRNAME);
\define('WGBACKLINKS_ICONS_PATH', \WGBACKLINKS_PATH.'/assets/icons');
\define('WGBACKLINKS_ICONS_URL', \WGBACKLINKS_URL . '/assets/icons');
\define('WGBACKLINKS_IMAGE_PATH', \WGBACKLINKS_PATH.'/assets/images');
\define('WGBACKLINKS_IMAGE_URL', \WGBACKLINKS_URL . '/assets/images');
\define('WGBACKLINKS_UPLOAD_PATH', XOOPS_UPLOAD_PATH . '/'.\WGBACKLINKS_DIRNAME);
\define('WGBACKLINKS_UPLOAD_URL', XOOPS_UPLOAD_URL.'/'.\WGBACKLINKS_DIRNAME);
\define('WGBACKLINKS_ADMIN', \WGBACKLINKS_URL . '/admin/index.php');
$local_logo = \WGBACKLINKS_IMAGE_URL . '/wedega.png';

// constants for module type
\define('WGBACKLINKS_MODTYPE_1', 1); //provider
\define('WGBACKLINKS_MODTYPE_2', 2); //client

// module information
$copyright = "<a href='https://wedega.com' title='Wedega - Webdesign Gabor' target='_blank'>
                     <img src='".$local_logo."' alt='Wedega - Webdesign Gabor' style='height:50px'/></a>";

include_once \WGBACKLINKS_PATH.'/include/functions.php';