<?php

class Vacsms_Smsnotification_Block_Adminhtml_Smsnotification_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();              
        $this->_objectId = 'id';
        $this->_blockGroup = 'smsnotification';
        $this->_controller = 'adminhtml_smsnotification';

        $this->_updateButton('save', 'label', Mage::helper('smsnotification')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('smsnotification')->__('Delete'));
        $this->_removeButton('reset');
    }

    public function getHeaderText()
    {
        if( Mage::registry('smsnotification_data') && Mage::registry('smsnotification_data')->getId() ) {
            return Mage::helper('smsnotification')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('smsnotification_data')->getTitle()));
        } else {
            return Mage::helper('smsnotification')->__('Add Item');
        }
    }
}
