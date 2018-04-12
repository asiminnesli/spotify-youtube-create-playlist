
<?php

include("variables.php");
echo urlencode($your_redirect_uri);

echo "
<a href='https://accounts.spotify.com/authorize/?client_id=334341f9627b494da778285d2e8b2370&response_type=code&redirect_uri=".$your_redirect_uri."&scope=playlist-modify-public%20playlist-modify-private%20playlist-read-private%20playlist-read-collaborative%20user-library-read%20user-library-modify%20user-read-private%20user-read-birthdate%20user-read-email%20user-follow-read%20user-follow-modify%20user-top-read%20user-read-playback-state%20user-read-recently-played%20user-read-currently-playing%20user-modify-playback-state'>SPOTİFY LİSTESİ OLUŞTUR</a>";
?>