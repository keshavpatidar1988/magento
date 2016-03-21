<?php
class Vacsms_Smsnotification_Block_Adminhtml_Smsnotification_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('smsnotification_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('smsnotification')->__('Manage notification Messages'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('smsnotification')->__('Notification Message'),
            'title'     => Mage::helper('smsnotification')->__('Notification Message'),
            'content'   => $this->getLayout()->createBlock('smsnotification/adminhtml_smsnotification_edit_tab_form')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}
  
 
