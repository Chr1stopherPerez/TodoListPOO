<?php
require_once 'database.class.php';
require_once 'taskManager.class.php';

// Utilisation de la classe Database pour la connexion à la base de données
$db = new Database("localhost", "root", "", "todolist");

// Utilisation de la classe TaskManager pour gérer les tâches
$taskManager = new TaskManager($db);

if (isset($_POST['addTask'])) {
    $task = $_POST['task'];
    // Pour les caractères speciaux
    $task = $db->getConnection()->real_escape_string($task);
    $taskManager->addTask($task);
}

if (isset($_GET['deleteTask'])) {
    $id = $_GET['deleteTask'];
    $taskManager->deleteTask($id);
}

if (isset($_GET['updateTask'])) {
    $id = $_GET['updateTask'];
    $taskManager->updateTask($id);
}

$tasks = $taskManager->getTasks();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>TodoList POO</title>
    <!-- FAVICON -->
    <link rel="icon" href="favicon.png">
</head>

<body>

    <h2>Ma TODO LISTE</h2>

    <form method="post" action="">
        <input type="text" name="task" required>
        <button type="submit" name="addTask">AJOUTER</button>
    </form>

    <ul>
        <?php
        foreach ($tasks as $row) {
            $completedClass = ($row['completed'] == 1) ? 'completed' : '';
            echo "<li class='$completedClass'>";
            echo "<input type='checkbox' onclick='updateTask({$row['id']})' " . ($row['completed'] == 1 ? 'checked' : '') . ">";
            echo "{$row['task']} ";
            echo "<a href='?deleteTask={$row['id']}'>SUPPRIMER</a>";
            echo "</li>";
        }
        ?>
    </ul>

    <script>
        function updateTask(id) {
            window.location.href = '?updateTask=' + id;
        }
    </script>

</body>

</html>


<!-- Index.php -->