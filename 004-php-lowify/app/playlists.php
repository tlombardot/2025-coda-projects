<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;


//Requête SQL

$db = InitDatabase();

$playlists = RequestSQL(<<<SQL
    SELECT 
        playlist.id AS id, 
        playlist.name AS name, 
        COUNT(song.id) AS num_song, 
        COALESCE(SUM(song.duration), 0) AS duration
    FROM playlist 
    LEFT JOIN x_playlist_song ON playlist.id = x_playlist_song.playlist_id 
    LEFT JOIN song ON x_playlist_song.song_id = song.id
    GROUP BY playlist.id 
    ORDER BY playlist.id DESC 
    LIMIT 100
    SQL,$db);

//Affichage HTML

$html = <<<HTML
    <h1>Playlist</h1>
    <section class = "playlist-container">
HTML;


foreach ($playlists as $playlist){
    $name = $playlist["name"];
    $id = $playlist["id"];
    $numSong = $playlist["num_song"];
    $duration  = gmdate("H:i:s", $playlist["duration"]); 

    $html .= <<<HTML
        <article class = "playlist">
            <a href ="./playlist.php?id=$id" class = "playlist-title">$name</a>
            <p class = "playlist-song">$numSong Song</p>
            <p class = "playlist-duration">$duration</p>
            <a href="./delete_playlist.php?id=$id" class ="btn-delete">Delete</a>
        </article>
    HTML;

}

$html .=<<<HTML
    </section>
    <section class = "create-container">
        <a href ="./create_playlist.php" class ="btn-create">Create</a>
    </section>
HTML;


echo (new HTMLPage("Lowify - Playlists"))
        -> addContent($html)
        -> addStylesheet("./playlists.css")
        -> render();


