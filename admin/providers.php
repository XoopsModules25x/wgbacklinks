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
 * @version        $Id: 1.0 providers.php 1 Thu 2016-05-05 08:16:06Z Wedega - Webdesign Gabor $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request provider_id
$providerId = XoopsRequest::getInt('provider_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgbacklinks->getConfig('adminpager'));
		$templateMain = 'wgbacklinks_admin_providers.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('providers.php'));
		$adminMenu->addItemButton(_AM_WGBACKLINKS_ADD_PROVIDER, 'providers.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
		$providersCount = $providersHandler->getCountProviders();
		$providersAll = $providersHandler->getAllProviders($start, $limit);
		$GLOBALS['xoopsTpl']->assign('providers_count', $providersCount);
		$GLOBALS['xoopsTpl']->assign('wgbacklinks_url', WGBACKLINKS_URL);
		$GLOBALS['xoopsTpl']->assign('wgbacklinks_upload_url', WGBACKLINKS_UPLOAD_URL);
		// Table view providers
		if($providersCount > 0) {
			foreach(array_keys($providersAll) as $i) {
				$provider = $providersAll[$i]->getValuesProviders();
                $result = $providersHandler->checkProviderKey($provider);
                if ($result == 'valid-provider-key') {
                    $image_valid = '<img src="' . WGBACKLINKS_ICONS_URL . '/16/ok.png" alt="' . _AM_WGBACKLINKS_CHECK_KEY_VALID . '">' . _AM_WGBACKLINKS_CHECK_KEY_VALID;
                } else if ($result == 'invalid-provider-key'){
                    $image_valid = '<img src="' . WGBACKLINKS_ICONS_URL . '/16/alert.png" alt="' . _AM_WGBACKLINKS_CHECK_KEY_INVALID . '">' . _AM_WGBACKLINKS_CHECK_KEY_INVALID;
                } else {
                    $image_valid = '<img src="' . WGBACKLINKS_ICONS_URL . '/16/alert.png" alt="' . _AM_WGBACKLINKS_CHECK_URL_INVALID . '">' . _AM_WGBACKLINKS_CHECK_URL_INVALID;
                }

                $provider['validkey'] = $image_valid;
				$GLOBALS['xoopsTpl']->append('providers_list', $provider);
				unset($provider);
			}
			// Display Navigation
			if($providersCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($providersCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _AM_WGBACKLINKS_THEREARENT_PROVIDERS);
		}

	break;
	case 'new':
		$templateMain = 'wgbacklinks_admin_providers.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('providers.php'));
		$adminMenu->addItemButton(_AM_WGBACKLINKS_PROVIDERS_LIST, 'providers.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
		// Get Form
		$providersObj =& $providersHandler->create();
		$form =& $providersObj->getFormProviders();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('providers.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($providerId)) {
			$providersObj =& $providersHandler->get($providerId);
		} else {
			$providersObj =& $providersHandler->create();
		}
		// Set Vars
		$providersObj->setVar('provider_name', $_POST['provider_name']);
		$providersObj->setVar('provider_url', $_POST['provider_url']);
		$providersObj->setVar('provider_key', $_POST['provider_key']);
		$providersObj->setVar('provider_submitter', isset($_POST['provider_submitter']) ? $_POST['provider_submitter'] : 0);
		$providersObj->setVar('provider_date_created', strtotime($_POST['provider_date_created']));
		// Insert Data
		if($providersHandler->insert($providersObj)) {
            //add client to providers website
            $client = array();
            $client['client_url'] = XOOPS_URL;
            $client['client_key'] = $wgbacklinks->getConfig('wgbacklinks_modkey');
            $provider = array();
            $provider['provider_url'] = $_POST['provider_url'];
            $provider['provider_key'] = $_POST['provider_key'];
            $result = $providersHandler->addClientToProvider($provider, $client);

            if ($result == 'success-add-client' || $result == 'add-client:client-exists') {
                // creating client successful or client already existing
                redirect_header('providers.php?op=list', 2, _AM_WGBACKLINKS_FORM_OK);
            } else {
                // an error occured
                echo $result;
                $GLOBALS['xoopsTpl']->assign('error', $result);
            }
		} else {
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', $providersObj->getHtmlErrors());
            $form =& $providersObj->getFormProviders();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }

	break;
	case 'edit':
		$templateMain = 'wgbacklinks_admin_providers.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminMenu->addNavigation('providers.php'));
		$adminMenu->addItemButton(_AM_WGBACKLINKS_ADD_PROVIDER, 'providers.php?op=new', 'add');
		$adminMenu->addItemButton(_AM_WGBACKLINKS_PROVIDERS_LIST, 'providers.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminMenu->renderButton());
		// Get Form
		$providersObj =& $providersHandler->get($providerId);
		$form =& $providersObj->getFormProviders();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$providersObj =& $providersHandler->get($providerId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('providers.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
            $provider = array();
            $provider['provider_key'] = $providersObj->getVar('provider_key');
            $provider['provider_url'] = $providersObj->getVar('provider_url');
            $provider['provider_name'] = $providersObj->getVar('provider_name');
            
			if($providersHandler->delete($providersObj)) {
                // delete client to provider database
                $client = array();
                $client['client_url'] = XOOPS_URL;
                $client['client_key'] = $wgbacklinks->getConfig('wgbacklinks_modkey');

                $result = $providersHandler->deleteClientFromProvider($provider, $client);

                if ($result == 'success-delete-client' || $result == 'delete-client:client-not-exists'){
                    // deleting client successful or client does not exist
                    redirect_header('providers.php', 3, _AM_WGBACKLINKS_FORM_DELETE_OK);
                } else {
                    // an error occured
                    $GLOBALS['xoopsTpl']->assign('error', $result);
                    break;
                }
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $providersObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'provider_id' => $providerId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_AM_WGBACKLINKS_FORM_SURE_DELETE, $providersObj->getVar('provider_name')));
		}

	break;
    case 'test':
        
        $providerId = 1;
        $providersObj =& $providersHandler->get($providerId);
        $url = $providersObj->getVar('provider_url');
        $key = $providersObj->getVar('provider_key');
        echo '<br/>url:$url - key:$key';
        $res = $providersHandler->validateProvider($url, $key);
        echo '<br/>res:$res';
        break;
}
include __DIR__ . '/footer.php';
