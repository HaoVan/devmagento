<?php

class Alfresco_Location_Block_Adminhtml_Location_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('location/tab/map.phtml');
    }

  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('location_form', array('legend'=>Mage::helper('location')->__('Item information')));
     
	  $object = Mage::getModel('location/location')->load( $this->getRequest()->getParam('id') );

      $fieldset->addField('province_name', 'text', array(
          'label'     => Mage::helper('location')->__('City Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'province_name',
      ));

      $fieldset->addField('restaurant_name', 'text', array(
          'label'     => Mage::helper('location')->__('Restaurant Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'restaurant_name',
      ));

      $fieldset->addField('restaurant_email', 'text', array(
          'label'     => Mage::helper('location')->__('Restaurant Email'),
          'class'     => 'validate-email',
          'required'  => false,
          'name'      => 'restaurant_email',
      ));

      $fieldset->addField('restaurant_phone', 'text', array(
          'label'     => Mage::helper('location')->__('Restaurant Phone'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'restaurant_phone',
      ));

      $fieldset->addField('location_x', 'text', array(
          'label'     => Mage::helper('location')->__('Location X'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'location_x',
      ));

      $fieldset->addField('location_y', 'text', array(
          'label'     => Mage::helper('location')->__('Location Y'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'location_y',
      ));

      $fieldset->addField('restaurant_address', 'text', array(
          'label'     => Mage::helper('location')->__('Restaurant Address'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'restaurant_address',
      ));


     
      if ( Mage::getSingleton('adminhtml/session')->getLocationData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getLocationData());
          Mage::getSingleton('adminhtml/session')->setLocationData(null);
      } elseif ( Mage::registry('location_data') ) {
          $form->setValues(Mage::registry('location_data')->getData());
      }
      return parent::_prepareForm();
  }
}