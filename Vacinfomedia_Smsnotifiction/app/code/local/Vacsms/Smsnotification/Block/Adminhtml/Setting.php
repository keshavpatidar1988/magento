<?php
class Vacsms_Smsnotification_Block_Adminhtml_Setting extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_setting';
        $this->_blockGroup = 'smsnotification';
        $this->_headerText = Mage::helper('smsnotification')->__('SMS Setting');
        $this->_addButtonLabel = Mage::helper('smsnotification')->__('Add Item');
        parent::__construct();
    }
}
