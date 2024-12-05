
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книга рецептов от Бондарева</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

</head>
<body>

<div class="container">
        <h1>Книга рецептов </h1>
        <!-- поиск -->
<form id="searchForm" class="search-form">
    <input type="text" id="searchInput" placeholder="Поиск по названию" class="form-control" style="width:14rem;margin-bottom:1rem;">
    <button type="button"  style="margin-bottom:1rem;"id="searchButton" class="btn btn-warning">Поиск</button>
</form>

       
        <form action="add.php" method="post" enctype="multipart/form-data" class="recipe-form">
            <div class="form-group">
                <label for="title">Название рецепта</label>
                <input type="text" name="title" id="title" placeholder="Название рецепта" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Описание рецепта</label>
                <textarea name="description" id="description" placeholder="Описание рецепта" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Изображение "форматы для ввода jpg, jpeg, png"</label>
                <input type="file" name="image" id="image" class="form-control" >
            </div>
            <div class="form-group">
                <input type="submit" id="addRecept" class="btn btn-success" value="Добавить рецепт">
                <button type="reset" id="clearRecept" class="btn btn-secondary">Очистить</button>
            </div>
        </form>

        

       
        <div id="successModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Рецепт успешно добавлен!</p>
            </div>
        </div>

       

       
<div class="recipe-list">
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "task";

  
    $conn = new mysqli($servername, $username, $password, $dbname);

   
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

  

 
    $sql = "SELECT * FROM task";
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
</div>
    </div>
    <footer>
    <div class="container">
        <p>&copy; Книга рецептов от Бондарева. Все права защищены.</p>
        <a href="tel:+375296650015">Позвонить</a>
        <a href="mailto:bodarev665566@gmail.com">Написать письмо</a>
    </div>
</footer>

    <script src="/js/js.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#searchButton').click(function() {
        var searchQuery = $('#searchInput').val();
        $.ajax({
            url: 'search.php',
            type: 'GET',
            data: { search: searchQuery },
            success: function(response) {
                $('.recipe-list').html(response);
            }
        });
    });
});
</script>


</body>
</html>