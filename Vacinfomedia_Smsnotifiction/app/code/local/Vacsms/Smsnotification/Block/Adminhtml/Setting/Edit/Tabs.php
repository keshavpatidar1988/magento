<?php
class Vacsms_Smsnotification_Block_Adminhtml_Setting_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('setting_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('smsnotification')->__('SMS API Setting'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('smsnotification')->__('SMS API Setting'),
            'title'     => Mage::helper('smsnotification')->__('SMS API Setting'),
            'content'   => $this->getLayout()->createBlock('smsnotification/adminhtml_setting_edit_tab_form')->toHtml(),
        ));        
        return parent::_beforeToHtml();
    }
}
  
 
