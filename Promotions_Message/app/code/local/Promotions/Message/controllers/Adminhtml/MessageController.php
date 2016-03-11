<?php

class Promotions_Message_Adminhtml_MessageController extends Mage_Adminhtml_Controller_action
{

    protected function _initAction()
    {
		$this->_checkModuleMessage();
        $this->loadLayout()
            ->_setActiveMenu('message/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Mesasge Manager'), Mage::helper('adminhtml')->__('Message Manager'));
        return $this;
    }    
    
    public function indexAction() 
    {
	    $this->_initAction();        
        $this->_addContent($this->getLayout()->createBlock('message/adminhtml_message'));
        $this->renderLayout();
    }
    
    public function _checkModuleMessage() 
    {
		$storeId = Mage::app()->getStore()->getStoreId(); 
        $configValue = Mage::getStoreConfig('message/messagestatus/status', $storeId);
        if($configValue == 0) 
        {
        $moduleStatus = Mage::helper('message')->__('Enable module from System -> Configuration to make Promotions working!');
	    return Mage::getSingleton('core/session')->addNotice($moduleStatus); 
	    } 
	}
    public function editAction()
    {
        $messageId     = $this->getRequest()->getParam('id');
        $messageModel  = Mage::getModel('message/message')->load($messageId);

        if ($messageModel->getId() || $messageId == 0) {
            Mage::register('message_data', $messageModel);
            $this->loadLayout();
            $this->_setActiveMenu('message/items');            
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Promotion Manager'), Mage::helper('adminhtml')->__('Promotion Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Promotion Detail'), Mage::helper('adminhtml')->__('Promotion Detail'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('message/adminhtml_message_edit'))
                 ->_addLeft($this->getLayout()->createBlock('message/adminhtml_message_edit_tabs'));
           $this->renderLayout();
        
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('message')->__('Promotion does not exist'));
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
                $messageModel = Mage::getModel('message/message');
				if(($this->getRequest()->getParam('id'))) { 
			    $data = Mage::getModel('message/message')->load($this->getRequest()->getParam('id'));   
				$updateTime = now();
				$createdTime = $data['created_time'];
			    } else { 
			    $updateTime = now();
				$createdTime = now();
				} 
		$processedContent = Mage::helper("cms")->getPageTemplateProcessor()->filter($postData['p_message']);
                $messageModel->setId($this->getRequest()->getParam('id'))
                    ->setPLocation($postData['p_location'])
                    ->setPAmountLess($postData['p_amount_less'])
                    ->setPAmountGreater($postData['p_amount_greater'])
                    ->setPMessage($processedContent)
                    ->setUpdateTime($updateTime)
                    ->setCreatedTime($createdTime)  
                    ->setStatus($postData['status'])
                    ->save();  
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Promotion was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setMessageData(false);

                $this->_redirect('*/*/');
                return; 
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setMessageData($this->getRequest()->getPost());
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
                $messageModel = Mage::getModel('message/message');
                $messageModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Promotion was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
}
