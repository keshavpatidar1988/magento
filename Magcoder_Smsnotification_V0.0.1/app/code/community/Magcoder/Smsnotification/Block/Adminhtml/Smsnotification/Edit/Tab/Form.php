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
class Magcoder_Smsnotification_Block_Adminhtml_Smsnotification_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('smsnotification_form', array('legend'=>Mage::helper('smsnotification')->__('Item information')));
        
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));
            $fieldset->addField('adminnotificationno', 'text', array(
            'label'     => Mage::helper('smsnotification')->__('Admin Notification No.#'),
            'class'     =>'validate-digits validate-length minimum-length-10 maximum-length-10',
            'name'      => 'adminnotificationno',
            'note'      => 'Example: 9752797524 (Should be 10 digits only)',
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('smsnotification')->__('Status'),
            'name'      => 'status',
            'note'      => 'Status Inactive will not participate in SMS notification.',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('smsnotification')->__('Active'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('smsnotification')->__('Inactive'),
                ),
            ),
        ));
              $fieldset->addField('notificationtype', 'select', array(
            'label'     => Mage::helper('smsnotification')->__('Notification'),
            'name'      => 'notificationtype',
            'note'      => 'Notification message according to status',
            'values'    => array(
                array(
                    'value'     => 'neworder',
                    'label'     => Mage::helper('smsnotification')->__('New Order'),
                ),
                array( 
                    'value'     => 'invoice',
                    'label'     => Mage::helper('smsnotification')->__('Invoice'),
                ),
                  array(
                    'value'     => 'shipment',
                    'label'     => Mage::helper('smsnotification')->__('Shipment'),
                ),
                  array(
                    'value'     => 'complete',
                    'label'     => Mage::helper('smsnotification')->__('Complete'),
                ),
            ),
        ));
        
        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('smsnotification')->__('Message'),
            'title'     => Mage::helper('smsnotification')->__('Message'),
            'style'     => 'width:98%; height:200px;',
            'class'     =>'validate-length minimum-length-10 maximum-length-250',
            'note'      => 'Message up-to 250 character (Min 10). Order number will be added dynamically to message before sending to user/admin.',
            'wysiwyg'   => false,
            'required'  => true,
        )); 
        
        if ( Mage::getSingleton('adminhtml/session')->getSmsnotificationData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSmsnotificationData());
            Mage::getSingleton('adminhtml/session')->setSmsnotificationData(null);
        } elseif ( Mage::registry('smsnotification_data') ) {
            $form->setValues(Mage::registry('smsnotification_data')->getData());
        }
        return parent::_prepareForm();
    }
}
