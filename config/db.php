<?php


// Connexion à la base de données
function connectToDB() {
    $dsn = "mysql:host=localhost;port=3306;dbname=tp-final-gestionnaire-taches";
    $db = new PDO($dsn, "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

