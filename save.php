<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "task";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$id = $_POST['id'];
$title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
$description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');

$image = null;
if ($_FILES['image']['error'] == 0) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = $targetFile;
        } else {
            echo "Ошибка загрузки изображения.";
            exit();
        }
    } else {
        echo "Недопустимый формат изображения.";
        exit();
    }
}

$sql = "UPDATE task SET title = ?, description = ?";
$params = array("ss", $title, $description);

if ($image) {
    $sql .= ", image = ?";
    $params[0] .= "s";
    $params[] = $image;
}

$sql .= " WHERE id = ?";
$params[0] .= "i";
$params[] = $id;

$stmt = $conn->prepare($sql);
$stmt->bind_param(...$params);

if ($stmt->execute()) {
    echo "Рецепт успешно обновлен!";
} else {
    echo "Ошибка: " . $stmt->error;
}


$stmt->close();
$conn->close();


header("Location: index.php");
exit();
?>