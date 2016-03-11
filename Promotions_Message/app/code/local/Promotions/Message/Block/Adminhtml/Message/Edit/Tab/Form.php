<?php

class Promotions_Message_Block_Adminhtml_Message_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{ 
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
    $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array('add_variables' => false,
          'add_widgets' => false, 
          'add_images' => true,
          'files_browser_window_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/cms_wysiwyg_images/index'),
          'files_browser_window_width' => (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_width'),
          'files_browser_window_height'=> (int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_height')
         ));  
        $fieldset = $form->addFieldset('message_form', array('legend'=>Mage::helper('message')->__('Message Detail'))); 
        $fullMatch = Mage::helper('message')->__('Promotion amount less than X.');
        $partialMatch = Mage::helper('message')->__('Promotion amount greater than X. ');
        $advancedMatch = Mage::helper('message')->__('Increase your order to $500.00 and receive a 10% discount.');
        //$destinationMessage = Mage::helper('message')->__('i.e Increase your order to $500.00 and receive a 10% discount');
        //$afterElementHtmlMatch = '<p class="nm"><small>' . ' <ul><li>'.$fullMatch.'</li><li>'.$partialMatch.'</li><li>'.$advancedMatch.'</li></ul> ' . '</small></p>';    
        //$afterElementHtmlDestination = '<p class="nm"><small>' .$destinationMessage. '</small></p>';  
        $fieldset->addField('p_location', 'select', array(
            'label'     => Mage::helper('message')->__('Promotion Location'),
            'name'      => 'p_location',
            'class'     => 'required-entry', 
            'values'    => array( 
                array(
                    'value'     => 1, 
                    'label'     => Mage::helper('message')->__('Cart Page'),
                ),
                array(
                    'value'     => 2,
                    'label'     => Mage::helper('message')->__('Below Header'),
                ), 
                array(
                    'value'     => 3,
                    'label'     => Mage::helper('message')->__('Above Footer'),
                ), 
            ),
        ));
        
        $fieldset->addField('p_amount_less', 'text', array(
            'label'     => Mage::helper('message')->__('Promotion amount less than'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'p_amount_less',
            'after_element_html' => $fullMatch,
        ));
        
        $fieldset->addField('p_amount_greater', 'text', array(
            'label'     => Mage::helper('message')->__('Promotion amount greater than'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'p_amount_greater',
            'after_element_html' => $partialMatch,
        ));
             
        /* 
		$fieldset->addField('p_message', 'editor', array(
			'name'      => 'p_message',
			'label'     => Mage::helper('message')->__('Promotion Message'),
			'title'     => Mage::helper('message')->__('Promotion Message'),
			'style'     => 'height:15em',
			'config'    => $wysiwygConfig,
			'wysiwyg'   => true,
			'required'  => false,
		)); */
		
		$fieldset->addField('p_message', 'editor', array(
			'name'      => 'p_message',
			'label'     => Mage::helper('message')->__('Content'),
			'title'     => Mage::helper('message')->__('Content'),
			'style'     => 'height:15em',
			'config'      => Mage::getSingleton('cms/wysiwyg_config')->getConfig(), 
			'wysiwyg'   => true,
			'required'  => true,
		));
		
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('message')->__('Status'),
            'name'      => 'status',
            'values'    => array( 
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('message')->__('Active'),
                ),
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('message')->__('Inactive'),
                ), 
            ),
        )); 
             
        if ( Mage::getSingleton('adminhtml/session')->getMessageData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getMessageData());
            Mage::getSingleton('adminhtml/session')->setMessageData(null);
        } elseif ( Mage::registry('message_data') ) {
            $form->setValues(Mage::registry('message_data')->getData());
        }
        return parent::_prepareForm();
    }
}
