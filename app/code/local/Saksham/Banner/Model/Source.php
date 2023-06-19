<?php
class Saksham_Banner_Model_Source extends Mage_Core_Model_Abstract
{
	public function toOptionArray()
    {
        $options = array();
        $collection = Mage::getModel('banner/group')->getCollection();
        foreach ($collection as $item) {
            $options[] = array(
                'value' => $item->getId(),
                'label' => $item->getName()
            );
        }

        return $options;
    }
}