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
/**
 * @param      $module
 * @return bool|null
 */
function xoops_module_update_wgbacklinks($module/*, $prev_version = null*/)
{

    /*
    if ($prev_version < 10) {
        $ret = update_wgbacklinks_v10($module);
    }*/
    $errors = $module->getErrors();
    if (!empty($errors)) {
        print_r($errors);
    }

    return null;
}
