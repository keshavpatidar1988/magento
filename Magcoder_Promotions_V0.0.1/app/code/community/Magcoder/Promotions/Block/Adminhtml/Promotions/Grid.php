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
 * @package      Promotions
 * @license      http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Support <support@magcoders.com>
 * 
 */
?>
<?php

class Magcoder_Promotions_Block_Adminhtml_Promotions_Grid extends Mage_Adminhtml_Block_Widget_Grid {
 
    public function __construct() {
        parent::__construct();
        $this->setId('promotionsGrid');
        // This is the primary key of the database 
        $this->setDefaultSort('promotions_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
 
    protected function _prepareCollection() {
        $collection = Mage::getModel('promotions/promotions')->getCollection();
        foreach ($collection as $link) {
            if ($link->getStoreId() && $link->getStoreId() != 0) {
                $link->setStoreId(explode(',', $link->getStoreId()));
            } else {
                $link->setStoreId(array('0'));
            }
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('promotions_id', array(
            'header' => Mage::helper('promotions')->__('ID'),
            'align' => 'right',
            'width' => '30px',
            'index' => 'promotions_id',
        ));

        $this->addColumn('p_location', array(
            'header' => Mage::helper('promotions')->__('Promotion Location'),
            'align' => 'left',
            'width' => '100px',
            'index' => 'p_location',
            'type' => 'options',
            'options' => array(
                1 => 'Cart Page',
             ),
        ));

        $this->addColumn('p_amount_less', array(
            'header' => Mage::helper('promotions')->__('Subtotal less than'),
            'align' => 'left',
            'index' => 'p_amount_less',
        ));

        $this->addColumn('p_amount_greater', array(
            'header' => Mage::helper('promotions')->__('Subtotal greater than'),
            'align' => 'left',
            'index' => 'p_amount_greater',
        ));

        $this->addColumn('created_time', array(
            'header' => Mage::helper('promotions')->__('Date Created'),
            'align' => 'left',
            'width' => '150px',
            'type' => 'datetime',
            'default' => '--',
            'index' => 'created_time',
        ));

        $this->addColumn('update_time', array(
            'header' => Mage::helper('promotions')->__('Date Updated'),
            'align' => 'left',
            'width' => '150px',
            'type' => 'datetime',
            'default' => '--',
            'index' => 'update_time',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('promotions')->__('Status'),
            'align' => 'left',
            'width' => '60px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header' => Mage::helper('promotions')->__('Store View'),
                'index' => 'store_id',
                'type' => 'store',
                'store_all' => true,
                'store_view' => true,
                'sortable' => true,
                'filter' => false,
            ));
        }

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
