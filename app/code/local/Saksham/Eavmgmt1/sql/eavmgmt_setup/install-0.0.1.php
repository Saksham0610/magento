<?php 

$this->startSetup();

$this->addEntityType(Saksham_Eavmgmt_Model_Resource_Eavmgmt::ENTITY,[
	'entity_model'=>'eavmgmt/eavmgmt',
	'attribute_model'=>'eavmgmt/attribute',
	'table'=>'eavmgmt/eavmgmt',
	'increment_per_store'=> '0',
	'additional_attribute_table' => 'eavmgmt/eav_attribute',
	'entity_attribute_collection' => 'eavmgmt/eavmgmt_attribute_collection'
]);

$this->createEntityTables('eavmgmt');
$this->installEntities();

$default_attribute_set_id = Mage::getModel('eav/entity_setup', 'core_setup')
    						->getAttributeSetId('eavmgmt', 'Default');

$this->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = {$default_attribute_set_id} WHERE `entity_type_code` = 'eavmgmt'");

$this->endSetup();