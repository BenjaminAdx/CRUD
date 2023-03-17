<?php

/* $pdo = new PDO("mysql:host=mysql-andrieux.alwaysdata.net;dbname=andrieux_todolist", "andrieux", "Camels01*"); */

require_once("connexion.php");

if (isset($_POST)) {

    if (isset($_POST["list"]) && isset($_POST["priority"])) {

        $list = htmlspecialchars(trim($_POST["list"]));
        $priority = $_POST["priority"];



        if (strlen($list) > 3) {

            $insert = $pdo->prepare("INSERT INTO todo (list,priorité) VALUES (?,?)");
            $insert->execute([$list, $priority]);
        } else {
            echo 'La tâche doit avoir minimum 3 caractères';
        }
    }
}

$query = $pdo->prepare("SELECT * FROM todo");
$query->execute();
$count = 1;
$fetch = $query->fetchAll();

$pdo = null;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <section class="gradient-custom-2">
        <div class="container py-5">

            <div class="row d-flex justify-content-center align-items-center">

                <div class="col-md-12 col-xl-10">

                    <div class="card mask-custom">
                        <div class="card-body p-4 text-white">

                            <div class="text-center pt-3 pb-2">
                                <h2 class="my-4">Todo List</h2>
                            </div>

                            <form action="" method="POST">
                                <input type="text" name="list" id="" placeholder="Todo" class="form-control"><br>
                                <select name=priority class="form-select form-select-sm">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select><br>
                                <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                            </form>

                            <table class="table text-white mb-0">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Todo</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                <?php
                                foreach ($fetch as $fetch) :
                                ?>
                                    <tr class="fw-normal">
                                        <td class="align-middle"><span class="ms-2"><?= $count++ ?></span></td>
                                        <td class="align-middle"><span class="ms-2"><?= $fetch['list'] ?></span></td>
                                        <td class="align-middle"><?php if ($fetch['priorité'] == "Low") : ?>
                                                <span class="badge bg-success"><?= $fetch['priorité'] ?></span><?php elseif ($fetch['priorité'] == "Medium") : ?>
                                                <span class="badge bg-warning"><?= $fetch['priorité'] ?></span><?php else : ?>
                                                <span class="badge bg-danger"><?= $fetch['priorité'] ?></span><?php endif; ?>
                                        </td>
                                        <td class="align-middle"><a href="edit.php?id='<?= $fetch['id'] ?>'" title="Edit"><button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a>
                                            <a href="delete.php?id='<?= $fetch['id'] ?>'" title="Delete"><button class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>