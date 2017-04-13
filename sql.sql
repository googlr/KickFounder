USE kickfounder;
SET FOREIGN_KEY_CHECKS=0;

# USER: loginname, username, password, say, hometown, interests, creditcard
DROP TABLE IF EXISTS `USER`;

CREATE TABLE `USER` (
  `loginname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
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
  `status` varchar(20) NOT NULL,
  `minfund` float DEFAULT NULL,
  `maxfund` float DEFAULT NULL,
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

# COMMENT: username, projectname, commmenttime, content
DROP TABLE IF EXISTS `COMMENT`;

CREATE TABLE `COMMENT` (
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

# PLEDGE: loginname, projectname, amount, pledgetime, chargestatus
DROP TABLE IF EXISTS `PLEDGE`;
CREATE TABLE `PLEDGE` (
  `loginname` varchar(40) NOT NULL,
  `projectname` varchar(100) NOT NULL,
  `pledgetime` DATETIME NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `chargestatus` varchar(20) NOT NULL,
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
# FOLLOW: username_F, username_BF
DROP TABLE IF EXISTS `FOLLOW`;
CREATE TABLE `FOLLOW` (
  `fname` varchar(40) NOT NULL,
  `bfname` varchar(40) NOT NULL,
  PRIMARY KEY (`fname`, `bfname`),
  FOREIGN KEY (`fname`) REFERENCES `USER` (`loginname`),
  FOREIGN KEY (`bfname`) REFERENCES `USER` (`loginname`)
);

