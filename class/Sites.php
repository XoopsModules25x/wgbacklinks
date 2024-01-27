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
 * Class Object Sites
 */
class Sites extends \XoopsObject
{

	/**
	 * Constructor 
	 *
	 */
	public function __construct()
	{
		$this->initVar('site_id', \XOBJ_DTYPE_INT);
		$this->initVar('site_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('site_descr', \XOBJ_DTYPE_TXTBOX);
		$this->initVar('site_url', \XOBJ_DTYPE_TXTBOX);
		$this->initVar('site_provider', \XOBJ_DTYPE_TXTBOX);
		$this->initVar('site_uniqueid', \XOBJ_DTYPE_TXTBOX);
		$this->initVar('site_submitter', \XOBJ_DTYPE_TXTBOX);
		$this->initVar('site_date_created', \XOBJ_DTYPE_INT);
		$this->initVar('site_active', \XOBJ_DTYPE_INT);
        $this->initVar('site_shared', \XOBJ_DTYPE_INT);
	}

	/**
	 * @static function &getInstance
	 *
	 */
	public static function &getInstance()
	{
		static $instance = false;
		if(!$instance) {
			$instance = new self();
		}
	}

	/**
	 * The new inserted $Id
	 */
	public function getNewInsertedIdSites()
	{
        return $GLOBALS['xoopsDB']->getInsertId();
	}

    /**
     * Get form
     *
     * @param mixed $action
     * @return \XoopsThemeForm
     */
	public function getFormSites($action = false)
	{
        global $xoopsUser;
        
		if($action === false) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? \_AM_WGBACKLINKS_SITE_ADD : \_AM_WGBACKLINKS_SITE_EDIT;
		// Get Theme Form
		\xoops_load('XoopsFormLoader');
		$form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text SiteName
		$form->addElement(new \XoopsFormText( \_AM_WGBACKLINKS_SITE_NAME, 'site_name', 50, 255, $this->getVar('site_name') ), true);
		// Form Text Area SiteDescr
		$form->addElement(new \XoopsFormTextArea( \_AM_WGBACKLINKS_SITE_DESCR, 'site_descr', $this->getVar('site_descr'), 4, 47 ));
		// Form Text SiteUrl
		$form->addElement(new \XoopsFormText( \_AM_WGBACKLINKS_SITE_URL, 'site_url', 50, 255, $this->getVar('site_url') ));
		// Form Text SiteUniqueid
        if (!$this->isNew()) {
            $form->addElement(new \XoopsFormText( \_AM_WGBACKLINKS_SITE_UNIQUEID, 'site_uniqueid', 50, 255, $this->getVar('site_uniqueid') ));
        }
		// Form Radio Yes/No
		$siteActive = $this->isNew() ? 1 : $this->getVar('site_active');
		$form->addElement(new \XoopsFormRadioYN( \_AM_WGBACKLINKS_SITE_ACTIVE, 'site_active', $siteActive));
		// Form site_submitter
        $site_submitter = $this->isNew() ? $xoopsUser->getVar('uname') : $this->getVar('site_submitter');
		$form->addElement(new \XoopsFormText( \_AM_WGBACKLINKS_SITE_SUBMITTER, 'site_submitter', 50, 255, $site_submitter));
		// Form Text Date Select
		$siteDate_created = $this->isNew() ? 0 : $this->getVar('site_date_created');
		$form->addElement(new \XoopsFormTextDateSelect( \_AM_WGBACKLINKS_SITE_DATE_CREATED, 'site_date_created', '', $siteDate_created ));
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
	public function getValuesSites($keys = null, $format = null, $maxDepth = null)
	{
		$ret                 = $this->getValues($keys, $format, $maxDepth);
		$ret['id']           = $this->getVar('site_id');
		$ret['name']         = $this->getVar('site_name');
        $ret['descr']        = \strip_tags($this->getVar('site_descr'));
		$ret['url']          = $this->getVar('site_url');
		$ret['provider']     = $this->getVar('site_provider');
		$ret['uniqueid']     = $this->getVar('site_uniqueid');
		$ret['submitter']    = $this->getVar('site_submitter');
		$ret['date_created'] = formatTimeStamp($this->getVar('site_date_created'), 's');
        $ret['active']       = $this->getVar('site_active');
        if ($this->getVar('site_active') == 1) {
            $image_active = '<a href="sites.php?op=activate&new_site_active=0&site_id=' . $this->getVar('site_id') . '"><img src="' . \WGBACKLINKS_ICONS_URL . '/16/ok.png" alt="' . _YES . '"></a>';
        } else {
            $image_active = '<a href="sites.php?op=activate&new_site_active=1&site_id=' . $this->getVar('site_id') . '"><img src="' . \WGBACKLINKS_ICONS_URL . '/16/off.png" alt="' . _NO . '"></a>';
        }
        $ret['active_img']   = $image_active;
        
        $ret['shared']       = $this->getVar('site_shared');
        if ($this->getVar('site_shared') == 1) {
            $image_shared = '<img src="' . \WGBACKLINKS_ICONS_URL . '/16/ok.png" alt="' . _YES . '">';
        } else {
            $image_shared = '<img src="' . \WGBACKLINKS_ICONS_URL . '/16/off.png" alt="' . _NO . '">';
        }
        $ret['shared_img']   = $image_shared;
        
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArraySites()
	{
		$ret = array();
		$vars = $this->getVars();
		foreach (\array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('{$var}');
		}
		return $ret;
	}
}
