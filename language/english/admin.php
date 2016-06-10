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
 * @version        $Id: 1.0 admin.php 1 Thu 2016-05-05 08:16:09Z Wedega - Webdesign Gabor $
 */
// ---------------- Admin Index ----------------
define('_AM_WGBACKLINKS_STATISTICS', "Statistics");
// There are
define('_AM_WGBACKLINKS_THEREARE_PROVIDERS', "There are <span class='bold'>%s</span> providers in the database");
define('_AM_WGBACKLINKS_THEREARE_SITES', "There are <span class='bold'>%s</span> sites in the database");
define('_AM_WGBACKLINKS_THEREARE_CLIENTS', "There are <span class='bold'>%s</span> clients in the database");
// ---------------- Admin Files ----------------
// There aren't
define('_AM_WGBACKLINKS_THEREARENT_PROVIDERS', "There aren't providers");
define('_AM_WGBACKLINKS_THEREARENT_SITES', "There aren't sites");
define('_AM_WGBACKLINKS_THEREARENT_CLIENTS', "There aren't clients");
// Save/Delete
define('_AM_WGBACKLINKS_FORM_OK', "Successfully saved");
define('_AM_WGBACKLINKS_FORM_DELETE_OK', "Successfully deleted");
define('_AM_WGBACKLINKS_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
define('_AM_WGBACKLINKS_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
// Buttons
define('_AM_WGBACKLINKS_ADD_PROVIDER', "Add New Provider");
define('_AM_WGBACKLINKS_ADD_SITE', "Add New Site");
define('_AM_WGBACKLINKS_ADD_CLIENT', "Add New Client");
define('_AM_WGBACKLINKS_SITES_SHARE', "Share sites with clients");
// Lists
define('_AM_WGBACKLINKS_PROVIDERS_LIST', "List of Providers");
define('_AM_WGBACKLINKS_SITES_LIST', "List of Sites");
define('_AM_WGBACKLINKS_CLIENTS_LIST', "List of Clients");
// ---------------- Admin Classes ----------------
define('_AM_WGBACKLINKS_CHECK_KEY_VALID', "Key valid");
define('_AM_WGBACKLINKS_CHECK_KEY_INVALID', "Key not valid");
define('_AM_WGBACKLINKS_CHECK_URL_INVALID', "Website url not valid or website not reachable");

// Provider add/edit
define('_AM_WGBACKLINKS_PROVIDER_ADD', "Add Provider");
define('_AM_WGBACKLINKS_PROVIDER_EDIT', "Edit Provider");
// Elements of Provider
define('_AM_WGBACKLINKS_PROVIDER_ID', "Id");
define('_AM_WGBACKLINKS_PROVIDER_NAME', "Name");
define('_AM_WGBACKLINKS_PROVIDER_URL', "Url");
define('_AM_WGBACKLINKS_PROVIDER_KEY', "Key");
define('_AM_WGBACKLINKS_PROVIDER_KEY_CHECK', "Provider key check");
define('_AM_WGBACKLINKS_PROVIDER_SUBMITTER', "Submitter");
define('_AM_WGBACKLINKS_PROVIDER_DATE_CREATED', "Date created");
define('_AM_WGBACKLINKS_PROVIDER_ADD_ERROR', "The data have been successfully saved in the client table of this website, but the automatically adding of the data of this website as provider on the client website table has failed. Please check the poviders list under client website.");
define('_AM_WGBACKLINKS_PROVIDER_ADD_TO_SITE', "Add my website to site list of provider");

// Site add/edit
define('_AM_WGBACKLINKS_SITE_ADD', "Add Site");
define('_AM_WGBACKLINKS_SITE_EDIT', "Edit Site");
// Elements of Site
define('_AM_WGBACKLINKS_SITE_ID', "Id");
define('_AM_WGBACKLINKS_SITE_NAME', "Name");
define('_AM_WGBACKLINKS_SITE_URL', "Url");
define('_AM_WGBACKLINKS_SITE_PROVIDER', "Provider");
define('_AM_WGBACKLINKS_SITE_UNIQUEID', "Site-Id");
define('_AM_WGBACKLINKS_SITE_SUBMITTER', "Submitter");
define('_AM_WGBACKLINKS_SITE_DATE_CREATED', "Date created");
define('_AM_WGBACKLINKS_SITE_ACTIVE', "Active");
define('_AM_WGBACKLINKS_SITE_DESCR', "Description");
// Elements of site sharing
define('_AM_WGBACKLINKS_SHARE_RESULTS', "Results of sharing");
define('_AM_WGBACKLINKS_SHARE_RESULT_ADDED', "Added site '%s'");
define('_AM_WGBACKLINKS_SHARE_RESULT_UPDATED', "Site '%s' updated");
define('_AM_WGBACKLINKS_SHARE_RESULT_DELETED', "Deleted inactive site '%s'");
define('_AM_WGBACKLINKS_SHARE_RESULT_SKIPPED', "Inactive site '%s' skipped");
define('_AM_WGBACKLINKS_SHARE_RESULT_FAILED', "information about failure sharing site");

// Client add/edit
define('_AM_WGBACKLINKS_CLIENT_ADD', "Add Client");
define('_AM_WGBACKLINKS_CLIENT_EDIT', "Edit Client");
// Elements of Client
define('_AM_WGBACKLINKS_CLIENT_ID', "Id");
define('_AM_WGBACKLINKS_CLIENT_URL', "Client-Url");
define('_AM_WGBACKLINKS_CLIENT_KEY', "Client-Key");
define('_AM_WGBACKLINKS_CLIENT_KEY_DESC', "<br><span style='font-size:80%;margin-top:10px;'>Please look into module preferences of the client site. There you can find the unique key, which is necessary for access/data exchange</span>");
define('_AM_WGBACKLINKS_CLIENT_PROVIDER', "Provider");
define('_AM_WGBACKLINKS_CLIENT_SUBMITTER', "Submitter");
define('_AM_WGBACKLINKS_CLIENT_DATE_CREATED', "Date created");
define('_AM_WGBACKLINKS_CLIENT_KEY_CHECK', "Client key check");
define('_AM_WGBACKLINKS_CLIENT_ADD_ERROR', "The data have been successfully saved in the provider table of this website, but the automatically adding of the data of this website as client to providers website table has failed. Please check the client list under poviders website.");
// General
define('_AM_WGBACKLINKS_FORM_ACTION', "Action");
define('_AM_WGBACKLINKS_FORM_EDIT', "Modification");
define('_AM_WGBACKLINKS_FORM_DELETE', "Clear");
// ---------------- Admin Others ----------------
define('_AM_WGBACKLINKS_MAINTAINEDBY', " is maintained by <a href='http://wedega.com'>http://wedega.com</a> and <a href='http://xoops.wedega.com'>http://xoops.wedega.com</a>");
// ---------------- End ----------------