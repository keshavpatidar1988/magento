<?php

class Kpatidar_Routem_Model_Mysql4_Routem extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('routem/routem', 'routem_id');
    }
} 
