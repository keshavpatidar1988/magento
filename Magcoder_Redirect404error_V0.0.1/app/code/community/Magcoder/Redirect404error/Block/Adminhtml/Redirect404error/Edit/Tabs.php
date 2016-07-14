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

class Magcoder_Redirect404error_Block_Adminhtml_Redirect404error_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('redirect404error_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('redirect404error')->__('Rule Detail'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('redirect404error')->__('Rule Detail'),
            'title'     => Mage::helper('redirect404error')->__('Rule Detail'),
            'content'   => $this->getLayout()->createBlock('redirect404error/adminhtml_redirect404error_edit_tab_form')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}
   
