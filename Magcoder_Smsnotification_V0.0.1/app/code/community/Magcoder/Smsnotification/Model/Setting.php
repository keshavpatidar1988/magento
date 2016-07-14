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
class Magcoder_Smsnotification_Model_Setting extends Mage_Core_Model_Abstract
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
 
