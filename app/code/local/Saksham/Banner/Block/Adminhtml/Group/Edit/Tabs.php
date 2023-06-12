<?php
class Saksham_Banner_Block_Adminhtml_Group_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('banner')->__('Banner Group Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('group_section', array(
            'label' => Mage::helper('banner')->__('Banner Group Information'),
            'title' => Mage::helper('banner')->__('Banner Group Information'),
            'content' => $this->getLayout()->createBlock('banner/adminhtml_group_edit_tab_form')->toHtml(),
        ));

        if (Mage::getModel('banner/group')->getCollection()->getData()) {
            $this->addTab('banner_section', array(
                'label' => Mage::helper('banner')->__('Banner Information'),
                'title' => Mage::helper('banner')->__('Banner Information'),
                'content' => $this->getLayout()->createBlock('banner/adminhtml_group_edit_tab_banner')->toHtml(),
            ));
        }

        return parent::_beforeToHtml();
    }
}