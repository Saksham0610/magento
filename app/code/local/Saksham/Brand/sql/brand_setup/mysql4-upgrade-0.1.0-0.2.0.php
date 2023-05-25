<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->addAttribute(4, 'brand', array(
    'type'          => 'int',
    'input'         => 'select',
    'label'         => 'Brand',
    'required'      => 0,
    'group'         => '',
    'sort_order'    => '',
    'global'        => 0
));
$installer->endSetup();