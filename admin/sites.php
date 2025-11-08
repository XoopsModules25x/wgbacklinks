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

use Xmf\Request;

include __DIR__ . '/header.php';

// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
// Request site_id
$siteId = Request::getInt('site_id');

switch ($op) {
    case 'share':
        $templateMain = 'wgbacklinks_admin_shares.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('sites.php'));
        $adminMenu->addItemButton(\_AM_WGBACKLINKS_SITES_LIST, 'sites.php?op=list', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
        $clientsCount = $clientsHandler->getCountClients();
        $clientsAll = $clientsHandler->getAllClients();
        $GLOBALS['xoopsTpl']->assign('clients_count', $clientsCount);
        $GLOBALS['xoopsTpl']->assign('wgbacklinks_url', \WGBACKLINKS_URL);
        $GLOBALS['xoopsTpl']->assign('wgbacklinks_upload_url', \WGBACKLINKS_UPLOAD_URL);
        $shared = [];
        // Table view clients
        if ($clientsCount > 0) {

            foreach (\array_keys($clientsAll) as $i) {
                $client = $clientsAll[$i]->getValuesClients();
                // share all sites with this client
                $sitesCount = $sitesHandler->getCountSites();
                $sitesAll = $sitesHandler->getAllSites();
                $GLOBALS['xoopsTpl']->assign('sites_count', $sitesCount);
                
                // Table view sites
                if ($sitesCount > 0) {

                    foreach (\array_keys($sitesAll) as $j) {
                        $site = $sitesAll[$j]->getValuesSites();
                        // execute data exchange
                        $result = $sitesHandler->shareSite($site, $client);
                        if ($result == 'updated ' . $client['client_key']) {
                            $result_text = \str_replace('%s', $site['site_name'], \_AM_WGBACKLINKS_SHARE_RESULT_UPDATED);
                            $image_success = '<img src="' . \WGBACKLINKS_ICONS_URL . '/16/ok.png" alt="' . $result_text . '">';
                        } else if ($result == 'added ' . $client['client_key']) { 
                            $result_text = \str_replace('%s', $site['site_name'], \_AM_WGBACKLINKS_SHARE_RESULT_ADDED);
                            $image_success = '<img src="' . \WGBACKLINKS_ICONS_URL . '/16/ok.png" alt="' . $result_text . '">';
                        } else if ($result == 'skipped ' . $client['client_key']) { 
                            $result_text = \str_replace('%s', $site['site_name'], \_AM_WGBACKLINKS_SHARE_RESULT_SKIPPED);
                            $image_success = '<img src="' . \WGBACKLINKS_ICONS_URL . '/16/ok.png" alt="' . $result_text . '">';
                        } else if ($result == 'deleted ' . $client['client_key']) { 
                            $result_text = \str_replace('%s', $site['site_name'], \_AM_WGBACKLINKS_SHARE_RESULT_DELETED);
                            $image_success = '<img src="' . \WGBACKLINKS_ICONS_URL . '/16/ok.png" alt="' . $result_text . '">';
                        } else {
                            $result_text = \_AM_WGBACKLINKS_SHARE_RESULT_FAILED . ': ' . $result;
                            $image_success = '<img src="' . \WGBACKLINKS_ICONS_URL . '/16/failed.png" alt="' . $result_text . '">';
                        }
                        $shared[]['result'] = $image_success . $result_text;
                        
                        $sitesObj = $sitesHandler->get($site['site_id']);
                        // Set Vars
                        $sitesObj->setVar('site_shared', '1');
                        // Insert Data
                        $res_update = $sitesHandler->insert($sitesObj);                        
                        unset($sitesObj);
                        unset($site);
                    }
                } else {
                    $GLOBALS['xoopsTpl']->assign('error', \_AM_WGBACKLINKS_THEREARENT_SITES);
                }
                $client['shared'] = $shared;
                $GLOBALS['xoopsTpl']->append('clients_list', $client);
                unset($client);
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGBACKLINKS_THEREARENT_SITES);
        }

        break;
    
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $start = Request::getInt('start');
        $limit = Request::getInt('limit', $helper->getConfig('adminpager'));
        $templateMain = 'wgbacklinks_admin_sites.tpl';
        $sitesCount = $sitesHandler->getCountSites();
        
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('sites.php'));
        $adminMenu->addItemButton(\_AM_WGBACKLINKS_ADD_SITE, 'sites.php?op=new');
        if ($sitesCount > 0 && $helper->getConfig('wgbacklinks_modtype') == \WGBACKLINKS_MODTYPE_1) {
            $adminMenu->addItemButton(\_AM_WGBACKLINKS_SITES_SHARE, 'sites.php?op=share', 'database_go');
        }
        $GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
        
        $sitesAll = $sitesHandler->getAllSites($start, $limit);
        $GLOBALS['xoopsTpl']->assign('sites_count', $sitesCount);
        $GLOBALS['xoopsTpl']->assign('wgbacklinks_url', \WGBACKLINKS_URL);
        $GLOBALS['xoopsTpl']->assign('wgbacklinks_upload_url', \WGBACKLINKS_UPLOAD_URL);
        $GLOBALS['xoopsTpl']->assign('moduletype', $helper->getConfig('wgbacklinks_modtype'));
        // Table view sites
        if ($sitesCount > 0) {
            foreach (\array_keys($sitesAll) as $i) {
                $site = $sitesAll[$i]->getValuesSites();
                $GLOBALS['xoopsTpl']->append('sites_list', $site);
                unset($site);
            }
            // Display Navigation
            if ($sitesCount > $limit) {
                include_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($sitesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
            
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGBACKLINKS_THEREARENT_SITES);
        }

    break;
    case 'new':
        $templateMain = 'wgbacklinks_admin_sites.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('sites.php'));
        $adminMenu->addItemButton(\_AM_WGBACKLINKS_SITES_LIST, 'sites.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
        // Get Form
        $sitesObj = $sitesHandler->create();
        $form = $sitesObj->getFormSites();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

    break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('sites.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($siteId)) {
            $sitesObj = $sitesHandler->get($siteId);
        } else {
            $sitesObj = $sitesHandler->create();
        }
        // Set Vars
        $sitesObj->setVar('site_name', Request::getString('site_name'));
        $sitesObj->setVar('site_descr', Request::getString('site_descr'));
        $sitesObj->setVar('site_url', Request::getString('site_url'));
        $sitesObj->setVar('site_uniqueid', Request::getString('site_uniqueid', \md5(\substr(str_shuffle("!$%&/=?_-;:,.0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50))));
        $sitesObj->setVar('site_active', Request::getInt('site_active'));
        $sitesObj->setVar('site_shared', '0');
        $sitesObj->setVar('site_submitter', Request::getInt('site_submitter'));
        $sitesObj->setVar('site_date_created', \strtotime(Request::getString('site_date_created')));
        
        // Insert Data
        if ($sitesHandler->insert($sitesObj)) {
            \redirect_header('sites.php?op=list', 2, \_AM_WGBACKLINKS_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $sitesObj->getHtmlErrors());
        $form = $sitesObj->getFormSites();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

    break;
    case 'activate':
        $sitesObj = $sitesHandler->get($siteId);
        $sitesObj->setVar('site_active', $_REQUEST['new_site_active']);
        $sitesObj->setVar('site_shared', '0');
        // Insert Data
        if ($sitesHandler->insert($sitesObj)) {
            \redirect_header('sites.php?op=list', 2, \_AM_WGBACKLINKS_FORM_OK);
        }
        $GLOBALS['xoopsTpl']->assign('error', $sitesObj->getHtmlErrors());
    break;
    case 'edit':
        $templateMain = 'wgbacklinks_admin_sites.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('sites.php'));
        $adminMenu->addItemButton(\_AM_WGBACKLINKS_ADD_SITE, 'sites.php?op=new');
        $adminMenu->addItemButton(\_AM_WGBACKLINKS_SITES_LIST, 'sites.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
        // Get Form
        $sitesObj = $sitesHandler->get($siteId);
        $form = $sitesObj->getFormSites();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

    break;
    case 'delete':
        $sitesObj = $sitesHandler->get($siteId);
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('sites.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($sitesHandler->delete($sitesObj)) {
                \redirect_header('sites.php', 3, \_AM_WGBACKLINKS_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $sitesObj->getHtmlErrors());
            }
        } else {
            xoops_confirm(array('ok' => 1, 'site_id' => $siteId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], \sprintf(\_AM_WGBACKLINKS_FORM_SURE_DELETE, $sitesObj->getVar('site_name')));
        }

    break;
}
include __DIR__ . '/footer.php';
