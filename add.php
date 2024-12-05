<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "task";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


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

$sql = "INSERT INTO task (title, description, image) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $description, $image);

if ($stmt->execute()) {
   
    header("Location: index.php");
    exit();
} else {
    echo "Ошибка: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>