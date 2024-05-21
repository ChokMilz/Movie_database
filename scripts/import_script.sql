USE movies_database;
-- Disable foreign key checks
SET FOREIGN_KEY_CHECKS = 0;
LOAD DATA LOCAL INFILE 'csv/Country-table.csv' INTO TABLE Country FIELDS TERMINATED BY ',' ENCLOSED BY '"' ESCAPED BY '"' LINES TERMINATED BY '\n' IGNORE 1 LINES (code, name, language);
LOAD DATA LOCAL INFILE 'csv/Movie-table.csv' INTO TABLE Movie FIELDS TERMINATED BY ',' ENCLOSED BY '"' ESCAPED BY '"' LINES TERMINATED BY '\n' IGNORE 1 LINES (
    movieId,
    title,
    year,
    producerId,
    genre,
    summary,
    countryCode
);
LOAD DATA LOCAL INFILE 'csv/Artist-table.csv' INTO TABLE Artist FIELDS TERMINATED BY ',' ENCLOSED BY '"' ESCAPED BY '"' LINES TERMINATED BY '\n' IGNORE 1 LINES (artistId, surname, name, DOB);
LOAD DATA LOCAL INFILE 'csv/Role-table.csv' INTO TABLE Role FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES (movieId, actorId, roleName);
LOAD DATA LOCAL INFILE 'csv/Internet-user-table.csv' INTO TABLE Internet_user FIELDS TERMINATED BY ',' ENCLOSED BY '"' ESCAPED BY '"' LINES TERMINATED BY '\n' IGNORE 1 LINES (email, surname, name, region);
LOAD DATA LOCAL INFILE 'csv/Score_movie_Table.csv' INTO TABLE Score_movie FIELDS TERMINATED BY ',' ENCLOSED BY '"' ESCAPED BY '"' LINES TERMINATED BY '\n' IGNORE 1 LINES (movieId, email, score);
-- Enable foreign key checks
SET foreign_key_checks = 1;