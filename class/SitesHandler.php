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
 * Class Object Handler Sites
 */
class SitesHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wgbacklinks_sites', Sites::class, 'site_id', 'site_name');
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
     * Get Count Sites in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountSites($start = 0, $limit = 0, $sort = 'site_id ASC, site_name', $order = 'ASC')
    {
        $criteriaCountSites = new \CriteriaCompo();
        $criteriaCountSites = $this->getSitesCriteria($criteriaCountSites, $start, $limit, $sort, $order);
        return parent::getCount($criteriaCountSites);
    }

    /**
     * Get All Sites in the database
     * @param int $start
     * @param int $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllSites($start = 0, $limit = 0, $sort = 'site_id ASC, site_name', $order = 'ASC')
    {
        $criteriaAllSites = new \CriteriaCompo();
        $criteriaAllSites = $this->getSitesCriteria($criteriaAllSites, $start, $limit, $sort, $order);
        return parent::getAll($criteriaAllSites);
    }


    /**
     * Get Criteria Sites
     * @param $criteriaSites
     * @param $start
     * @param $limit
     * @param $sort
     * @param $order
     * @return mixed
     */
    private function getSitesCriteria($criteriaSites, $start, $limit, $sort, $order)
    {
        $criteriaSites->setStart($start);
        $criteriaSites->setLimit($limit);
        $criteriaSites->setSort($sort);
        $criteriaSites->setOrder($order);
        return $criteriaSites;
    }

    /**
     * submit site data to all client websites
     *
     * @param array $site , array $client
     * @param $client
     * @return string
     */
    public function shareSite($site, $client) {

        global $xoopsUser;
        
        $postdata = \http_build_query(
            array(
                'ptype' => 'share-site',
                'client_key'     => $client['client_key'],
                'client_url'     => $client['client_url'],
                'site_name'      => $site['site_name'],
                'site_descr'     => $site['site_descr'],
                'site_url'       => $site['site_url'],
                'site_uniqueid'  => $site['site_uniqueid'],
                'site_active'    => $site['site_active'],
                'site_submitter' => $xoopsUser->getVar('uname') . ' - ' . \XOOPS_URL
            )
        );

        $helper = Helper::getInstance();
        return $helper->execExchangeData($client['client_url'], $postdata);
    }
}
