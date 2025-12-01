<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$host='mysql';
$dbname='lowify';
$charset='utf8mb4';
$username = 'lowify';
$password ='lowifypassword';
$db = null;

//GET ID

$id = $_GET['id'] ?? "";

if(empty($id)){
    header("Location: error.php?msg=This song don't exist");
    exit();
}

//Requête SQL
$db = InitDatabase();

//Verification song

$songs = RequestSQL(<<<SQL
    SELECT *
    FROM song WHERE id = $id 
    LIMIT 100
    SQL,$db);

if(empty($songs)){
    header("Location: error.php?msg=This song don't exist");
    exit();
}

//Changement isLiked 

RequestSQL(<<<SQL
    UPDATE song 
    SET is_liked = 1 - is_liked 
    WHERE id = $id;
    SQL,$db);

//Redirection

header('Location: ' . $_SERVER['HTTP_REFERER']);