<?php
class Saksham_Brand_Model_Source_Model extends Mage_Eav_Model_Entity_Attribute_Source_Abstract implements Mage_Eav_Model_Entity_Attribute_Source_Interface
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
                array(
                    'value' => 'option1',
                    'label' => 'Option 1',
                ),
                array(
                    'value' => 'option2',
                    'label' => 'Option 2',
                ),
                // add more options as needed
            );
        }
        return $this->_options;
    }
}