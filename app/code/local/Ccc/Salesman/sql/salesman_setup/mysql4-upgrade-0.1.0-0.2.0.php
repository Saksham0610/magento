<?php
$installer = $this;
$installer->startSetup();
$installer->run("

	DROP TABLE IF EXISTS {$this->getTable('salesman_address')};
	CREATE TABLE {$this->getTable('salesman_address')} (
	  `address_id` int(11) NOT NULL,
	  `salesman_id` int(11) NOT NULL,
	  `address` varchar(255) NOT NULL,
	  `city` varchar(50) NOT NULL,
	  `state` varchar(50) NOT NULL,
	  `country` varchar(50) NOT NULL,
	  `zip` int(8) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

	ALTER TABLE {$this->getTable('salesman_address')}
	  ADD PRIMARY KEY (`address_id`),
	  ADD KEY `salesman_id` (`salesman_id`);

	ALTER TABLE {$this->getTable('salesman_address')}
	  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

	ALTER TABLE {$this->getTable('salesman_address')} ADD FOREIGN KEY (`salesman_id`) REFERENCES `salesman`(`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

");
$installer->endSetup();