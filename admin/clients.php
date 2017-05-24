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
 * @version        $Id: 1.0 clients.php 1 Thu 2016-05-05 08:16:09Z Wedega - Webdesign Gabor $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op       = XoopsRequest::getString('op', 'list');
$clientId = XoopsRequest::getInt('client_id');
$error    = XoopsRequest::getString('error', 'none');


xoops_loadLanguage('main', 'wgbacklinks');

if ($error != 'none') {
    $GLOBALS['xoopsTpl']->assign('error', $error);
}


global $xoopsUser;

switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgbacklinks->getConfig('adminpager'));
		$templateMain = 'wgbacklinks_admin_clients.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('clients.php'));
		$adminMenu->addItemButton(_AM_WGBACKLINKS_ADD_CLIENT, 'clients.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
		$clientsCount = $clientsHandler->getCountClients();
		$clientsAll = $clientsHandler->getAllClients($start, $limit);
		$GLOBALS['xoopsTpl']->assign('clients_count', $clientsCount);
		$GLOBALS['xoopsTpl']->assign('wgbacklinks_url', WGBACKLINKS_URL);
		$GLOBALS['xoopsTpl']->assign('wgbacklinks_upload_url', WGBACKLINKS_UPLOAD_URL);
		// Table view clients
		if($clientsCount > 0) {
			foreach(array_keys($clientsAll) as $i) {
				$client = $clientsAll[$i]->getValuesClients();
                $result = $clientsHandler->checkClientKey($client);
                if ($result == 'valid-client-key') {
                    $image_valid = '<img src="' . WGBACKLINKS_ICONS_URL . '/16/ok.png" alt="' . _AM_WGBACKLINKS_CHECK_KEY_VALID . '">' . _AM_WGBACKLINKS_CHECK_KEY_VALID;
                } else if ($result == 'invalid-client-key'){
                    $image_valid = '<img src="' . WGBACKLINKS_ICONS_URL . '/16/alert.png" alt="' . _AM_WGBACKLINKS_CHECK_KEY_INVALID . '">' . _AM_WGBACKLINKS_CHECK_KEY_INVALID;
                } else {
                    $image_valid = '<img src="' . WGBACKLINKS_ICONS_URL . '/16/alert.png" alt="' . _AM_WGBACKLINKS_CHECK_URL_INVALID . '">' . _AM_WGBACKLINKS_CHECK_URL_INVALID;
                }
                $client['validkey'] = $image_valid;

				$GLOBALS['xoopsTpl']->append('clients_list', $client);
				unset($client);
			}
			// Display Navigation
			if($clientsCount > $limit) {
				include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
				$pagenav = new XoopsPageNav($clientsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _AM_WGBACKLINKS_THEREARENT_CLIENTS);
		}

	break;
	case 'new':
		$templateMain = 'wgbacklinks_admin_clients.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('clients.php'));
		$adminMenu->addItemButton(_AM_WGBACKLINKS_CLIENTS_LIST, 'clients.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
		// Get Form
		$clientsObj = $clientsHandler->create();
		$form = $clientsObj->getFormClients();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('clients.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($clientId)) {
			$clientsObj = $clientsHandler->get($clientId);
		} else {
			$clientsObj = $clientsHandler->create();
		}
		// Set Vars
        $clientsObj->setVar('client_url', $_POST['client_url']);
		$clientsObj->setVar('client_key', $_POST['client_key']);
		$clientsObj->setVar('client_submitter', $_POST['client_submitter']);
		$clientsObj->setVar('client_date_created', strtotime($_POST['client_date_created']));
            
		// Insert Data
		if($clientsHandler->insert($clientsObj)) {
            // add provider to client database
            $client = array();
            $client['client_url'] = $_POST['client_url'];
            $client['client_key'] = $_POST['client_key'];
            $provider = array();
            $provider['provider_key'] = $wgbacklinks->getConfig('wgbacklinks_modkey');
            $provider['provider_name'] = $xoopsConfig['sitename'];
            
            $result = $clientsHandler->addProviderToClient($provider, $client);
            if ($result == 'success-add-provider' || $result == 'add-provider:provider-exists'){
                // creating provider successful or provider already existing
                redirect_header('clients.php?op=list', 2, _AM_WGBACKLINKS_FORM_OK);
            } else {
                // an error occured
                echo $result;
                redirect_header('clients.php?op=list&amp;error='._AM_WGBACKLINKS_PROVIDER_ERROR_ADD, 5, _AM_WGBACKLINKS_PROVIDER_ERROR_ADD);
            }
		} else {
            $GLOBALS['xoopsTpl']->assign('error', $clientsObj->getHtmlErrors());
            // Get Form
            $form = $clientsObj->getFormClients();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }

	break;
	case 'edit':
		$templateMain = 'wgbacklinks_admin_clients.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('clients.php'));
		$adminMenu->addItemButton(_AM_WGBACKLINKS_ADD_CLIENT, 'clients.php?op=new', 'add');
		$adminMenu->addItemButton(_AM_WGBACKLINKS_CLIENTS_LIST, 'clients.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
		// Get Form
		$clientsObj = $clientsHandler->get($clientId);
		$form = $clientsObj->getFormClients();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$clientsObj = $clientsHandler->get($clientId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('clients.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
            
			if($clientsHandler->delete($clientsObj)) {
                // delete provider to client database
                $client = array();
                $client['client_url'] = $_POST['client_url'];
                $client['client_key'] = $_POST['client_key'];
                $provider = array();
                $provider['provider_key'] = $wgbacklinks->getConfig('wgbacklinks_modkey');

                $result = $clientsHandler->deleteProviderFromClient($provider, $client);

                if ($result == 'success-delete-provider' || $result == 'delete-provider:provider-not-exists'){
                    // creating provider successful or provider already existing
                    redirect_header('clients.php', 3, _AM_WGBACKLINKS_FORM_DELETE_OK);
                } else if ( $result == _MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_CKEY ) {
                    redirect_header('clients.php?op=list&amp;error='. _AM_WGBACKLINKS_PROVIDER_ERROR_DELETE . "<br>" . _MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_CKEY, 10, _AM_WGBACKLINKS_PROVIDER_ERROR_DELETE);
                } else {
                    // an error occured
                    $GLOBALS['xoopsTpl']->assign('error', $result);
                    break;
                }
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $clientsObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'client_id' => $clientId, 'client_url' => $clientsObj->getVar('client_url'), 'client_key' => $clientsObj->getVar('client_key'), 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_WGBACKLINKS_FORM_SURE_DELETE, $clientsObj->getVar('client_url')));
		}

	break;
}
include __DIR__ . '/footer.php';
