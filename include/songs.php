<?php

function getAllSongs()
{
    $songs = dbQuery("
                SELECT *
                FROM songs 
              ")->fetchAll();
    return $songs;
}

function getUsersSongs()
{ // fill in to get all of a user's songs

}

function mergeSongDataFromRecco($trackMetaData, $trackTempoData)
{
    $mergedTrackData = [];

    foreach ($trackTempoData as $track) {
        $trackId = $track['id'];
        $trackInfo = $trackMetaData[$trackId];
        $mergedTrackData[$trackId] = [
            'reccoId' => $trackId,
            'tempo' => $track['tempo'],
            'spotifyId' => str_replace("https://open.spotify.com/track/", "", $trackInfo['href']),
            'name' => $trackInfo['trackTitle'],
            'artist' => $trackInfo['artists'][0]['name'],
            'length' => $trackInfo['durationMs'] * 0.001
        ];
    }
    return $mergedTrackData;
}

function storeTrackData($fullTrackData)
{ // takes in array of full track data that is indexed by reccoId, like that returned by mergeSongDataFromRecco();
    global $pdo;

    $rows = [];
    foreach ($fullTrackData as $track) {
        $name = $pdo->quote($track['name']);
        $artist = $pdo->quote($track['artist']);
        $tempo = floatval($track['tempo']);
        $spotifyId = $pdo->quote($track['spotifyId']);
        $reccoId = $pdo->quote($track['reccoId']);
        $length = $track['length']; // in seconds

        $rows[] = "($name, $artist, $tempo, $spotifyId, $reccoId, $length)";
    }
    if (!empty($rows)) {
        dbQuery("
    INSERT IGNORE INTO songs (name, artist, tempo, spotifyId, reccoId, length) VALUES " . implode(", ", $rows) . "
    ");
    }
}
