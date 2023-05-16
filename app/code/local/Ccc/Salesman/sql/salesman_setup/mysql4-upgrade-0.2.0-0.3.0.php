<?php
$installer = $this;
$installer->startSetup();
$installer->run("

	DROP TABLE IF EXISTS {$this->getTable('salesman_price')};
	CREATE TABLE {$this->getTable('salesman_price')} (
	  `entity_id` int(11) NOT NULL,
	  `salesman_id` int(11) NOT NULL,
	  `product_id` int(11) NOT NULL,
	  `salesman_price` decimal(11,0) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

	ALTER TABLE {$this->getTable('salesman_price')}
	  ADD PRIMARY KEY (`entity_id`),
	  ADD KEY `product_id` (`product_id`),
	  ADD KEY `salesman_id` (`salesman_id`);

	ALTER TABLE {$this->getTable('salesman_price')}
  	  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT;

	ALTER TABLE {$this->getTable('salesman_price')} ADD FOREIGN KEY (`product_id`) REFERENCES `product`(`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

	ALTER TABLE {$this->getTable('salesman_price')} ADD FOREIGN KEY (`salesman_id`) REFERENCES `salesman`(`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

");
$installer->endSetup();