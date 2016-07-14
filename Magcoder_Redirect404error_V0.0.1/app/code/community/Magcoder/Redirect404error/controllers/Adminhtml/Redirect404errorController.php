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
 * @package      Redirect 404 Error
 * @license      http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Support <support@magcoders.com>
 * 
 */
?>
<?php

class Magcoder_Redirect404error_Adminhtml_Redirect404errorController extends Mage_Adminhtml_Controller_action
{

    protected function _initAction()
    {
		$this->_checkModuleMessage();
        $this->loadLayout()
            ->_setActiveMenu('redirect404error/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Rule Manager'), Mage::helper('adminhtml')->__('Rule Manager'));
        return $this;
    }    
    
    public function indexAction() 
    {
	    $this->_initAction();        
        $this->_addContent($this->getLayout()->createBlock('redirect404error/adminhtml_redirect404error'));
        $this->renderLayout();
    }
    
    public function _checkModuleMessage() 
    {
		$storeId = Mage::app()->getStore()->getStoreId(); 
        $configValue = Mage::getStoreConfig('redirect404error/redirect404errorstatus/status', $storeId);
        if($configValue == 0) 
        {
        $moduleStatus = Mage::helper('redirect404error')->__('Enable module from System -> Configuration to make rules working!');
	    return Mage::getSingleton('core/session')->addNotice($moduleStatus); 
	    } 
	}
    public function editAction()
    {
        $redirect404errorId     = $this->getRequest()->getParam('id');
        $redirect404errorModel  = Mage::getModel('redirect404error/redirect404error')->load($redirect404errorId);

        if ($redirect404errorModel->getId() || $redirect404errorId == 0) {
            Mage::register('redirect404error_data', $redirect404errorModel);
            $this->loadLayout();
            $this->_setActiveMenu('redirect404error/items');            
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Rule Manager'), Mage::helper('adminhtml')->__('Rule Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Rule Detail'), Mage::helper('adminhtml')->__('Rule Detail'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('redirect404error/adminhtml_redirect404error_edit'))
                 ->_addLeft($this->getLayout()->createBlock('redirect404error/adminhtml_redirect404error_edit_tabs'));
           $this->renderLayout();
        
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('redirect404error')->__('Rule does not exist'));
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
                $postData = $this->getRequest()->getPost();
                $redirect404errorModel = Mage::getModel('redirect404error/redirect404error');
				if(($this->getRequest()->getParam('id'))){ 
			    $data = Mage::getModel('redirect404error/redirect404error')->load($this->getRequest()->getParam('id'));   
				$updateTime = now();
				$createdTime = $data['created_time'];
			    } else { 
			    $updateTime = now();
				$createdTime = now();
				} 
			    
                $redirect404errorModel->setId($this->getRequest()->getParam('id'))
                    ->setMatchType($postData['match_type'])
                    ->setMatch(strtolower($postData['match']))
                    ->setRedirect($postData['redirect'])
                    ->setUpdateTime($updateTime)
                    ->setCreatedTime($createdTime) 
                    ->setDestination(strtolower($postData['destination']))
                    ->setStatus($postData['status'])
                    ->save(); 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Rule was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setRedirect404errorData(false);

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setRedirect404errorData($this->getRequest()->getPost());
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
                $redirect404errorModel = Mage::getModel('redirect404error/redirect404error');
                $redirect404errorModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Rule was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
}
