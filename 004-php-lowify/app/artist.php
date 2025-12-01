<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;

$id = $_GET['id'] ?? "";

if (empty($id)) {
    header("Location: error.php?msg=This artist don't exist");
    exit();
}

//Init Database

$db = InitDatabase();

//Requête SQL

$artists = RequestSQL(<<<SQL
    SELECT * FROM artist WHERE id=$id LIMIT 100
    SQL, $db);

if (empty($artists)) {
    header("Location: error.php?msg=This artist don't exist");
    exit();
}

$songs = RequestSQL(<<<SQL
    SELECT song.id, song.name, song.duration, song.note,song.is_liked, album.cover FROM song JOIN album ON song.album_id = album.id 
    WHERE song.album_id = $id ORDER BY note DESC LIMIT 5
    SQL, $db);

if (empty($songs)) {
    header("Location : error.php?message= This song don't exist");
    exit;
}

$albums = RequestSQL(<<<SQL
    SELECT id,name,cover,release_date FROM album WHERE artist_id=$id 
    SQL, $db);


if (empty($albums)) {
    header("Location : error.php?message=This album don't exist");
    exit;
}

//Affichage HTML

foreach ($artists as $artist) {
    $name = $artist["name"];
    $biography = $artist["biography"];
    $cover = $artist["cover"];
    $monthly_listeners = $artist["monthly_listeners"];
}


$monthly_listeners = format_monthly_listeners($monthly_listeners);


$html = <<<HTML
    <div class="navigation-top">
        <a href="index.php" class="btn-back">← Home</a>
    </div>
    <div class="artist-header">
        <div class="header-content">
            <img src="$cover" alt="$name" class="artist-img shadow-lg">
            <div class="artist-meta">
                <span class="verified-badge"><span class="check">✔</span> Artist Verified</span>
                <h1>$name</h1>
                <p class="listeners">$monthly_listeners monthly listeners</p>
            </div>
        </div>
    </div>

    <div class="artist-body">
        <h2>About</h2>
        <div class="biography">
            $biography
        </div>
    </div>
HTML;

$html .= '<div class="section-title"><h2>Popular</h2></div>';
$html .= '<div class="song-container">';


foreach ($songs as $song) {
    $id = $song["id"];
    $nameSong = $song["name"];
    $durationSong = $song["duration"];
    $durationSong = $song["duration"];
    $formattedTime = gmdate("i:s", $durationSong);
    $noteSong = $song["note"];
    $coverSong = $song["cover"];
    $isLiked = $song["is_liked"];

    $heartClass = ($isLiked == 1) ? 'liked' : 'not-liked';
    $heartIcon = ($isLiked == 1) ? '♥' : '♡';

    $html .= <<<HTML
            <div class="list-song">
                <div class="song-left">
                    <img src="$coverSong" alt="cover">
                    <span class="song-name">$nameSong</span>
                </div>
                
                <div class="song-right">
                    <span class="note">★ $noteSong</span>
                    <span class="time">$formattedTime</span>
                    
                    <div class="song-actions">
                        <a href="add_to_playlist.php?id=$id" class="btn-icon btn-add" title="Add to playlist">+</a>
                        <a href="like_song.php?id=$id" class="btn-icon btn-like $heartClass" title="Like">$heartIcon</a>
                    </div>
                </div>
            </div>
        HTML;
}
$html .= '</div>';

$html .= '<div class="section-title"><h2>Discographie</h2></div>';
$html .= '<div class="album-container">';

foreach ($albums as $album) {
    $idAlbum = $album["id"];
    $nameAlbum = $album["name"];
    $coverAlbum = $album["cover"];
    $releaseAlbum = $album["release_date"];

    $html .= <<<HTML
            <div class="list-album">
                <a style ="text-decoration: none; color: white;" href ="./album.php?id=$idAlbum">
                <img src="$coverAlbum">
                <p class="album-title">$nameAlbum</p>
                <p class="album-date">Sortie : $releaseAlbum</p>
                </a>
            </div>
        HTML;
}
$html .= '</div>';



echo (new HTMLPage("Lowify - $name"))
    ->addContent($html)
    ->addStylesheet("./artist.css")
    ->render();
