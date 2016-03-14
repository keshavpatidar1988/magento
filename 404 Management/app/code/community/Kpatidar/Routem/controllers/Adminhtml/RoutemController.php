<?php

class Kpatidar_Routem_Adminhtml_RoutemController extends Mage_Adminhtml_Controller_action
{

    protected function _initAction()
    {
		$this->_checkModuleMessage();
        $this->loadLayout()
            ->_setActiveMenu('routem/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Rule Manager'), Mage::helper('adminhtml')->__('Rule Manager'));
        return $this;
    }    
    
    public function indexAction() 
    {
	    $this->_initAction();        
        $this->_addContent($this->getLayout()->createBlock('routem/adminhtml_routem'));
        $this->renderLayout();
    }
    
    public function _checkModuleMessage() 
    {
		$storeId = Mage::app()->getStore()->getStoreId(); 
        $configValue = Mage::getStoreConfig('routem/routemstatus/status', $storeId);
        if($configValue == 0) 
        {
        $moduleStatus = Mage::helper('routem')->__('Enable module from System -> Configuration to make rules working!');
	    return Mage::getSingleton('core/session')->addNotice($moduleStatus); 
	    } 
	}
    public function editAction()
    {
        $routemId     = $this->getRequest()->getParam('id');
        $routemModel  = Mage::getModel('routem/routem')->load($routemId);

        if ($routemModel->getId() || $routemId == 0) {
            Mage::register('routem_data', $routemModel);
            $this->loadLayout();
            $this->_setActiveMenu('routem/items');            
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Rule Manager'), Mage::helper('adminhtml')->__('Rule Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Rule Detail'), Mage::helper('adminhtml')->__('Rule Detail'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('routem/adminhtml_routem_edit'))
                 ->_addLeft($this->getLayout()->createBlock('routem/adminhtml_routem_edit_tabs'));
           $this->renderLayout();
        
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('routem')->__('Rule does not exist'));
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
                $routemModel = Mage::getModel('routem/routem');
				if(!empty($this->getRequest()->getParam('id'))){ 
			    $data = Mage::getModel('routem/routem')->load($this->getRequest()->getParam('id'));   
				$updateTime = now();
				$createdTime = $data['created_time'];
			    } else { 
			    $updateTime = now();
				$createdTime = now();
				} 
			    
                $routemModel->setId($this->getRequest()->getParam('id'))
                    ->setMatchType($postData['match_type'])
                    ->setMatch(strtolower($postData['match']))
                    ->setRedirect($postData['redirect'])
                    ->setUpdateTime($updateTime)
                    ->setCreatedTime($createdTime) 
                    ->setDestination(strtolower($postData['destination']))
                    ->setStatus($postData['status'])
                    ->save(); 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Rule was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setRoutemData(false);

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setRoutemData($this->getRequest()->getPost());
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
                $routemModel = Mage::getModel('routem/routem');
                $routemModel->setId($this->getRequest()->getParam('id'))
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
