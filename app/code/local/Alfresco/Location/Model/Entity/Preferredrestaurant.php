<?php
class Alfresco_Location_Model_Entity_Preferredrestaurant extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	public function getAllOptions() {
            
            if($this->_options === null) {
                $this->_options = array();
                
                $allLocation = Mage::getModel('location/location')->getCollection();
                $data = $allLocation->getData();
                return $data;
            }
        }
}