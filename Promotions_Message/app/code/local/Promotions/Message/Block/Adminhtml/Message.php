<?php

class Promotions_Message_Block_Adminhtml_Message extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_message';
        $this->_blockGroup = 'message';
        $this->_headerText = Mage::helper('message')->__('Promotions Management');
        $this->_addButtonLabel = Mage::helper('message')->__('Add Promotion');
        parent::__construct();
    }
} 
 

