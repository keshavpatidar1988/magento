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
 * @package      Redirect 404 Error
 * @license      http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Support <support@magcoders.com>
 * 
 */
?>
<?php

class Magcoder_Redirect404error_Block_Adminhtml_Redirect404error_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct(); 
                
        $this->_objectId = 'id';
        $this->_blockGroup = 'redirect404error';
        $this->_controller = 'adminhtml_redirect404error';
        $this->_updateButton('save', 'label', Mage::helper('redirect404error')->__('Save Rule'));
        $this->_updateButton('delete', 'label', Mage::helper('redirect404error')->__('Delete Rule'));
    }

    public function getHeaderText()
    {
        if( Mage::registry('redirect404error_data') && Mage::registry('redirect404error_data')->getId() ) {
            return Mage::helper('redirect404error')->__("Edit Rule Match '%s'", $this->htmlEscape(Mage::registry('redirect404error_data')->getMatch()));
        } else {
            return Mage::helper('redirect404error')->__('Add Rule');
        }
    }
} 
