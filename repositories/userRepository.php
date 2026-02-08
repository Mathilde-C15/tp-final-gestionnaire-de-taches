<?php

require __DIR__ . '/../config/db.php';

function insertUser(array $user, string $mot_de_passe_hache) : ?int {
    $db = connectToDB();
    try {
        $requete = $db->prepare("INSERT INTO user (email, username, password) VALUES (:email, :username, :password)");
        
        //bindParam() associe la valeur de la variable $name au paramètre :name dans la requête préparée,
        //en spécifiant que $name est une chaîne de caractères (:PARAM_STR). C'est une sécurité contre 
        //les injections SQL.
        $requete->bindParam(':email', $user['email'], PDO::PARAM_STR);
        $requete->bindParam(':username', $user['username'], PDO::PARAM_STR);
        $requete->bindParam(':password', $mot_de_passe_hache, PDO::PARAM_STR);
        $requete->bindParam(':password', $mot_de_passe_hache, PDO::PARAM_STR);
        
        $requete->execute();
        $id = $db->lastInsertId();
        return $id;
    } catch (Exception $e) {
        //die($e->getMessage());
        return null;
    }
}

function getUserByUsername(string $username) : ?array {
    $db = connectToDB();
    try {
        $query = $db->prepare('SELECT * FROM user WHERE username = :username');
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    } catch (Exception $e) {
        //var_dump($e);
        //die($e->getMessage());
        return null;
    }
}