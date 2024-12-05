<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рецепт</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Рецепт</h1>

    <?php
   
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "task";

   
    $conn = new mysqli($servername, $username, $password, $dbname);

   
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    
    $recipeId = isset($_GET['id']) ? intval($_GET['id']) : 0;

   
    $sql = "SELECT * FROM task WHERE id = $recipeId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
        echo '<p>' . htmlspecialchars($row['description']) . '</p>';
        if ($row['image']) {
            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Изображение" >';
        }
    } else {
        echo '<p>Рецепт не найден.</p>';
    }

   
    $conn->close();
    ?>

<div style="margin-top:1rem;">
<a href="index.php" class="btn btn-primary " >Вернуться к списку рецептов</a>
</div>

</div>


</body>
</html>