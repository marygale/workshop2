/* Song List */
LOAD DATA LOCAL INFILE 'C:/Users/user/Downloads/work-related/R/eloi/unique_jam.csv'
INTO TABLE songs
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(song_id,artist,title)
SET created_at=CURRENT_TIMESTAMP,updated_at=CURRENT_TIMESTAMP

LOAD DATA LOCAL INFILE 'C:/Users/user/Downloads/work-related/R/eloi/jav10.csv'
INTO TABLE jam_rule2
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\r\n'
IGNORE 1 ROWS
(lhs,rhs,support,confidence,lift,count)
SET created_at=CURRENT_TIMESTAMP,updated_at=CURRENT_TIMESTAMP

