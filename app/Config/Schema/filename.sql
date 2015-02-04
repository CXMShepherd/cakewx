

DROP TABLE IF EXISTS `liunian_dev`.`cx_T002`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TActivitieCritique`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TActivitieCustomInfo`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TActivities`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TAnnouncement`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TChapter`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TChapterAdmin`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TChapterFramework`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TCustomField`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TCustomFieldAdmin`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TCustomTable`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TDbIni`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TEnumItem`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TGroup`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TGroupAdmin`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TGroupPendingPerson`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TGroupPerson`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TImage`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TImageOwner`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TMessage`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TMessageTo`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TPerson`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TPersonEditInfo`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TPersonFeed`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TPersonFriend`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TPersonIcon`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TPersonLog`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TPost`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TQuestionnaire`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TQuestionnaireAnswer`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TQuestionnaireItem`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TUpdateInfo`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_TUser`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_active`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_authinfo`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_blogs`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_captcha`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_classes`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_comments`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_doing`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_donatefield`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_donateperson`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_donates`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_download`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_feedback`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_fields`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_filter`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_friendgroup`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_friends`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_menu`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_messages`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_multiclass`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_optimize`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_party`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_partyperson`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_recommend`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_remind`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_spacevisitors`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_tuan`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_useractived`;
DROP TABLE IF EXISTS `liunian_dev`.`cx_social_users`;


CREATE TABLE `liunian_dev`.`cx_T002` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F001` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F002` datetime DEFAULT NULL,
	`F003` datetime DEFAULT NULL,
	`F004` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F005` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F006` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F007` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F008` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F009` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F010` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `liunian_dev`.`cx_TActivitieCritique` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FActivitie` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,
	`FActive` int(11) DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TActivitieCustomInfo` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FActivitie` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TActivities` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`CheckState` int(11) DEFAULT NULL,
	`FIsActive` text(1) DEFAULT NULL,
	`FPublishDate` datetime DEFAULT NULL,
	`FStartDate` datetime DEFAULT NULL,
	`FEndDate` datetime DEFAULT NULL,
	`FOffDate` datetime DEFAULT NULL,
	`FType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMaxPersonCount` int(11) DEFAULT NULL,
	`FAddress` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FContent` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FSendMan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPric` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIcon` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FImageOwner` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FQuestionnaire` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsTJ` text(1) DEFAULT NULL,
	`FPricNumber` float(18,2) DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TAnnouncement` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPost` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TChapter` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FGroupName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FClass` int(11) DEFAULT NULL,
	`FGroupState` int(11) DEFAULT NULL,
	`FCreatePerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FIsActive` text(1) DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIcon` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FJoinPattern` int(11) DEFAULT NULL,
	`FZC` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FText` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FWebSit` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAdmin` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAdminPwd` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAdminEMail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FParent` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsAutoDate` text(1) DEFAULT NULL,
	`FDateString` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FKeyWord` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FKeyName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FGJ` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FQY` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FisReg` text(1) DEFAULT NULL,
	`FPhone` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAddress` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FDistCode` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Ffddbr` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FLinkMan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FLinkManPhone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FLinkManMobile` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FLinkManFax` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Fywzgdw` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Fdkcs` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Fpzdw` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Fbsjgrs` int(11) DEFAULT NULL,
	`FMemberCount` int(11) DEFAULT NULL,
	`Fsjdzzmc` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Fdzzclsj` datetime DEFAULT NULL,
	`Fdzzqc` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Fdzzfzr` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Fdzzlsgx` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Fdzzlly` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Fdjzdyjpcdw` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Flhjlhfgdzz` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TChapterAdmin` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FChapterType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FChapter` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAllowDel` text(1) DEFAULT NULL,
	`FAllowAdd` text(1) DEFAULT NULL,
	`FAllowEdit` text(1) DEFAULT NULL,
	`FAllowExport` text(1) DEFAULT NULL,	PRIMARY KEY  (`Id`),
	KEY `iFPerson_TChapterAdmin` (`FPerson`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TChapterFramework` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FGroup` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FTitle` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FBeginDate` datetime DEFAULT NULL,
	`FEndDate` datetime DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TCustomField` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`IsActive` text(1) DEFAULT NULL,
	`FIsManageField` text(1) DEFAULT NULL,
	`FShow` text(1) DEFAULT NULL,
	`FAllowDel` text(1) DEFAULT NULL,
	`FIndex` int(11) DEFAULT NULL,
	`FieldDisName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FTableName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FieldName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FType` int(11) DEFAULT NULL,
	`FEnumName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FEnumFieldAllowEdit` text(1) DEFAULT NULL,
	`FLen` int(11) DEFAULT NULL,
	`FLenDig` int(11) DEFAULT NULL,
	`FRemark` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FInWebSite` text(1) DEFAULT NULL,
	`FClassName` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAllowEdit` text(1) DEFAULT NULL,
	`FEnumMuti` text(1) DEFAULT NULL,
	`FMustValue` text(1) DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `liunian_dev`.`cx_TCustomFieldAdmin` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`CustomField` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TCustomTable` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FIsActive` text(1) DEFAULT NULL,
	`FAllowDel` text(1) DEFAULT NULL,
	`FTableName` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FTableDisName` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateMan` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,
	`FRemark` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`),
	UNIQUE KEY `iFTableName_TCustomTable` (`FTableName`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TDbIni` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FValue` blob DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TEnumItem` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FIndex` int(11) DEFAULT NULL,
	`EnumName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`EnumType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TGroup` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FUsePop` int(11) DEFAULT NULL,
	`FGroupName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreatePerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIcon` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`CheckState` int(11) DEFAULT NULL,
	`FIsActive` text(1) DEFAULT NULL,
	`FJoinPattern` int(11) DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FText` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FWebSit` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAdmin` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAdminPwd` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAdminEMail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FClass` int(11) DEFAULT NULL,
	`FTypeMain` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FParent` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsTrue` text(1) DEFAULT NULL,
	`FisOfficial` text(1) DEFAULT NULL,
	`FIsAuth` text(1) DEFAULT NULL,
	`FState` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCountry` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FDistCode` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCity` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FZC` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FGroupState` int(11) DEFAULT NULL,
	`FKeyWord` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsAutoDate` text(1) DEFAULT NULL,
	`FDateString` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FKeyName` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FModeStyle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FModeRowKey` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`),
	KEY `iFParent_TGroup` (`FParent`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TGroupAdmin` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FGroup` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TGroupPendingPerson` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FGroup` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FInviter` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TGroupPerson` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FGroup` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FDir` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TImage` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FIcon` blob DEFAULT NULL,
	`FImageOwner` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FWidth` int(11) DEFAULT NULL,
	`FHigth` int(11) DEFAULT NULL,
	`FSizeStr` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TImageOwner` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FActiveitie` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCoverld` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,
	`FActivitie` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCoverId` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `liunian_dev`.`cx_TMessage` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateMan` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,
	`FContent` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FontAndColor` blob DEFAULT NULL,
	`FIsDel` text(1) DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TMessageTo` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsRead` text(1) DEFAULT NULL,
	`FMessage` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMessageType` int(11) DEFAULT NULL,
	`FIsDel` text(1) DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TPerson` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FMemberId` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FullName` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FBirthday` datetime DEFAULT NULL,
	`FEMail` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`CreateDate` datetime DEFAULT NULL,
	`CreateMan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FSex` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCountry` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCity` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FHomeplace` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPoliticalStatus` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPaperType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIDNumber` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FResume` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMobileNumber` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FQQ` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPhone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAddress` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAddressCode` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FRemark` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FNational` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMarriage` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCompanyName` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCompanyPosition` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCompanyXZ` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCompanyIndustry` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F028` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F029` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F030` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F031` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F032` int(11) DEFAULT NULL,
	`F033` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F034` int(11) DEFAULT NULL,
	`F035` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsAuth` text(1) DEFAULT NULL,
	`F036` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F037` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F038` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F039` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F040` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F041` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsLogin` int(11) DEFAULT NULL,
	`F042` float(10) DEFAULT NULL,
	`FPassWord` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsPwdChange` int(11) DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F043` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F044` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F045` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F046` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F047` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F055` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F056` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`continent` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`F076` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAlumType` int(11) DEFAULT NULL,
	`FAuthType` int(11) DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`),
	UNIQUE KEY `iFMemberId_TPerson` (`FMemberId`),
	KEY `Id_index` (`Id`),
	KEY `Id` (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=InnoDB;

CREATE TABLE `liunian_dev`.`cx_TPersonEditInfo` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FieldType` int(11) DEFAULT NULL,
	`FTableName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FieldName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FValueOld` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FValueNew` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FEditTime` datetime DEFAULT NULL,
	`FEditState` int(11) DEFAULT NULL,
	`ProcMan` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TPersonFeed` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,
	`FType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FAction` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FTitle` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FImageUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsNotShow` tinyint(1) DEFAULT '0' NOT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TPersonFriend` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,
	`FriendId` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FClass` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FState` tinyint(1) NOT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TPersonIcon` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIcon` blob DEFAULT NULL,
	`FSmallIcon` blob DEFAULT NULL,	PRIMARY KEY  (`Id`),
	UNIQUE KEY `iFPerson_TPersonIcon` (`FPerson`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TPersonLog` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateMan` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TPost` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FContent` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FPublishDate` datetime DEFAULT NULL,
	`FCreateMan` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FType` int(11) DEFAULT NULL,
	`FPostOwner` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FViewNum` int(11) NOT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TQuestionnaire` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FTitle` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime NOT NULL,
	`FCreateMan` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TQuestionnaireAnswer` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FQuestionnaire` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FQuestionnaireItem` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Ftext` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TQuestionnaireItem` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FType` int(11) DEFAULT NULL,
	`FOwner` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIndex` int(11) DEFAULT NULL,
	`FTitle` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`Ftext` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TUpdateInfo` (
	`Id` int(11) NOT NULL AUTO_INCREMENT,
	`FTableName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FFieldID` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`onlykey` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`),
	KEY `iFTableName_TUpdateInfo` (`FTableName`),
	KEY `iFFieldID_TUpdateInfo` (`FFieldID`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_TUser` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FisActive` text(1) DEFAULT NULL,
	`PopGroup` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`isManage` text(1) DEFAULT NULL,
	`FIsAdmin` text(1) DEFAULT NULL,
	`FLoginName` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPassWord` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FLastLoginTime` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`),
	UNIQUE KEY `iFLoginName_TUser` (`FLoginName`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_active` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime NOT NULL,
	`FType` int(11) DEFAULT 0 NOT NULL,
	`FValue` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FKey` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FIsActive` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0' NOT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_authinfo` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FullName` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIdNumber` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FEMail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,
	`FExtraInfo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FType` tinyint(1) DEFAULT '0',
	`FMobileNumber` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_blogs` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FType` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_captcha` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`captcha_time` int(11) DEFAULT NULL,
	`ip_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`word` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_classes` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FTitle` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FContent` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FSource` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_comments` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FMessage` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FType` int(11) NOT NULL,
	`FOwner` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_doing` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FMessage` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsMood` tinyint(1) DEFAULT '0',
	`FIsNotShow` tinyint(1) DEFAULT '0',	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_donatefield` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FDonate` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_donateperson` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FOrderNumber` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FCompleteDate` datetime DEFAULT NULL,
	`FMessage` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FullName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FEMail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FType` int(11) NOT NULL,
	`FOwnerDonate` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPayType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPayOrderNumber` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FSite` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FSiteName` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPayStatus` int(11) DEFAULT NULL,
	`FPhoneNumber` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPayMoney` float NOT NULL,
	`FSchoolLinkMan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_donates` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FTitle` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FType` int(11) DEFAULT NULL,
	`FIcon` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,
	`FPrice` float DEFAULT NULL,
	`FNumbers` int(11) DEFAULT NULL,
	`FState` tinyint(1) DEFAULT NULL,
	`FGoods` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_download` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FileName` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FOldName` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FileType` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FileSize` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_feedback` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FMemo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateTime` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_fields` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FieldOwner` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FAction` int(5) DEFAULT 0,
	`FIndex` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_filter` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime NOT NULL,
	`FTableNmae` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FTableId` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FKeywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FState` int(11) DEFAULT 0 NOT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_friendgroup` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime NOT NULL,	KEY `Id` (`Id`),
	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_friends` (
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FUid` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FOwnerFriendGroup` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FStatus` tinyint(1) DEFAULT '0',
	`FNote` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL	) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_menu` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FMenuName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FIndex` int(11) DEFAULT NULL,
	`FMenuLevel` int(11) DEFAULT NULL,
	`FMenuParent` int(11) DEFAULT NULL,
	`FIsActive` tinyint(1) DEFAULT NULL,
	`FRoutes` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FImage` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_messages` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreatePerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FMessage` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_multiclass` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FTableName` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FTableId` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FType` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime NOT NULL,
	`FOwnerClass` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_optimize` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FOwner` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FOwnerVirtual` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FType` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCount` int(11) DEFAULT 0 NOT NULL,
	`FLastWiteTable` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FChildCount` int(11) DEFAULT 0,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_party` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FMemo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FStartDate` datetime DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_partyperson` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FParty` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_recommend` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FOwnerId` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FType` int(5) NOT NULL,
	`FMessage` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FState` int(2) DEFAULT 0,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,	PRIMARY KEY  (`FPerson`, `Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_remind` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FType` int(5) DEFAULT 0,
	`FMessage` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FState` int(2) DEFAULT 0,
	`FPersonOwner` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FOwnerId` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_spacevisitors` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FUid` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FVisitorId` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FDateTime` datetime DEFAULT NULL,	PRIMARY KEY  (`Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_tuan` (
	`Id` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FAuth` varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FCreateDate` datetime NOT NULL,
	`FTuanIP` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FInvite` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FInviteValues` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`FPerson`, `Id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_useractived` (
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FBasicInfo` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FType` int(4) DEFAULT NULL,
	`FCreateDate` datetime DEFAULT NULL,
	`FEMail` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FExtraInfo` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FState` tinyint(1) DEFAULT NULL,
	`FMailInfo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FReg` tinyint(1) DEFAULT NULL,
	`FIP` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FInvite` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FInviteExtra` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FTableInfo` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`FPerson`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

CREATE TABLE `liunian_dev`.`cx_social_users` (
	`FPerson` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`FLoginName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FRegDate` datetime DEFAULT NULL,
	`FRegIP` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FLastLoginTime` datetime DEFAULT NULL,
	`FLastLoginIP` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`FIsLogin` int(11) DEFAULT NULL,
	`FPassWord` int(11) NOT NULL,
	`FRole` int(5) DEFAULT 0,
	`FQuestion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0',
	`FAnswer` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0',
	`FSoapIsLogin` int(11) DEFAULT 0,
	`FSoapSessionId` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,	PRIMARY KEY  (`FPerson`),
	UNIQUE KEY `FLoginName` (`FLoginName`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_general_ci,
	ENGINE=MyISAM;

