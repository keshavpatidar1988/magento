<?php

class Promotions_Message_Model_Observer {
    private static $_handleCustomerFirstSearchCounter = 1;
    
    public function checkCartSubtotal(Varien_Event_Observer $observer) {
        $_handleCustomerFirstSearchCounter++;
        if (($this->checkModuleStatus() == 1)) {
            $subtotal = Mage::helper('checkout/cart')->getQuote()->getSubtotal();
            //Adds Custom message to shopping cart 
            $collections = $this->getFilteredData($subtotal);
            foreach ($collections as $collection) { 
                if ($collection['p_location'] == 1) { // Show only for cart items
                    $messages = html_entity_decode(stripslashes($collection['p_message']));
                    //Mage::getSingleton('checkout/session')->addSuccess(nl2br($messages));
                }
            }  
        }
    }  
    // Check module status in admin
    public function checkModuleStatus() {
        $storeId = Mage::app()->getStore()->getStoreId();
        return Mage::getStoreConfig('message/messagestatus/status', $storeId);
    }

    // get collection of promotions from database.
    public function getFilteredData($range) {
        $collection = Mage::getModel('message/message')->getCollection()
                ->addFieldToSelect('p_amount_less')
                ->addFieldToSelect('p_amount_greater')
                ->addFieldToSelect('p_message')
                ->addFieldToSelect('p_location')
                ->addFieldToFilter('p_amount_greater', array('lteq' => $range))
                ->addFieldToFilter('p_amount_less', array('gteq' => $range))
                ->addFieldToFilter('status', 1);
        return $collection->getData();
    }

}

