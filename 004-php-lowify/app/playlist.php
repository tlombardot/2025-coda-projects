<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;

$id = $_GET["id"] ?? "";

if (empty($id)) {
    header("Location: error.php?msg=Playlist not found");
    exit();
}

//Requête SQL

$db = InitDatabase();

$playlistData = RequestSQL("SELECT * FROM playlist WHERE id = $id", $db);

if (empty($playlistData)) {
    header("Location: error.php?msg=Playlist not found");
    exit();
}

$playlist = $playlistData[0];
$plName = $playlist["name"];
$plNbSong = $playlist["nb_song"];
$plDuration = gmdate("H:i:s", $playlist["duration"]);

$songs = RequestSQL(<<<SQL
    SELECT x_playlist_song.playlist_id, song.id, song.name, song.duration, song.note, album.cover, artist.name as artist_name
    FROM x_playlist_song
    JOIN song ON x_playlist_song.song_id = song.id
    JOIN album ON song.album_id = album.id
    JOIN artist ON album.artist_id = artist.id
    WHERE x_playlist_song.playlist_id = $id
    ORDER BY x_playlist_song.id DESC
SQL, $db);


// HTML
$html = <<<HTML
    <div class="playlist-header">
        <div class="playlist-cover-placeholder">♫</div>
        
        <div class="playlist-info">
            <span class="type">Playlist</span>
            <h1>$plName</h1>
            <div class="meta">
                <span>$plNbSong title</span>
                <span>• Duration : $plDuration</span>
            </div>
            <a href="./add_playlist_song.php?id=" class="btn-add-more" style="display:none;">+ Add song</a> 
        </div>
    </div>
    
    <div class="tracklist-container">
        <div class="tracklist-header">
            <span>#</span>
            <span>Title</span>
            <span>Note</span>
            <span class="align-right">Duration</span>
            <span class="align-right">Action</span>
        </div>
HTML;

if (empty($songs)) {
    $html .= '<div class="empty-state">This playlist is empty. <a href="index.php">Add song to playlist</a></div>';
}

$count = 1;
foreach ($songs as $song) {
    $sId = $song['id'];
    $pId = $song["playlist_id"];
    $sName = $song["name"];
    $sArtist = $song["artist_name"];
    $sNote = $song['note'];
    $sCover = $song["cover"];
    $sDuration = gmdate("i:s", $song["duration"]);

    $html .= <<<HTML
            <div class="track-item">
                <span class="track-number">$count</span>
                
                <div class="track-main">
                    <img src="$sCover" class="track-img">
                    <div class="track-details">
                        <span class="track-title"><a href="./song.php?id=$sId">$sName</a></span>
                        <span class="track-artist">$sArtist</span>
                    </div>
                </div>

                <span class="track-note">★ $sNote</span>
                
                <span class="track-duration">$sDuration</span>
                
                <div class="track-action">
                    <a href="./remove_from_playlist.php?song_id=$sId&playlist_id=$pId"
                       class="btn-remove" 
                       onclick="return confirm('Remove from the playlist ?');"
                       title="Remove from playlist">
                    </a>
                </div>
            </div>
        HTML;
    $count++;
}

$html .= "</div>";

$html .= <<<HTML
    <div style="padding: 20px 40px;">
        <a href="playlists.php" class="btn-back-pl">← Back to playlists</a>
    </div>
HTML;


echo (new HTMLPage("Playlist - $plName"))
        ->addContent($html)
        ->addStylesheet("playlist.css")
        ->render();
