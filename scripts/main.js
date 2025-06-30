// spotify functions
const spotifyURL = 'https://api.spotify.com/v1/';

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

async function clearPlaylist(token, playlistId) {

    const playlist = await getPlaylist(token, playlistId);

    const songIds = playlist.tracks.items.map((item) => ({
        uri: item.track.uri

    }));

    if (songIds.length > 0) {
        const result = await fetch(spotifyURL + "playlists/" + playlistId + "/tracks", {
            method: "DELETE",
            headers: {
                "Authorization": "Bearer " + token,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ tracks: songIds })

        });

        return await result.json();
    }
}

async function getPlaylist(token, playlistId) {
    // we should probably try/catch to see if the user deleted this playlist and send null value of playlistid to the server if the user did end up deleting the playlist.. but im not experienced with try/catch and i dont wanna do dat rn
    const result = await fetch(spotifyURL + "playlists/" + playlistId, {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Content-Type": "application/json"
        }
    });

    return await result.json();
}

async function generatePlaylist(token, profileId, playlistId) {
    if (playlistId == "") {
        const playlist = await createPlaylist(token, profileId, "ZackCorp Workout Playlist", "this is a test playlist")
        // access playlist attributes here if needed
        updatePlaylist(token, playlist.id, ['2qmmnbJ9JR3f7vofbyje5r', '1G3YgeTpECl3LYqFsUfzs5', '0VU5k3vCrpqDgUygMjiFYj', '5uQOauh47VFt3B2kV9kRXw', '42zd6DYQ4o4SECmTITrM1U']);
        document.getElementById("playlistId").value = playlist.id
        document.getElementById("form").requestSubmit(); // store playlist id through form submission to database to check if the playlist exists already, delete the id if the user wants to save the playlist 
    } else {
        await clearPlaylist(token, playlistId);
        updatePlaylist(token, playlistId, ['2qmmnbJ9JR3f7vofbyje5r', '1G3YgeTpECl3LYqFsUfzs5', '0VU5k3vCrpqDgUygMjiFYj', '5uQOauh47VFt3B2kV9kRXw', '42zd6DYQ4o4SECmTITrM1U']);

    }
}

