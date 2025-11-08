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

function wgbacklinksMetaKeywords($content): void
{
    global $xoopsTpl, $xoTheme;
    $myts = MyTextSanitizer::getInstance();
    $content = $myts->undoHtmlSpecialChars($myts->displayTarea($content));
    if (isset($xoTheme) && \is_object($xoTheme)) {
        $xoTheme->addMeta('meta', 'keywords', \strip_tags($content));
    } else {    // Compatibility for old Xoops versions
        $xoopsTpl->assign('xoops_meta_keywords', \strip_tags($content));
    }
}

function wgbacklinksMetaDescription($content): void
{
    global $xoopsTpl, $xoTheme;
    $myts = MyTextSanitizer::getInstance();
    $content = $myts->undoHtmlSpecialChars($myts->displayTarea($content));
    if (isset($xoTheme) && \is_object($xoTheme)) {
        $xoTheme->addMeta('meta', 'description', \strip_tags($content));
    } else {    // Compatibility for old Xoops versions
        $xoopsTpl->assign('xoops_meta_description', \strip_tags($content));
    }
}

/**
 * Rewrite all url
 *
 * @String  $module  module name
 * @String  $array   array
 * @param $module
 * @param $array
 * @param string $type
 * @return string $type    string replacement for any blank case
 */
function wgbacklinks_RewriteUrl($module, $array, string $type = 'content'): string
{
    $comment = '';
    $helper = Helper::getInstance();
    $lenght_id = $helper->getConfig('lenght_id');
    $rewrite_url = $helper->getConfig('rewrite_url');

    $id = $array['content_id'];
    if ($lenght_id != 0) {
        while (\strlen($id) < $lenght_id)
            $id = "0" . $id;
    }

    if (isset($array['topic_alias']) && $array['topic_alias']) {
        $topic_name = $array['topic_alias'];
    } else {
        $topic_name = wgbacklinks_Filter(xoops_getModuleOption('static_name', $module));
    }

    switch ($rewrite_url) {

        case 'none':
            if ($topic_name) {
                 $topic_name = 'topic=' . $topic_name . '&amp;';
            }
            $rewrite_base = '/modules/';
            $page = 'page=' . $array['content_alias'];
            return \XOOPS_URL . $rewrite_base . $module . '/' . $type . '.php?' . $topic_name . 'id=' . $id . '&amp;' . $page . $comment;

        case 'rewrite':
            if ($topic_name) {
                $topic_name = $topic_name . '/';
            }
            $rewrite_base = xoops_getModuleOption('rewrite_mode', $module);
            $rewrite_ext = xoops_getModuleOption('rewrite_ext', $module);
            $module_name = '';
            if (xoops_getModuleOption('rewrite_name', $module)) {
                $module_name = xoops_getModuleOption('rewrite_name', $module) . '/';
            }
            $page = $array['content_alias'];
            $type = $type . '/';
            $id = $id . '/';
            if ($type == 'content/') $type = '';

            if ($type == 'comment-edit/' || $type == 'comment-reply/' || $type == 'comment-delete/') {
                return \XOOPS_URL . $rewrite_base . $module_name . $type . $id . '/';
            }

            return \XOOPS_URL . $rewrite_base . $module_name . $type . $topic_name . $id . $page . $rewrite_ext;

        case 'short':
            if ($topic_name) {
                $topic_name = $topic_name . '/';
            }
            $rewrite_base = xoops_getModuleOption('rewrite_mode', $module);
            $rewrite_ext = xoops_getModuleOption('rewrite_ext', $module);
            $module_name = '';
            if (xoops_getModuleOption('rewrite_name', $module)) {
                $module_name = xoops_getModuleOption('rewrite_name', $module) . '/';
            }
            $page = $array['content_alias'];
            $type = $type . '/';
            if ($type == 'content/') $type = '';

            if ($type == 'comment-edit/' || $type == 'comment-reply/' || $type == 'comment-delete/') {
                return \XOOPS_URL . $rewrite_base . $module_name . $type . $id . '/';
            }

            return \XOOPS_URL . $rewrite_base . $module_name . $type . $topic_name . $page . $rewrite_ext;
    }
    return '';
}

/**
 * Replace all escape, character, ... for display a correct url
 *
 * @String  $url    string to transform
 * @String  $type   string replacement for any blank case
 * @param $url
 * @param string $type
 * @return string $url
 */
function wgbacklinks_Filter($url, string $type = ''): string
{

    // Get regular expression from module setting. default setting is : `[^a-z0-9]`i
    $helper = Helper::getInstance();
    $regular_expression = $helper->getConfig('regular_expression');

    $url = \strip_tags($url);
    $url = \preg_replace("`\[.*\]`U", "", $url);
    $url = \preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $url);
    $url = htmlentities($url, ENT_COMPAT, 'utf-8');
    $url = \preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i", "\1", $url);
    $url = \preg_replace(array($regular_expression, "`[-]+`"), "-", $url);
    return ($url == "") ? $type : strtolower(\trim($url, '-'));
}