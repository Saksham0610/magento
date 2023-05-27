<?php 

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addKey($installer->getTable('eavmgmt/eavmgmt_decimal'),
    'UNQ_EAVMGMT_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('eavmgmt/eavmgmt_datetime'),
    'UNQ_EAVMGMT_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('eavmgmt/eavmgmt_int'),
    'UNQ_EAVMGMT_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->getConnection()->addKey($installer->getTable('eavmgmt/eavmgmt_text'),
    'UNQ_EAVMGMT_DECIMAL', array('entity_id','attribute_id', 'store_id'), 'unique');

$installer->endSetup();

?>