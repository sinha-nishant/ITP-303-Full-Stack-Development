-- 1. Display albums that have the letters “on” somewhere in the album title.
-- Sort results in alphabetical order by album title.
USE sinhan_song_db;
SELECT *
FROM albums
WHERE title LIKE '%on%'
ORDER BY title;

-- 2. Same as #1, but only show album title and artist name (no artist_id) columns.
SELECT album_id, title
FROM albums
WHERE title LIKE '%on%'
ORDER BY title;

-- 3. Display tracks that have AAC audio file format.
-- Only show track name (alias: track_name), composer, media type name (alias: media_type), and unit price columns.
SELECT tracks.name, composer, media_types.name, unit_price
FROM tracks
	JOIN media_types
    ON tracks.media_type_id = media_types.media_type_id
WHERE tracks.media_type_id = 5;

-- 4. Display R&B/Soul and Jazz tracks that have a composer (not NULL).
-- Sort results in reverse-alphabetical order by track name.
-- Only show track ID, track name (track_name), composer, milliseconds, and genre name (genre_name) columns.
SELECT tracks.track_id, tracks.name, composer, milliseconds, genres.name
FROM tracks
	JOIN genres
    ON tracks.genre_id = genres.genre_id
WHERE composer IS NOT NULL 
AND (tracks.genre_id = 14 OR tracks.genre_id = 2)
ORDER BY tracks.name DESC;

-- 1. Display drama (genre) DVDs that won awards. 
-- Sort results by year of when the DVD won an award. 
-- Show dvd title, award, genre, label, and rating.
USE sinhan_dvd_db;
SELECT title, award, genre, label, rating
FROM dvd_titles
	JOIN genres
    ON dvd_titles.genre_id = genres.genre_id
    JOIN labels
    ON dvd_titles.label_id = labels.label_id
    JOIN ratings
    ON dvd_titles.rating_id = ratings.rating_id
WHERE award IS NOT NULL AND genre = 'Drama'
ORDER BY award;

-- 2. Display DVDs made by Universal (a label) and have DTS sound.
-- Show dvd title, sound, label, genre, and rating
SELECT title, sound, label, genre, rating
FROM dvd_titles
	JOIN sounds
    ON dvd_titles.sound_id = sounds.sound_id
	JOIN genres
    ON dvd_titles.genre_id = genres.genre_id
    JOIN labels
    ON dvd_titles.label_id = labels.label_id
    JOIN ratings
    ON dvd_titles.rating_id = ratings.rating_id
WHERE sound = 'DTS' AND label = 'Universal'
ORDER BY title;

-- 3. Display R-rated Sci-Fi DVDs that have a release date (not NULL). 
-- Order results from newest to oldest released DVD.
-- Show dvd title, release date, rating, genre, sound, and label.
SELECT title, release_date, rating, genre, sound, label
FROM dvd_titles
	JOIN sounds
    ON dvd_titles.sound_id = sounds.sound_id
	JOIN genres
    ON dvd_titles.genre_id = genres.genre_id
    JOIN labels
    ON dvd_titles.label_id = labels.label_id
    JOIN ratings
    ON dvd_titles.rating_id = ratings.rating_id
WHERE rating = 'R' AND release_date IS NOT NULL AND genre = 'Sci-Fi'
ORDER BY release_date DESC;