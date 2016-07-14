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

class Magcoder_Promotions_Model_Observer {
    private static $_handleCustomerFirstSearchCounter = 1;
    
    public function checkCartSubtotal(Varien_Event_Observer $observer) {
        $_handleCustomerFirstSearchCounter++;
        if (($this->checkModuleStatus() == 1)) {
            $subtotal = Mage::helper('checkout/cart')->getQuote()->getSubtotal();
            //Adds Custom promotions to shopping cart 
            $collections = $this->getFilteredData($subtotal);
            foreach ($collections as $collection) { 
                if ($collection['p_location'] == 1) { // Show only for cart items
                    $promotionss = html_entity_decode(stripslashes($collection['p_promotions']));
                    //Mage::getSingleton('checkout/session')->addSuccess(nl2br($promotionss));
                }
            }  
        } 
    }  
    // Check module status in admin
    public function checkModuleStatus() {
        $storeId = Mage::app()->getStore()->getStoreId();
        return Mage::getStoreConfig('promotions/promotionsstatus/status', $storeId);
    }

    // get collection of promotions from database.
    public function getFilteredData($range) {
        $collection = Mage::getModel('promotions/promotions')->getCollection()
                ->addFieldToSelect('p_amount_less')
                ->addFieldToSelect('p_amount_greater')
                ->addFieldToSelect('p_promotions')
                ->addFieldToSelect('p_location')
                ->addFieldToSelect('store_id')
                ->addFieldToFilter('p_amount_greater', array('lteq' => $range))
                ->addFieldToFilter('p_amount_less', array('gteq' => $range))
                ->addFieldToFilter('status', 1);
        return $collection->getData();
    }

}
 
