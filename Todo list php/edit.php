<?php

$pdo = new PDO("mysql:host=localhost;dbname=todolist", "root", "root");


if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM `todo` WHERE `id` = $id";

    $query = $pdo->prepare($sql);

    $query->execute();

    $result = $query->fetch();
}


if (isset($_POST)) {
    if (isset($_POST["list"]) && isset($_POST["priority"])) {

        $list = htmlspecialchars(trim($_POST["list"]));
        $priority = $_POST["priority"];



        if (strlen($list) > 3) {
            $id = strip_tags($_GET['id']);
            $edit = $pdo->prepare("UPDATE todo SET list = ?, priorité = ? WHERE id = $id");
            $edit->execute([$list, $priority]);
            header('location: index.php');
        } else {
            echo 'La tâche doit avoir minimum 3 caractères';
        }
    }
}

$pdo = null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Todo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <section class="vh-100 gradient-custom-2">
        <div class="container py-5 h-100">

            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-md-12 col-xl-10">

                    <div class="card mask-custom">
                        <div class="card-body p-4 text-white">

                            <div class="text-center pt-3 pb-2">
                                <h2 class="my-4">Update this Todo</h2>
                            </div>

                            <form action="" method="POST">
                                <input type="text" name="list" id="" placeholder="Todo" class="form-control" value="<?= $result['list'] ?>"><br>
                                <select name=priority class="form-select form-select-sm">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select><br>
                                <input type="submit" value="Modify" name="submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>