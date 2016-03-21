<?php
class Vacsms_Smsnotification_Model_Mysql4_Setting extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('smsnotification/setting', 'setting_id');
    }
}  
