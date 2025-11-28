<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "database.php";

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

try{
    $songs = $db->executeQuery(<<<SQL
    SELECT *
    FROM song WHERE id = $id 
    LIMIT 100
    SQL);
    
}catch (PDOException $es){
    echo "Error Request". $es->getMessage();
}

if(empty($songs)){
    header("Location: error.php?msg=This song don't exist");
    exit();
}

//Changement isLiked 

try{
    $db->executeQuery(<<<SQL
    UPDATE song 
    SET is_liked = 1 - is_liked 
    WHERE id = $id;
    SQL);
}catch (PDOException $el){
    echo "Error Request". $el->getMessage();
}

//Redirection

header('Location: ' . $_SERVER['HTTP_REFERER']);