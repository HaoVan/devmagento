<?php
class Alfresco_Location_Model_Resource_Province extends Mage_Core_Model_Resource_Db_Abstract
{
public function _construct()
	{
		$this->_init('location/province','province_id');
	}
}