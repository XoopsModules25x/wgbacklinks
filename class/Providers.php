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
 * Class Object Providers
 */
class Providers extends \XoopsObject
{

    /**
     * Constructor 
     *
     */
    public function __construct()
    {
        $this->initVar('provider_id', \XOBJ_DTYPE_INT);
        $this->initVar('provider_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('provider_url', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('provider_key', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('provider_submitter', \XOBJ_DTYPE_INT);
        $this->initVar('provider_date_created', \XOBJ_DTYPE_INT);
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
    public function getNewInsertedIdProviders()
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * Get form
     *
     * @param mixed $action
     * @return \XoopsThemeForm
     */
    public function getFormProviders($action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \_AM_WGBACKLINKS_PROVIDER_ADD : \_AM_WGBACKLINKS_PROVIDER_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text ProviderName
        $form->addElement(new \XoopsFormText(\_AM_WGBACKLINKS_PROVIDER_NAME, 'provider_name', 50, 255, $this->getVar('provider_name') ), true);
        // Form Text ProviderUrl
        $provider_url = $this->isNew() ? 'https://mydomain.com' : $this->getVar('provider_url');
        $form->addElement(new \XoopsFormText(\_AM_WGBACKLINKS_PROVIDER_URL, 'provider_url', 50, 255, $provider_url ), true);
        // Form Text ProviderKey
        $form->addElement(new \XoopsFormText(\_AM_WGBACKLINKS_PROVIDER_KEY, 'provider_key', 50, 255, $this->getVar('provider_key') ));
        if ($this->isNew()) {
            // Form Text Add to site table
            $form->addElement(new \XoopsFormRadioYN(\_AM_WGBACKLINKS_PROVIDER_ADD_TO_SITE, 'provider_add_site', 1));
        }
        // Form Select User
        $form->addElement(new \XoopsFormSelectUser( \_AM_WGBACKLINKS_PROVIDER_SUBMITTER, 'provider_submitter', false, $this->getVar('provider_submitter') ));
        // Form Text Date Select
        $providerDate_created = $this->isNew() ? 0 : $this->getVar('provider_date_created');
        $form->addElement(new \XoopsFormTextDateSelect(\_AM_WGBACKLINKS_PROVIDER_DATE_CREATED, 'provider_date_created', '', $providerDate_created ));
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
    public function getValuesProviders($keys = null, $format = null, $maxDepth = null)
    {
        $ret                 = $this->getValues($keys, $format, $maxDepth);
        $ret['id']           = $this->getVar('provider_id');
        $ret['name']         = $this->getVar('provider_name');
        $ret['url']          = $this->getVar('provider_url');
        $ret['key']          = $this->getVar('provider_key');
        $ret['submitter']    = \XoopsUser::getUnameFromId($this->getVar('provider_submitter'));
        $ret['date_created'] = formatTimeStamp($this->getVar('provider_date_created'), 's');                
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayProviders()
    {
        $ret = array();
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('{$var}');
        }
        return $ret;
    }
}
