
function showModal() {
    var modal = document.getElementById("successModal");
    modal.style.display = "block";
}


function closeModal() {
    var modal = document.getElementById("successModal");
    modal.style.display = "none";
}


function clearForm() {
    document.querySelector('form').reset();
}


var closeBtn = document.getElementsByClassName("close")[0];
closeBtn.onclick = function() {
    closeModal();
}


document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); 

   
    var formData = new FormData(this);
    fetch('add.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data === "Рецепт успешно добавлен!") {
            showModal(); 
            clearForm(); 
            location.reload(); 
        } else {
            alert("Ошибка: " + data);
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });
});


document.querySelectorAll('.edit-btn').forEach(function(button) {
    button.addEventListener('click', function() {
        var recipeId = this.getAttribute('data-id');
        window.location.href = 'edit.php?id=' + recipeId;
    });
});

document.querySelectorAll('.delete-btn').forEach(function(button) {
    button.addEventListener('click', function() {
        var recipeId = this.getAttribute('data-id');
        if (confirm("Вы уверены, что хотите удалить этот рецепт?")) {
            fetch('delete.php?id=' + recipeId, {
                method: 'GET'
            })
            .then(response => response.text())
            .then(data => {
                if (data === "Рецепт успешно удален!") {
                    location.reload(); 
                } else {
                    alert("Ошибка: " + data);
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        }
    });
});