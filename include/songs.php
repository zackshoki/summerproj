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
            'artist' => $trackInfo['artists'][0]['name'],
            'length' => $trackInfo['durationMs']*0.001
        ];
    }
    return $mergedTrackData;
}

function storeTrackData($fullTrackData) { // takes in array of full track data that is indexed by reccoId, like that returned by mergeSongDataFromRecco();
    global $pdo; 

    $rows = [];
    foreach ($fullTrackData as $track) {
        $name = $pdo->quote($track['name']);
        $artist = $pdo->quote($track['artist']);
        $tempo = floatval($track['tempo']);
        $spotifyId = $pdo->quote($track['spotifyId']);
        $reccoId = $pdo->quote($track['reccoId']);
        $length = $pdo->quote($track['length']);

        $rows[] = "($name, $artist, $tempo, $spotifyId, $reccoId, $length)";
    }
    if (!empty($rows)) {
    dbQuery("
    INSERT IGNORE INTO songs (name, artist, tempo, spotifyId, reccoId, length) VALUES ".implode(", ", $rows)."
    ");
    }
}

function getSongList($min, $max) { // gets all songs with a bpm between the values given and returns their spotifyids in an array format, store the length values of each song in the array as well
    // this function should probably take both half-times (divide by 2) and double-times (multiply by 2) of the given min and max to account for clear issues of tempo calculations
    $songList = dbQuery("
        SELECT spotifyId, length FROM songs WHERE tempo > $min AND tempo < $max 
    ")->fetchAll(); // potentially take tempo and name and display these in some way?
    return $songList;
}

function constructPlaylist($min, $max, $lengthOfRunInMinutes) { // GREEDYYYYYOOH algorithm that will randomly shuffle the array given from getSongList and loop through picking a song and adding it to the new songlist until the new song list's length exceeds the length of the run, then returns the new song list
    $songList = getSongList($min, $max);
    $lengthOfRun = $lengthOfRunInMinutes * 60; // minutes to seconds
    shuffle($songList);
    $spotifyIds = [];
    $lengthOfPlaylist = 0; // in seconds
    $i = 0;

    while ($lengthOfPlaylist < $lengthOfRun) {
        $lengthOfPlaylist = $lengthOfPlaylist+$songList[$i]['length'];
        $spotifyIds[] =  $songList[$i]['spotifyId'];
        $i++;
    }

    return $spotifyIds;
}