<?php


session_start();


if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}


$ranking = [
    ['username' => 'Banana', 'score' => 42],
    ['username' => 'Bob', 'score' => 35],
    ['username' => 'Bib', 'score' => 20],
    ['username' => 'Bab', 'score' => 12],
    ['username' => 'John', 'score' => 5],
];

$layoutTitle = 'Ranking';
$template = 'templates/ranking.phtml';
include 'layout.phtml';