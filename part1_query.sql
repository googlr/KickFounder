# 3
SELECT pl.loginname, SUM(amount)
FROM PLEDGE AS pl JOIN TAG AS tag
	ON pl.projectname = tag.projectname
GROUP BY pl.loginname
HAVING pl.chargestatus = 'succeed' AND tag.tagname = 'jazz';

# 5
SELECT content
FROM DISCUSS AS dis
WHERE dis.loginname IN (SELECT bfname
						FROM FOLLOW AS fol
						WHERE fname = 'BobInBrooklyn');
                        
# 7
INSERT INTO PLEDGE(`loginname`, `projectname`, `amount`, `pledgetime`, chargestatus)
	VALUES ('BobInBrooklyn', 'KickFounder', 10000, '2017-04-13 18:30:59', 'ongoing');
    
# 8(2)
DELIMITER$$
CREATE TRIGGER Pledge_after_update_trigger
	AFTER UPDATE ON PLEDGE
    FOR EACH ROW
BEGIN
	CREATE 
	IF SELECT 
		FROM PROJECT AS pj JOIN 
			(SELECT projectname AS pjname, SUM(amount) AS totalfund
			FROM PLEDGE AS pl
			GROUP BY pl.projectname
			HAVING pl.chargestatus = 'ongoing') AS pjtotal
        ON pj.projectname = pjtotal.pjname
    
    THEN
END$$
DELIMITER;

SHOW TRIGGERS;

