<?php 
class Saksham_Saksham_Block_Adminhtml_Saksham extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'saksham';
		$this->_controller = 'adminhtml_saksham';
		$this->_headerText = $this->__('Grid');
		$this->_addButtonLabel = $this->__('Add');
		parent::__construct();
	}
}