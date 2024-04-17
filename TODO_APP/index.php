<?php

$todoNames = [];
if (file_exists('data.json')) {
    $todoNames = json_decode(file_get_contents("data.json"), true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <form action="newToDo.php" method="post">
        <input type="text" name="newTask" placeholder="Add New Task" id="">
        <button>ADD</button>
    </form>
    <div>
        <ul>
            <?php foreach ($todoNames as $todoName => $todo) : ?>
                <li><?= $todoName ?>
                    <form action="change.php" method="post">
                    <input type="hidden" name="newTask" value=<?= $todoName ?>>
                        <input type="checkbox" name="complete" <?= $todo['completed'] ? "checked" : "" ?> id="">
                    </form>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="newTask" value=<?= $todoName ?>>
                        <button>
                            Delete
                        </button>
                    </form>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>


    <script>
        const checkboxes = document.querySelectorAll("input[type=checkbox]");
        checkboxes.forEach(ch=>{
            ch.onclick=function(){
                this.parentNode.submit();
            };
        })
    </script>
</body>

</html>