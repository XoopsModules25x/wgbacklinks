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

// Copy base file
$indexFile = XOOPS_UPLOAD_PATH.'/index.html';
$blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
// Making of uploads/wgbacklinks folder
$wgbacklinks = XOOPS_UPLOAD_PATH.'/wgbacklinks';
if(!\is_dir($wgbacklinks)) {
	\mkdir($wgbacklinks);
	chmod($wgbacklinks, 0777);
}
\copy($indexFile, $wgbacklinks.'/index.html');
// ------------------- Install Footer ------------------- //
