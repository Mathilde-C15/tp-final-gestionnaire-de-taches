<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}



$layoutTitle = "Account";
$template = 'templates/account.phtml';
include __DIR__ . '/layout.phtml';