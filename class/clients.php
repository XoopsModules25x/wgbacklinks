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
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgbacklinksClients
 */
class WgbacklinksClients extends XoopsObject
{
	/**
	 * @var mixed
	 */
	private $wgbacklinks = null;

	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->wgbacklinks = WgbacklinksHelper::getInstance();
		$this->initVar('client_id', XOBJ_DTYPE_INT);
		$this->initVar('client_url', XOBJ_DTYPE_TXTBOX);
        $this->initVar('client_key', XOBJ_DTYPE_TXTBOX);
		$this->initVar('client_submitter', XOBJ_DTYPE_TXTBOX);
		$this->initVar('client_date_created', XOBJ_DTYPE_INT);
	}

	/**
	 * @static function &getInstance
	 *
	 * @param null
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
	public function getNewInsertedIdClients()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * Get form
	 *
	 * @param mixed $action
	 */
	public function getFormClients($action = false)
	{
		global $xoopsUser;
        
        if($action === false) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGBACKLINKS_CLIENT_ADD) : sprintf(_AM_WGBACKLINKS_CLIENT_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text ClientUrl
		$form->addElement(new XoopsFormText( _AM_WGBACKLINKS_CLIENT_URL, 'client_url', 50, 255, $this->getVar('client_url') ), true);
        // Form Text ClientKey
		$form->addElement(new XoopsFormText( _AM_WGBACKLINKS_CLIENT_KEY . _AM_WGBACKLINKS_CLIENT_KEY_DESC, 'client_key', 50, 255, $this->getVar('client_key') ), true);
		// Form Text client_submitter
        $client_submitter = $this->isNew() ? $xoopsUser->getVar('uname') : $this->getVar('client_submitter');
        $form->addElement(new XoopsFormText( _AM_WGBACKLINKS_CLIENT_SUBMITTER, 'client_submitter', 50, 255, $client_submitter));
		// Form Text Date Select
		$clientDate_created = $this->isNew() ? time() : $this->getVar('client_date_created');
		$form->addElement(new XoopsFormTextDateSelect( _AM_WGBACKLINKS_CLIENT_DATE_CREATED, 'client_date_created', '', $clientDate_created));
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}

	/**
	 * Get Values
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
		foreach (array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('{$var}');
		}
		return $ret;
	}
}

/**
 * Class Object Handler WgbacklinksClients
 */
class WgbacklinksClientsHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgbacklinks_clients', 'wgbacklinksclients', 'client_id', 'client_url');
	}

	/**
	 * @param bool $isNew
	 *
	 * @return object
	 */
	public function create($isNew = true)
	{
		return parent::create($isNew);
	}

	/**
	 * retrieve a field
	 *
	 * @param int $i field id
	 * @return mixed reference to the {@link Get} object
	 */
	public function get($i = null, $fields = null)
	{
		return parent::get($i, $fields);
	}

	/**
	 * get inserted id
	 *
	 * @param null
	 * @return integer reference to the {@link Get} object
	 */
	public function getInsertId()
	{
		return $this->db->getInsertId();
	}

	/**
	 * Get Count Clients in the database
	 */
	public function getCountClients($start = 0, $limit = 0, $sort = 'client_id ASC, client_key', $order = 'ASC')
	{
		$criteriaCountClients = new CriteriaCompo();
		$criteriaCountClients = $this->getClientsCriteria($criteriaCountClients, $start, $limit, $sort, $order);
		return parent::getCount($criteriaCountClients);
	}

	/**
	 * Get All Clients in the database
	 */
	public function getAllClients($start = 0, $limit = 0, $sort = 'client_id ASC, client_key', $order = 'ASC')
	{
		$criteriaAllClients = new CriteriaCompo();
		$criteriaAllClients = $this->getClientsCriteria($criteriaAllClients, $start, $limit, $sort = 'client_id ASC, client_key', $order = 'ASC');
		return parent::getAll($criteriaAllClients);
	}

	/**
	 * Get Criteria Clients
	 */
	private function getClientsCriteria($criteriaClients, $start, $limit, $sort, $order)
	{
		$criteriaClients->setStart( $start );
		$criteriaClients->setLimit( $limit );
		$criteriaClients->setSort( $sort );
		$criteriaClients->setOrder( $order );
		return $criteriaClients;
	}
     
    public function addProviderToClient($provider, $client) {
        // add the provider to tables in client website
        global $xoopsUser;
           
        $postdata = http_build_query(
            array(
                'ptype'              => 'add-provider',
                'client_url'         => $client['client_url'],
                'client_key'         => $client['client_key'],
                'provider_key'       => $provider['provider_key'],
                'provider_name'      => $provider['provider_name'],
                'provider_url'       => XOOPS_URL,
                'provider_submitter' => $xoopsUser->getVar('uname') . ' - ' . XOOPS_URL                
            )
        );
        
        $val_url = rtrim($client['client_url'], '/');
        if (substr($val_url, -17) != 'exchange-data.php') {
            $val_url .= '/modules/wgbacklinks/exchange-data.php';
        }
        
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        
        $context  = stream_context_create($opts);
        $result = file_get_contents($val_url, false, $context);
        return $result;   
        
    }
    
    public function deleteProviderFromClient($provider, $client) {
        // delete the provider from tables in client website
        global $xoopsUser;
           
        $postdata = http_build_query(
            array(
                'ptype'        => 'delete-provider',
                'client_url'   => $client['client_url'],
                'client_key'   => $client['client_key'],
                'provider_key' => $provider['provider_key']        
            )
        );
        
        $val_url = rtrim($client['client_url'], '/');
        if (substr($val_url, -17) != 'exchange-data.php') {
            $val_url .= '/modules/wgbacklinks/exchange-data.php';
        }
        
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        
        $context  = stream_context_create($opts);
        $result = file_get_contents($val_url, false, $context);
        return $result;   
        
    }
    
    public function checkClientKey($client) {
        // check whether the client key is valid on client website
        global $xoopsUser;
           
        $postdata = http_build_query(
            array(
                'ptype'      => 'check-client-key',
                'client_url' => $client['client_url'],
                'client_key' => $client['client_key']      
            )
        );
        
        $val_url = rtrim($client['client_url'], '/');
        if (substr($val_url, -17) != 'exchange-data.php') {
            $val_url .= '/modules/wgbacklinks/exchange-data.php';
        }

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        
        $context  = stream_context_create($opts);
        $result = file_get_contents($val_url, false, $context);
        return $result;   
        
    }
}
