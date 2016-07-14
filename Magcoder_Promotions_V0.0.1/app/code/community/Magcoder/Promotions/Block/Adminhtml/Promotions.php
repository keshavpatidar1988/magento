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

class Magcoder_Promotions_Block_Adminhtml_Promotions extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_promotions';
        $this->_blockGroup = 'promotions';
        $this->_headerText = Mage::helper('promotions')->__('Promotions Management');
        $this->_addButtonLabel = Mage::helper('promotions')->__('Add Promotion');
        parent::__construct();
    }
} 
 

 