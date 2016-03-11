<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('message')};
CREATE TABLE {$this->getTable('message')} (
  `message_id` int(11) unsigned NOT NULL auto_increment,
  `p_amount_less` varchar(255) NOT NULL default '0',
  `p_amount_greater` varchar(255) NOT NULL default '', 
  `p_message` text NOT NULL,
  `p_location` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`message_id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup();
  
