<?php

require_once "inc/page.inc.php";
require_once "inc/database.inc.php";
require_once "utils.php";

$db = null;

//Requête SQL

$db = InitDatabase();

$topartists = RequestSQL(<<<SQL
    SELECT id, name, monthly_listeners, cover FROM artist  ORDER BY monthly_listeners DESC LIMIT 5 
    SQL, $db);



if (empty($topartists)){
    header("Location: error.php?msg=This artist don't exist");
    exit();
}

$recentAlbums = RequestSQL(<<<SQL
    SELECT id, name, cover FROM album  ORDER BY release_date DESC LIMIT 5 
    SQL, $db);

if (empty($recentAlbums)){
    header("Location: error.php?msg=This album don't exist");
    exit();
}

$topalbums = RequestSQL(<<<SQL
    SELECT album.id, album.name, ROUND(AVG(note),1) AS moyenne_note, cover FROM album 
    JOIN song ON song.album_id = album.id GROUP BY album.id 
    ORDER BY ROUND(AVG(note),1) DESC LIMIT 5
    SQL, $db);

if (empty($topalbums)){
    header("Location: error.php?msg=This album don't exist");
    exit();
}

//Affichage HTML

$html = <<<HTML
    <div class="header-container">
        <h1>Lowify</h1>
        <a href="playlists.php" class="btn-library">
                <span>My Playlists</span>
        </a>
        <div class="search-wrapper">
            <form action="search.php" method="GET" class="search-form">
                <button type="submit" class="search-btn">
                    <svg role="img" height="24" width="24" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10.533 1.279c-5.18 0-9.407 4.14-9.407 9.279s4.227 9.279 9.407 9.279c2.234 0 4.29-.77 5.907-2.058l4.353 4.353a1 1 0 101.414-1.414l-4.344-4.344a9.157 9.157 0 002.077-5.816c0-5.14-4.226-9.28-9.407-9.28zm-7.407 9.279c0-4.006 3.302-7.28 7.407-7.28s7.407 3.274 7.407 7.28-3.302 7.279-7.407 7.279-7.407-3.273-7.407-7.28z"></path>
                    </svg>
                </button>
                <input type="text" name="search" placeholder="What do you want to listen ?" required>
            </form>
        </div>
    </div>
    <h2>Top Trending</h2>
    <section class = "grid-container">
HTML;




foreach($topartists as $topartist){
    $idArtist = $topartist["id"];
    $nameArtist = $topartist["name"];
    $monthly_listeners = $topartist["monthly_listeners"];
    $coverArtist = $topartist["cover"];
    $monthly_listeners = format_monthly_listeners($monthly_listeners);
    $html .= <<<HTML
        <article class = "artist-card">
            <div class="img-wrapper">
                <img src = "$coverArtist">
            </div>
            <a href ="./artist.php?id=$idArtist" class ="card-title">$nameArtist</a>
            <p class="card-subtitle">$monthly_listeners listeners</p>
        </article>
    HTML;
}

$html .= <<<HTML
    </section>
    <h2>Top Release</h2>
    <section class = "grid-container">
HTML;

foreach($recentAlbums as $recentAlbum){
    $idRAlbum = $recentAlbum["id"];
    $nameRAlbum = $recentAlbum["name"];
    $coverRAlbum = $recentAlbum["cover"];
    $html .= <<<HTML
        <article class = "card album-card">
            <div class="img-wrapper">
                <img src = "$coverRAlbum">
            </div>
            <a href ="./album.php?id=$idRAlbum " class="card-title">$nameRAlbum</a>
            <p class="card-subtitle">New Album</p>
        </article>
    HTML;
}

$html .= <<<HTML
    </section>
    <h2>Top Album</h2>
    <section class = "grid-container">
HTML;


foreach($topalbums as $topalbum){
    $idAlbum = $topalbum["id"];
    $nameAlbum = $topalbum["name"];
    $coverAlbum = $topalbum["cover"];
    $note = $topalbum["moyenne_note"];
    $html .= <<<HTML
        <article class = "card album-card">
            <div class = "img-wrapper">
                <img src = "$coverAlbum">
            </div>
            <a href ="./album.php?id=$idAlbum " class="card-title">$nameAlbum</a>
            <p class ="card-subtitle note">★ $note</p>
        </article>
    HTML;
}
$html .= <<<HTML
    </section>
HTML;

echo (new HTMLPage("Lowify - Accueil"))
            ->addContent($html)
            ->addStylesheet("./index.css")
            ->render();
