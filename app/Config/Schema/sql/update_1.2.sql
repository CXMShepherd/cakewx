CREATE TABLE `cx_wcdata_cates` (
  `Id` int(11) AUTO_INCREMENT NOT NULL,
  `FWebchat` varchar(38) NOT NULL,
  `FName` varchar(100) NOT NULL,
  `FType` varchar(200) NOT NULL default '0',
  `FOrder` int(11) default 0,
  `FCreatedate` datetime default NULL,
    PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
alter table cx_wcdata_tw add column FCate int(11) null default 0;