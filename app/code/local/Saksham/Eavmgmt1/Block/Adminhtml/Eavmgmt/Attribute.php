<?php

class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'eavmgmt';
		$this->_controller = 'adminhtml_eavmgmt_attribute';
		$this->_headerText = Mage::helper('vendor')->__('Manage Attributes');
        $this->_addButtonLabel = Mage::helper('vendor')->__('Add New Attribute');
		parent::__construct();
	}
}