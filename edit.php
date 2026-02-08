<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

$task = [
  "title" => "",
  "content" => "",
  "urgent" => false,
  "important" => false
];



$layoutTitle = 'Edition';
$template = 'templates/edit.phtml';
include __DIR__.'/layout.phtml';
