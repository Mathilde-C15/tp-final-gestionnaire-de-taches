<?php

session_start();

include('repositories/userRepository.php');

// Vérifie si l'utilisateur est déjà connecté, si oui, l'envoie vers la page 'account'
if (isset($_SESSION['loggedIn'])) {
    header("Location: userTasks.php");
    exit();
}

// Si on a bien une requête POST, on récupère les données identifiant et password.
if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = getUserByUsername($username);
    //var_dump($user); exit;

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $user;
        header("Location: userTasks.php");
        exit();
    } else {
        $error = "Identifiants incorrects. Veuillez réessayer.";
    }
}



$layoutTitle = 'Connexion';
$template = 'templates/login.phtml';
include __DIR__ . '/layout.phtml';