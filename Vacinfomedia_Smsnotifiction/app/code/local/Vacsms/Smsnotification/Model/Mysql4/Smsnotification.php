<?php
class Vacsms_Smsnotification_Model_Mysql4_Smsnotification extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('smsnotification/smsnotification', 'smsnotification_id');
    }
}  
