<?php
session_start();

// Détruire la session
session_unset();
session_destroy();

// Redirige vers la page d'authentification
header("Location: index.php");
exit();