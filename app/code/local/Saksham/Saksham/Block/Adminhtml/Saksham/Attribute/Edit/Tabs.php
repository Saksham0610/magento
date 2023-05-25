<?php
class Saksham_Saksham_Block_Adminhtml_Saksham_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('saksham_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('saksham')->__('Attribute Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main', array(
            'label'     => Mage::helper('saksham')->__('Properties'),
            'title'     => Mage::helper('saksham')->__('Properties'),
            'content'   => $this->getLayout()->createBlock('saksham/adminhtml_saksham_attribute_edit_tab_main')->toHtml(),
            'active'    => true
        ));

        $model = Mage::registry('entity_attribute');

        $this->addTab('labels', array(
            'label'     => Mage::helper('saksham')->__('Manage Label / Options'),
            'title'     => Mage::helper('saksham')->__('Manage Label / Options'),
            'content'   => $this->getLayout()->createBlock('saksham/adminhtml_saksham_attribute_edit_tab_options')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}