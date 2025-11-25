<?php
$resulats ="";
$choiceOrdi = "--";
$choice = ['pierre', 'feuille', 'ciseaux', 'spok', 'lézard'];
$resultats = "";
$choiceJoueur = $_GET['choice'] ?? "--";
$winOrdi = 0;
$winJoueur = 0;
$numPlay = 0;
$numPlay += $_GET['numPlay'] ?? 0;


function loadResults(string $choiceJoueur, string $choiceOrdi):string{
    if ($choiceJoueur === $choiceOrdi ){
        return "Egalite";
    }
    if (($choiceJoueur === 'pierre' && $choiceOrdi === 'ciseaux') ||
        ($choiceJoueur === 'feuille' && $choiceOrdi === 'pierre') ||
        ($choiceJoueur === 'ciseaux' && $choiceOrdi === 'feuille') ||
        ($choiceJoueur === 'pierre' && $choiceOrdi === 'lézard') ||
        ($choiceJoueur === 'feuille' && $choiceOrdi === 'spok') ||
        ($choiceJoueur === 'ciseaux' && $choiceOrdi === 'lézard') ||
        ($choiceJoueur === 'lézard' && $choiceOrdi === 'spok') ||
        ($choiceJoueur === 'spok' && $choiceOrdi ==='ciseaux')){
            return "Gagné";
        }else{
            return "Perdu";
        }
}

if ($choiceJoueur != "--"){
        $choiceOrdi = $choice[array_rand($choice)];
        $resulats = loadResults($choiceJoueur, $choiceOrdi);
}



$page = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
</head>
<title>Chifoumi</title>
<body>
    <main>
        <h1>Jeu Pierre, Feuilles, Ciseaux</h1>
        <div class = lancerJoueur>
             <p>Player : $choiceJoueur</p>
        </div>
        <div class = lancerOrdi>
            <p>PHP : $choiceOrdi </p>
        </div>
        <div class = resultats>
            <p>$resulats</p>
        </div>
        <div class = stats>
            <p>Plays : $numPlay WinPlayer : $winJoueur WinPHP : $winOrdi</p>
        </div>
        <a href="./index.php?choice=pierre&numPlay=1">Pierre</a>
        <a href="./index.php?choice=feuille&numPlay=1">Feuilles</a>
        <a href="./index.php?choice=ciseaux&numPlay=1">Ciseaux</a>
        <a href="./index.php?choice=spok&numPlay=1">Spok</a>
        <a href="./index.php?choice=lézard&numPlay=1">Lézard</a>
        <a href="/">Reset</a>
    </main>
</body>
<html>
HTML;

echo $page;
