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
class Magcoder_Smsnotification_Block_Adminhtml_Setting_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
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
  
 
