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
define('_AM_WGBACKLINKS_STATISTICS', "Statistiken");
// There are
define('_AM_WGBACKLINKS_THEREARE_PROVIDERS', "Es befinden sich <span class='bold'>%s</span> Provider in der Datenbank");
define('_AM_WGBACKLINKS_THEREARE_SITES', "Es befinden sich <span class='bold'>%s</span> Seiten in der Datenbank");
define('_AM_WGBACKLINKS_THEREARE_CLIENTS', "Es befinden sich <span class='bold'>%s</span> Clients in der Datenbank");
// ---------------- Admin Files ----------------
// There aren't
define('_AM_WGBACKLINKS_THEREARENT_PROVIDERS', "Es gibt derzeit keine Provider-Daten");
define('_AM_WGBACKLINKS_THEREARENT_SITES', "Es gibt derzeit keine Seiten-Daten");
define('_AM_WGBACKLINKS_THEREARENT_CLIENTS', "Es gibt derzeit keine Client-Daten");
// Save/Delete
define('_AM_WGBACKLINKS_FORM_OK', "Erfolgreich gespeichert");
define('_AM_WGBACKLINKS_FORM_DELETE_OK', "Erfolgreich gelöscht");
define('_AM_WGBACKLINKS_FORM_SURE_DELETE', "Wollen Sie wirklich löschen: <b><span style='color : Red;'>%s </span></b>");
define('_AM_WGBACKLINKS_FORM_SURE_RENEW', "Wollen Sie wirklich aktualisieren: <b><span style='color : Red;'>%s </span></b>");
// Buttons
define('_AM_WGBACKLINKS_ADD_PROVIDER', "Neuen Provider hinzufügen");
define('_AM_WGBACKLINKS_ADD_SITE', "Neue Seite hinzufügen");
define('_AM_WGBACKLINKS_ADD_CLIENT', "Neuen Client hinzufügen");
define('_AM_WGBACKLINKS_SITES_SHARE', "Seiten mit allen Clients teilen");
// Lists
define('_AM_WGBACKLINKS_PROVIDERS_LIST', "Liste der Provider");
define('_AM_WGBACKLINKS_SITES_LIST', "Liste der Seiten");
define('_AM_WGBACKLINKS_CLIENTS_LIST', "Liste der Clients");
// ---------------- Admin Classes ----------------
define('_AM_WGBACKLINKS_CHECK_KEY_VALID', "Schlüssel gültig");
define('_AM_WGBACKLINKS_CHECK_KEY_INVALID', "Schlüssel nicht gültig");
define('_AM_WGBACKLINKS_CHECK_URL_INVALID', "Webseiten-Url nicht gültig oder Webseite nicht erreichbar");

// Provider add/edit
define('_AM_WGBACKLINKS_PROVIDER_ADD', "Provider hinzufügen");
define('_AM_WGBACKLINKS_PROVIDER_EDIT', "Provider bearbeiten");
// Elements of Provider
define('_AM_WGBACKLINKS_PROVIDER_ID', "Id");
define('_AM_WGBACKLINKS_PROVIDER_NAME', "Name");
define('_AM_WGBACKLINKS_PROVIDER_URL', "Url");
define('_AM_WGBACKLINKS_PROVIDER_KEY', "Schlüssel");
define('_AM_WGBACKLINKS_PROVIDER_KEY_CHECK', "Provider-Schlüssel überprüfen");
define('_AM_WGBACKLINKS_PROVIDER_SUBMITTER', "Einsender");
define('_AM_WGBACKLINKS_PROVIDER_DATE_CREATED', "erstellt am");
define('_AM_WGBACKLINKS_PROVIDER_ADD_ERROR', "Die Daten wurden erfolgreich in der Client-Tabelle dieser Webseite gespeichert, aber das automatische Hinzufügen der Daten in der Provider-Tabelle auf der Client-Webseite ist fehlgeschlagen. Bitte überprüfen Sie die Liste der Provider auf der Client-Webseite.");
define('_AM_WGBACKLINKS_PROVIDER_ADD_TO_SITE', "Meine Webseite zum Seitenverzeichnis beim Provider hinzufügen");
// Site add/edit
define('_AM_WGBACKLINKS_SITE_ADD', "Seite hinzufügen");
define('_AM_WGBACKLINKS_SITE_EDIT', "Seite bearbeiten");
// Elements of Site
define('_AM_WGBACKLINKS_SITE_ID', "Id");
define('_AM_WGBACKLINKS_SITE_NAME', "Name");
define('_AM_WGBACKLINKS_SITE_URL', "Url");
define('_AM_WGBACKLINKS_SITE_PROVIDER', "Provider");
define('_AM_WGBACKLINKS_SITE_UNIQUEID', "Seiten-Id");
define('_AM_WGBACKLINKS_SITE_SUBMITTER', "Einsender");
define('_AM_WGBACKLINKS_SITE_DATE_CREATED', "erstellt am");
define('_AM_WGBACKLINKS_SITE_ACTIVE', "Aktiv");
define('_AM_WGBACKLINKS_SITE_DESCR', "Beschreibung");
// Elements of site sharing
define('_AM_WGBACKLINKS_SHARE_RESULTS', "Ergebnis der Verteilung");
define('_AM_WGBACKLINKS_SHARE_RESULT_ADDED', "Seite '%s' hinzugefügt");
define('_AM_WGBACKLINKS_SHARE_RESULT_UPDATED', "Seite '%s' aktualisiert");
define('_AM_WGBACKLINKS_SHARE_RESULT_DELETED', "Inaktive Seite '%s' gelöscht");
define('_AM_WGBACKLINKS_SHARE_RESULT_SKIPPED', "Inaktive Seite '%s' übersprungen");
define('_AM_WGBACKLINKS_SHARE_RESULT_FAILED', "Information über Fehler bei Verteilung");

// Client add/edit
define('_AM_WGBACKLINKS_CLIENT_ADD', "Client hinzufügen");
define('_AM_WGBACKLINKS_CLIENT_EDIT', "Edit Client");
// Elements of Client
define('_AM_WGBACKLINKS_CLIENT_ID', "Id");
define('_AM_WGBACKLINKS_CLIENT_URL', "Client-Url");
define('_AM_WGBACKLINKS_CLIENT_KEY', "Client-Schlüssel");
define('_AM_WGBACKLINKS_CLIENT_KEY_DESC', "<br><span style='font-size:80%;'>Bitte überprüfen Sie in den Moduleinstellungen der Client-Webseite. Dort finden Sie diesen eindeutigen Schlüsser, welche für den Zugriff/Datenaustausch nötig ist.</span>");
define('_AM_WGBACKLINKS_CLIENT_PROVIDER', "Provider");
define('_AM_WGBACKLINKS_CLIENT_SUBMITTER', "Einsender");
define('_AM_WGBACKLINKS_CLIENT_DATE_CREATED', "erstellt am");
define('_AM_WGBACKLINKS_CLIENT_KEY_CHECK', "Überprüfung Client-Schlüssel");
define('_AM_WGBACKLINKS_CLIENT_ADD_ERROR', "Die Daten wurden erfolgreich in der Provider-Tabelle dieser Webseite gespeichert, aber das automatische Hinzufügen der Daten in der Client-Tabelle auf der Provider-Webseite ist fehlgeschlagen. Bitte überprüfen Sie die Liste der Client auf der Provider-Webseite.");
// General
define('_AM_WGBACKLINKS_FORM_ACTION', "Aktion");
define('_AM_WGBACKLINKS_FORM_EDIT', "Bearbeiten");
define('_AM_WGBACKLINKS_FORM_DELETE', "Löschen");
// ---------------- Admin Others ----------------
define('_AM_WGBACKLINKS_MAINTAINEDBY', " wird unterstützt durch <a href='http://wedega.com'>http://wedega.com</a> und <a href='http://xoops.wedega.com'>http://xoops.wedega.com</a>");
// ---------------- End ----------------