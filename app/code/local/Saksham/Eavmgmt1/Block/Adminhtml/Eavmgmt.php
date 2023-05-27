<?php 
class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'eavmgmt';
		$this->_controller = 'adminhtml_eavmgmt';
		$this->_headerText = $this->__('Eavmgmt Grid');
		$this->_addButtonLabel = $this->__('Add Eavmgmt');
		parent::__construct();
	}
}