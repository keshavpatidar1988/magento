<?php

class Kpatidar_Routem_Block_Adminhtml_Routem_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{ 
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('routem_form', array('legend'=>Mage::helper('routem')->__('Rule Detail'))); 
        $fullMatch = Mage::helper('routem')->__('i.e Full Match: demo/demo1/demo-dress.html.');
        $partialMatch = Mage::helper('routem')->__('i.e Partial Match: dress or shirt or pant etc. ');
        $advancedMatch = Mage::helper('routem')->__('i.e Advanced Match: regular expressions like /\bdress\b/i current one will find dress.');
        $destinationMessage = Mage::helper('routem')->__('i.e demo.html, demo/demo.html.');
        $afterElementHtmlMatch = '<p class="nm"><small>' . ' <ul><li>'.$fullMatch.'</li><li>'.$partialMatch.'</li><li>'.$advancedMatch.'</li></ul> ' . '</small></p>';    
        $afterElementHtmlDestination = '<p class="nm"><small>' .$destinationMessage. '</small></p>';  
        $fieldset->addField('match_type', 'select', array(
            'label'     => Mage::helper('routem')->__('Match Type'),
            'name'      => 'match_type',
            'class'     => 'required-entry', 
            'values'    => array( 
                array(
                    'value'     => 1, 
                    'label'     => Mage::helper('routem')->__('Full Match'),
                ),
                array(
                    'value'     => 2,
                    'label'     => Mage::helper('routem')->__('Partial Match'),
                ), 
                array(
                    'value'     => 3,
                    'label'     => Mage::helper('routem')->__('Advanced Match'),
                ), 
            ),
        ));
        
        $fieldset->addField('match', 'text', array(
            'label'     => Mage::helper('routem')->__('Match'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'match',
            'after_element_html' => $afterElementHtmlMatch,
        ));
        
        $fieldset->addField('destination', 'text', array(
            'label'     => Mage::helper('routem')->__('Destination'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'destination',
            'after_element_html' => $afterElementHtmlDestination,
        ));
        
        $fieldset->addField('redirect', 'select', array(
            'label'     => Mage::helper('routem')->__('Redirect'),
            'name'      => 'redirect',
            'values'    => array( 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('routem')->__('Default'),
                ),
                array(
                    'value'     => 302, 
                    'label'     => Mage::helper('routem')->__('Temporary (302)'),
                ),
                array(
                    'value'     => 301,
                    'label'     => Mage::helper('routem')->__('Permanent (301)'), 
            ),
            ),
        )); 
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('routem')->__('Status'),
            'name'      => 'status',
            'values'    => array( 
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('routem')->__('Active'),
                ),
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('routem')->__('Inactive'),
                ), 
            ),
        )); 
             
        if ( Mage::getSingleton('adminhtml/session')->getRoutemData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getRoutemData());
            Mage::getSingleton('adminhtml/session')->setRoutemData(null);
        } elseif ( Mage::registry('routem_data') ) {
            $form->setValues(Mage::registry('routem_data')->getData());
        }
        return parent::_prepareForm();
    }
}
