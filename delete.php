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


$sql = "DELETE FROM task WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipeId);

if ($stmt->execute()) {
    echo "Рецепт успешно удален!";
} else {
    echo "Ошибка: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>