<?php
class Vacsms_Smsnotification_Model_Mysql4_Smsnotification_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('smsnotification/smsnotification');
    }
}
