<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;


//Requête SQL

$db = InitDatabase();

$name = $_POST["name"] ?? "";

if (!empty($name)){
    $safeName = addslashes($name);
    RequestSQL(<<<SQL
    INSERT INTO playlist (name) VALUES ('$safeName')
    SQL,$db);
}




$html = <<<HTML
    <div class="createPlaylist-header">
        <a href="./playlists.php" class="btn-back">← Back to Playlists</a>
        <h1>Create a new playlist</h1>
    </div>
    
    <div class="playlist-container">
        <form method="POST" action="create_playlist.php" class="create-form">
            <input type="text" name="name" placeholder="My Awesome Playlist" required autocomplete="off">
            <input type="submit" name="submit" value="Create">
        </form>
    </div>
HTML;

if (!empty($name)){
    $html .= <<<HTML
        <div class="result-container">
            <div class="success-message">
                ✅ The playlist <strong>$name</strong> has been created!
            </div>
            <a href="playlists.php" class="btn-view">View all playlists</a>
        </div>
    HTML;
}

echo (new HTMLPage("Lowify - Create a playlist"))
            -> addContent($html)
            -> addStylesheet("./create_playlist.css")
            -> render();


