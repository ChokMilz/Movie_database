DROP DATABASE IF EXISTS movies_database;
CREATE DATABASE movies_database;
USE movies_database;
CREATE TABLE Country (
    code CHAR(2) PRIMARY KEY,
    name VARCHAR(255),
    language VARCHAR(100)
);
CREATE TABLE Movie (
    movieId INT PRIMARY KEY,
    title VARCHAR(255),
    year YEAR,
    producerId INT,
    genre VARCHAR(100),
    summary TEXT,
    countryCode CHAR(2),
    FOREIGN KEY (countryCode) REFERENCES Country(code)
);
CREATE TABLE Artist (
    artistId INT PRIMARY KEY,
    surname VARCHAR(255),
    name VARCHAR(255),
    DOB SMALLINT
);
CREATE TABLE Role (
    movieId INT,
    actorId INT,
    roleName VARCHAR(255),
    PRIMARY KEY (movieId, actorId),
    FOREIGN KEY (movieId) REFERENCES Movie(movieId),
    FOREIGN KEY (actorId) REFERENCES Artist(artistId)
);
CREATE TABLE Internet_user (
    email VARCHAR(255) PRIMARY KEY,
    surname VARCHAR(255),
    name VARCHAR(255),
    region VARCHAR(255)
);
CREATE TABLE Score_movie (
    movieId INT,
    email VARCHAR(255),
    score TINYINT,
    PRIMARY KEY (email, movieId),
    FOREIGN KEY (email) REFERENCES Internet_user(email),
    FOREIGN KEY (movieId) REFERENCES Movie(movieId)
);