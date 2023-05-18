<?php
class Saksham_Saksham_Block_Adminhtml_Saksham_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'saksham';
        $this->_controller = 'adminhtml_saksham';

        $this->_updateButton('save', 'label', Mage::helper('saksham')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('saksham')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
        'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
        'onclick' => 'saveAndContinueEdit()',
        'class' => 'save',
        ), -100);
    }

    public function getHeaderText()
    {
        return Mage::helper('saksham')->__('My Form Container');
    }
}