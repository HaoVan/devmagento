<?php
class Alfresco_Location_Model_Resource_Location extends Mage_Core_Model_Resource_Db_Abstract
{
	public function _construct()
	{
		$this->_init('location/location','location_id');
	}


}