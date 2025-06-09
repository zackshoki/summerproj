const client_id = 'e222be8a405045a79868de716b5aef44';
const client_secret = 'd48a28f221264ee8bfe3ad63c33006be';
const auth = btoa(client_id + ':' + client_secret); // browser-safe

const authOptions = {
  method: 'POST',
  headers: {
    'Authorization': 'Basic ' + auth,
    'Content-Type': 'application/x-www-form-urlencoded'
  },
  body: new URLSearchParams({ grant_type: 'client_credentials' })
};

fetch('https://accounts.spotify.com/api/token', authOptions)
  .then(res => res.json())
  .then(data => console.log('worked', data.access_token))
  .catch(err => console.error('didn’t work', err));

