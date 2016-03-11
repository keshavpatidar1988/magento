<?php

class Promotions_Message_Block_Adminhtml_Message_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('messageGrid');
        // This is the primary key of the database
        $this->setDefaultSort('message_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('message/message')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('message_id', array(
            'header'    => Mage::helper('message')->__('ID'),
            'align'     =>'right',
            'width'     => '30px',
            'index'     => 'message_id',
        ));

        $this->addColumn('p_location', array(
            'header'    => Mage::helper('message')->__('Promotion Location'),
            'align'     => 'left',
            'width'     => '100px',
            'index'     => 'p_location',
            'type'      => 'options',
            'options'   => array(
                1 => 'Cart Page',
                2 => 'Below Header',
                3 => 'Above Footer',
            ),
        )); 
        
        $this->addColumn('p_amount_less', array(
            'header'    => Mage::helper('message')->__('Promotion amount less than'),
            'align'     =>'left',
            'index'     => 'p_amount_less',
        ));
        
        $this->addColumn('p_amount_greater', array(
            'header'    => Mage::helper('message')->__('Promotion amount greater than'),
            'align'     =>'left',
            'index'     => 'p_amount_greater',
        ));

        $this->addColumn('created_time', array(
            'header'    => Mage::helper('message')->__('Date Created'),
            'align'     => 'left',
            'width'     => '150px',
            'type'      => 'datetime',
            'default'   => '--',
            'index'     => 'created_time',
        ));

        $this->addColumn('update_time', array(
            'header'    => Mage::helper('message')->__('Date Updated'),
            'align'     => 'left',
            'width'     => '150px',
            'type'      => 'datetime',
            'default'   => '--',  
            'index'     => 'update_time',
        ));    
        
        $this->addColumn('status', array(
            'header'    => Mage::helper('message')->__('Status'),
            'align'     => 'left',
            'width'     => '60px',
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
