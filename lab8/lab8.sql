-- #1
CREATE VIEW mpeg_tracks AS
SELECT tracks.name AS track_name, artists.name AS artist_name, composer, albums.title AS album_title, media_types.name AS media_type
FROM tracks
	JOIN media_types
    ON tracks.media_type_id = media_types.media_type_id
    JOIN albums
    ON tracks.album_id = albums.album_id
    JOIN artists
    ON albums.artist_id = artists.artist_id
WHERE tracks.media_type_id = 1
ORDER BY tracks.name;

SELECT * FROM mpeg_tracks;

-- #2
INSERT INTO tracks (name, album_id, media_type_id, genre_id, composer, milliseconds, bytes, unit_price)
VALUES ('The Ocean', 137, 1, 1, 'John Bonham/John Paul Jones/Robert Plant', 248000, 7990000, 0.99);

-- #3
UPDATE tracks
SET bytes = 8998765, unit_price = 1.99
WHERE tracks.track_id = 3504;

-- #4 
DELETE FROM playlist_track
WHERE playlist_track.track_id = 122;

DELETE FROM tracks
WHERE tracks.track_id = 122; 

-- #5
SELECT tracks.album_id, albums.title AS album_title, COUNT(tracks.track_id) as track_count
FROM tracks
	JOIN albums
    ON tracks.album_id = albums.album_id
GROUP BY tracks.album_id;
