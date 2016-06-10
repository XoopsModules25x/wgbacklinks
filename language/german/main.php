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
define('_MA_WGBACKLINKS_INDEX', "Übersicht");
define('_MA_WGBACKLINKS_TITLE', "wgBacklinks");
define('_MA_WGBACKLINKS_DESC', "Dieses Modul fügt Ihrer Webseite Backlings hinzu oder aktualisiert diese. Die Verwaltung erfolgt über eine zentrale Provider-Webseite.");
define('_MA_WGBACKLINKS_INDEX_DESC', "wgBacklinks, ihr Xoops-Modul zur Verwaltung von Backlinks - zur Verfügung gestellt von Wedega Webdesign Gabor (wedega. com)");

// ---------------- Contents ----------------
// Caption of Site
define('_MA_WGBACKLINKS_SITE_NAME', "Name");
define('_MA_WGBACKLINKS_SITE_URL', "Link zur Webseite");
define('_MA_WGBACKLINKS_SITE_DESCR', "Zusätzliche Informationen");
// Admin link
define('_MA_WGBACKLINKS_ADMIN', "Administration");

// Elements of exchange-data
define('_MA_WGBACKLINKS_EXCHANGE_ERR_ADD_SITE', "Fehler: Hinzufügen der Seite '%s' in Seiten-Tabelle fehlgeschlagen");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_DELETE_SITE', "Fehler: Löschen der Seite '%s' von der Seiten-Tabelle fehlgeschlagen");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_CKEY', "Fehler: ungültiger Client-Schlüssel");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_INVALID_PKEY', "Fehler: ungültiger Provider-Schlüssel");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_ADD_PROVIDER', "Fehler beim Hinzufügen Provider '%p' bei Client '%c'.<br/>Fehler: %e");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_DEL_PROVIDER', "Fehler beim Löschen Provider '%p' vom Client '%c'.<br/>Fehler: %e");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_ADD_CLIENT', "Fehler beim Hinzufügen Client '%c' bei Provider '%p'.<br/>Fehler: %e");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_DEL_CLIENT', "Fehler beim Löschen Client '%c' vom Provider '%p'.<br/>Fehler: %e");
define('_MA_WGBACKLINKS_EXCHANGE_ERR_PROV_ADD_SITE', "Fehler beim Hinzufügen des Clients '%c' in Seiten-Tabelle von Provider '%p'.<br/>Fehler: %e");

// ---------------- End ----------------