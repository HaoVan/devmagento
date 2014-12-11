<?php

class Alfresco_Location_Block_Adminhtml_Location_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('location_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('location')->__('Location Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('information', array(
          'label'     => Mage::helper('location')->__('Location Information'),
          'title'     => Mage::helper('location')->__('Location Information'),
		  'content'   => $this->getLayout()->createBlock('location/adminhtml_location_edit_tab_form')->toHtml(),
      ));

	  
	  
	  
     
      return parent::_beforeToHtml();
  }
}