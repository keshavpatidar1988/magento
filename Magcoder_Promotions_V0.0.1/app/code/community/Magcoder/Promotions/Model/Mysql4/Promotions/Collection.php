<?php
/*
 * Magcoder
 * 
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * versions in the future. If you wish to customize this extension for your
 * needs please refer to http://www.magcoders.com/ for more information.
 *
 * @category     community
 * @package      Promotions
 * @license      http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Support <support@magcoders.com>
 * 
 */
?>
<?php
class Magcoder_Promotions_Model_Mysql4_Promotions_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{ 
    public function _construct()
    {
        //parent::__construct(); 
        $this->_init('promotions/promotions');
    }
        public function addStoreFilter($store, $withAdmin = true) {

        if ($store instanceof Mage_Core_Model_Store) {
            $store = array($store->getId());
        }
 
        if (!is_array($store)) {
            $store = array($store);
        }

        $this->addFilter('store_id', array('in' => $store));

        return $this;
    }
} 
     