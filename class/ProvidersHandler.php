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
 * Class Object Handler Providers
 */
class ProvidersHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wgbacklinks_providers', Providers::class, 'provider_id', 'provider_name');
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
     * Get Count Providers in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountProviders($start = 0, $limit = 0, $sort = 'provider_id ASC, provider_date_created', $order = 'ASC')
    {
        $criteriaCountProviders = new \CriteriaCompo();
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
        $criteriaAllProviders = new \CriteriaCompo();
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
     * @return mixed
     */
    private function getProvidersCriteria($criteriaProviders, $start, $limit, $sort, $order)
    {
        $criteriaProviders->setStart($start);
        $criteriaProviders->setLimit($limit);
        $criteriaProviders->setSort($sort);
        $criteriaProviders->setOrder($order);
        return $criteriaProviders;
    }

    /**
     * check whether the client is registered at the provider website, and add, if not exist
     *
     * @param array $provider , array $client
     * @param $client
     * @return string
     */
    public function addClientToProvider($provider, $client) {

        global $xoopsUser;

        $postdata = \http_build_query(
            array(
                'ptype'           => 'add-client',
                'provider_url'    => $provider['provider_url'],
                'provider_key'    => $provider['provider_key'],
                'client_url'      => $client['client_url'],
                'client_key'      => $client['client_key'],
                'client_addsite'  => $client['client_addsite'],
                'client_sitename' => $client['client_sitename'],
                'client_slogan'   => $client['client_slogan'],
                'pcsubmitter'     => ($xoopsUser->getVar('uname') . ' - ' . \XOOPS_URL)
            )
        );
        
        $helper = Helper::getInstance();
        return $helper->execExchangeData($provider['provider_url'], $postdata);
    }

    /**
     * delete the provider from table 'provider' in client website
     *
     * @param array $provider , array $client
     * @param $client
     * @return string
     */
    public function deleteClientFromProvider($provider, $client) {

        $postdata = \http_build_query(
            array(
                'ptype'        => 'delete-client',
                'client_url'   => $client['client_url'],
                'client_key'   => $client['client_key'],
                'provider_url' => $provider['provider_url'],
                'provider_key' => $provider['provider_key']        
            )
        );
        
        $helper = Helper::getInstance();
        return $helper->execExchangeData($provider['provider_url'], $postdata);
        
    }
    
    /**
     * validate whether the given website and key are valid for provider website
     *
     * @param array $provider
     * @return string
     */
    public function checkProviderKey($provider) {

        $postdata = \http_build_query(
            array(
                'ptype'        => 'check-provider-key',
                'provider_url' => $provider['provider_url'],
                'provider_key' => $provider['provider_key']
            )
        );
        
        $helper = Helper::getInstance();
        return $helper->execExchangeData($provider['provider_url'], $postdata);
        
    }
}
