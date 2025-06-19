<?php

    $token = getenv('ACCESS_TOKEN');
    
    totalSavedTracks();
    $savedTracksFromSpotify = getAllSavedTracks();
    $reccoTrackData = spotifyIdsToReccoData($savedTracksFromSpotify);
    $analyzedTracks = analyzeTracks($reccoTrackData);
    $mergedTrackData = mergeSongDataFromRecco($reccoTrackData, $analyzedTracks);
    storeTrackData($mergedTrackData);

