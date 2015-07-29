CREATE TABLE `cx_invite` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FInvCode` varchar(100) NOT NULL,
  `FCreatedate` datetime NOT NULL,
  `FUseddate` datetime DEFAULT NULL,
  `FIsUsed` tinyint(1) DEFAULT '0',
  `FMemo` text COMMENT '备注',
  `FPerson` varchar(38) DEFAULT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `FMobileNumber` varchar(100) DEFAULT NULL,
  `FEMail` varchar(100) DEFAULT NULL,
  `FUser` text COMMENT '个人信息',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `FInvCode` (`FInvCode`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `cx_wcdata_orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FWebchat` varchar(38) DEFAULT NULL,
  `FOwnerId` varchar(100) NOT NULL DEFAULT '' COMMENT '店铺id',
  `FStoreName` varchar(200) DEFAULT NULL COMMENT '所属店铺',
  `FType` tinyint(1) DEFAULT '0',
  `FCreatedate` datetime DEFAULT NULL COMMENT '下单时间',
  `FUserId` varchar(100) DEFAULT NULL COMMENT '顾客id',
  `FUserName` varchar(100) DEFAULT NULL COMMENT '姓名',
  `FUserPhone` varchar(100) DEFAULT NULL COMMENT '电话',
  `FUserAddress` varchar(1000) DEFAULT NULL COMMENT '配送地址',
  `FMemo` text COMMENT '备注',
  `FPrice` double DEFAULT NULL COMMENT '总价',
  `FPay` varchar(100) DEFAULT NULL,
  `FStatus` tinyint(2) DEFAULT NULL COMMENT '订单状态，0为无效订单，1未处理，2为已确认订单，3为成功订单',
  `FProduct` text COMMENT '商品数据',
  `FUserTime` varchar(100) DEFAULT NULL COMMENT '配送时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `cx_wcdata_stores` (
  `Id` varchar(38) NOT NULL DEFAULT '',
  `FWebchat` varchar(38) NOT NULL,
  `FOwnerId` varchar(38) DEFAULT NULL COMMENT '0为单店铺',
  `FStore` varchar(100) DEFAULT NULL COMMENT 'cy001为餐饮店，gs001为果蔬店，cs001为超市，00为其他',
  `FName` varchar(100) NOT NULL,
  `FBackPicUrl` varchar(1000) DEFAULT NULL COMMENT '店铺背景图',
  `FSignPicUrl` varchar(1000) DEFAULT NULL COMMENT '店铺标志图',
  `FMemo` text COMMENT '店铺简介',
  `FQQ` varchar(11) DEFAULT NULL,
  `FPhone` varchar(100) DEFAULT NULL,
  `FAddress` varchar(500) DEFAULT NULL,
  `FAdLng` varchar(100) DEFAULT NULL COMMENT '经度',
  `FAdLat` varchar(100) DEFAULT NULL COMMENT '纬度',
  `FOrderPrefix` varchar(100) DEFAULT NULL,
  `FStopMemo` text COMMENT '暂停营业提示语',
  `FSendPrice` varchar(100) DEFAULT '0' COMMENT '起送价格',
  `FDevCost` varchar(100) DEFAULT '0' COMMENT '外送费',
  `FOvFreeDc` int(11) DEFAULT NULL COMMENT '订单超过多少免外送费',
  `FIsCouponsFirst` tinyint(1) DEFAULT NULL COMMENT '是否启用首单优惠',
  `FCouponsFirst` float DEFAULT NULL COMMENT '首单立减多少',
  `FDevDistance` varchar(100) DEFAULT '1' COMMENT '外送距离',
  `FDevArea` text COMMENT '外送区域',
  `FPay` tinyint(1) DEFAULT '0' COMMENT '0为货到付款，1为在线支付，2为微信支付',
  `FIsDrLimit` tinyint(1) DEFAULT '0' COMMENT '是否开启配送限制，0不开启，1为开启',
  `FDrTime` varchar(100) DEFAULT NULL COMMENT '提前多少分钟下单',
  `FIsCoupons` tinyint(1) DEFAULT '0' COMMENT '是否启用优惠券',
  `FMcouponPrice` varchar(100) DEFAULT NULL COMMENT '最大优惠券面值',
  `FIsDiscount` tinyint(1) DEFAULT '0' COMMENT '是否启用折扣',
  `FDiscount` int(11) DEFAULT '0' COMMENT '折扣',
  `FRdPhone` varchar(100) DEFAULT NULL COMMENT '短信订单提醒',
  `FIsRdPhone` tinyint(1) DEFAULT '0' COMMENT '是否启用短信提醒',
  `FIsRdMail` tinyint(1) DEFAULT '0' COMMENT '是否启用邮箱提醒',
  `FRdMail` varchar(100) DEFAULT NULL COMMENT '邮箱订单提醒',
  `FCreatedate` datetime DEFAULT NULL,
  `FUpdatedate` datetime DEFAULT NULL,
  `FStatus` tinyint(1) DEFAULT '1' COMMENT '营业状态，0为不营业，1为正常营业',
  `FIsActive` tinyint(1) DEFAULT '1' COMMENT '店铺是否有效',
  `FOrderTime` varchar(100) DEFAULT NULL COMMENT '营业时间',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cx_wcdata_tw_persons` (
  `Id` varchar(38) NOT NULL,
  `FEventId` varchar(38) NOT NULL,
  `FMemo` text,
  `FState` int(11) DEFAULT NULL,
  `FCreatedate` datetime DEFAULT NULL,
  `FUpdatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cx_wcdata_tw_product` (
  `Id` varchar(38) NOT NULL,
  `FOwnerId` varchar(38) NOT NULL,
  `FOrigPrice` float DEFAULT NULL,
  `FPrice` float DEFAULT NULL,
  `FPicUrl` varchar(1000) DEFAULT NULL,
  `FState` tinyint(1) DEFAULT '1',
  `FStartdate` datetime DEFAULT NULL,
  `FCreatedate` datetime DEFAULT NULL,
  `FAddress` varchar(1000) DEFAULT NULL,
  `FUnit` varchar(100) DEFAULT NULL COMMENT '商品规格',
  `FIsClosed` tinyint(1) DEFAULT '0' COMMENT '是否暂停销售',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cx_wcdata_users` (
  `FOpenId` varchar(100) NOT NULL DEFAULT '',
  `FUnionid` varchar(100) NULL DEFAULT '',
  `FMemberId` varchar(38) DEFAULT NULL,
  `FWebchat` varchar(38) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `FSubscribe` tinyint(1) DEFAULT NULL,
  `FNickname` varchar(500) DEFAULT NULL,
  `FSex` varchar(100) DEFAULT NULL,
  `FLanguage` varchar(100) DEFAULT NULL,
  `FCity` varchar(100) DEFAULT NULL,
  `FProvince` varchar(100) DEFAULT NULL,
  `FCountry` varchar(100) DEFAULT NULL,
  `FHeadimgurl` varchar(2000) DEFAULT NULL,
  `FSubscribe_time` int(11) DEFAULT NULL,
  `FCreatedate` datetime DEFAULT NULL,
  `FUpdatedate` datetime DEFAULT NULL,
  `FMemo` text,
  `FPhone` varchar(100) DEFAULT NULL COMMENT '联系电话',
  `FAddress` varchar(1000) DEFAULT NULL COMMENT '地址',
  `FIsMember` tinyint(1) DEFAULT 0 COMMENT '是否报名',
  PRIMARY KEY (`FOpenId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cx_wcdata_sent` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FWebchat` varchar(38) NOT NULL,
  `FMsgId` varchar(200) DEFAULT NULL,
  `FType` tinyint(1) DEFAULT NULL,
  `FSentMsg` text COMMENT 'json',
  `FCreatedate` datetime DEFAULT NULL,
  `FStatus` tinyint(1) DEFAULT NULL,
  `FError` varchar(200) DEFAULT NULL,
  `FSentCount` int(11) DEFAULT NULL,
  `FErrorCount` int(11) DEFAULT NULL,
  `FTotalCount` int(11) DEFAULT NULL,
  `FilterCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `cx_wcdata_cates` (
  `Id` varchar(38) NOT NULL DEFAULT '',
  `FWebchat` varchar(38) NOT NULL,
  `FOwnerId` varchar(38) DEFAULT NULL COMMENT '所属店铺',
  `FParentId` varchar(38) DEFAULT NULL COMMENT '父菜单',
  `FName` varchar(100) NOT NULL,
  `FType` varchar(200) NOT NULL DEFAULT '0',
  `FOrder` int(11) DEFAULT '0',
  `FTwj` text COMMENT '数据',
  `FCreatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;