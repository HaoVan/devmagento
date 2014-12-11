<?php
class Alfresco_Location_Block_Adminhtml_Location_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'location';
        $this->_controller = 'adminhtml_location';
        
        $this->_updateButton('save', 'label', Mage::helper('location')->__('Save Location'));
        $this->_updateButton('delete', 'label', Mage::helper('location')->__('Delete Location'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('location_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'location_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'location_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('location_data') && Mage::registry('location_data')->getId() ) {
            return Mage::helper('location')->__("Edit Location '%s'", $this->htmlEscape(Mage::registry('location_data')->getTitle()));
        } else {
            return Mage::helper('location')->__('Add Location');
        }
    }
}