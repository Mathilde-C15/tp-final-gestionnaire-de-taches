<?php
session_start();

include('repositories/userTasksRepository.php');

// Si l'utilisateur n'est pas connecté, cette page est inaccessible et on retourne à index.php.
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

$userId = (int) $_SESSION['user_id'];

$tasks = getTasksByUserId($userId);
$tasks = $tasks ?? [];



$layoutTitle = 'Compte';
$template = 'templates/userTasks.phtml';
include 'layout.phtml';