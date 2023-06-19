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
                'name' => 'pv.value',
                'cost' => 'pdc.value',
                'price' => 'pdp.value',
                'color' => 'pi.value',
            ))
            ->joinLeft(
                array('pv' => $resource->getTableName('catalog_product_entity_varchar')),
                'pv.entity_id = p.entity_id AND pv.attribute_id = 73',
                array()
            )
            ->joinLeft(
                array('pdc' => $resource->getTableName('catalog_product_entity_decimal')),
                'pdc.entity_id = p.entity_id AND pdc.attribute_id = 81',
                array()
            )
            ->joinLeft(
                array('pdp' => $resource->getTableName('catalog_product_entity_decimal')),
                'pdp.entity_id = p.entity_id AND pdp.attribute_id = 77',
                array()
            )
            ->joinLeft(
                array('pi' => $resource->getTableName('catalog_product_entity_int')),
                'pi.entity_id = p.entity_id AND pi.attribute_id = 94',
                array()
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
        $attributeCollection = Mage::getResourceModel('eav/entity_attribute_collection');
        $attributeCollection->addFieldToFilter('entity_type_id', 4);

        $attributeOptions = array();

        foreach ($attributeCollection as $attribute) {
            $attributeId = $attribute->getAttributeId();
            $attributeCode = $attribute->getAttributeCode();

            if ($attribute->usesSource()) {
                $options = $attribute->getSource()->getAllOptions(false);
                echo "<pre>"; print_r($options); die();

                foreach ($options as $option) {
                    $optionId = $option['value'];
                    $optionName = $option['label'];

                    $attributeOptions[] = array(
                        'attribute_id' => $attributeId,
                        'attribute_code' => $attributeCode,
                        'option_id' => $optionId,
                        'option_name' => $optionName
                    );
                }
            }
        }

        // Output the result array
        print_r($attributeOptions);

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
        echo "third";
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
        echo "fourth";
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
        echo "fifth";
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
        echo "sixth";
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
        echo "seventh";
    }

    public function eigthAction()
    {
        // Need list product with number of quantity sold till now for each. return an array with product id, sku, sold quantity.
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_eigth'));
        $this->renderLayout();
    }

    public function eigthQueryAction()
    {
        echo "eigth";
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
        echo "ninth";
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
        echo "tenth";
    }
}