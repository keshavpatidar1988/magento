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

class Magcoder_Promotions_Block_Adminhtml_Promotions_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() { 
        $form = new Varien_Data_Form(); 
        $this->setForm($form);
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('add_variables' => false, 
            'add_widgets' => false,
            'add_images' => true,
            'files_browser_window_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index'),
            'files_browser_window_width' => (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_width'),
            'files_browser_window_height' => (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_height')
        )); 
        $fieldset = $form->addFieldset('promotions_form', array('legend' => Mage::helper('promotions')->__('Promotions Detail')));
        $fullMatch = Mage::helper('promotions')->__('Promotion amount less than X.');
        $partialMatch = Mage::helper('promotions')->__('Promotion amount greater than X. '); 
        $advancedMatch = Mage::helper('promotions')->__('Increase your order to $500.00 and receive a 10% discount.');
        //$destinationPromotions = Mage::helper('promotions')->__('i.e Increase your order to $500.00 and receive a 10% discount');
        //$afterElementHtmlMatch = '<p class="nm"><small>' . ' <ul><li>'.$fullMatch.'</li><li>'.$partialMatch.'</li><li>'.$advancedMatch.'</li></ul> ' . '</small></p>';    
        //$afterElementHtmlDestination = '<p class="nm"><small>' .$destinationPromotions. '</small></p>';  
        $fieldset->addField('p_location', 'select', array(
            'label' => Mage::helper('promotions')->__('Promotion Location'),
            'name' => 'p_location',
            'class' => 'required-entry',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('promotions')->__('Cart Page'),
                ),
            ),
        ));

        $fieldset->addField('p_amount_less', 'text', array(
            'label' => Mage::helper('promotions')->__('Subtotal less than'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'p_amount_less',
            'after_element_html' => $fullMatch,
        ));

        $fieldset->addField('p_amount_greater', 'text', array(
            'label' => Mage::helper('promotions')->__('Subtotal greater than'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'p_amount_greater',
            'after_element_html' => $partialMatch,
        ));
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'stores[]',
                'label' => Mage::helper('promotions')->__('Store View'),
                'title' => Mage::helper('promotions')->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')
                        ->getStoreValuesForForm(false, true),
            ));
        } else {  
            $fieldset->addField('store_id', 'hidden', array(
                'name' => 'stores[]',
                'value' => Mage::app()->getStore(true)->getId()
            ));
        }
        /*
          $fieldset->addField('p_promotions', 'editor', array(
          'name'      => 'p_promotions',
          'label'     => Mage::helper('promotions')->__('Promotion Promotions'),
          'title'     => Mage::helper('promotions')->__('Promotion Promotions'),
          'style'     => 'height:15em',
          'config'    => $wysiwygConfig,
          'wysiwyg'   => true,
          'required'  => false,
          )); */

        $fieldset->addField('p_promotions', 'editor', array(
            'name' => 'p_promotions',
            'label' => Mage::helper('promotions')->__('Content'),
            'title' => Mage::helper('promotions')->__('Content'),
            'style' =>'height:15em;width:600px;',
            'config' => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
            'wysiwyg' => true,
            'required' => true,
        )); 

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('promotions')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('promotions')->__('Active'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('promotions')->__('Inactive'),
                ),
            ),
        ));

        if (Mage::getSingleton('adminhtml/session')->getPromotionsData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getPromotionsData());
            Mage::getSingleton('adminhtml/session')->setPromotionsData(null);
        } elseif (Mage::registry('promotions_data')) {
            $form->setValues(Mage::registry('promotions_data')->getData());
        }
        return parent::_prepareForm();
    }

}
 