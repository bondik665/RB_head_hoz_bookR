<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "task";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


$recipeId = $_GET['id'];


$sql = "SELECT * FROM task WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipeId);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();


$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать рецепт</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .recipe-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #343a40;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Редактировать рецепт</h1>

        <!-- Форма для редактирования рецепта -->
        <form action="save.php" method="post" enctype="multipart/form-data" class="recipe-form">
            <input type="hidden" name="id" value="<?php echo $recipe['id']; ?>">
            <div class="form-group">
                <label for="title">Название рецепта</label>
                <input type="text" name="title" id="title" placeholder="Название рецепта" class="form-control" value="<?php echo htmlspecialchars($recipe['title']); ?>">
            </div>
            <div class="form-group">
                <label for="description">Описание рецепта</label>
                <textarea name="description" id="description" placeholder="Описание рецепта" class="form-control" rows="5"><?php echo htmlspecialchars($recipe['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" name="image" id="image" class="form-control">
                <?php if ($recipe['image']) { ?>
                    <img src="<?php echo htmlspecialchars($recipe['image']); ?>" alt="Изображение рецепта" style="max-width: 100%;">
                <?php } ?>
            </div>
            <div class="form-group">
                <input type="submit" id="saveRecept" class="btn btn-success" value="Сохранить рецепт">
                <a href="index.php" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</body>
</html>