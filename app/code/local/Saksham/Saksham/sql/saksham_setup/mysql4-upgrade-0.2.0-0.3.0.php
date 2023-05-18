<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');

$installer->startSetup();

$installer->addAttribute(9, 'mobile', array(
    'type'          => 'int',
    'input'         => 'text',
    'label'         => 'Mobile',
    'required'      => 0,
    'group'         => '',
    'sort_order'    => '',
    'global'        => 0
));

$installer->addAttribute(9, 'balance', array(
    'type'          => 'decimal',
    'input'         => 'text',
    'label'         => 'Balance',
    'required'      => 0,
    'group'         => '',
    'sort_order'    => '',
    'global'        => 0
));

$installer->addAttribute(9, 'status', array(
    'type'          => 'int',
    'input'         => 'select',
    'label'         => 'Status',
    'required'      => 0,
    'group'         => '',
    'sort_order'    => '',
    'global'        => 0
));

$installer->endSetup();