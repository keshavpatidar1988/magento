<?php

class Kpatidar_Routem_Block_Adminhtml_Routem_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('routem_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('routem')->__('Rule Detail'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('routem')->__('Rule Detail'),
            'title'     => Mage::helper('routem')->__('Rule Detail'),
            'content'   => $this->getLayout()->createBlock('routem/adminhtml_routem_edit_tab_form')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}
   
