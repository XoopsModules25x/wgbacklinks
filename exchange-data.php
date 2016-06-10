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
 * @version        $Id: 1.0 exchange-data.php 1 Thu 2016-05-05 08:16:07Z Wedega - Webdesign Gabor $
 */
include __DIR__ . '/header.php';

$ptype  = $_REQUEST['ptype'];

// check provider key against providers website
// called by: admin/provider.php (class/provider.php) from client website
if ($ptype == 'check-provider-key') {
    $provider_key = $_REQUEST['provider_key'];
    if ($provider_key == $wgbacklinks->getConfig('wgbacklinks_modkey')) {
        echo 'valid-provider-key';
    } else {
        echo 'invalid-provider-key';
    } 
}

// check client key against clients website
// called by: admin/client.php (class/client.php) from provider website
 if ($ptype == 'check-client-key') {
    $client_key = $_REQUEST['client_key'];
    if ($client_key == $wgbacklinks->getConfig('wgbacklinks_modkey')) {
        echo 'valid-client-key';
    } else {
        echo 'invalid-client-key';
    } 
}
 
// check provider registration at the client and add new, if not existing
// called by: clients.php from provider website
if ($ptype == 'add-provider') {
    $client_key = $_REQUEST['client_key'];
    $client_url = $_REQUEST['client_url'];
    $provider_key = $_REQUEST['provider_key'];
    
    if ($client_key == $wgbacklinks->getConfig('wgbacklinks_modkey')) {
        $crit_provider = new CriteriaCompo();
        $crit_provider->add(new Criteria('provider_key', $provider_key));
        $providersCount = $providersHandler->getCount($crit_provider);
        if ($providersCount == 0) {
            // add this provider to table provider
            $providersObj = $providersHandler->create();
            $providersObj->setVar('provider_name', $_REQUEST['provider_name']);
            $providersObj->setVar('provider_url', $_REQUEST['provider_url']);
            $providersObj->setVar('provider_key', $_REQUEST['provider_key']);
            $providersObj->setVar('provider_submitter', $_REQUEST['provider_submitter']);
            $providersObj->setVar('provider_date_created', time());
            // Insert Data
            if($providersHandler->insert($providersObj)) {
                echo 'success-' . $ptype;
            } else {
                $result_text = str_replace('%p', $_REQUEST['provider_name'], _MA_WGBACKLINKS_EXCHANGE_ERR_ADD_PROVIDER);
                $result_text = str_replace('%c', $client_url, $result_text);
                $result_text = str_replace('%e', $providersObj->getHtmlErrors(), $result_text);
            }
        } else {
            echo $ptype . ':provider-exists';
        }
    } else {
        echo _MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_CKEY;
    }
}

// check provider registration at the client website and delete, if existing
// called by: admin/clients.php (class/clients.php) from provider website
if ($ptype == 'delete-provider') {
    $client_key = $_REQUEST['client_key'];
    $client_url = $_REQUEST['client_url'];
    $provider_key = $_REQUEST['provider_key'];
    
    if ($client_key == $wgbacklinks->getConfig('wgbacklinks_modkey')) {
        $crit_provider = new CriteriaCompo();
        $crit_provider->add(new Criteria('provider_key', $provider_key));
        $providersCount = $providersHandler->getCount($crit_provider);

        if ($providersCount > 0) {
            // delete this provider from table providers
            $providerId = 0;
            $providersAll = $providersHandler->getall($crit_provider);
            foreach(array_keys($providersAll) as $i) {
                $providerId = $providersAll[$i]->getVar('provider_id');
            }

            if ($providerId > 0) {
                $providersObj = $providersHandler->get($providerId);
                if($providersHandler->delete($providersObj)) {
                    echo 'success-' . $ptype;
                } else {
                    $result_text = str_replace('%p', $_REQUEST['provider_name'], _MA_WGBACKLINKS_EXCHANGE_ERR_DEL_PROVIDER);
                    $result_text = str_replace('%c', $client_url, $result_text);
                    $result_text = str_replace('%e', $providersObj->getHtmlErrors(), $result_text);
                    echo $result_text;
                }
            } else {
                echo 'invalid criteria for get provider';
            }
        } else {
            echo $ptype . ':provider-not-exists';
        }
    } else {
        echo _MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_CKEY;
    }
}

// check client registration at the provider website and add new, if not existing
// called by: admin/provider.php (class/provider.php) from client website
if ($ptype == 'add-client') {
    
    $provider_url    = $_REQUEST['provider_url'];
    $provider_key    = $_REQUEST['provider_key'];
    $client_url      = $_REQUEST['client_url'];
    $client_key      = $_REQUEST['client_key'];
    $client_addsite  = $_REQUEST['client_addsite'];
    $client_sitename = $_REQUEST['client_sitename'];
    $client_slogan   = $_REQUEST['client_slogan'];
    $pcsubmitter     = $_REQUEST['pcsubmitter'];
    
    if ($provider_key == $wgbacklinks->getConfig('wgbacklinks_modkey')) {
        $crit_client = new CriteriaCompo();
        $crit_client->add(new Criteria('client_key', $client_key));
        $clientsCount = $clientsHandler->getCount($crit_client);
        if ($clientsCount == 0) {
            // add this client to table client
            $clientsObj = $clientsHandler->create();
            
            // Set Vars
            $clientsObj->setVar('client_url', $client_url);
            $clientsObj->setVar('client_key', $client_key);
            $clientsObj->setVar('client_submitter', $pcsubmitter);
            $clientsObj->setVar('client_date_created', time());
            // Insert Data
            if($clientsHandler->insert($clientsObj)) {
                
                if ($client_addsite > 0) {
                    $sitesObj = $sitesHandler->create();
                    // Set Vars
                    $sitesObj->setVar('site_name', $client_sitename);
                    $sitesObj->setVar('site_descr', $client_slogan);
                    $sitesObj->setVar('site_url', $client_url);
                    $sitesObj->setVar('site_uniqueid', md5(substr(str_shuffle("!$%&/=?_-;:,.0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50)));
                    $sitesObj->setVar('site_active', '1');
                    $sitesObj->setVar('site_shared', '0');
                    $sitesObj->setVar('site_submitter', $pcsubmitter);
                    $sitesObj->setVar('site_date_created', time());
                    
                    // Insert Data
                    if($sitesHandler->insert($sitesObj)) {
                        echo 'success-' . $ptype;
                    } else {
                        $result_text = str_replace('%p', $provider_url, _MA_WGBACKLINKS_EXCHANGE_ERR_PROV_ADD_SITE);
                        $result_text = str_replace('%c', $client_url, $result_text);
                        $result_text = str_replace('%e', $clientsObj->getHtmlErrors(), $result_text);
                        echo $result_text;
                    }
                }
            } else {
                $result_text = str_replace('%p', $provider_url, _MA_WGBACKLINKS_EXCHANGE_ERR_ADD_CLIENT);
                $result_text = str_replace('%c', $client_url, $result_text);
                $result_text = str_replace('%e', $clientsObj->getHtmlErrors(), $result_text);
                echo $result_text;
            }
        } else {
            echo $ptype . ':client-exists';
        }
    } else {
        echo _MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_PKEY;
    }
}

// check client registration at the provider and delete, if existing
// called by: admin/provider.php (class/provider.php) from client website
if ($ptype == 'delete-client') {
    $client_key = $_REQUEST['client_key'];
    $client_url = $_REQUEST['client_url'];
    $provider_key = $_REQUEST['provider_key'];
    
    if ($provider_key == $wgbacklinks->getConfig('wgbacklinks_modkey')) {
        $crit_client = new CriteriaCompo();
        $crit_client->add(new Criteria('client_key', $client_key));
        $clientsCount = $clientsHandler->getCount($crit_client);

        if ($clientsCount > 0) {
            // delete this client from table clients
            $clientId = 0;
            $clientsAll = $clientsHandler->getall($crit_client);
            foreach(array_keys($clientsAll) as $i) {
                $clientId = $clientsAll[$i]->getVar('client_id');
            }

            if ($clientId > 0) {
                $clientsObj = $clientsHandler->get($clientId);
                if($clientsHandler->delete($clientsObj)) {
                    echo 'success-' . $ptype;
                } else {
                    $result_text = str_replace('%p', $_REQUEST['provider_name'], _MA_WGBACKLINKS_EXCHANGE_ERR_DEL_CLIENT);
                    $result_text = str_replace('%c', $client_url, $result_text);
                    $result_text = str_replace('%e', $clientsObj->getHtmlErrors(), $result_text);
                    echo $result_text;
                }
            } else {
                echo 'invalid criteria for get client';
            }
        } else {
            echo $ptype . ':client-not-exists';
        }
    } else {
        echo _MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_PKEY;
    }
}

// register sites to client database:
// if site exists, data will updated
// if site doesn't exist, site will be added
// called by: admin/sites.php (class/sites.php) from provider website
if ($ptype == 'share-site') {
    
    // check first cliekey
    $client_key = $_REQUEST['client_key'];
    $client_url = $_REQUEST['client_url'];

    if ($client_key == $wgbacklinks->getConfig('wgbacklinks_modkey')) {
        // valid key given by provider

        $psite_name      = $_REQUEST['site_name'];
        $psite_descr     = $_REQUEST['site_descr'];
        $psite_url       = $_REQUEST['site_url'];
        $psite_uniqueid  = $_REQUEST['site_uniqueid'];
        $psite_active    = $_REQUEST['site_active'];
        $psite_submitter = $_REQUEST['site_submitter'];

        $site_id = 0;

        $crit_site = new CriteriaCompo();
        $crit_site->add(new Criteria('site_uniqueid', $psite_uniqueid));
        $sitesAll = $sitesHandler->getall($crit_site);

        foreach(array_keys($sitesAll) as $i) {
            $site_id = $sitesAll[$i]->getVar('site_id');
            unset($site);
        }
        
        if ($site_id > 0) {
            // existing site, update
            $result =  'updated ' . $client_key;
            $sitesObj = $sitesHandler->get($site_id);
        } else {
            // new site
            if ($psite_active > 0) {
                // site is active, add new site
                $result = 'added ' . $client_key;
                $sitesObj = $sitesHandler->create();
            }
        }
        if ($psite_active == 0) {
            // site is not active
            // delete, if exisiting
            if ($site_id > 0) {
                if($sitesHandler->delete($sitesObj)) {
                    $result = 'deleted ' . $client_key;
                } else {
                    $result = str_replace('%s', $psite_name, _MA_WGBACKLINKS_EXCHANGE_ERR_DELETE_SITE);
                    $result = str_replace('%c', $client_url, $result);
                }
            } else {
                $result = 'skipped ' . $client_key;
            }
            echo $result;
        } else {
            // add or update existing site
            // Set Vars
            $sitesObj->setVar('site_name', $psite_name);
            $sitesObj->setVar('site_url', $psite_url);
            $sitesObj->setVar('site_uniqueid', $psite_uniqueid);
            $sitesObj->setVar('site_submitter', $psite_submitter);
            $sitesObj->setVar('site_date_created', time());
            $sitesObj->setVar('site_active', $psite_active);
            $sitesObj->setVar('site_descr', $psite_descr);
            // Insert Data
            if($sitesHandler->insert($sitesObj)) {
                echo $result;
            } else {
                $result_text = str_replace('%s', $psite_name, _MA_WGBACKLINKS_EXCHANGE_ERR_ADD_SITE);
                echo str_replace('%c', $client_url, $result_text);
            }
        }
    } else {
        echo _MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_CKEY;
    }

}
