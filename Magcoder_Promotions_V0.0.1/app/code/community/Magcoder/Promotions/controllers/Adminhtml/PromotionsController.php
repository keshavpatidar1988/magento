<?php

class Magcoder_Promotions_Adminhtml_PromotionsController extends Mage_Adminhtml_Controller_action {

    protected function _initAction() { 
        $this->_checkModulePromotions();
        $this->loadLayout()
                ->_setActiveMenu('promotions/items')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Promotions Manager'), Mage::helper('adminhtml')->__('Promotions Manager'));
        return $this;
    } 

    public function indexAction() {
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('promotions/adminhtml_promotions')); 
        $this->renderLayout();
    }

    public function _checkModulePromotions() {
        $storeId = Mage::app()->getStore()->getStoreId();
        $configValue = Mage::getStoreConfig('promotions/promotionsstatus/status', $storeId);
        if ($configValue == 0) {
            $moduleStatus = Mage::helper('promotions')->__('Enable module from System -> Configuration to make Promotions working!');
            return Mage::getSingleton('core/session')->addNotice($moduleStatus);
        }
    }

    public function editAction() {
        $promotionsId = $this->getRequest()->getParam('id');
        $promotionsModel = Mage::getModel('promotions/promotions')->load($promotionsId);

        if ($promotionsModel->getId() || $promotionsId == 0) {
            Mage::register('promotions_data', $promotionsModel);
            $this->loadLayout();
            $this->_setActiveMenu('promotions/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Promotion Manager'), Mage::helper('adminhtml')->__('Promotion Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Promotion Detail'), Mage::helper('adminhtml')->__('Promotion Detail'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('promotions/adminhtml_promotions_edit'))
                    ->_addLeft($this->getLayout()->createBlock('promotions/adminhtml_promotions_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('promotions')->__('Promotion does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($this->getRequest()->getPost()) {
            try {
                $postData = $this->getRequest()->getPost();
                $promotionsModel = Mage::getModel('promotions/promotions');
                if (($this->getRequest()->getParam('id'))) {
                    $data = Mage::getModel('promotions/promotions')->load($this->getRequest()->getParam('id'));
                    $updateTime = now();
                    $createdTime = $data['created_time'];
                } else {
                    $updateTime = now();
                    $createdTime = now();
                } 
                $processedContent = Mage::helper("cms")->getPageTemplateProcessor()->filter($postData['p_promotions']);
                if (isset($postData['stores'])) {
                    if (in_array('0', $postData['stores'])) {
                        $postData['store_id'] = '0';
                    } else {
                        $postData['store_id'] = implode(",", $postData['stores']);
                    }
                    unset($postData['stores']);
                }
                $promotionsModel->setId($this->getRequest()->getParam('id'))
                        ->setPLocation($postData['p_location'])
                        ->setPAmountLess($postData['p_amount_less'])
                        ->setPAmountGreater($postData['p_amount_greater'])
                        ->setPPromotions($processedContent)
                        ->setUpdateTime($updateTime)
                        ->setCreatedTime($createdTime)
                        ->setStatus($postData['status']) 
                        ->setStoreId($postData['store_id'])
                        ->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Promotion was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setPromotionsData(false);

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getPromotions());
                Mage::getSingleton('adminhtml/session')->setPromotionsData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $promotionsModel = Mage::getModel('promotions/promotions');
                $promotionsModel->setId($this->getRequest()->getParam('id'))
                        ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Promotion was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getPromotions());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

}
 