<?php
$resulats ="";
$choiceOrdi = "--";
$choice = ['pierre', 'feuille', 'ciseaux', 'spok', 'lézard'];
$resultats = "";
$choiceJoueur = $_GET['choice'] ?? "--";
$winOrdi = $_GET['winOrdi'] ?? 0;
$winJoueur = $_GET['winJoueur'] ?? 0;
$zeroWin = $_GET['zeroWin'] ?? 0;
$numPlay = $_GET['numPlay'] ?? 0;



function loadResults(string $choiceJoueur, string $choiceOrdi, int &$winOrdi, int &$winJoueur, int &$zeroWin):string{
    if ($choiceJoueur === $choiceOrdi ){
        $zeroWin += 1;
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
            $winJoueur += 1;
            return "Gagné";
        }else{
            $winOrdi += 1;
            return "Perdu";
        }
}

if ($choiceJoueur != "--"){
        $choiceOrdi = $choice[array_rand($choice)];
        $resulats = loadResults($choiceJoueur, $choiceOrdi, $winOrdi, $winJoueur, $zeroWin);
        $numPlay += 1;
}

$params = "&numPlay=$numPlay&winJoueur=$winJoueur&winOrdi=$winOrdi&zeroWin=$zeroWin";

$page = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Chifoumi Pro</title>
</head>
<body>
    <main>
        <h1>Pierre Feuille Ciseaux<br><small style="font-size:0.6em">Spock Lézard</small></h1>
        
        <div class="game-area">
            <div class="lancerJoueur">
                 <p>Vous <span>$choiceJoueur</span></p>
            </div>
            <div class="lancerOrdi">
                <p>Ordi <span>$choiceOrdi</span></p>
            </div>
        </div>

        <div class="resultats">
            <p style="color:var(--primary-color)">$resulats</p>
        </div>

        <div class="stats">
            <div class="stat-item">Parties : $numPlay</div>
            <div class="stat-item">Égalités : $zeroWin</div>
            <div class="stat-item" style="color:#4ade80">Vous : $winJoueur</div>
            <div class="stat-item" style="color:#f87171">Ordi : $winOrdi</div>
        </div>

        <div class="controls">
            <a class="btn-game" href="./index.php?choice=pierre$params">Pierre 🪨</a>
            <a class="btn-game" href="./index.php?choice=feuille$params">Feuille 📄</a>
            <a class="btn-game" href="./index.php?choice=ciseaux$params">Ciseaux ✂️</a>
            <a class="btn-game" href="./index.php?choice=spok$params">Spock 🖖</a>
            <a class="btn-game" href="./index.php?choice=lézard$params">Lézard 🦎</a>
        </div>
        
        <a class="btn-reset" href="./index.php">Réinitialiser le jeu</a>
    </main>
</body>
</html>
HTML;

echo $page;
