<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;

$id = $_GET['id'] ?? "";

if (empty($id)){
    header("Location: error.php?msg=This album don't exist");
    exit();
}

//Inititalisation Database

$db = InitDatabase();

//Requête SQL

$albums = RequestSQL(<<<SQL
        SELECT
        album.name AS album_name,
        album.cover AS album_cover,
        album.release_date,
        artist.name AS artist_name,
        artist.id AS artist_id,
        song.id AS song_id,
        song.name AS song_name,
        song.note,
        song.is_liked,
        DATE_FORMAT(SEC_TO_TIME(song.duration), '%i:%s') AS formatted_duration
        FROM song
        JOIN album ON song.album_id = album.id
        JOIN artist ON album.artist_id = artist.id
        WHERE album_id = $id
        ORDER by song.id ASC
        SQL, $db);


if (empty($albums)){
    header("Location: error.php?msg=This album don't exist");
    exit();
}

//Initialisation de Variable

$albumInfo = $albums[0];

$nameAlbum = $albumInfo["album_name"];
$nameArtist = $albumInfo["artist_name"];
$cover = $albumInfo["album_cover"];
$artistId = $albumInfo["artist_id"];
$releaseDate = $albumInfo["release_date"];

//Affichage HTML

$html = <<<HTML
    <div class="navigation-top">
        <a href="index.php" class="btn-back">← Home</a>
    </div>

    <div class="album-header">
        <img src="$cover" class="cover-img shadow-lg">
        <div class="album-info">
            <span class="type">Album</span>
            <h1>$nameAlbum</h1>
            <div class="meta">
                <img src="$cover" class="mini-artist-img" alt="">
                <a href="artist.php?id=$artistId" class="artist-link">$nameArtist</a>
                <span class="bullet">•</span>
                <span>$releaseDate</span>
            </div>
        </div>
    </div>
    
    <div class="song-container">
HTML;

foreach ($albums as $album){
    $songId = $album["song_id"];
    $songName = $album["song_name"];
    $note = $album["note"];
    $time = $album['formatted_duration'];
    $isLiked = $album["is_liked"];

    // Gestion du coeur
    $heartClass = ($isLiked == 1) ? 'liked' : 'not-liked';
    $heartIcon = ($isLiked == 1) ? '♥' : '♡';

    $html .=<<<HTML
        <div class="song-info">
            <div class="song-left">
                <span class="song-title">$songName</span>
            </div>
            <div class="song-right">
                <span class="note">★ $note</span>
                <span class="time">$time</span>
                <div class="song-actions">
                    <!-- Bouton Ajouter à la playlist -->
                    <a href="add_to_playlist.php?id=$songId" class="btn-icon btn-add" title="Add to playlist">+</a>
                    <!-- Bouton Like -->
                    <a href="like_song.php?id=$songId" class="btn-icon btn-like $heartClass" title="Like">$heartIcon</a>
                </div>
            </div>
        </div>
    HTML;
}

$html .= '</div>';

echo (new HTMLPage("Lowify - $nameAlbum"))
        ->addContent($html)
        ->addStylesheet("./album.css")
        ->render();

