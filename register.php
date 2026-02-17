<?php

session_start();

include('repositories/userRepository.php');

if(!empty($_POST)){

    $db = connectToDB();
    
    $email = $_POST['email'];
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $errors = array();
    
    // Validation d'un mot de passe fort avec les REGEX
    // Présence d'une majuscule
    $uppercase = preg_match("/[A-Z]/", $password);
    // Présence d'une minuscule
    $lowercase = preg_match("/[a-z]/", $password);
    // Présence d'un nombre
    $number = preg_match("/[0-9]/", $password);
    
    // strlen() établit la longueur d'une chaîne de caractères (string length)
    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        $errors["password"] = "Le mot de passe doit contenir 8 caractères minimum, une lettre majuscule et un chiffre.";
    } else {
        // password_hash() permet de crypter le mot de passe.
        $mot_de_passe_hache = password_hash($password, PASSWORD_DEFAULT);
        
        $requete = $db->prepare("INSERT INTO users (user_name, password) VALUES (:user_name, :password)");
        
        //bindParam() associe la valeur de la variable $username au paramètre :username dans la requête préparée, en spécifiant que $username est une chaîne de caractères (:PARAM_STR). C'est une sécurité contre les injections SQL.
        $requete->bindParam(':user_name', $username, PDO::PARAM_STR);
        $requete->bindParam(':password', $mot_de_passe_hache, PDO::PARAM_STR);
        
        $requete->execute();
        
        $insert = insertUser($_POST, $mot_de_passe_hache);
        //var_dump($insert); exit;
        
        header('Location: userTasks.php');
        exit;
    }
    
}



$layoutTitle = 'Register';
$template = 'templates/register.phtml';
include __DIR__ . '/layout.phtml';