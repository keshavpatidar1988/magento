<?php

class Vacsms_Smsnotification_Block_Adminhtml_Setting_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                
        $this->_objectId = 'id';
        $this->_blockGroup = 'smsnotification';
        $this->_controller = 'adminhtml_setting';
        $this->_updateButton('save', 'label', Mage::helper('smsnotification')->__('Save Item'));
        $this->_removeButton('reset');
        $this->_removeButton('back');    
        //$this->_addButton('setting_new', array(
        //'label'     => Mage::helper('smsnotification')->__('Test API'),
        //'onclick'   => "setLocation('{$this->getUrl('*/*/testapi')}')",
   //));
        
        }

    public function getHeaderText()
    {
        if( Mage::registry('setting_data') && Mage::registry('setting_data')->getId() ) {
            return Mage::helper('smsnotification')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('setting_data')->getTitle()));
        } else {
            return Mage::helper('smsnotification')->__('Add Item');
        }
    } 
} 

http://203.212.70.200/smpp/sendsms?username=vactest&password=vactest123&to=919873871377&from=VACTST&udh=&text=hello&dlr-mask=19&dlr-url
