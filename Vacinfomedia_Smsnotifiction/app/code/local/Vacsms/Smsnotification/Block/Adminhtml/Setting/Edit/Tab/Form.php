<?php
class Vacsms_Smsnotification_Block_Adminhtml_Setting_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('setting_form', array('legend'=>Mage::helper('smsnotification')->__('SMS API configuration')));
        $fieldset->addField('apiurl', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('API URL'),
            'class'     => 'required-entry validate-length minimum-length-10 maximum-length-500',
            'required'  => true,
            'name'      => 'apiurl',
            'note'      =>'Example: http://111.212.70.200/smpp/sendsms', 
        ));
        $fieldset->addField('apitestingnumber', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('Mobile No. (Testing)'),
            'class'     => 'required-entry validate-length minimum-length-10 maximum-length-10',
            'required'  => true,
            'name'      => 'apitestingnumber',
            'note'      =>'This number will be used for testing API only.', 
        ));
        $fieldset->addField('username', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('API Username'), 
            'class'     => 'required-entry validate-length minimum-length-3 maximum-length-100',
            'required'  => true,
            'name'      => 'username',
            'note'      =>'Example: XXXXX', 
        )); 
        $fieldset->addField('password', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('API Password'),
            'class'     => 'required-entry validate-length minimum-length-3 maximum-length-100',
            'required'  => true,
            'name'      => 'password',
            'note'      =>'Example: XXXXX', 
        )); 
        $fieldset->addField('fromname', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('From Name'),
            'class'     => 'required-entry validate-length minimum-length-3 maximum-length-10',
            'required'  => true,
            'name'      => 'fromname',
            'note'      =>'Example: XYZSHOP Should be same as registred one.',  
        )); 
        $fieldset->addField('defaultmessage', 'editor', array(
            'name'      => 'defaultmessage',
            'label'     => Mage::helper('smsnotification')->__('API Test Message'),
            'title'     => Mage::helper('smsnotification')->__('API TestMessage'),
            'style'     => 'width:98%; height:200px;',
            'class'     =>'validate-length minimum-length-10 maximum-length-250',
            'note'      => 'Message upto 250 charactor (Min 10). If API setup is correct then this message get delivered on the above mobile number and testing will be passed.',
            'wysiwyg'   => false,
            'required'  => true, 
        )); 
        $fieldset->addField('udh', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('UDH'),
            'class'     => 'validate-length minimum-length-0 maximum-length-100',
            'name'      => 'udh',
            'note'      => 'If required in API then use. Currently its not required.', 
        )); 
        $fieldset->addField('dlrmask', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('DLR Mask'),
            'name'      => 'dlrmask',
            'note'      => 'If required in API then use. Currently its not required.', 
        )); 
        $fieldset->addField('dlrurl', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('DLR Url'),
            'name'      => 'dlrurl',
            'class'     => 'validate-length minimum-length-0 maximum-length-500',
            'note'      => 'If required in API then use. Currently its not required.', 
        )); 
        if ( Mage::getSingleton('adminhtml/session')->getSmsnotificationData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSmsnotificationData());
            Mage::getSingleton('adminhtml/session')->setSmsnotificationData(null);
        } elseif ( Mage::registry('setting_data') ) {
            $form->setValues(Mage::registry('setting_data')->getData());
        }
        return parent::_prepareForm();
    }
}  
