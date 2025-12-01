<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;

$songId = $_GET["id"] ?? "";


//Requête SQL

$db = InitDatabase();

$songData = RequestSQL("SELECT id, name, duration, artist_id FROM song WHERE id = $songId", $db);

if (empty($songData)) {
    header("Location: error.php?msg=Song not found");
    exit();
}

$song = $songData[0];
$songName = $song["name"];
$songDuration = $song["duration"];

$playlistId = $_POST["playlist_id"] ?? "";

if (!empty($playlistId)){
    RequestSQL(<<<SQL
            INSERT INTO x_playlist_song (playlist_id, song_id) 
            VALUES ($playlistId, $songId)
        SQL, $db);
    RequestSQL(<<<SQL
            UPDATE playlist 
            SET nb_song = nb_song + 1, 
                duration = duration + $songDuration 
            WHERE id = $playlistId
        SQL,$db);
    $message = "Song added with success";
}

$playlists = RequestSQL("SELECT id, name FROM playlist ORDER BY name ASC", $db);

$html = <<<HTML
    <div class="add-container">
        <div class="header-box">
            <a href="index.php" class="btn-back">← Back</a>
            <h1>Add to the playlist</h1>
            <p class="subtitle">Song : <strong>$songName</strong></p>
        </div>
HTML;

if (!empty($message)) {
    $html .= <<<HTML
        <div class="msg-success">$message</div>
    HTML;
}

$html .= <<<HTML
        <form method="POST" action="add_to_playlist.php?id=$songId" class="add-form">
            <label for="playlist">Choose your playlist :</label>
            <div class="select-wrapper">
                <select name="playlist_id" id="playlist" required>
                    <option value="" disabled selected>-- Select :  --</option>
HTML;

foreach ($playlists as $playlist) {
    $pId = $playlist["id"];
    $pName = $playlist["name"];
    $html .= <<<HTML
        <option value="$pId">$pName</option>
        HTML;
}

$html .= <<<HTML
                </select>
                <span class="arrow">▼</span>
            </div>

            <button type="submit" class="btn-submit">Add</button>
        </form>
    </div>
HTML;

//Rendue HTML

echo (new HTMLPage("Add to the playlist"))
    ->addContent($html)
    ->addStylesheet("add_to_playlist.css")
    ->render();

