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

function getSongList($min, $max) { // gets all songs with a bpm between the values given and returns their spotifyids in an array format, store the length values of each song in the array as well
    // this function should probably take both half-times (divide by 2) and double-times (multiply by 2) of the given min and max to account for clear issues of tempo calculations
    if ($min < 0) {
        $min = 0; 
    }
    $max2 = $max*2; 
    $min2 = $min*2; 
    $maxHalf = $max/2; 
    $minHalf = $min/2; 

    $songList = dbQuery("
        SELECT spotifyId, length
        FROM songs 
        WHERE (tempo > $min AND tempo < $max)
        OR
        (tempo > $min2 AND tempo < $max2)
        OR 
        (tempo > $minHalf AND tempo < $maxHalf)
    ")->fetchAll() ?? NULL; // potentially take tempo and name and display these in some way?
    
    $songList = array_filter($songList);
    return $songList;
}

function constructPlaylist($min, $max, $lengthOfRunInMinutes) { // GREEDYYYYYOOH algorithm that will randomly shuffle the array given from getSongList and loop through picking a song and adding it to the new songlist until the new song list's length exceeds the length of the run, then returns the new song list
    $songList = getSongList($min, $max);
    $lengthOfRun = $lengthOfRunInMinutes * 60; // minutes to seconds
    shuffle($songList);
    $spotifyIds = [];
    $lengthOfPlaylist = 0; // in seconds
    $i = 0;
    while ($lengthOfPlaylist < $lengthOfRun) {  // main loop
        if (isset($songList[$i]['spotifyId']) && !in_array($songList[$i]['spotifyId'], $spotifyIds, true)) {
            $lengthOfPlaylist = $lengthOfPlaylist + ($songList[$i]['length'] ?? 0);
            $spotifyIds[] =  $songList[$i]['spotifyId'] ?? NULL;
            
        }
        $i++;
        if ($i >= count($songList)) { // if there's not enough songs at a certain tempo range, expand to diff tempos
            $min = $min - 10;  
            $songList = array_merge(getSongList($min, $min+10), getSongList($max, $max+10));
            $max = $max + 10; 
            $i = 0; 
        } else if ($min < 0 && $max > 300) { // error handling
            echo "ERROR, please save more songs for a run this long! <br>";
            echo "<a href='index.php'>retry?</a>";
            die;
        } 
    }
    
    $spotifyIds = array_filter($spotifyIds);
    shuffle($spotifyIds);
    return $spotifyIds;
}
