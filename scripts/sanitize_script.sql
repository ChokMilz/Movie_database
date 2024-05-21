USE movies_database;
UPDATE Artist
SET DOB = NULL
WHERE DOB = '0';
UPDATE Movie
SET countryCode = 'US'
WHERE movieId = 115;
UPDATE Country
SET language = NULL
WHERE (
        SELECT LENGTH(language) = 1
    );