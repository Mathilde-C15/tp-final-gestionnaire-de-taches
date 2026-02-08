<?php
session_start();

// Si l'utilisateur n'est pas connecté, cette page est inaccessible et on retourne à index.php.
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

$layoutTitle = 'Compte';
$template = 'templates/userTasks.phtml';
include 'layout.phtml';