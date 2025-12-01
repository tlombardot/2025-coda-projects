<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;

//Initialisation Database

$db = InitDatabase();

//Récupération GET id

$playlistId = $_GET["id"] ?? "";


//Requête SQL

RequestSQL("DELETE FROM x_playlist_song WHERE playlist_id = $playlistId", $db);
RequestSQL("DELETE FROM playlist WHERE id = $playlistId", $db);

//Redirection

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();