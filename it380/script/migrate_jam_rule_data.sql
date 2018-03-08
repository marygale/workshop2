LOAD DATA LOCAL INFILE '../csv/jav10.csv'
INTO TABLE jam_rule2
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(lhs,rhs,support,confidence,lift,count)
SET created_at=CURRENT_TIMESTAMP,updated_at=CURRENT_TIMESTAMP