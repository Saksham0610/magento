<?php
class Ccc_Practice_QueryController extends Mage_Core_Controller_Front_Action
{
    public function writeAction()
    {
        echo "<pre>";
        $resource = Mage::getSingleton('core/resource');
        $write = $resource->getConnection('core_write');
        $table = $resource->getTableName('product/product');
        $write->insert(
            $table, 
            ['name' => 'nokia 5000', 'sku' => 5000]
        );
        echo "123";
    }

    public function readAction()
     {
        echo "<pre>";
        $resource = Mage::getSingleton('core/resource');
        $write = $resource->getConnection('core_write');
        $table = $resource->getTableName('product/product');
        $table2 = $resource->getTableName('catalog/product');
        $name = 'n';
        $select = $write->select()
            ->from(['tbl' => $table], ['name', 'sku'])
            ->join(['tbl2' => $table2], 'tbl.sku = tbl2.sku', ['entity_type_id'])
            ->where('name LIKE ?', "%{$name}%")
            ->group('name');
        $results = $write->fetchAll($select);
        print_r($results);
     } 

    public function updateAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $write = $resource->getConnection('core_write');
        $table = $resource->getTableName('product/product');
        $write->update(
        $table,
            ['name' => 'nokia 1700'],
            ['product_id = ?' => 2072]
        );
    }

    public function deleteAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $write = $resource->getConnection('core_write');
        $table = $resource->getTableName('product/product');
        $write->delete(
            $table,
                ['product_id IN (?)' => [2071, 2072]]
            );
    }

    public function insertMultipleAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $write = $resource->getConnection('core_write');
        $table = $resource->getTableName('product/product');
        $rows = [
            ['name'=>'1', 'sku'=>'1'],
            ['name'=>'2', 'sku'=>'2'],
        ];
        $write->insertMultiple($table, $rows);
    }

    public function insertOnDuplicateAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $write = $resource->getConnection('core_write');
        $table = $resource->getTableName('product/product');
        $data = [];
        $data[] = [
            'sku' => '2',
            'name' => '3'
        ];

        $write->insertOnDuplicate(
            $table,
            $data, 
            ['name'] 
        );
    }
}