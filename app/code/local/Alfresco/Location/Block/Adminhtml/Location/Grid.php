<?php

class Alfresco_Location_Block_Adminhtml_Location_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('LocationGrid');
      $this->setDefaultSort('location_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('location/location')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {


      $this->addColumn('location_id', array(
          'header'    => Mage::helper('location')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'location_id',
      ));

      $this->addColumn('province_name', array(
          'header'    => Mage::helper('location')->__('Province Name'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'province_name',
      ));

      $this->addColumn('restaurant_name', array(
          'header'    => Mage::helper('location')->__('Restaurant Name'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'restaurant_name',
      ));

      $this->addColumn('restaurant_address', array(
          'header'    => Mage::helper('location')->__('Restaurant Address'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'restaurant_address',
      ));

      $this->addColumn('restaurant_phone', array(
          'header'    => Mage::helper('location')->__('Restaurant Phone'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'restaurant_phone',
      ));

      $this->addColumn('restaurant_email', array(
          'header'    => Mage::helper('location')->__('Restaurant Email'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'restaurant_email',
      ));

      $this->addExportType('*/*/exportCsv', Mage::helper('location')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('location')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('location_id');
        $this->setMassactionIdField('province_name');
        $this->setMassactionIdField('restaurant_name');
        $this->setMassactionIdField('restaurant_address');
        $this->setMassactionIdField('restaurant_phone');
        $this->setMassactionIdField('restaurant_email');

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }



}