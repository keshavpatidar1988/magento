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
class Magcoder_Smsnotification_Model_Smsnotification extends Mage_Core_Model_Abstract
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
	}
}
