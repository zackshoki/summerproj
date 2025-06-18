<?php 

function getAllSongs() {
    $songs = dbQuery("
            SELECT *
            FROM songs 
        ")->fetchAll();
        return $songs; 
}

function getUsersSongs() { // fill in to get all of a user's songs
    
}

function mergeSongDataFromRecco($trackMetaData, $trackTempoData) {
    $mergedTrackData = [];

    foreach($trackTempoData as $track) {
        $trackId = $track['id'];
        $trackInfo = $trackMetaData[$trackId];
        $mergedTrackData[$trackId] = [
            'reccoId' => $trackId,
            'tempo' => $track['tempo'],
            'spotifyId' => str_replace("https://open.spotify.com/track/", "", $trackInfo['href']),
            'name' => $trackInfo['trackTitle'],
            'artist' => $trackInfo['artists'][0]['name']
        ];
    }
    return $mergedTrackData;
}

function storeTrackData($fullTrackData) { // takes in array of full track data that is indexed by reccoId, like that returned by mergeSongDataFromRecco();
    $rows = [];
    foreach ($fullTrackData as $track) {
        $rows[] = "('".$track['name']."', '".$track['artist']."', ".$track['tempo'].", '".$track['spotifyId']."', '".$track['reccoId']."')";
    }
    dbQuery("
    INSERT IGNORE INTO songs (name, artist, tempo, spotifyId, reccoId) VALUES ".implode(", ", $rows)."
    ");
}