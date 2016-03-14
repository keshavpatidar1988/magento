<?php

class Kpatidar_Routem_Model_Routem extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('routem/routem');
    }
}
