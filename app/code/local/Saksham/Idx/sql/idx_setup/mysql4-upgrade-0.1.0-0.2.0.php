<?php 
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$entityTypeId = $installer->getEntityTypeId('catalog_product');
$installer->addAttribute($entityTypeId, 'collection', array(
    'group' => 'General',
    'input' => 'select',
    'type' => 'int',
    'sort_order' => '100',
    'label' => 'Select Collection',
    'backend' => '',
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'searchable' => 1,
    'filterable' => 1,
    'comparable' => 1,
    'visible_on_front' => 0,
    'is_html_allowed_on_front' => 0,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
));
$installer->endSetup();