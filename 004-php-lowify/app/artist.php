<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "database.php";

$db = null;

$id = $_GET['id'] ?? "";

if (empty($id)){
    header("Location: error.php?msg=This artist don't exist");
    exit();
}

$db = InitDatabase();


try{
    $artists = $db->executeQuery(<<<SQL
    SELECT * FROM artist WHERE id=$id LIMIT 100
    SQL);
    
}catch (PDOException $e){
    echo "Error Request". $e->getMessage();
}

if (empty($artists)){
    header("Location: error.php?msg=This artist don't exist");
    exit();
}

try{
    $songs = $db->executeQuery(<<<SQL
    SELECT song.id, song.name, song.duration, song.note, album.cover FROM song JOIN album ON song.album_id = album.id 
    WHERE song.album_id = $id ORDER BY note DESC LIMIT 5
    SQL);
    
}catch (PDOException $es){
    echo "Error Request". $es->getMessage();
}

if (empty($songs)){
    header("Location : error.php?message= This song don't exist");
    exit;
}

try{
    $albums = $db->executeQuery(<<<SQL
    SELECT id,name,cover,release_date FROM album WHERE artist_id=$id 
    SQL);
    
}catch (PDOException $ea){
    echo "Error Request". $ea->getMessage();
}

if (empty($albums)){
    header("Location : error.php?message=This album don't exist");
    exit;
}

foreach ($artists as $artist){
    $name = $artist["name"];
    $biography = $artist["biography"];
    $cover = $artist["cover"];
    $monthly_listeners = $artist["monthly_listeners"];
}


function format_monthly_listeners($monthly_listeners):string{
    if ($monthly_listeners > 1000000000){
        $formatted = $monthly_listeners/1000000000;
        $suffix = "B";
    }
    elseif ($monthly_listeners > 1000000){
        $formatted = $monthly_listeners/1000000;
        $suffix = "M";
    }
    elseif ($monthly_listeners > 1000){
        $formatted = $monthly_listeners/1000;
        $suffix = "K";
    }

    if ($formatted == floor($formatted)){
        return "+". floor($formatted). $suffix;
    }else{
        return "+". number_format($formatted, 1). $suffix;
    }
    
    
}


$monthly_listeners = format_monthly_listeners($monthly_listeners);


$html =<<<HTML
    <div class="artist-header">
        <div class="header-content">
            <img src="$cover" alt="$name" class="artist-img shadow-lg">
            <div class="artist-meta">
                <span class="verified-badge"><span class="check">✔</span> Artist Verified</span>
                <h1>$name</h1>
                <p class="listeners">$monthly_listeners monthly listeners</p>
            </div>
        </div>
    </div>

    <div class="artist-body">
        <h2>About</h2>
        <div class="biography">
            $biography
        </div>
    </div>
HTML;

$html .= '<div class="section-title"><h2>Popular</h2></div>';
$html .= '<div class="song-container">';


foreach ($songs as $song){
    $nameSong = $song["name"];
    $durationSong = $song["duration"];
    $minute = floor($durationSong/60);
    $secondes = $durationSong %60;
    $noteSong = $song["note"];
    $coverSong = $song["cover"];
    $html .= <<<HTML
            <div class="list-song">
                <div class="song-left">
                    <img src="$coverSong">
                    <p>$nameSong</p>
                </div>
                <div class="detail">
                    <span class="note">★ $noteSong</span>
                    <span class="time">$minute:$secondes</span>
                </div>
            </div>
    HTML;
}

$html .= '<div class="section-title"><h2>Discographie</h2></div>';
$html .= '<div class="album-container">';

foreach ($albums as $album){
    $idAlbum = $album["id"];
    $nameAlbum = $album["name"];
    $coverAlbum = $album["cover"];
    $releaseAlbum = $album["release_date"];

    $html .= <<<HTML
            <div class="list-album">
                <a href ="./album.php?id=$idAlbum">
                <img src="$coverAlbum">
                <p class="album-title">$nameAlbum</p>
                <p class="album-date">Sortie : $releaseAlbum</p>
                </a>
            </div>
        HTML;
}
$html .= '</div>';





echo (new HTMLPage("Lowify - $name"))
        ->addContent($html)
        ->addStylesheet("./artist.css")
        ->render();


