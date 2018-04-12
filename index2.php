z?php include("auth.php");

<?php
echo "<br><a href='https://accounts.spotify.com/authorize/?client_id=".$spotify_client_id."&response_type=code&redirect_uri=".$spotify_redirect_id."&scope=playlist-modify-public%20playlist-modify-private%20playlist-read-private%20playlist-read-collaborative%20user-library-read%20user-library-modify%20user-read-private%20user-read-birthdate%20user-read-email%20user-follow-read%20user-follow-modify%20user-top-read%20user-read-playback-state%20user-read-recently-played%20user-read-currently-playing%20user-modify-playback-state'>SPOTİFY PLAYLİST MAKER</a>";
?>