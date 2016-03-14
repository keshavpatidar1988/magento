<?php

class Kpatidar_Routem_Block_Adminhtml_Routem_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('routemGrid');
        // This is the primary key of the database
        $this->setDefaultSort('routem_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('routem/routem')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('routem_id', array(
            'header'    => Mage::helper('routem')->__('ID'),
            'align'     =>'right',
            'width'     => '30px',
            'index'     => 'routem_id',
        ));

        $this->addColumn('match_type', array(
            'header'    => Mage::helper('routem')->__('Match Type'),
            'align'     => 'left',
            'width'     => '100px',
            'index'     => 'match_type',
            'type'      => 'options',
            'options'   => array(
                1 => 'Full Match',
                2 => 'Partial Match',
                3 => 'Advanced Match',
            ),
        )); 
        
        $this->addColumn('redirect', array(
            'header'    => Mage::helper('routem')->__('Redirect'),
            'align'     => 'left',
            'width'     => '100px',
            'index'     => 'redirect',
            'type'      => 'options',
            'options'   => array(
                0 => 'Default',
                302 => 'Temporary (302)',
                301 => 'Permanent (301)',
            ),
        )); 
        
        $this->addColumn('match', array(
            'header'    => Mage::helper('routem')->__('Match'),
            'align'     =>'left',
            'index'     => 'match',
        ));
        
        $this->addColumn('destination', array(
            'header'    => Mage::helper('routem')->__('Destination'),
            'align'     =>'left',
            'index'     => 'destination',
        ));
        
        /* $this->addColumn('created_time', array(
            'header'    => Mage::helper('routem')->__('Date Created'),
            'align'     => 'left',
            'width'     => '150px',
            'type'      => 'datetime',
            'default'   => '--',
            'index'     => 'created_time',
        ));

        $this->addColumn('update_time', array(
            'header'    => Mage::helper('routem')->__('Date Updated'),
            'align'     => 'left',
            'width'     => '150px',
            'type'      => 'datetime',
            'default'   => '--',  
            'index'     => 'update_time',
        ));    
        */
        $this->addColumn('status', array(
            'header'    => Mage::helper('routem')->__('Status'),
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
