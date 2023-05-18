<?php
class Saksham_Saksham_Block_Adminhtml_Saksham_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('saksham')->__('Saksham Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('saksham')->__('Saksham Information'),
            'title' => Mage::helper('saksham')->__('Saksham Information'),
            'content' => $this->getLayout()->createBlock('saksham/adminhtml_saksham_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}