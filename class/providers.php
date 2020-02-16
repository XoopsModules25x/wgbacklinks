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
 * @version        $Id: 1.0 providers.php 1 Thu 2016-05-05 08:16:07Z Wedega - Webdesign Gabor $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgbacklinksProviders
 */
class WgbacklinksProviders extends XoopsObject
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
		$this->initVar('provider_id', XOBJ_DTYPE_INT);
		$this->initVar('provider_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('provider_url', XOBJ_DTYPE_TXTBOX);
		$this->initVar('provider_key', XOBJ_DTYPE_TXTBOX);
		$this->initVar('provider_submitter', XOBJ_DTYPE_INT);
		$this->initVar('provider_date_created', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdProviders()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

    /**
     * Get form
     *
     * @param mixed $action
     * @return XoopsThemeForm
     */
	public function getFormProviders($action = false)
	{
		if($action === false) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGBACKLINKS_PROVIDER_ADD) : sprintf(_AM_WGBACKLINKS_PROVIDER_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text ProviderName
		$form->addElement(new XoopsFormText( _AM_WGBACKLINKS_PROVIDER_NAME, 'provider_name', 50, 255, $this->getVar('provider_name') ), true);
		// Form Text ProviderUrl
        $provider_url = $this->isNew() ? 'http://mydomain.com' : $this->getVar('provider_url');
		$form->addElement(new XoopsFormText( _AM_WGBACKLINKS_PROVIDER_URL, 'provider_url', 50, 255, $provider_url ), true);
		// Form Text ProviderKey
		$form->addElement(new XoopsFormText( _AM_WGBACKLINKS_PROVIDER_KEY, 'provider_key', 50, 255, $this->getVar('provider_key') ));
        if ($this->isNew()) {
            // Form Text Add to site table
            $form->addElement(new XoopsFormRadioYN( _AM_WGBACKLINKS_PROVIDER_ADD_TO_SITE, 'provider_add_site', 1));
        }
		// Form Select User
		$form->addElement(new XoopsFormSelectUser( _AM_WGBACKLINKS_PROVIDER_SUBMITTER, 'provider_submitter', false, $this->getVar('provider_submitter') ));
		// Form Text Date Select
		$providerDate_created = $this->isNew() ? 0 : $this->getVar('provider_date_created');
		$form->addElement(new XoopsFormTextDateSelect( _AM_WGBACKLINKS_PROVIDER_DATE_CREATED, 'provider_date_created', '', $providerDate_created ));
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
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
		$ret['submitter']    = XoopsUser::getUnameFromId($this->getVar('provider_submitter'));
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
		foreach (array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('{$var}');
		}
		return $ret;
	}
}

/**
 * Class Object Handler WgbacklinksProviders
 */
class WgbacklinksProvidersHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgbacklinks_providers', 'wgbacklinksproviders', 'provider_id', 'provider_name');
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
     * @param null $fields
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
     * Get Count Providers in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
	public function getCountProviders($start = 0, $limit = 0, $sort = 'provider_id ASC, provider_date_created', $order = 'ASC')
	{
		$criteriaCountProviders = new CriteriaCompo();
		$criteriaCountProviders = $this->getProvidersCriteria($criteriaCountProviders, $start, $limit, $sort, $order);
		return parent::getCount($criteriaCountProviders);
	}

    /**
     * Get All Providers in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
	public function getAllProviders($start = 0, $limit = 0, $sort = 'provider_id ASC, provider_date_created', $order = 'ASC')
	{
		$criteriaAllProviders = new CriteriaCompo();
		$criteriaAllProviders = $this->getProvidersCriteria($criteriaAllProviders, $start, $limit, $sort, $order);
		return parent::getAll($criteriaAllProviders);
	}

    /**
     * Get Criteria Providers
     * @param $criteriaProviders
     * @param $start
     * @param $limit
     * @param $sort
     * @param $order
     * @return
     */
	private function getProvidersCriteria($criteriaProviders, $start, $limit, $sort, $order)
	{
		$criteriaProviders->setStart( $start );
		$criteriaProviders->setLimit( $limit );
		$criteriaProviders->setSort( $sort );
		$criteriaProviders->setOrder( $order );
		return $criteriaProviders;
	}

    /**
     * check whether the client is registered at the provider website, and add, if not exist
     *
     * @param array $provider , array $client
     * @param $client
     * @return result|string
     */
    public function addClientToProvider($provider, $client) {

        global $xoopsUser;

        $postdata = http_build_query(
            array(
                'ptype'           => 'add-client',
                'provider_url'    => $provider['provider_url'],
                'provider_key'    => $provider['provider_key'],
                'client_url'      => $client['client_url'],
                'client_key'      => $client['client_key'],
                'client_addsite'  => $client['client_addsite'],
                'client_sitename' => $client['client_sitename'],
                'client_slogan'   => $client['client_slogan'],
                'pcsubmitter'     => ($xoopsUser->getVar('uname') . ' - ' . XOOPS_URL)
            )
        );
        
        $wgbacklinks = WgbacklinksHelper::getInstance();
        $result = $wgbacklinks->execExchangeData($provider['provider_url'], $postdata); 
        
        return $result;
    }

    /**
     * delete the provider from table 'provider' in client website
     *
     * @param array $provider , array $client
     * @param $client
     * @return result|string
     */
    public function deleteClientFromProvider($provider, $client) {

        $postdata = http_build_query(
            array(
                'ptype'        => 'delete-client',
                'client_url'   => $client['client_url'],
                'client_key'   => $client['client_key'],
                'provider_url' => $provider['provider_url'],
                'provider_key' => $provider['provider_key']        
            )
        );
        
        $wgbacklinks = WgbacklinksHelper::getInstance();
        $result = $wgbacklinks->execExchangeData($provider['provider_url'], $postdata); 
        
        return $result;
        
    }
    
    /**
	 * validate whether the given website and key are valid for provider website
	 *
	 * @param array $provider
	 * @return result|string
	 */
    public function checkProviderKey($provider) {

        $postdata = http_build_query(
            array(
                'ptype'        => 'check-provider-key',
                'provider_url' => $provider['provider_url'],
                'provider_key' => $provider['provider_key']
            )
        );
        
        $wgbacklinks = WgbacklinksHelper::getInstance();
        $result = $wgbacklinks->execExchangeData($provider['provider_url'], $postdata); 

        return $result;
        
    }
}
