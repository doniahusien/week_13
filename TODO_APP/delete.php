<?php
$todoName = $_POST['newTask'];
$todoArray = json_decode(file_get_contents("data.json"), true);
unset($todoArray[$todoName]);

file_put_contents("data.json", json_encode($todoArray));
header("location: index.php");