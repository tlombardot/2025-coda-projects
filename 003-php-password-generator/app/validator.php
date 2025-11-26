<?php
$message ="";
$password = $_POST['password'] ?? "";
$score = 0;

function verifMotDePasseReGex(string $password,&$score):string{
    $verif = "";
    if (!preg_match('/[A-Z]/',$password)){
        $verif .= "Il manque une majuscule !\n";
        
    }else{
        $score += 1;
    }
    if (!preg_match('/[a-z]/',$password)){
        $verif .= "Il manque une minuscule !\n";
    }else{
        $score += 1;
    }
    if (!preg_match('/\d/',$password)){
        $verif .= "Il manque un chiffre !\n";
    }else{
        $score += 1;
    }
    if (!preg_match('/[\W_]/',$password)){
        $verif .= "Il manque un charactère spèciale !\n";
    }else{
        $score += 1;
    }

    if (strlen($password)< 8){
        $verif .= "Il doit avoir minimum 8 charactère !\n";
    }else{
        $score += 1;
    }
    return $verif;
}
if (!empty($password)){
    $message = verifMotDePasseReGex($password, $score);
    $score *= 4;
}





$html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Générateur de mot de passe</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav class="menu-switch">
            <a href="index.php" class="switch-btn">Générateur</a>
            <a href="validator.php" class="switch-btn active">Validateur</a>
        </nav>
        <form method ="post" action="validator.php">
            <div class = password>
                <p>Saisissez votre mot de passe : </p>
                <input type ="text" name = "password"></ipunt>
            </div>
            <div class = submit>
                <input type ="submit" value ="Valider"></ipunt>
            </div>
            <div class = resultat>
                <p>$score / 20</p>
                <p>$message</p>
            </div>
        </form>
    </body>
</html>
HTML;

echo $html;