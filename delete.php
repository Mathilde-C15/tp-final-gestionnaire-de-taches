<?php 

require __DIR__ . './config/db.php';

include('repositories/userRepository.php');

session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

$pdo->prepare("DELETE FROM users WHERE id = ?")
    ->execute([$id_user]);

session_destroy();

header("Location: login.php");
exit();
