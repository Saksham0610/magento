<?php
class Saksham_Eavmgmt_Model_Eavmgmt extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('eavmgmt/eavmgmt');
    } 

    public function getOption()
    {
        $collection = $this->getCollection();
        $collection->getSelect()
                    ->joinLeft(
                        array('eao'=> 'eav_attribute_option'),
                        "eao.attribute_id = main_table.attribute_id"
                    );
        $datas = $collection->getItems();
        $collection = [];
        foreach ($datas as $data) {
            if ($data->frontend_input == 'select') {
                $collection[] = $data;
            }
        }
        echo "<pre>";
        print_r($collection);
        die;
    }
}