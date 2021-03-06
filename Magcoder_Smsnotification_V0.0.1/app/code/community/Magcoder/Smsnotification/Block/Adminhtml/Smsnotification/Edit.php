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
 * @package      Smsnotification for vacinfomedia API
 * @license      http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Support <support@magcoders.com>
 * 
 */
?>
<?php

class Magcoder_Smsnotification_Block_Adminhtml_Smsnotification_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
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
