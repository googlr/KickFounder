# USER
INSERT INTO `USER` VALUES('BobInBrooklyn','Bob Stark','qwert123','Change the world','Brooklyn','Skiing','8888 8888 8888 8888');
INSERT INTO `USER` VALUES('johnth1@gmail.com','John Wu','12345678','To be or not to be','Manhattan','Money','2222 2222 2222 2222');
INSERT INTO `USER` VALUES('AllenShow','Allen Degenerous','hi5allen','Gay pride, LGBT go','Queens','TV shows','7777 7777 7777 7777');
INSERT INTO `USER` VALUES('CaptainAmerican','Steve Rogers','lovepeggy','I can do this all day','Brooklyn','Dancing','6666 6666 6666 6666');
INSERT INTO `USER` VALUES('DeadPool','Wade Wilson','deadpool','Screw the heros','Canada','Porn','3333 3333 3333 3333');

# PROJECT
INSERT INTO `PROJECT`(`projectname`, `loginname`, `description`, `projectstatus`, `minfund`, `maxfund`, `posttime`, `endtime`, `plantime`) VALUES ('Great song', 'johnth1@gmail.com', 'I want produce a jazz, do you like that?', 'ongoing', 200, 300, '2017-03-12 12:10:29', '2017-05-12 12:10:29', '2017-09-13 12:10:29');
INSERT INTO `PROJECT`(`projectname`, `loginname`, `description`, `projectstatus`, `minfund`, `maxfund`, `posttime`, `endtime`, `plantime`) VALUES ('Good Music', 'BobInBrooklyn', 'Jazz is my life! Come on, let dance.', 'ongoing', 300, 400, '2017-03-11 12:10:29', '2017-05-11 12:10:29', '2017-10-13 12:10:29');
INSERT INTO `PROJECT`(`projectname`, `loginname`, `description`, `projectstatus`, `minfund`, `maxfund`, `posttime`, `endtime`, `plantime`) VALUES ('Good Music2', 'DeadPool', 'Jazz is my life! Come on, let dance.', 'ongoing', 304, 4060, '2017-03-15 12:10:29', '2017-04-11 12:16:29', '2017-11-13 12:10:29');
INSERT INTO `PROJECT`(`projectname`, `loginname`, `description`, `projectstatus`, `minfund`, `maxfund`, `posttime`, `endtime`, `plantime`) VALUES ('Music part1', 'BobInBrooklyn', 'Jazz is my life! Come on, let dance.', 'complete', 340, 440, '2017-03-13 12:10:29', '2017-05-13 12:10:29', '2017-10-14 12:10:29');
INSERT INTO `PROJECT`(`projectname`, `loginname`, `description`, `projectstatus`, `minfund`, `maxfund`, `posttime`, `endtime`, `plantime`) VALUES ('Music part2', 'BobInBrooklyn', 'Jazz is my life! Come on, let dance.', 'complete', 400, 500, '2017-03-14 12:10:29', '2017-05-14 12:10:29', '2017-10-15 12:10:29');
INSERT INTO `PROJECT`(`projectname`, `loginname`, `description`, `projectstatus`, `minfund`, `maxfund`, `posttime`, `endtime`, `plantime`) VALUES ('Music part3', 'BobInBrooklyn', 'Jazz is my life! Come on, let dance.', 'complete', 500, 600, '2017-04-15 12:10:29', '2017-05-15 12:10:29', '2017-10-16 12:10:29');
# RATE
INSERT INTO `RATE` VALUES ('Music part1', 'DeadPool','2017-03-16 12:10:29', 5);
INSERT INTO `RATE` VALUES ('Music part2', 'DeadPool','2017-03-16 12:10:39', 5);
INSERT INTO `RATE` VALUES ('Music part3', 'DeadPool','2017-03-16 12:10:49', 5);

# TAG
INSERT INTO `TAG` VALUES('Great song','jazz');
INSERT INTO `TAG` VALUES('Great song','vocal');
INSERT INTO `TAG` VALUES('Great song','music');
INSERT INTO `TAG` VALUES('Good Music','jazz');
INSERT INTO `TAG` VALUES('Good Music','music');
INSERT INTO `TAG` VALUES('Music part1','jazz');
INSERT INTO `TAG` VALUES('Music part1','music');
INSERT INTO `TAG` VALUES('Music part2','jazz');
INSERT INTO `TAG` VALUES('Music part2','music');
INSERT INTO `TAG` VALUES('Music part3','jazz');
INSERT INTO `TAG` VALUES('Music part3','music');

# DISCUSS
INSERT INTO `DISCUSS` VALUES('Great song','johnth1@gmail.com','2017-03-12 12:11:00','Voice from heaven, thank you for your support');
INSERT INTO `DISCUSS` VALUES('Great song','AllenShow','2017-03-12 12:12:12','First one to comment LOL');
INSERT INTO `DISCUSS` VALUES('Great song','DeadPool','2017-03-15 17:12:00','I hate loud music');
INSERT INTO `DISCUSS` VALUES('Good Music','BobInBrooklyn','2017-03-11 13:10:45','Jazz you have never heard before, you can not miss it');
INSERT INTO `DISCUSS` VALUES('Good Music','CaptainAmerican','2017-03-15 17:10:45','Yo~ bro, we are brooklyn boys');
INSERT INTO `DISCUSS` VALUES('Music part1','BobInBrooklyn','2017-03-13 13:10:29','Here comes BobInBrooklyn, Let us rock together');
INSERT INTO `DISCUSS` VALUES('Music part1','AllenShow','2017-04-13 14:10:29','It is gona to be HUGE');
INSERT INTO `DISCUSS` VALUES('Music part1','DeadPool','2017-04-17 13:13:29','Why kate perry is still single? soooo sad');
INSERT INTO `DISCUSS` VALUES('Music part2','CaptainAmerican','2017-03-14 12:15:37','Go, Brooklyn boys, go');
INSERT INTO `DISCUSS` VALUES('Music part2','AllenShow','2017-03-18 19:35:00','Master Piece, like always');

#PLEDGE
SET SQL_SAFE_UPDATES=0; 
INSERT INTO `PLEDGE` VALUES ('johnth1@gmail.com', 'Great song', '2017-04-01 12:10:29', 100);
INSERT INTO `PLEDGE` VALUES ('johnth1@gmail.com', 'Great song', '2017-04-01 13:10:29', 200);
INSERT INTO `PLEDGE` VALUES ('johnth1@gmail.com', 'Great song', '2017-04-01 14:10:29', 800);
INSERT INTO `PLEDGE` VALUES ('johnth1@gmail.com', 'Good Music', '2017-04-01 15:10:29', 700);
INSERT INTO `PLEDGE` VALUES ('johnth1@gmail.com', 'Music part1', '2017-04-01 16:10:29', 100);
INSERT INTO `PLEDGE` VALUES ('johnth1@gmail.com', 'Music part2', '2017-04-01 17:10:29', 100);
INSERT INTO `PLEDGE` VALUES ('johnth1@gmail.com', 'Music part3', '2017-04-01 18:10:29', 100);
