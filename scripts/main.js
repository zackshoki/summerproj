// spotify functions
spotifyURL = 'https://api.spotify.com/v1/';

async function fetchProfile(token) {
    const result = await fetch(spotifyURL + "me", {
        method: "GET", 
        headers: {
             Authorization: `Bearer ${token}` 
            }
    })
    

    return await result.json();
}

function populateUI(profile) {
    console.log(profile);
    document.getElementById("displayName").innerText = profile.display_name;
    if (profile.images[0]) {
        const profileImage = new Image(200, 200);
        profileImage.src = profile.images[0].url;
        document.getElementById("avatar").appendChild(profileImage);
        document.getElementById("imgUrl").innerText = profile.images[0].url;
    }
    document.getElementById("id").innerText = profile.id;
    document.getElementById("email").innerText = profile.email;
    document.getElementById("uri").innerText = profile.uri;
    document.getElementById("uri").setAttribute("href", profile.external_urls.spotify);
    document.getElementById("url").innerText = profile.href;
    document.getElementById("url").setAttribute("href", profile.href);
}

async function createPlaylist(token, userId, playlistName, playlistDescription) {
    const result = await fetch(spotifyURL + "users/" + userId + "/playlists", {
        method: "POST", 
        headers: {
             "Authorization": "Bearer " + token,
             "Content-Type": "application/json"
            },
        body: JSON.stringify({
            "name": playlistName,
            "description": playlistDescription, 
            "public": false
        })
    }); 

    return await result.json();
}

async function updatePlaylist(token, playlistId, songIds) {
    formattedSongIds = songIds.map((songId) => "spotify:track:" + songId);
    const result = await fetch(spotifyURL + "playlists/" + playlistId + "/tracks?uris=" + formattedSongIds.toString(), {
        method: "PUT", 
        headers: {
             "Authorization": "Bearer " + token,
             "Content-Type": "application/json"
            }
    }); 

    return await result.json();
}

async function clearPlaylist(token, playlistId, tracks) { // needs the tracks attribute from the playlist to clear all of them
    const result = await fetch(spotifyURL + "playlists/" + playlistId + "/tracks", {
        method: "DELETE", 
        headers: {
             "Authorization": "Bearer " + token,
             "Content-Type": "application/json"
            },
        body: {
            tracks: JSON.stringify(tracks)
        }
    }); 

    return await result.json();
}

async function getPlaylist(token, playlistId) {
    const result = await fetch(spotifyURL + "playlists/" + playlistId, {
        method: "GET", 
        headers: {
             "Authorization": "Bearer " + token,
             "Content-Type": "application/json"
            }
    }); 

    return await result.json();
}