# proj1 c
USE kickfounder;
# 1
INSERT INTO `USER`(`loginname`, `username`, `password`) VALUES ('johnth1@gmail.com', 'John Wu', '12345678');
# SELECT * FROM USER;
# 2
SELECT projectname FROM PROJECT
WHERE projectstatus="ongoing"
AND description LIKE "%jazz%"
ORDER BY posttime DESC;
# 3
SELECT pl.loginname, SUM(amount)
FROM PLEDGE AS pl JOIN TAG AS tag
	ON pl.projectname = tag.projectname
GROUP BY pl.loginname
HAVING pl.chargestatus = 'succeed' AND tag.tagname = 'jazz';
# 4
SELECT loginname FROM PROJECT
WHERE projectname IN (
SELECT PROJECT.projectname
FROM RATE, PROJECT
WHERE projectstatus="complete" AND PROJECT.projectname=RATE.projectname
GROUP BY PROJECT.projectname
HAVING AVG(score) >= 4
)
GROUP BY loginname
HAVING COUNT(loginname) >=3;
# 5
SELECT content
FROM DISCUSS AS dis
WHERE dis.loginname IN (SELECT bfname
						FROM FOLLOW AS fol
						WHERE fname = 'BobInBrooklyn');
# 6
INSERT INTO `PROJECT`(`projectname`, `loginname`, `description`, `projectstatus`, `minfund`, `maxfund`, `posttime`, `endtime`, `plantime`) VALUES ('Great song', 'John Wu', 'I want produce a song, do you like that?', 'ongoing', 200, 300, '2017-03-11 12:10:29', '2017-05-11 12:10:29', '2017-09-12 12:10:29');
SELECT * FROM PROJECT;				
                        
# 7
INSERT INTO PLEDGE(`loginname`, `projectname`, `amount`, `pledgetime`, chargestatus)
	VALUES ('BobInBrooklyn', 'KickFounder', 10000, '2017-04-13 18:30:59', 'ongoing');
    
# 8
delimiter //
CREATE TRIGGER charge_trigger AFTER INSERT ON PLEDGE
FOR EACH ROW BEGIN
IF (SELECT SUM(amount) FROM PLEDGE WHERE PLEDGE.projectname=NEW.projectname) > (SELECT maxfund FROM PROJECT WHERE PROJECT.projectname=NEW.projectname) THEN
	UPDATE PROJECT SET projectstatus='successed';
    INSERT INTO `CHARGE` VALUE (NEW.loginname, NEW.projectname, NOW(),
    (SELECT SUM(amount) FROM PLEDGE WHERE PLEDGE.projectname=NEW.projectname), (SELECT creditcard FROM USER WHERE USER.loginname=NEW.loginname));
END IF;
END; //
delimiter ;


