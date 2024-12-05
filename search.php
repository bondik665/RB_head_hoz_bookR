<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "task";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = $conn->real_escape_string($searchQuery);

$sql = "SELECT * FROM task WHERE title LIKE '%$searchQuery%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="recipe-item">';
        echo '<a href="recipe.php?id=' . $row['id'] . '">';
        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
        echo '<p>' . htmlspecialchars($row['description']) . '</p>';
        if ($row['image']) {
            echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Изображение" >';
        }
        echo '</a>';
        echo '<div class="actions">';
        echo '<button class="btn btn-secondary edit-btn" data-id="' . $row['id'] . '">Редактировать</button>';
        echo '<button class="btn btn-danger delete-btn" data-id="' . $row['id'] . '">Удалить</button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Нет рецептов.</p>';
}


$conn->close();
?>