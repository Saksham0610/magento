<?php
class Saksham_Saksham_Block_Adminhtml_Saksham_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{	
	public function __construct()
	{		
		$this->_blockGroup = 'saksham';
        $this->_controller = 'adminhtml_saksham';
        $this->_headerText = 'Add';
        parent::__construct();
        if(!$this->getRequest()->getParam('set') && !$this->getRequest()->getParam('id'))
		{
			$this->_removeButton('save');
		} 
	}
}