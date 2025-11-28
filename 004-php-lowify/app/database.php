<?php

function InitDatabase():DatabaseManager {
    $host='mysql';
    $dbname='lowify';
    $charset='utf8mb4';
    $username = 'lowify';
    $password ='lowifypassword';
    try{
        $db =  new DatabaseManager("mysql:host=$host;dbname=$dbname;$charset",
        username : $username,
        password : $password
        );
    }catch (PDOException $ed){
        echo "Error database". $ed->getMessage();;
    }
    return $db;
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