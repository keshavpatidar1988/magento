<?php
class Vacsms_Smsnotification_Model_Smsnotification extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('smsnotification/smsnotification');
    }
    
    public function notificationSms($notificationtype)
    {
	    $smsNotificationMessage = Mage::getModel('smsnotification/smsnotification')->getCollection();
        $smsNotificationMessage->addFieldToFilter('notificationtype', array('eq' => trim($notificationtype)));
        $smsNotificationMessage->addFieldToFilter('status', array('eq' => 1));
        return $smsNotificationMessage;
        //foreach($smsNotificationMessage as $singleMessage){
        //$smsTitle = $singleMessage->getTitle();
        //$smsContent = $singleMessage->getContent();
        //}
        //echo $smsTitle;
        //echo "<br/>";
        //echo $smsContent;
        //die('d');
	}
}
