<?php

$select = '';
$valueMaj = $_POST['maj'] ?? 0;
$valueMin = $_POST['min'] ?? 0;
$valueChiffre = $_POST['chiffre'] ?? 0;
$valueSymboles = $_POST['symboles'] ?? 0;
$selectOption = $_POST['size'] ?? 12;

$checkMaj      = ($valueMaj == 1) ? 'checked' : '';
$checkMin      = ($valueMin == 1) ? 'checked' : '';
$checkChiffre  = ($valueChiffre == 1) ? 'checked' : '';
$checkSymboles = ($valueSymboles == 1) ? 'checked' : '';

function generateSelectOption($selected = 12):string{
    $html = "";

    $options = range(8,42);

    foreach ($options as $value){
        $attribute = "";
        if ((int)$value === (int)$selected){
            $attribute ="selected";
        }
        $html .= "<option $attribute value=\"$value\">$value</option>";
    }
    return $html;
}

function generateRandomCharacter(int $valueMaj, int $valueMin, int $valueChiffre, int $valueSymboles, int $length):string{
    $result = "";
    if ($valueMaj == 1){
        $maj = range('A', 'Z');
        $majRand = array_rand($maj,1);
        $result .= $maj[$majRand];
        $length -= 1;
    }else{
        $maj = [];
    }
    if ($valueMin == 1){
        $min = range('a','z');
        $minRand = array_rand($min,1);
        $result .= $min[$minRand];
        $length -= 1;
    }else{
        $min = [];}
    if ($valueChiffre == 1){
        $chiffre = range(0,9);
        $chiffreRand = array_rand($chiffre,1);
        $result .= $chiffre[$chiffreRand];
        $length -= 1;
    }else{
        $chiffre = [];}
    if ($valueSymboles == 1){
        $symboles = str_split('!@#$%^&*()-_=+[]{};:,.<>?');
        $symboleRand = array_rand($symboles,1);
        $result .= $symboles[$symboleRand];
        $length -= 1;
    }else{
        $symboles = [];}
    $allString = array_merge($maj,$min,$chiffre,$symboles); 
    if (empty($allString)){
        return $result;
    }else{
        for($i = 0; $i < $length; $i++) {
        $stringRand = array_rand($allString);
        $result .= $allString[$stringRand];
    }
    return $result;
    }
}
function generatePassword(string $password):string{
    return str_shuffle($password);
    
}


$select= generateSelectOption($selectOption);
$char=generateRandomCharacter($valueMaj, $valueMin, $valueChiffre, $valueSymboles, $selectOption);
$password = generatePassword($char);

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
        <nav>
            <nav class="menu-switch">
                <a href="index.php" class="switch-btn active">Générateur</a>
                <a href="validator.php" class="switch-btn">Validateur</a>
            </nav>
        <nav>
        <form method ="post" action="index.php">
            <div class = password>
                <p>Votre mot de passe génèré : </p>
                <input type ="text" name = "password" value ="$password" paleholder="**************" readonly></ipunt>
            </div>
            <div class = "select">
                <select name ="size">
                    $select
                </select>
            </div>
            <div class = checkbox>
                <div class="option">
                    <input type="checkbox" name="maj" value="1" $checkMaj> Utiliser les majuscules (A-Z)
                </div>
                <div class="option">
                    <input type="checkbox" name="min" value="1" $checkMin> Utiliser les minuscules (a-z)
                </div>
                <div class="option">
                    <input type="checkbox" name="chiffre" value="1" $checkChiffre> Utiliser les chiffres (0-9)
                </div>
                <div class="option">
                    <input type="checkbox" name="symboles" value="1" $checkSymboles> Utiliser les symboles (!@#$)
                </div>
            </div>
            <div class = submit>
                <input type ="submit" value ="Génèrer"></ipunt>
            </div>
        </form>
    </body>
</html>
HTML;

echo $html;