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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-4">
    <div class="max-w-md mx-auto">
        <form action="newToDo.php" method="post" class="mb-4 flex">
            <input type="text" name="newTask" placeholder="Add New Task" class="flex-1 rounded-l-lg border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white rounded p-2">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg">ADD</button>
        </form>
        <div>
            <ul>
                <?php foreach ($todoNames as $todoName => $todo) : ?>
                    <li class="flex items-center justify-between py-2 px-4 border border-gray-200 mb-2 rounded-md bg-white">
                        <form action="change.php" method="post" class="flex items-center">
                            <input type="hidden" name="newTask" value="<?= $todoName ?>">
                            <input type="checkbox" name="complete" <?= $todo['completed'] ? "checked" : "" ?> id="" class="mr-2 form-checkbox">
                        </form>
                        <span class="<?= $todo['completed'] ? 'line-through text-gray-500' : 'text-gray-800' ?>"><?= $todoName ?></span>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="newTask" value="<?= $todoName ?>">
                            <button class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <script>
        const checkboxes = document.querySelectorAll("input[type=checkbox]");
        checkboxes.forEach(ch => {
            ch.onclick = function() {
                this.parentNode.submit();
            };
        })
    </script>
</body>

</html>
