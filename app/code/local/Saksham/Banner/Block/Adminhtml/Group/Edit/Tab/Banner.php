<?php
class Saksham_Banner_Block_Adminhtml_Group_Edit_Tab_Banner extends Mage_Adminhtml_Block_Widget_Form_Container
{
    function __construct()
    {
        $this->setTemplate('banner/banner.phtml');
    }

    public function getCollection()
    {
        return Mage::getModel('banner/banner')->getCollection()->addFieldToFilter('group_id', $this->getRequest()->getParam('group_id'));
    }

}