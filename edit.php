<?php
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit();
}

$pdo = new PDO("mysql:host=localhost;dbname=tp-final-gestionnaire-taches;charset=utf8mb4", "root", "");

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header("Location: userTasks.php"); exit(); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pdo->prepare("UPDATE tasks SET title=?, content=?, urgent=?, important=? WHERE id=?")
      ->execute([
        trim($_POST['taskTitle'] ?? ''),
        trim($_POST['taskContent'] ?? ''),
        isset($_POST['urgent']) ? 1 : 0,
        isset($_POST['important']) ? 1 : 0,
        $id
      ]);
  header("Location: userTasks.php");
  exit();
}

$task = $pdo->prepare("SELECT * FROM tasks WHERE id=?");
$task->execute([$id]);
$task = $task->fetch(PDO::FETCH_ASSOC);



$layoutTitle = 'Edition';
$template = 'templates/edit.phtml';
include __DIR__.'/layout.phtml';
