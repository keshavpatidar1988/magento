<?php
/*
 * Magcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * versions in the future. If you wish to customize this extension for your
 * needs please refer to http://www.magcoders.com/ for more information.
 *
 * @category     community
 * @package      Promotions
 * @license      http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Support <support@magcoders.com>
 * 
 */
?>
<?php

class Magcoder_Promotions_Block_Adminhtml_Promotions_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'promotions';
        $this->_controller = 'adminhtml_promotions';
        $this->_updateButton('save', 'label', Mage::helper('promotions')->__('Save Promotion'));
        $this->_updateButton('delete', 'label', Mage::helper('promotions')->__('Delete Promotion'));
    }
  
    public function getHeaderText()
    {
        if( Mage::registry('promotions_data') && Mage::registry('promotions_data')->getId() ) {
            return Mage::helper('promotions')->__("Edit Promotion ", $this->htmlEscape(Mage::registry('promotions_data')->getMatch()));
        } else {
            return Mage::helper('promotions')->__('Add Promotion');
        }
    }
    
    protected function _prepareLayout() {
    parent::_prepareLayout();
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
				if ($head = $this->getLayout()->getBlock('head')) {
					$head->addItem('js', 'lib/flex.js')
                         ->addItem('js', 'lib/FABridge.js')
                         ->addItem('js', 'mage/adminhtml/flexuploader.js')
                         ->addItem('js', 'mage/adminhtml/browser.js')
                         ->addItem('js', 'prototype/window.js')
                         ->addItem('js', 'prototype/prototype.js') 
                         ->addItem('js_css', 'prototype/windows/themes/default.css')
                         ->addCss('lib/prototype/windows/themes/magento.css')
                         ->addItem('js', 'mage/adminhtml/variables.js');
				}
		}
	} 
}
 