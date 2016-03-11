<?php

class Promotions_Message_Block_Adminhtml_Message_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'message';
        $this->_controller = 'adminhtml_message';
        $this->_updateButton('save', 'label', Mage::helper('message')->__('Save Promotion'));
        $this->_updateButton('delete', 'label', Mage::helper('message')->__('Delete Promotion'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('message_data') && Mage::registry('message_data')->getId() ) {
            return Mage::helper('message')->__("Edit Promotion Match '%s'", $this->htmlEscape(Mage::registry('message_data')->getMatch()));
        } else {
            return Mage::helper('message')->__('Add Promotion');
        }
    }
    
    protected function _prepareLayout() {
    parent::_prepareLayout();
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
				if ($head = $this->getLayout()->getBlock('head')) {
					$head->addItem('js', 'prototype/window.js')
						->addItem('js_css', 'prototype/windows/themes/default.css')
						->addCss('lib/prototype/windows/themes/magento.css')
						->addItem('js', 'mage/adminhtml/variables.js');
				}
		}
	} 
}
