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

class Magcoder_Redirect404error_Block_Adminhtml_Redirect404error_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{ 
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('redirect404error_form', array('legend'=>Mage::helper('redirect404error')->__('Rule Detail'))); 
        $fullMatch = Mage::helper('redirect404error')->__('i.e Full Match: test/test1/test-dress.html.');
        $partialMatch = Mage::helper('redirect404error')->__('i.e Partial Match: dress or blue or pink etc. ');
        $advancedMatch = Mage::helper('redirect404error')->__('i.e Advanced Match: regular expressions like /\bgreen\b/i current one will find dress.');
        $destinationMessage = Mage::helper('redirect404error')->__('i.e test.html, test/test.html.');
        $afterElementHtmlMatch = '<p class="nm"><small>' . ' <ul><li>'.$fullMatch.'</li><li>'.$partialMatch.'</li><li>'.$advancedMatch.'</li></ul> ' . '</small></p>';    
        $afterElementHtmlDestination = '<p class="nm"><small>' .$destinationMessage. '</small></p>';  
        $fieldset->addField('match_type', 'select', array(
            'label'     => Mage::helper('redirect404error')->__('Match Type'),
            'name'      => 'match_type',
            'class'     => 'required-entry', 
            'values'    => array( 
                array(
                    'value'     => 1, 
                    'label'     => Mage::helper('redirect404error')->__('Full Match'),
                ),
                array(
                    'value'     => 2,
                    'label'     => Mage::helper('redirect404error')->__('Partial Match'),
                ), 
                array(
                    'value'     => 3,
                    'label'     => Mage::helper('redirect404error')->__('Advanced Match'),
                ), 
            ),
        ));
        
        $fieldset->addField('match', 'text', array(
            'label'     => Mage::helper('redirect404error')->__('Match'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'match',
            'after_element_html' => $afterElementHtmlMatch,
        ));
        
        $fieldset->addField('destination', 'text', array(
            'label'     => Mage::helper('redirect404error')->__('Destination'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'destination',
            'after_element_html' => $afterElementHtmlDestination,
        ));
        
        $fieldset->addField('redirect', 'select', array(
            'label'     => Mage::helper('redirect404error')->__('Redirect'),
            'name'      => 'redirect',
            'values'    => array( 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('redirect404error')->__('Default'),
                ),
                array(
                    'value'     => 302, 
                    'label'     => Mage::helper('redirect404error')->__('Temporary (302)'),
                ),
                array(
                    'value'     => 301,
                    'label'     => Mage::helper('redirect404error')->__('Permanent (301)'), 
            ),
            ),
        )); 
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('redirect404error')->__('Status'),
            'name'      => 'status',
            'values'    => array( 
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('redirect404error')->__('Active'),
                ),
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('redirect404error')->__('Inactive'),
                ), 
            ),
        )); 
             
        if ( Mage::getSingleton('adminhtml/session')->getRedirect404errorData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getRedirect404errorData());
            Mage::getSingleton('adminhtml/session')->setRedirect404errorData(null);
        } elseif ( Mage::registry('redirect404error_data') ) {
            $form->setValues(Mage::registry('redirect404error_data')->getData());
        }
        return parent::_prepareForm();
    } 
}
