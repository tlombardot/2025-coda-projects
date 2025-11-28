<?php

require_once "inc/page.inc.php";

$message = $_GET["msg"] ?? "";


$html =<<<HTML
    <div class="error-container">
        <h1 class="error-title">Oops! Something went wrong</h1>
        <p class ="error-message">$message</p>
        <a href="index.php" class="btn-home">Go back to Home</a>
    </div>
HTML;


echo (new HTMLPage("Lowify - Error"))
        ->addContent($html)
        ->addStylesheet("./error.css")
        ->render();