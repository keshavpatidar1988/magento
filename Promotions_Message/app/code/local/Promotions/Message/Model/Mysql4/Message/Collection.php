<?php

class Promotions_Message_Model_Mysql4_Message_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('message/message');
    }
} 
