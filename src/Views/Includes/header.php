<?php
session_start();

if (!isset($_SESSION['connectéUser'])) {
    header('location: connexion.php');
    die;
}

require_once "src/classes/Reservation.php";
require_once "src/classes/User.php";
require_once "src/classes/Database.php";


?>

<!DOCTYPE html>
<html lang="fr">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/responsive.css">

</head>

<body>

    <!------------------- HEADER ------------------->
    <header class="header">
        <a href="./deconnexion.php" class="boutonConnexion">Déconnexion</a>
        <h1>Vercors Musique Festival</h1>
    </header>