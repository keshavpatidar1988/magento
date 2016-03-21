<?php
class Vacsms_Smsnotification_Model_Setting extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('smsnotification/setting');
    }
    
    public function testSmsapi($url){
	     $ch = curl_init($url);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 $result = curl_exec($ch);
		 return $result;
	}
	public function sentSmsNotifictions($formatedMessage,$notifictionSendingNo){
    $resource = Mage::getSingleton('core/resource');
    $readConnection = $resource->getConnection('core_read');
    $query = 'SELECT * FROM ' . $resource->getTableName('smsnotification/setting'). ' WHERE status = 1';
    $results = $readConnection->fetchRow($query);
    $url = trim($results['apiurl'])."?username=".trim($results['username'])."&password=".trim($results['password'])."&to=91".trim($notifictionSendingNo)."&from=".trim($results['fromname'])."&udh=".trim($results['udh'])."&text=".trim(urlencode($formatedMessage))."&dlr-mask=".trim($results['dlrmask'])."&dlr-url";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	return $result;
	} 
}
 
