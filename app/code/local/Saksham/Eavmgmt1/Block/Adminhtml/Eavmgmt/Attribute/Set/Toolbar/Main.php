<?php
class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Attribute_Set_Toolbar_Main extends Mage_Adminhtml_Block_Template
{
    public function __construct()
    {    
        parent::__construct();
        $this->setTemplate('eavmgmt/attribute/set/toolbar/main.phtml');
    }

    protected function _prepareLayout()
    {
        $this->setChild('addButton',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('eavmgmt')->__('Add New Set'),
                    'onclick'   => 'setLocation(\'' . $this->getUrl('*/*/add') . '\')',
                    'class' => 'add',
                ))
        );
        return parent::_prepareLayout();
    }

    protected function getNewButtonHtml()
    {
        return $this->getChildHtml('addButton');
    }

    protected function _getHeader()
    {
        return Mage::helper('eavmgmt')->__('Manage Eavmgmt Attribute Sets');
    }

    protected function _toHtml()
    {
        return parent::_toHtml();
    }
}
