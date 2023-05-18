<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->addAttribute(9, 'email', array(
    'type'          => 'varchar',
    'input'         => 'text',
    'label'         => 'Email',
    'required'      => 0,
    'group'         => '',
    'sort_order'    => '',
    'global'        => 0
));
$installer->endSetup();