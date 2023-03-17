<?php

require_once("connexion.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM todo WHERE id = $id";

    $query = $pdo->prepare($sql);

    $query->execute();

    header('location: index.php');
}
$pdo = null;
