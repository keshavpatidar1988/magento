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
class Magcoder_Smsnotification_Adminhtml_SmsnotificationController extends Mage_Adminhtml_Controller_action
{

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('smsnotification/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }    
    
    public function indexAction() {
        $this->_initAction();        
        $this->_addContent($this->getLayout()->createBlock('smsnotification/adminhtml_smsnotification'));
        $this->renderLayout();
    }

    public function editAction()
    {
        $smsnotificationId     = $this->getRequest()->getParam('id');
        $smsnotificationModel  = Mage::getModel('smsnotification/smsnotification')->load($smsnotificationId);
        if ($smsnotificationModel->getId() || $smsnotificationId == 0) {
            Mage::register('smsnotification_data', $smsnotificationModel);
             $this->loadLayout();
            $this->_setActiveMenu('smsnotification/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('smsnotification/adminhtml_smsnotification_edit'))
                 ->_addLeft($this->getLayout()->createBlock('smsnotification/adminhtml_smsnotification_edit_tabs'));
                 $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('smsnotification')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }
    
    public function newAction()
    {
        $this->_forward('edit');
    }
    
    public function saveAction()
    {

        if ( $this->getRequest()->getPost() ) {
            try {
				$ids=array(3);
                $postData = $this->getRequest()->getPost();
                $idcheck = $this->getRequest()->getParam('id');
                $smsnotificationModel = Mage::getModel('smsnotification/smsnotification');
                $checkExistingvalue = Mage::getModel('smsnotification/smsnotification')->getCollection()
				->addFieldToFilter('notificationtype', $postData['notificationtype']);
			    $isExist = $checkExistingvalue->getColumnValues('notificationtype');
				if($isExist && $idcheck==NULL){
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Duplicate notification type. (Please update existing)'));
                Mage::getSingleton('adminhtml/session')->setSmsnotificationData(false);
                $this->_redirect('*/*/');
                return;
				} else { 
                $smsnotificationModel->setId($this->getRequest()->getParam('id'))
                    ->setTitle($postData['title'])
                    ->setAdminnotificationno($postData['adminnotificationno'])
                    ->setContent($postData['content'])
                    ->setNotificationtype($postData['notificationtype']) 
                    ->setStatus($postData['status'])
                    ->save(); 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setSmsnotificationData(false);
                $this->_redirect('*/*/');
                return;
			}  
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setSmsnotificationData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
    
    public function deleteAction()  
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $smsnotificationModel = Mage::getModel('smsnotification/smsnotification');
                
                $smsnotificationModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                    
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } 
        }
        $this->_redirect('*/*/');
    }
}
