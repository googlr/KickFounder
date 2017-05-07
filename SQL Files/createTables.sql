USE kickfounder;
SET FOREIGN_KEY_CHECKS=0;

# USER: loginname, username, password, say, hometown, interests, creditcard
DROP TABLE IF EXISTS `USER`;

CREATE TABLE `USER` (
  `loginname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `say` varchar(255) DEFAULT NULL,
  `hometown` varchar(40) DEFAULT NULL,
  `interests` varchar(40) DEFAULT NULL,
  `creditcard` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`loginname`)
);


# PROJECT: projectname, loginname, description, status, posttime, minfund, maxfund, endtime, plantime
DROP TABLE IF EXISTS `PROJECT`;

CREATE TABLE `PROJECT` (
  `projectname` varchar(100) NOT NULL,
  `loginname` varchar(40) NOT NULL,
  `description` varchar(4096) NOT NULL,
  `projectstatus` varchar(20) NOT NULL,	#ongoing, succeed, failed, complete
  `minfund` decimal(10,2) DEFAULT NULL,
  `maxfund` decimal(10,2) DEFAULT NULL,
  `posttime` DATETIME DEFAULT NULL,
  `endtime` DATETIME DEFAULT NULL,
  `plantime` DATETIME DEFAULT NULL,
  PRIMARY KEY (`projectname`),
  FOREIGN KEY (`loginname`) REFERENCES `USER` (`loginname`)
);

# TAG: projectname, tagname
DROP TABLE IF EXISTS `TAG`;

CREATE TABLE `TAG` (
  `projectname` varchar(100) NOT NULL,
  `tagname` varchar(40) NOT NULL,
  PRIMARY KEY (`projectname`, `tagname`),
  FOREIGN KEY (`projectname`) REFERENCES `PROJECT` (`projectname`)
);

# DISCUSS: loginname, projectname, commmenttime, content
DROP TABLE IF EXISTS `DISCUSS`;

CREATE TABLE `DISCUSS` (
  `projectname` varchar(100) NOT NULL,
  `loginname` varchar(40) NOT NULL,
  `commenttime` DATETIME NOT NULL,
  `content` varchar(4096) DEFAULT NULL,
  PRIMARY KEY (`projectname`, `loginname`, `commenttime`),
  FOREIGN KEY (`projectname`) REFERENCES `PROJECT` (`projectname`),
  FOREIGN KEY (`loginname`) REFERENCES `USER` (`loginname`)
);

# MATERIAL: projectname, uploadtime, matdes, file
DROP TABLE IF EXISTS `MATERIAL`;

CREATE TABLE `MATERIAL` (
  `projectname` varchar(100) NOT NULL,
  `uploadtime` DATETIME NOT NULL,
  `matdes` varchar(4096) DEFAULT NULL,
  `file` mediumblob DEFAULT NULL,
  PRIMARY KEY (`projectname`, `uploadtime`),
  FOREIGN KEY (`projectname`) REFERENCES `PROJECT` (`projectname`)
);

# RATE: projectname, loginname, score, ratetime
DROP TABLE IF EXISTS `RATE`;
CREATE TABLE `RATE` (
  `projectname` varchar(100) NOT NULL,
  `loginname` varchar(40) NOT NULL,
  `ratetime` DATETIME NOT NULL,
  `score`  float DEFAULT 0,
  PRIMARY KEY (`projectname`, `loginname`),
  FOREIGN KEY (`projectname`) REFERENCES `PROJECT` (`projectname`),
  FOREIGN KEY (`loginname`) REFERENCES `USER` (`loginname`)
);

# PLEDGE: loginname, projectname, amount, pledgetime
DROP TABLE IF EXISTS `PLEDGE`;
CREATE TABLE `PLEDGE` (
  `loginname` varchar(40) NOT NULL,
  `projectname` varchar(100) NOT NULL,
  `pledgetime` DATETIME NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  #`chargestatus` varchar(20) NOT NULL,	#ongoing, succeed, failed
  PRIMARY KEY (`projectname`, `loginname`,`pledgetime`),
  FOREIGN KEY (`projectname`) REFERENCES `PROJECT` (`projectname`),
  FOREIGN KEY (`loginname`) REFERENCES `USER` (`loginname`)
);

# CHARGE: loginname, projectname, chargetime, totalamount, creditcard
DROP TABLE IF EXISTS `CHARGE`;
CREATE TABLE `CHARGE` (
  `loginname` varchar(40) NOT NULL,
  `projectname` varchar(100) NOT NULL,
  `chargetime` DATETIME NOT NULL,
  `totalamount` decimal(10,2) DEFAULT NULL,
  `creditcard` varchar(40) NOT NULL,
  PRIMARY KEY (`projectname`, `loginname`),
  FOREIGN KEY (`projectname`) REFERENCES `PROJECT` (`projectname`),
  FOREIGN KEY (`loginname`) REFERENCES `USER` (`loginname`)
);

# LIKE: loginname, projectname
DROP TABLE IF EXISTS `LIKE`;
CREATE TABLE `LIKE` (
  `loginname` varchar(40) NOT NULL,
  `projectname` varchar(100) NOT NULL,
  PRIMARY KEY (`projectname`, `loginname`),
  FOREIGN KEY (`projectname`) REFERENCES `PROJECT` (`projectname`),
  FOREIGN KEY (`loginname`) REFERENCES `USER` (`loginname`)
);
# FOLLOW: fname, bfname
DROP TABLE IF EXISTS `FOLLOW`;
CREATE TABLE `FOLLOW` (
  `fname` varchar(40) NOT NULL,
  `bfname` varchar(40) NOT NULL,
  PRIMARY KEY (`fname`, `bfname`),
  FOREIGN KEY (`fname`) REFERENCES `USER` (`loginname`),
  FOREIGN KEY (`bfname`) REFERENCES `USER` (`loginname`)
);

# USERACT: loginname, acttime, acttype, actvalue
DROP TABLE IF EXISTS `USERACT`;
CREATE TABLE `USERACT` (
  `loginname` varchar(40) NOT NULL,
  `acttime` DATETIME NOT NULL,
  `acttype` varchar(40) NOT NULL, # tag, search, project
  `actvalue` varchar(60) NOT NULL,
  PRIMARY KEY (`loginname`, `acttime`),
  FOREIGN KEY (`loginname`) REFERENCES `USER` (`loginname`)
);
