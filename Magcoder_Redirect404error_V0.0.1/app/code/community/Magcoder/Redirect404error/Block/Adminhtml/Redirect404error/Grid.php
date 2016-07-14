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

class Magcoder_Redirect404error_Block_Adminhtml_Redirect404error_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('redirect404errorGrid');
        // This is the primary key of the database
        $this->setDefaultSort('redirect404error_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('redirect404error/redirect404error')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('redirect404error_id', array(
            'header'    => Mage::helper('redirect404error')->__('ID'),
            'align'     =>'right',
            'width'     => '30px',
            'index'     => 'redirect404error_id',
        ));

        $this->addColumn('match_type', array(
            'header'    => Mage::helper('redirect404error')->__('Match Type'),
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
            'header'    => Mage::helper('redirect404error')->__('Redirect'),
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
            'header'    => Mage::helper('redirect404error')->__('Match'),
            'align'     =>'left',
            'index'     => 'match',
        ));
        
        $this->addColumn('destination', array(
            'header'    => Mage::helper('redirect404error')->__('Destination'),
            'align'     =>'left',
            'index'     => 'destination',
        ));
        
        $this->addColumn('created_time', array(
            'header'    => Mage::helper('redirect404error')->__('Date Created'),
            'align'     => 'left',
            'width'     => '150px',
            'type'      => 'datetime',
            'default'   => '--',
            'index'     => 'created_time',
        ));

        $this->addColumn('update_time', array(
            'header'    => Mage::helper('redirect404error')->__('Date Updated'),
            'align'     => 'left',
            'width'     => '150px',
            'type'      => 'datetime',
            'default'   => '--',  
            'index'     => 'update_time',
        ));    
                $this->addColumn('status', array(
            'header'    => Mage::helper('redirect404error')->__('Status'),
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
