<?php
class Vacsms_Smsnotification_Model_Observer {
    public function example(Varien_Event_Observer $observer) {
		$orderId = $observer->getEvent()->getOrderIds();
		if($orderId[0] && $orderId[0]!==''){
		 $order_id = $orderId[0];
		 $order = Mage::getModel('sales/order')->load($order_id);
  		
        if($order->getCustomerId() === NULL){
				$checkBillingNumber = $order->getBillingAddress()->getTelephone();
				$checkShippingNumber = $order->getShippingAddress()->getTelephone();
				if($checkBillingNumber){
				$notificationNumber = $checkBillingNumber;
				} else if($checkShippingNumber) {
				$notificationNumber = $checkShippingNumber;
				} else { 
				$notificationNumber = "blank";
				}
		} else {
				$customer = Mage::getModel('customer/customer')->load($order->getCustomerId());
				$checkDefaultBillingNumber = $customer->getDefaultBillingAddress()->getTelephone();
				if($checkDefaultBillingNumber) {
				$notificationNumber = $checkDefaultBillingNumber;
				} else {
				$notificationNumber = "blank";
		      }
		}	
		if($notificationNumber!=trim('blank')){
	    $notificationtype= trim('neworder'); 
       	$results = Mage::getModel('smsnotification/smsnotification')->notificationSms($notificationtype);
      	foreach($results as $result){
			$total = Mage::helper('core')->currency($order->getGrandTotal() , true, false);
			$orderID = $order->getIncrementId();
			$roughContent = $result->getContent();
			$adminNotifiction = $result->getAdminnotificationno();
			$myaccountUrl = Mage::getUrl('customer/account');
			$keywords = array("#ORDERNO#", "#GTOTAL#", "#URL#");
			$replacement   = array($orderID, $total, $myaccountUrl);
			$formatedContent = str_replace($keywords, $replacement, $roughContent);
		    $resultCustomer = Mage::getModel('smsnotification/setting')->sentSmsNotifictions(trim($formatedContent), trim($notificationNumber));
			if($resultCustomer == trim("Sent.")){ 
				Mage::log('Notification sent to customer #'.$order->getIncrementId(), null, 'smsnotification.log');
			} else {
				Mage::log('Unable to sent message to customer due to '.$resultCustomer. 'For order # '.$order->getIncrementId(), null, 'smsnotification.log');
			}
			$resultAdmin = Mage::getModel('smsnotification/setting')->sentSmsNotifictions(trim($formatedContent."Admin"), trim($adminNotifiction));
			if($resultAdmin == trim("Sent.")){ 
				Mage::log('Notification sent to admin #'.$order->getIncrementId(), null, 'smsnotification.log');
			} else {
				Mage::log('Unable to sent message to admin due to '.$resultAdmin. 'For order # '.$order->getIncrementId(), null, 'smsnotification.log');
			}

		}
		}        

		} else {
	
		$request = Mage::app()->getRequest()->getParams();
		$order_id = $request['order_id'];
		$order = Mage::getModel('sales/order')->load($order_id);
		Mage::log('Order State (Currently not qualifying for sms notification only new orders)'.$order->getState(), null, 'smsnotification.log');
		}
		
    }
}  
