<?php
declare(strict_types=1);
namespace XoopsModules\Wgbacklinks;

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

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Clients
 */
class Clients extends \XoopsObject
{

    /**
     * Constructor 
     *
     */
    public function __construct()
    {
        $this->initVar('client_id', \XOBJ_DTYPE_INT);
        $this->initVar('client_url', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('client_key', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('client_submitter', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('client_date_created', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function &getInstance
     *
     */
    public static function &getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
    }

    /**
     * The new inserted $Id
     */
    public function getNewInsertedIdClients()
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * Get form
     *
     * @param mixed $action
     * @return \XoopsThemeForm
     */
    public function getFormClients($action = false)
    {
        global $xoopsUser;
        
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \_AM_WGBACKLINKS_CLIENT_ADD : \_AM_WGBACKLINKS_CLIENT_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text ClientUrl
        $form->addElement(new \XoopsFormText(\_AM_WGBACKLINKS_CLIENT_URL, 'client_url', 50, 255, $this->getVar('client_url') ), true);
        // Form Text ClientKey
        $form->addElement(new \XoopsFormText(\_AM_WGBACKLINKS_CLIENT_KEY . \_AM_WGBACKLINKS_CLIENT_KEY_DESC, 'client_key', 50, 255, $this->getVar('client_key') ), true);
        // Form Text client_submitter
        $client_submitter = $this->isNew() ? $xoopsUser->getVar('uname') : $this->getVar('client_submitter');
        $form->addElement(new \XoopsFormText(\_AM_WGBACKLINKS_CLIENT_SUBMITTER, 'client_submitter', 50, 255, $client_submitter));
        // Form Text Date Select
        $clientDate_created = $this->isNew() ? \time() : $this->getVar('client_date_created');
        $form->addElement(new \XoopsFormTextDateSelect(\_AM_WGBACKLINKS_CLIENT_DATE_CREATED, 'client_date_created', '', $clientDate_created));
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesClients($keys = null, $format = null, $maxDepth = null)
    {
        $ret                 = $this->getValues($keys, $format, $maxDepth);
        $ret['id']           = $this->getVar('client_id');
        $ret['url']          = $this->getVar('client_url');
        $ret['key']          = $this->getVar('client_key');
        $ret['provider']     = $this->getVar('client_provider');
        $ret['submitter']    = $this->getVar('client_submitter');
        $ret['date_created'] = formatTimeStamp($this->getVar('client_date_created'), 's');
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayClients()
    {
        $ret  = array();
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('{$var}');
        }
        return $ret;
    }
}
