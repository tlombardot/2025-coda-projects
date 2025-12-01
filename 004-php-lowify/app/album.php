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

$db = InitDatabase();

$albums = RequestSQL(<<<SQL
    SELECT album.name AS album_name,album.cover AS album_cover,album.release_date,artist.name AS artist_name,
    artist.id AS artist_id,song.name AS song_name,song.note,DATE_FORMAT(SEC_TO_TIME(song.duration), '%i:%s') AS formatted_duration
    FROM song JOIN album ON song.album_id = album.id JOIN artist ON album.artist_id = artist.id WHERE album_id = $id ORDER by song.id ASC;
    SQL,$db);


if (empty($albums)){
    header("Location: error.php?msg=This album don't exist");
    exit();
}
$albumInfo = $albums[0];

$nameAlbum = $albumInfo["album_name"];
$nameArtist = $albumInfo["artist_name"];
$cover = $albumInfo["album_cover"];
$artistId = $albumInfo["artist_id"];
$releaseDate = $albumInfo["release_date"];
$html = <<<HTML
    <div class="album-header">
        <img src="$cover" class="cover-img shadow-lg">
        <div class="album-info">
            <h1>$nameAlbum</h1>
            <div class="meta">
                <a href="artist.php?id=$artistId" class="artist-link">$nameArtist</a>
                <span>• $releaseDate</span>
            </div>
        </div>
    </div>
    
    <div class="song-container">
HTML;

foreach ($albums as $album){
    $songName = $album["song_name"];
    $note = $album["note"];
    $tempsFormated = $album['formatted_duration'];

    $html .=<<<HTML
        <div class = song-info>
            <p>$songName</p>
            <p>$note</p>
            <p>$tempsFormated</p>
        </div>
    HTML;
}

$html .= <<<HTML
        </div>
</div>
HTML;

echo (new HTMLPage("Lowify - Album"))
        ->addContent($html)
        ->addStylesheet("./album.css")
        ->render();

