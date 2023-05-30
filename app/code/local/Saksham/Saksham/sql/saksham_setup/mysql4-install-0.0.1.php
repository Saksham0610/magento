<?php 

$this->startSetup();

$this->addEntityType(Saksham_Saksham_Model_Resource_Saksham::ENTITY,[
	'entity_model'=>'saksham/saksham',
	'attribute_model'=>'saksham/attribute',
	'table'=>'saksham/saksham',
	'increment_per_store'=> '0',
	'additional_attribute_table' => 'saksham/eav_attribute',
	'entity_attribute_collection' => 'saksham/saksham_attribute_collection'
]);

$this->createEntityTables('saksham');
$this->installEntities();

$default_attribute_set_id = Mage::getModel('eav/entity_setup', 'core_setup')
    						->getAttributeSetId('saksham', 'Default');

$this->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = {$default_attribute_set_id} WHERE `entity_type_code` = 'saksham'");

$this->endSetup();