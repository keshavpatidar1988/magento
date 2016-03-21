<?php
class Vacsms_Smsnotification_Block_Adminhtml_Smsnotification extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_smsnotification';
        $this->_blockGroup = 'smsnotification';
        $this->_headerText = Mage::helper('smsnotification')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('smsnotification')->__('Add Item');
        parent::__construct();
    }
}
 
