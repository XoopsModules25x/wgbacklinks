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
 * @version        $Id: 1.0 modinfo.php 1 Thu 2016-05-05 08:16:09Z Wedega - Webdesign Gabor $
 */
// ---------------- Admin Main ----------------
\define('_MI_WGBACKLINKS_NAME', "wgBacklinks");
\define('_MI_WGBACKLINKS_DESC', "Dieses Modul fügt Ihrer Webseite Backlings hinzu oder aktualisiert diese. Die Verwaltung erfolgt über eine zentrale Provider-Webseite");
// ---------------- Admin Menu ----------------
\define('_MI_WGBACKLINKS_ADMENU1', "Dashboard");
\define('_MI_WGBACKLINKS_ADMENU2', "Provider");
\define('_MI_WGBACKLINKS_ADMENU3', "Seiten");
\define('_MI_WGBACKLINKS_ADMENU4', "Clients");
\define('_MI_WGBACKLINKS_ABOUT', "Über");
// ---------------- Admin Nav ----------------
\define('_MI_WGBACKLINKS_ADMIN_PAGER', "Anzahl Listeneinträge Admin-Seiten");
\define('_MI_WGBACKLINKS_ADMIN_PAGER_DESC', "Definieren Sie, wieviele Einträge in den Lister auf den Admin-Seiten angezeigt werden sollen");
\define('_MI_WGBACKLINKS_USER_PAGER', 'User Listenzeilen');
\define('_MI_WGBACKLINKS_USER_PAGER_DESC', 'Anzahl der Zeilen für Listen auf Userseite');
// User
// Blocks
// Config
\define('_MI_WGBACKLINKS_KEYWORDS', "Keywords");
\define('_MI_WGBACKLINKS_KEYWORDS_DESC', "Bitte hier Ihre Schlüsselwörter eintragen (getrennt durch einen Beistrich)");
\define('_MI_WGBACKLINKS_MODTYPE', "Modul-Typ");
\define('_MI_WGBACKLINKS_MODTYPE_DESC', "Bitte legen Sie fest, ob Sie das Modul als Provider oder Client nutzen wollen");
\define('_MI_WGBACKLINKS_MODTYPE_1', "Provider");
\define('_MI_WGBACKLINKS_MODTYPE_2', "Client");
\define('_MI_WGBACKLINKS_MODKEY', "Eindeutiger Schlüssel");
\define('_MI_WGBACKLINKS_MODKEY_DESC', "Jeder Provider/Client braucht einen eindeutigen Schlüssel für die Identifizierung.<br/>Dieser Schlüssel wird normalerweise vom Modul automatisch erstellt.");

// ---------------- End ----------------