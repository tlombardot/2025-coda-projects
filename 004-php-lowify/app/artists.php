<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "database.php";


$db = null;

$artists = [];

$html = <<<HTML
        <h1>Artists</h1>
        <div class='artist-list'>
</html>
HTML;


$db = InitDatabase();

try{
    $artists = $db->executeQuery(<<<SQL
    SELECT id, name, cover FROM artist
    SQL);
    
}catch (PDOException $e){
    echo "Error Request". $e->getMessage();
}

if (empty($artists)){
    header("Location: error.php?msg=This artist don't exist");
    exit();
}

foreach ($artists as $artist){
    $names = $artist["name"];
    $covers = $artist["cover"];
    $id = $artist["id"];
    $html.=<<<HTML
    <div class="artist-card">
        <a href="./artist.php?id=$id">
        <img src="$covers" alt="Cover de $names">
        <p>$names</p>
        </a>
    </div>
    HTML;
}

$html .= "</div>";




echo (new HTMLPage(title: "Lowify - Artistes"))
            ->addContent($html)
            ->addStylesheet("./artists.css")
            ->render();
