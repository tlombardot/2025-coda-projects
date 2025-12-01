<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;

//Récupération GET id

$songId = $_GET["song_id"] ?? "";
$playlistId = $_GET["playlist_id"] ?? "";

//Initialisation Base de données

$db = InitDatabase();

//Requête SQL

$songData = RequestSQL("SELECT duration FROM song WHERE id = $songId", $db);
$duration = $songData[0]["duration"];


RequestSQL(<<<SQL
            DELETE FROM x_playlist_song 
            WHERE playlist_id = $playlistId AND song_id = $songId
        SQL, $db);

RequestSQL(<<<SQL
    UPDATE playlist 
    SET nb_song = GREATEST(0, nb_song - 1), 
        duration = GREATEST(0, duration - $duration) 
    WHERE id = $playlistId
SQL, $db);

//Redirection

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();