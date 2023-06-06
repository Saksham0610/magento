<?php
class Saksham_Banner_Model_Banner extends Mage_Core_Model_Abstract
{
	function __construct()
	{
		$this->_init('banner/banner');
	}

	public function getGroupKey()
    {
        $group = Mage::getModel('banner/group')->load($this->group_id);
        return $group->group_key; 
    }

    public function getHeight()
    {
    	$group = Mage::getModel('banner/group')->load($this->group_id);
    	if ($group->height < 100) {
    		return 100;
    	}

    	return $group->height;
    }

    public function getWidth()
    {
    	$group = Mage::getModel('banner/group')->load($this->group_id);
    	if ($group->width < 200) {
    		return 200;
    	}

    	return $group->width;
    }

    public function resize()
    {
    	foreach (Mage::getModel('banner/banner')->getCollection()->getItems() as $data) {
            $originalImagePath = 'media/banner/original/' . $data->image; 

            $height = $data->getHeight(); 
            $width = $data->getWidth();

            $resizedImagePath = 'media/banner/resized/' . $data->image; 

            $imageObj = new Varien_Image($originalImagePath);
            $imageObj->constrainOnly(true);
            $imageObj->keepAspectRatio(true);
            $imageObj->keepFrame(false);
            $imageObj->resize($width, $height);
            $imageObj->save($resizedImagePath);
        }
    }
}