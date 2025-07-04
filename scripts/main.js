// spotify functions
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

function showPlaylist(playlist) {
    document.getElementById("playlistName").innerText = playlist.name; 
    if (playlist.images[0]) {
        const playlistImage = new Image(200, 200);
        playlistImage.src = playlist.images[0].url;
        document.getElementById("playlistImage").appendChild(playlistImage);
    }
    let songNames = []; 
    playlist.tracks.items.forEach((item) => {
        songNames.push(item.track.name + " - " + item.track.artists[0].name); 
    });

    document.getElementById("songNames").innerText = JSON.stringify(songNames);
    document.title = playlist.name;
}

