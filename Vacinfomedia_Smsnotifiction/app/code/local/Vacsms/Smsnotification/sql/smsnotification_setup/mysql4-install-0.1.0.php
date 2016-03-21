<?php
$installer = $this;
$installer->startSetup();
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('smsnotification')};
CREATE TABLE {$this->getTable('smsnotification')} (
  `smsnotification_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `adminnotificationno` varchar(10) NOT NULL default '',
  `content` text NOT NULL default '',
  `notificationtype` varchar(100) NOT NULL default '',
  `status` varchar(50) NOT NULL,
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`smsnotification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS {$this->getTable('smsnotification_setting')};
CREATE TABLE {$this->getTable('smsnotification_setting')} (
 `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `apiurl` text NOT NULL,
  `apitestingnumber` varchar(10) NOT NULL default '',
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fromname` varchar(10) NOT NULL,
  `defaultmessage` text NOT NULL,
  `udh` varchar(100) NOT NULL,
  `dlrmask` text NOT NULL,
  `dlrurl` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `datetine` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `{$installer->getTable('smsnotification_setting')}` VALUES (1, '', '', '', '', '', '', '', '', '', '0','');

    ");
$installer->endSetup();
