<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('redirect404error')};
CREATE TABLE {$this->getTable('redirect404error')} (
  `redirect404error_id` int(11) unsigned NOT NULL auto_increment,
  `match_type` smallint(6) NOT NULL default '0',
  `match` varchar(255) NOT NULL default '',
  `destination` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `redirect` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`redirect404error_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

    ");
$installer->endSetup();
  
