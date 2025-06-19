<?php
function sendDataToDB() {
    totalSavedTracks();
    $savedTracksFromSpotify = array_slice(getAllSavedTracks(), random_int(0, 600), 10);
    $reccoTrackData = spotifyIdsToReccoData($savedTracksFromSpotify);
    $analyzedTracks = analyzeTracks($reccoTrackData);
    $mergedTrackData = mergeSongDataFromRecco($reccoTrackData, $analyzedTracks);
    storeTrackData($mergedTrackData);
}
