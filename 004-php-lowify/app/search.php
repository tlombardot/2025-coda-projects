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
        song.is_liked,
        album.name AS album_name,
        album.cover,
        artist.name AS artist_name
        FROM song
        JOIN album ON song.album_id = album.id
        JOIN artist ON album.artist_id = artist.id
        WHERE (MATCH(song.name) AGAINST('$search' IN NATURAL LANGUAGE MODE) OR
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
                <input type="text" name="search" value="$search" placeholder="Artistes, titres ou albums">
            </form>
        </div>
    </div>
    
HTML;


// --- AFFICHAGE HTML ---

// Bouton Retour (Style Artist)
$html = <<<HTML
    <div class="navigation-top">
        <a href="index.php" class="btn-back">← Home</a>
    </div>

    <div class="header-container">
        <h1>Search</h1>
        <div class="search-wrapper">
            <form action="search.php" method="GET" class="search-form">
                <button type="submit" class="search-btn">
                    <svg role="img" height="24" width="24" viewBox="0 0 24 24" fill="currentColor"><path d="M10.533 1.279c-5.18 0-9.407 4.14-9.407 9.279s4.227 9.279 9.407 9.279c2.234 0 4.29-.77 5.907-2.058l4.353 4.353a1 1 0 101.414-1.414l-4.344-4.344a9.157 9.157 0 002.077-5.816c0-5.14-4.226-9.28-9.407-9.28zm-7.407 9.279c0-4.006 3.302-7.28 7.407-7.28s7.407 3.274 7.407 7.28-3.302 7.279-7.407 7.279-7.407-3.273-7.407-7.28z"></path></svg>
                </button>
                <input type="text" name="search" value="$search" placeholder="Artists, songs or albums">
            </form>
        </div>
    </div>
HTML;

// Section Artistes
if (!empty($artists)){
    $html .= <<< HTML
        <h2>Artists</h2>
        <section class="grid-container">
    HTML;
    foreach ($artists as $artist) {
        $id = $artist["id"];
        $name = $artist["name"];
        $cover = $artist["cover"];
        $html .= <<<HTML
            <article class="card artist-card">
                <div class="img-wrapper"><img src="$cover" alt="$name"></div>
                <a href="artist.php?id=$id" class="card-title">$name</a>
                <p class="card-subtitle">Artist</p>
            </article>
        HTML;
    }
    $html .= '</section>';
}

// Section Albums
if (!empty($albums)){
    $html .= <<<HTML
        <h2>Albums</h2>
        <section class="grid-container">
    HTML;
    foreach ($albums as $album) {
        $id = $album["id"];
        $name = htmlspecialchars($album["name"]);
        $cover = htmlspecialchars($album["cover"]);
        $html .= <<<HTML
            <article class="card album-card">
                <div class="img-wrapper"><img src="$cover" alt="$name"></div>
                <a href="album.php?id=$id" class="card-title">$name</a>
                <p class="card-subtitle">Album</p>
            </article>
        HTML;
    }
    $html .= '</section>';
}

// Section Chansons 
if (!empty($songs)){
    $html .= <<<HTML
        <h2>Songs</h2>
        <div class="song-container">
    HTML;
    foreach ($songs as $song) {
        $id = $song["id"];
        $name = $song["name"];
        $artistName = $song['artist_name'];
        $albumName = $song['album_name'];
        $cover = $song["cover"];
        $note = $song["note"];
        $duration = gmdate("i:s", $song["duration"]);
        $isLiked = $song["is_liked"];

        // Gestion du coeur
        $heartClass = ($isLiked == 1) ? 'liked' : 'not-liked';
        $heartIcon = ($isLiked == 1) ? '♥' : '♡';

        $html .= <<<HTML
            <div class="list-song">
                <div class="song-left">
                    <img src="$cover" alt="cover">
                    <div style="display:flex; flex-direction:column; align-items:flex-start;">
                        <span class="song-name">$name</span>
                        <span style="font-size:0.8rem; color:#b3b3b3;">$artistName • $albumName</span>
                    </div>
                </div>
                <div class="song-right">
                    <span class="note">★ $note</span>
                    <span class="time">$duration</span>
                    <div class="song-actions">
                        <!-- Bouton Ajouter à la playlist -->
                        <a href="add_to_playlist.php?id=$id" class="btn-icon btn-add" title="Add to playlist">+</a>
                        <!-- Bouton Like -->
                        <a href="like_song.php?id=$id" class="btn-icon btn-like $heartClass" title="Like">$heartIcon</a>
                    </div>
                </div>
            </div>
        HTML;
    }
    $html .= '</div>';
}

if (empty($artists) && empty($albums) && empty($songs)) {
    $html .= <<<HTML
        <div class="no-results" style="text-align:center; margin-top:50px; color:#b3b3b3;">
            <h3>No results found for "$search"</h3>
        </div>
    HTML;
}

echo (new HTMLPage("Lowify - $search"))
            ->addContent($html)
            ->addStylesheet("./index.css")
            ->addStylesheet("./artist.css") 
            ->render();