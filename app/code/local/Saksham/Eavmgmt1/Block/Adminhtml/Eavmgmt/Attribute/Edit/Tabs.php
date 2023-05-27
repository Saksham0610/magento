<?php

class Saksham_Eavmgmt_Block_Adminhtml_Eavmgmt_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('eavmgmt_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('eavmgmt')->__('Attribute Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main', array(
            'label'     => Mage::helper('eavmgmt')->__('Properties'),
            'title'     => Mage::helper('eavmgmt')->__('Properties'),
            'content'   => $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_attribute_edit_tab_main')->toHtml(),
            'active'    => true
        ));

        $model = Mage::registry('entity_attribute');

        $this->addTab('labels', array(
            'label'     => Mage::helper('eavmgmt')->__('Manage Label / Options'),
            'title'     => Mage::helper('eavmgmt')->__('Manage Label / Options'),
            'content'   => $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_attribute_edit_tab_options')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}