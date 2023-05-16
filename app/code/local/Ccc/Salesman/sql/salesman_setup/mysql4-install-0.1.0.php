<?php
$installer = $this;
$installer->startSetup();
$installer->run("

	DROP TABLE IF EXISTS {$this->getTable('salesman')};

	CREATE TABLE {$this->getTable('salesman')} (
	  `salesman_id` int(11) NOT NULL,
	  `address_id` int(11) NOT NULL,
	  `first_name` varchar(255) NOT NULL,
	  `last_name` varchar(255) NOT NULL,
	  `email` varchar(255) NOT NULL,
	  `gender` tinyint(4) NOT NULL,
	  `mobile` int(10) NOT NULL,
	  `status` tinyint(4) NOT NULL,
	  `company` varchar(255) NOT NULL,
	  `created_at` datetime NOT NULL,
	  `updated_at` datetime DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

	ALTER TABLE {$this->getTable('salesman')}
		ADD PRIMARY KEY (`salesman_id`),
		ADD KEY `address_id` (`address_id`);

	ALTER TABLE {$this->getTable('salesman')}
  		MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT;

");
$installer->endSetup();