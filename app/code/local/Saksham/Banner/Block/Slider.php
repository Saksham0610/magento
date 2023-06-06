<?php
class Saksham_Banner_Block_Slider extends Mage_Core_Block_Template
{
    function __construct()
    {
        parent::__construct();
    }

    public function getSliderData()
    {
        $collection = Mage::getModel('banner/banner')->getCollection()->addFieldToFilter('group_id', Mage::getStoreConfig('banner/banner_group/banner_select'));
        return $collection;
    }
}