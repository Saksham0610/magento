<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$entityTypeId     = $installer->getEntityTypeId('catalog_category');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
$options = array(
    'values' => array(
        '0' => 'No',
        '1' => 'Yes'
    )
);
$installer->addAttribute('catalog_category', 'featured_category', array(
	'group'        => 'General Information',
    'type'         => 'int',
    'label'        => 'Featured Category',
    'input'        => 'select',
    'default'      => '0',
    'class'        => '',
    'backend'      => 'eav/entity_attribute_backend_array',
    'frontend'     => '',
    'source'       => '',
    'global'       => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible'      => true,
    'required'     => false,
    'user_defined' => true,
    'searchable'   => false,
    'filterable'   => false,
    'comparable'   => false,
    'visible_on_front' => false,
    'default'      => 0,
    'option'       => $options,
    'sort_order'   => 50,
));
$installer->endSetup();