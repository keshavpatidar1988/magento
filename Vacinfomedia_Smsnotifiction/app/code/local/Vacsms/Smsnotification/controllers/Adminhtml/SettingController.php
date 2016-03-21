<?php
class Vacsms_Smsnotification_Adminhtml_SettingController extends Mage_Adminhtml_Controller_action
{
    protected function _initAction()
    { 
        $this->loadLayout()
            ->_setActiveMenu('smsnotification/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Setting'), Mage::helper('adminhtml')->__('Setting'));
        return $this;
    }    
     
    public function indexAction() {
        $this->_initAction();         
        $this->_addContent($this->getLayout()->createBlock('smsnotification/adminhtml_setting'));
        $this->renderLayout();
    }

    public function editAction()
    {   $smsnotificationId     = 1;
        $smsnotificationModel  = Mage::getModel('smsnotification/setting')->load($smsnotificationId);
        if ($smsnotificationModel->getId() || $smsnotificationId == 0) {
            Mage::register('setting_data', $smsnotificationModel);
             $checkAuth = $smsnotificationModel->getStatus();
             if($checkAuth==0){
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('smsnotification')->__('sms API is not authenticated please aunticate to avail sms notifictions to user.'));
			} if($checkAuth==1) {
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('smsnotification')->__('Congratulations your API is authenticated,and now customer and user will be notify on registred mobile no.'));
			}
            $this->loadLayout(); 
            $this->_setActiveMenu('smsnotification/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('SMS Manager'), Mage::helper('adminhtml')->__('SMS Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('SMS Manager'), Mage::helper('adminhtml')->__('SMS Manager'));          
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);            
            $this->_addContent($this->getLayout()->createBlock('smsnotification/adminhtml_setting_edit'))
                 ->_addLeft($this->getLayout()->createBlock('smsnotification/adminhtml_setting_edit_tabs'));
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
                $postData = $this->getRequest()->getPost();
                $smsnotificationModel = Mage::getModel('smsnotification/setting');
            		$customMessageUrl = trim($postData['apiurl'])."?username=".trim($postData['username'])."&password=".trim($postData['password'])."&to=91".trim($postData['apitestingnumber'])."&from=".trim($postData['fromname'])."&udh=".trim($postData['udh'])."&text=".trim(urlencode($postData['defaultmessage']))."&dlr-mask=".trim($postData['dlrmask'])."&dlr-url";
					$result = Mage::getModel('smsnotification/setting')->testSmsapi($customMessageUrl);
					if($result == trim("Sent.")){ 
				    $smsnotificationModel->setId(1)
                    ->setApiurl(trim($postData['apiurl']))
                    ->setApitestingnumber(trim($postData['apitestingnumber']))
                    ->setUsername(trim($postData['username']))
                    ->setPassword(trim($postData['password'])) 
                    ->setFromname(trim($postData['fromname']))
                    ->setDefaultmessage(trim($postData['defaultmessage']))
                    ->setUdh(trim($postData['udh']))
                    ->setDlrmask(trim($postData['dlrmask']))
                    ->setDlrurl(trim($postData['dlrurl']))  
                    ->setStatus('1')   
                    ->save(); 
					Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('WOW! API Test Passed. Test message has been sent at your above number.'));
					} else {
					$smsnotificationModel->setId(1)
                    ->setApiurl(trim($postData['apiurl']))
                    ->setApitestingnumber(trim($postData['apitestingnumber']))
                    ->setUsername(trim($postData['username']))
                    ->setPassword(trim($postData['password'])) 
                    ->setFromname(trim($postData['fromname']))
                    ->setDefaultmessage(trim($postData['defaultmessage']))
                    ->setUdh(trim($postData['udh']))
                    ->setDlrmask(trim($postData['dlrmask']))
                    ->setDlrurl(trim($postData['dlrurl']))  
                    ->setStatus('0')  
                    ->save(); 
					Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('API test fail plz make sure that all details provided are correct.'));
					if($result){
					Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Reasson: '.$result));
					} else { 
					Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please use diffrent content in test message or use diffrent number to test'));
					}
				} 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Settings updated successfully '));
                Mage::getSingleton('adminhtml/session')->setSettingData(false);
                $this->_redirect('*/*/edit'); 
                return;
            } catch (Exception $e) { 
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setSettingData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/'); 
    }
}
