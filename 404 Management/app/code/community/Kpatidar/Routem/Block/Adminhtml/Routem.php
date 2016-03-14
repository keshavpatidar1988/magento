<?php

class Kpatidar_Routem_Block_Adminhtml_Routem extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_routem';
        $this->_blockGroup = 'routem';
        $this->_headerText = Mage::helper('routem')->__('404 Management');
        $this->_addButtonLabel = Mage::helper('routem')->__('Add Rule');
        parent::__construct();
    }
} 
 
