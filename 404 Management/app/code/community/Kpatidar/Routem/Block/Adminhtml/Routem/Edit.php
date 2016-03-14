<?php

class Kpatidar_Routem_Block_Adminhtml_Routem_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                
        $this->_objectId = 'id';
        $this->_blockGroup = 'routem';
        $this->_controller = 'adminhtml_routem';
        $this->_updateButton('save', 'label', Mage::helper('routem')->__('Save Rule'));
        $this->_updateButton('delete', 'label', Mage::helper('routem')->__('Delete Rule'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('routem_data') && Mage::registry('routem_data')->getId() ) {
            return Mage::helper('routem')->__("Edit Rule Match '%s'", $this->htmlEscape(Mage::registry('routem_data')->getMatch()));
        } else {
            return Mage::helper('routem')->__('Add Rule');
        }
    }
} 
