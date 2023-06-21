<?php
class Ccc_Practice_Adminhtml_QueryController extends Mage_Adminhtml_Controller_Action
{
    public function firstAction()
    {
        // Need a list of product with these columns product name, sku, cost, price, color.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_first'));
        $this->renderLayout();
    }

    public function firstQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $tableName = $resource->getTableName('catalog/product');
        $select = $readConnection->select()
            ->from(array('p' => $tableName), array(
                'sku' => 'p.sku',
            ))
            ->joinLeft(
                array('pv' => $resource->getTableName('catalog_product_entity_varchar')),
                'pv.entity_id = p.entity_id AND pv.attribute_id = 73',
                array('name' => 'pv.value')
            )
            ->joinLeft(
                array('pdc' => $resource->getTableName('catalog_product_entity_decimal')),
                'pdc.entity_id = p.entity_id AND pdc.attribute_id = 81',
                array('cost' => 'pdc.value')
            )
            ->joinLeft(
                array('pdp' => $resource->getTableName('catalog_product_entity_decimal')),
                'pdp.entity_id = p.entity_id AND pdp.attribute_id = 77',
                array('price' => 'pdp.value')
            )
            ->joinLeft(
                array('pi' => $resource->getTableName('catalog_product_entity_int')),
                'pi.entity_id = p.entity_id AND pi.attribute_id = 94',
                array('color' => 'pi.value')
            );

        echo $select;
    }

    public function secondAction()
    {
        // Need a list of attribute & options. return an array with attribute id, attribute code, option Id, option name.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_second'));
        $this->renderLayout();
    }

    public function secondQueryAction()
    {
        $attributeOptions = [];

        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $attributeOptionTable = $resource->getTableName('eav_attribute_option');
        $attributeTable = $resource->getTableName('eav_attribute');

        $select = $readConnection->select()
            ->from(
                array('ao' => $attributeOptionTable),
                array(
                    'attribute_id' => 'ao.attribute_id',
                    'option_id' => 'ao.option_id',
                )
            )
            ->join(
                array('ov' => $resource->getTableName('eav_attribute_option_value')),
                'ov.option_id = ao.option_id',
                array('option_name' => 'ov.value')
            )
            ->join(
                array('a' => $attributeTable),
                'a.attribute_id = ao.attribute_id',
                array('attribute_code' => 'a.attribute_code')
            );

        echo $select;
    }

    public function thirdAction()
    {
        // Need a list of attribute having options count greater than 10. return array with attribute id, attribute code, option count.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_third'));
        $this->renderLayout();
    }

    public function thirdQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $attributeOptionTable = $resource->getTableName('eav_attribute_option');
        $attributeTable = $resource->getTableName('eav_attribute');

        $select = $readConnection->select()
            ->from(
                array('main_table' => $attributeTable),
                array(
                    'attribute_id' => 'main_table.attribute_id',
                    'attribute_code' => 'main_table.attribute_code',
                )
            )
            ->joinLeft(
                array('option_count_table' => $attributeOptionTable),
                'option_count_table.attribute_id = main_table.attribute_id',
                array(
                    'option_count' => 'COUNT(option_count_table.option_id)',
                )
            )
            ->group('main_table.attribute_id')
            ->having('COUNT(option_count_table.option_id) > 1', 1);

        echo $select;
    }

    public function fourthAction()
    {
        // Need list of product with assigned images. return an array with product Id, sku, base image, thumb image, small image.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_fourth'));
        $this->renderLayout();
    }

    public function fourthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        echo $select = $readConnection->select()
            ->from(
                array('main_table'=> $resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )
            ->joinLeft(
                array('vc'=>$resource->getTableName('catalog_product_entity_varchar')),
                'vc.entity_id = main_table.entity_id AND vc.attribute_id = 87',
                array('image' => 'vc.value')
            )
            ->joinLeft(
                array('thumb'=>$resource->getTableName('catalog_product_entity_varchar')),
                'thumb.entity_id = main_table.entity_id AND thumb.attribute_id = 89',
                array('thumbnail' => 'thumb.value')
            )
            ->joinLeft(
                array('small'=>$resource->getTableName('catalog_product_entity_varchar')),
                'small.entity_id = main_table.entity_id AND small.attribute_id = 88',
                array('small' => 'small.value')
            );
    }

    public function fifthAction()
    {
        // Need list of product with gallery image count. return an array with product sku, gallery images count, without consideration of thumb, small, base.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_fifth'));
        $this->renderLayout();
    }

    public function fifthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('main_table'=> $resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )
            ->joinLeft(
                array('m'=>$resource->getTableName('catalog/product_attribute_media_gallery')),
                'm.entity_id = main_table.entity_id',
                array('image' => 'COUNT(m.value)')
            )
            ->group('main_table.entity_id');
    }

    public function sixthAction()
    {
        // Need list of top to bottom customers with their total order counts. return an array with customer id, customer name, customer email, order count.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_sixth'));
        $this->renderLayout();
    }

    public function sixthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('main_table'=> $resource->getTableName('customer_entity')),
                array('entity_id','email')
            )
            ->joinLeft(
                array('e'=>$resource->getTableName('customer_entity_varchar')),
                'e.entity_id = main_table.entity_id AND e.attribute_id = 5',
                array('firstname' => 'e.value')
            )
            ->joinLeft(
                array('o' => $resource->getTableName('sales/order')),
                'o.customer_id = e.entity_id',
                array('order_count' => 'COUNT(o.entity_id)')
            )
            ->group('main_table.entity_id');
    }

    public function seventhAction()
    {
        // Need list of top to bottom customers with their total order counts, order status wise. return an array with customer id, customer name, customer email, status, order count.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_seventh'));
        $this->renderLayout();
    }

    public function seventhQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('main_table'=> $resource->getTableName('customer_entity')),
                array('entity_id','email')
            )
            ->joinLeft(
                array('e'=>$resource->getTableName('customer_entity_varchar')),
                'e.entity_id = main_table.entity_id AND e.attribute_id = 5',
                array('firstname' => 'e.value')
            )
            ->joinLeft(
                array('o' => $resource->getTableName('sales/order')),
                'o.customer_id = e.entity_id',
                array('order_count' => 'COUNT(o.entity_id)')
            )
            ->joinLeft(
                array('s' => Mage::getSingleton('core/resource')->getTableName('sales_order_status')),
                'o.status = s.status',
                array('order_status' => 's.label')
            )
            ->group('main_table.entity_id');
    }

    public function eightAction()
    {
        // Need list product with number of quantity sold till now for each. return an array with product id, sku, sold quantity.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_eight'));
        $this->renderLayout();
    }

    public function eightQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $select = $readConnection->select()
            ->from(array('oi' => $resource->getTableName('sales/order_item')), array())
            ->columns(array(
                'product_id' => 'oi.product_id',
                'sku' => 'oi.sku',
                'sold_quantity' => new Zend_Db_Expr('SUM(oi.qty_ordered)')
            ))
            ->group('oi.product_id');

        echo $select;

        $query = $select->__toString();

        $results = $readConnection->fetchAll($query);

        $productData = array();
        foreach ($results as $result) {
            $productId = $result['product_id'];
            $sku = $result['sku'];
            $soldQuantity = $result['sold_quantity'];

            $productData[] = array(
                'product_id' => $productId,
                'sku' => $sku,
                'sold_quantity' => $soldQuantity
            );
        }
        echo "<pre>";
        print_r($productData);
    }

    public function ninthAction()
    {
        // Need list of those attributes for whose value is not assigned to product. return an array result product wise with these columns product Id, sku, attribute Id, attribute code.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_ninth'));
        $this->renderLayout();
    }

    public function ninthQueryAction()
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $tablePrefix = Mage::getConfig()->getTablePrefix();

        echo $select = $connection->select()
            ->from(array('e' => 'catalog_product_entity'), array('entity_id AS product_id', 'sku'))
            ->join(
                array('a' => 'eav_attribute'),
                'e.entity_type_id = a.entity_type_id',
                array('attribute_id', 'attribute_code')
            )
            ->joinLeft(
                array('avc' => 'catalog_product_entity_varchar'),
                'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
                array()
            )
            ->joinLeft(
                array('avi' => 'catalog_product_entity_int'),
                'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
                array()
            )
            ->joinLeft(
                array('avd' => 'catalog_product_entity_decimal'),
                'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
                array()
            )
            ->joinLeft(
                array('avt' => 'catalog_product_entity_text'),
                'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
                array()
            )
            ->where('avc.value IS NULL AND avi.value IS NULL AND avd.value IS NULL AND avt.value IS NULL')
            ->where('a.is_user_defined = ?', 1);
    }

    public function tenthAction()
    {
        // Need list of those attributes for whose value is not assigned to product. return an array result product wise with these columns product Id, sku, attribute Id, attribute code, value.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_tenth'));
        $this->renderLayout();
    }

    public function tenthQueryAction()
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $tablePrefix = Mage::getConfig()->getTablePrefix();

        echo $select = $connection->select()
        ->from(
            array('e' => 'catalog_product_entity'),
            array('entity_id AS product_id','sku')
        )
        ->join(
            array('a' => 'eav_attribute'),
            'e.entity_type_id = a.entity_type_id',
            array('attribute_id', 'attribute_code')
        )
        ->joinLeft(
            array('avc' => 'catalog_product_entity_varchar'),
            'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avi' => 'catalog_product_entity_int'),
            'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
            array('avi.value')
        )
        ->joinLeft(
            array('avd' => 'catalog_product_entity_decimal'),
            'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avt' => 'catalog_product_entity_text'),
            'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
            array()
        )
        ->where('avc.value IS NOT NULL OR avi.value IS NOT NULL OR avd.value IS NOT NULL OR avt.value IS NOT NULL')
        ->where('a.is_user_defined = ?', 1);
    }

    public function testAction()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
    }
}