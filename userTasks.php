<?php
session_start();

include('repositories/userTasksRepository.php');

// Si l'utilisateur n'est pas connecté, cette page est inaccessible et on retourne à index.php.
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$userId = (int) $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $urgent = isset($_POST['urgent']);
    $important = isset($_POST['important']);

    if ($title !== '' && $content !== '') {
        addTaskForUser($userId, $title, $content, $urgent, $important);
        header("Location: userTasks.php"); // évite le double submit
        exit();
    }
}

$tasks = getTasksByUserId($userId) ?? [];




$layoutTitle = 'Compte';
$template = 'templates/userTasks.phtml';
include 'layout.phtml';