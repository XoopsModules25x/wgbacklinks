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

use XoopsModules\Wgbacklinks\Helper;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Handler Clients
 */
class ClientsHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
	public function __construct(\XoopsDatabase $db)
	{
		parent::__construct($db, 'wgbacklinks_clients', Clients::class, 'client_id', 'client_url');
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
     * @param int $id field id
     * @param null $fields
     * @return \XoopsObject|null reference to the {@link Get} object
     */
	public function get($id = null, $fields = null)
	{
		return parent::get($id, $fields);
	}

	/**
	 * get inserted id
	 *
	 * @return integer reference to the {@link Get} object
	 */
	public function getInsertId()
	{
		return $this->db->getInsertId();
	}

    /**
     * Get Count Clients in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
	public function getCountClients($start = 0, $limit = 0, $sort = 'client_id ASC, client_key', $order = 'ASC')
	{
		$criteriaCountClients = new \CriteriaCompo();
		$criteriaCountClients = $this->getClientsCriteria($criteriaCountClients, $start, $limit, $sort, $order);
		return parent::getCount($criteriaCountClients);
	}

    /**
     * Get All Clients in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
	public function getAllClients($start = 0, $limit = 0, $sort = 'client_id ASC, client_key', $order = 'ASC')
	{
		$criteriaAllClients = new \CriteriaCompo();
		$criteriaAllClients = $this->getClientsCriteria($criteriaAllClients, $start, $limit, $sort, $order);
		return parent::getAll($criteriaAllClients);
	}

    /**
     * Get Criteria Clients
     * @param $criteriaClients
     * @param $start
     * @param $limit
     * @param $sort
     * @param $order
     * @return mixed
     */
	private function getClientsCriteria($criteriaClients, $start, $limit, $sort, $order)
	{
		$criteriaClients->setStart( $start );
		$criteriaClients->setLimit( $limit );
		$criteriaClients->setSort( $sort );
		$criteriaClients->setOrder( $order );
		return $criteriaClients;
	}

    /**
     * add the provider to tables in client website
     *
     * @param array $provider , array $client
     * @param $client
     * @return string
     */
    public function addProviderToClient($provider, $client) {

        global $xoopsUser;
           
        $postdata = \http_build_query(
            array(
                'ptype'              => 'add-provider',
                'client_url'         => $client['client_url'],
                'client_key'         => $client['client_key'],
                'provider_key'       => $provider['provider_key'],
                'provider_name'      => $provider['provider_name'],
                'provider_url'       => \XOOPS_URL,
                'provider_submitter' => $xoopsUser->getVar('uname') . ' - ' . \XOOPS_URL                
            )
        );
        
        $helper = Helper::getInstance();
        return $helper->execExchangeData($client['client_url'], $postdata);
        
    }

    /**
     * delete the provider from tables in client website
     *
     * @param array $provider , array $client
     * @param $client
     * @return string
     */
    public function deleteProviderFromClient($provider, $client) {
        
        $postdata = \http_build_query(
            array(
                'ptype'        => 'delete-provider',
                'client_url'   => $client['client_url'],
                'client_key'   => $client['client_key'],
                'provider_key' => $provider['provider_key']        
            )
        );
        
        $helper = Helper::getInstance();
        return $helper->execExchangeData($client['client_url'], $postdata);
        
    }
    
    /**
	 * check whether the client key is valid on client website
	 *
	 * @param array $client
	 * @return string
	 */
    public function checkClientKey($client) {

        $postdata = \http_build_query(
            array(
                'ptype'      => 'check-client-key',
                'client_url' => $client['client_url'],
                'client_key' => $client['client_key']      
            )
        );
        
        $helper = Helper::getInstance();
        return $helper->execExchangeData($client['client_url'], $postdata);
        
    }
}
