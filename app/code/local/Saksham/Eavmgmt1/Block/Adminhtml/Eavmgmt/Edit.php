<?php
class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{	
	public function __construct()
	{		
		$this->_blockGroup = 'eavmgmt';
        $this->_controller = 'adminhtml_eavmgmt';
        $this->_headerText = 'Add Eavmgmt';
        parent::__construct();
        if(!$this->getRequest()->getParam('set') && !$this->getRequest()->getParam('id'))
		{
			$this->_removeButton('save');
		} 
	}
}