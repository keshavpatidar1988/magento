<?php

class Vacsms_Smsnotification_Block_Adminhtml_Smsnotification_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('smsnotificationGrid');
        // This is the primary key of the database
        $this->setDefaultSort('smsnotification_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('smsnotification/smsnotification')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('smsnotification_id', array(
            'header'    => Mage::helper('smsnotification')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'smsnotification_id',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('smsnotification')->__('Title'),
            'width'     => '150px',
            'index'     => 'title',
        ));
    $this->addColumn('adminnotificationno', array(
            'header'    => Mage::helper('smsnotification')->__('Admin Notification No.#'),
            'width'     => '150px',
            'index'     => 'adminnotificationno',
        ));
        $this->addColumn('content', array(
            'header'    => Mage::helper('smsnotification')->__('Message'),
            'index'     => 'content',
        ));

        $this->addColumn('notificationtype', array(

            'header'    => Mage::helper('smsnotification')->__('Notification'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'notificationtype', 
            'type'      => 'options',
            'options'   => array(
                'neworder' => 'New Order',
                'invoice'=> 'Invoice',
                'shipment'=> 'Shipment',
                'complete'=> 'Complete',
            ),
        ));

  
        $this->addColumn('status', array(

            'header'    => Mage::helper('smsnotification')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }


}
