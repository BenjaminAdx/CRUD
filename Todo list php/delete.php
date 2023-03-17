<?php

$pdo = new PDO("mysql:host=mysql-andrieux.alwaysdata.net;dbname=andrieux_todolist", "andrieux", "Camels01*");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM todo WHERE id = $id";

    $query = $pdo->prepare($sql);

    $query->execute();

    header('location: index.php');
}
$pdo = null;
