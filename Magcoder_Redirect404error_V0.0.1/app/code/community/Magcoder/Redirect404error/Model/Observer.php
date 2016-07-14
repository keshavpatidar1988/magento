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

class Magcoder_Redirect404error_Model_Observer {
    public function redirect404errorManagement(Varien_Event_Observer $observer) {
        if ($this->checkModuleStatus() == 1) {
            //Cross check noroute request
            if ($observer->getEvent()->getControllerAction()->getFullActionName() == "cms_index_noRoute") {
                $collection = $this->getFilteredData();
                if (count($collection) > 0) {
                    foreach ($collection as $rule) {
                      $checkRedirect404 = $this->checkMatchTypeAndRedirect($rule);
                    }
                   if($checkRedirect404 && $checkRedirect404 == 1)
                   $this->checkRedirectStringAndRedirect();
                } else {
                   $this->checkRedirectStringAndRedirect();
                }
            }
        }
    }

 // Redirect request if found 404
    public function customRedirect($param, $redirectcode) {
	$redirect = $this->trimSlash(Mage::getUrl($param));
        if($redirectcode == 0 || $redirectcode == 'default' || $redirectcode == 302 ){
		Mage::app()->getFrontController()->getResponse()->setRedirect($redirect, 302);
		} else { 
		Mage::app()->getFrontController()->getResponse()->setRedirect($redirect, 301);
		}  
        Mage::app()->getResponse()->sendResponse();
        exit;
    }  
     
    
    // Remove last slash from string
    public function trimSlash($string) {
        return trim($string, "/");
    }

    // Check module status in admin
    public function checkModuleStatus() {
        $storeId = Mage::app()->getStore()->getStoreId();
        return Mage::getStoreConfig('redirect404error/redirect404errorstatus/status', $storeId);
    }
    
    // Check 404 not found page status in admin
    public function check404ModuleStatus() {
        $storeId = Mage::app()->getStore()->getStoreId();
        return Mage::getStoreConfig('redirect404error/redirect404errorstatus/status404', $storeId);
    }

    // get url path (string) 
    public function getUrlString() {
        $urlRequest = Mage::app()->getFrontController()->getRequest();
        $requestUri = $urlRequest->getServer('REQUEST_URI');
        if (strpos($requestUri, 'index.php') !== FALSE) {
            if (is_null($urlRequest->getServer('ORIG_PATH_INFO'))) {
                return ltrim($urlRequest->getServer('PATH_INFO'), '/');
            } else {
                return ltrim($urlRequest->getServer('ORIG_PATH_INFO'), '/');
            }
        } else {
            return ltrim($requestUri, '/');
        }
    }

    // Validate redirect url and redirect at required string
    public function checkRedirectStringAndRedirect() {
       if($this->check404ModuleStatus() == 1) {
        $urlPart = $this->getUrlString();
        // Check if url part is empty or not,
        if (empty($urlPart)) {
            // Redirect user on root level 		
            $this->customRedirect('/', 'default');
        } else {
            // Get configured category suffix (we are considering that product/category/page all have same)
            $suffix = Mage::helper('catalog/category')->getCategoryUrlSuffix();
            $string = $this->trimSlash($urlPart);

            $plorp = substr(strrchr($string, '/'), 1);
            $string = $this->trimSlash(substr($string, 0, - strlen($plorp))) . $suffix;
            // Check string part is equal to suffix or not
            if ($string != $suffix) {
                // Redirect user according to url part
                $this->customRedirect($string, 'default');
            } else {
                // Redirect customer to base url 
                $this->customRedirect('/', 'default');
            }
        }
	}
    }

    // get collection of rules from database.
    public function getFilteredData() {
        $collection = Mage::getModel('redirect404error/redirect404error')->getCollection()
                ->addFieldToSelect('match_type')
                ->addFieldToSelect('match')
                ->addFieldToSelect('destination')
                ->addFieldToSelect('redirect')
                ->addFieldToFilter('status', 1);
        return $collection->getData();
    }

    // according to match type redirect user to destination.   
    public function checkMatchTypeAndRedirect($rule) {		
        $currentUrl = $this->getUrlString();
        if ($currentUrl && !empty($currentUrl)) {
            $matchType = trim($rule['match_type']);
            $match = trim($rule['match']);
            $destination = trim($rule['destination']);
            $redirect = trim($rule['redirect']);

            // full match redirection logic
            if ($matchType == 1) {
                $output = strcasecmp(trim($match), trim($currentUrl));
                if ($output == 0) {
                    $this->customRedirect($destination, $redirect);
                } else {
                    return true;
                } 
            }

            // partial match redirection logic
            if ($matchType == 2) {
                if (preg_match("/\b" . trim($match) . "\b/i", $currentUrl)) {
                    $this->customRedirect($destination, $redirect);
                } else {
                   return true;
                }
            }

            // advanced match redirection logic
            if ($matchType == 3) {
                if (preg_match(trim($match), trim($currentUrl))) {
                    $this->customRedirect($destination, $redirect);
                } else {
                  return true;
                }
            } 
        }
    }

}

