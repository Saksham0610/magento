<?php
class Saksham_Saksham_Block_Adminhtml_Saksham_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'saksham';
        $this->_controller = 'adminhtml_saksham_attribute';
        $this->_headerText = Mage::helper('saksham')->__('Manage');
        parent::__construct();
        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('add', 'label', Mage::helper('saksham')->__('Add'));
        } else {
            $this->_removeButton('add');
        }
    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('saksham/adminhtml_saksham_attribute/' . $action);
    }
}