<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;

//GET ID

$search = $_GET['search'] ?? "";


//Requête SQL
$db = InitDatabase();


$artists = RequestSQL(<<<SQL
    SELECT *
    FROM artist
    WHERE (
    MATCH(name) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR
    name LIKE '%$search%'
    )
    SQL, $db);


$albums = RequestSQL(<<<SQL
    SELECT *
    FROM album
    WHERE (
    MATCH(name) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR
    name LIKE '%$search%'
    )
    SQL,$db);

$songs = RequestSQL(<<<SQL
    SELECT 
        song.id,
        song.name, 
        song.duration, 
        song.note, 
        album.name AS album_name, 
        album.cover, 
        artist.name AS artist_name
    FROM song 
    JOIN album ON song.album_id = album.id
    JOIN artist ON album.artist_id = artist.id
    WHERE (
    MATCH(song.name) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR
    song.name LIKE '%$search%'
    )  ORDER BY song.note DESC LIMIT 20
    SQL,$db);

//Affichage HTML

$html = <<<HTML
    <div class="header-container">
        <a href ="index.php">Back To Home</a>
        <h1>Search</h1>
        <div class="search-wrapper">
            <form action="search.php" method="GET" class="search-form">
                <button type="submit" class="search-btn">
                    <svg role="img" height="24" width="24" viewBox="0 0 24 24" fill="currentColor"><path d="M10.533 1.279c-5.18 0-9.407 4.14-9.407 9.279s4.227 9.279 9.407 9.279c2.234 0 4.29-.77 5.907-2.058l4.353 4.353a1 1 0 101.414-1.414l-4.344-4.344a9.157 9.157 0 002.077-5.816c0-5.14-4.226-9.28-9.407-9.28zm-7.407 9.279c0-4.006 3.302-7.28 7.407-7.28s7.407 3.274 7.407 7.28-3.302 7.279-7.407 7.279-7.407-3.273-7.407-7.28z"></path></svg>
                </button>
                <input type="text" name="search" value="$search" placeholder="Artistes, titres ou albums" required>
            </form>
        </div>
    </div>
    
HTML;


//Affichage Artistes
if (!empty($artists)){
    $html .= <<<HTML
        <h2>Artists</h2>
        <section class="grid-container">
    HTML;
}
foreach ($artists as $artist) {
        $id = $artist["id"];
        $name = $artist["name"];
        $cover = $artist["cover"];
        $html .= <<<HTML
            <article class="card artist-card">
                <div class="img-wrapper"><img src="$cover" alt="$name"></div>
                <a href="artist.php?id=$id" class="card-title">$name</a>
                <p class="card-subtitle">Artiste</p>
            </article>
        HTML;
}
if (!empty($artists)){
    $html .= <<<HTML
        </section>
    HTML;
}

//Affichage Album
if (!empty($albums)){
    $html .= <<<HTML
        <h2>Album</h2>
        <section class="grid-container">
    HTML;
}
foreach ($albums as $album) {
        $id = $album["id"];
        $name = $album["name"];
        $cover = $album["cover"];
        $html .= <<<HTML
            <article class="card album-card">
                <div class="img-wrapper">
                    <img src="$cover" alt="$name">
                </div>
                <a href="album.php?id=$id" class="card-title">$name</a>
                <p class="card-subtitle">Album</p>
            </article>
        HTML;
}
if (!empty($albums)){
    $html .= <<<HTML
        </section>
    HTML;
}   

//Affichage Song
if (!empty($songs)){
    $html .= <<<HTML
        <h2>Song</h2>
        <section class="song-container">
    HTML;
}
foreach ($songs as $song) {
        $id = $song["id"];
        $name = $song["name"];
        $artistName = $song['artist_name'];
        $albumName = $song['album_name'];
        $cover = $song["cover"];
        
        $note = $song["note"];
        $duration = gmdate("i:s", $song["duration"]); 
        
        $html .= <<<HTML
            <div class="song-info">
                <div style="display:flex; align-items:center; gap:15px; overflow:hidden; text-align:left;">
                    
                    <img src="$cover" style="width:40px; height:40px; border-radius:4px; flex-shrink:0; object-fit:cover;">
                    
                    <div style="display:flex; flex-direction:column; justify-content:center; align-items: flex-start; overflow:hidden;">
                        <p style="margin:0; font-weight:600; color:white; white-space:nowrap; text-overflow:ellipsis; overflow:hidden; max-width:100%;">
                            <a style= "color: white" href="./add_to_playlist.php?id=$id">$name</a>
                        </p>
                        <p style="margin:0; font-size:0.85rem; color:#b3b3b3; white-space:nowrap; text-overflow:ellipsis; overflow:hidden; max-width:100%;">
                            $artistName • $albumName
                        </p>
                    </div>
                </div>

                <p style="font-weight:bold; color:#1DB954; margin:0;">★ $note</p> 

                <p style="margin:0;">$duration</p>
            </div>
    HTML;
}


if (!empty($songs)){
    $html .= <<<HTML
        </section>
    HTML;
}

if (empty($artists) && empty($albums) && empty($songs)) {
    $html .= <<<HTML
        <div class="no-results">
            <h3>No find for "$search"</h3>
        </div>
    HTML;
}

echo (new HTMLPage("Lowify - $search"))
            ->addContent($html)
            ->addStylesheet("./index.css")
            ->addStylesheet("./album.css")
            ->render();