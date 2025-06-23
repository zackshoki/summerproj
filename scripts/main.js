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