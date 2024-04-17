<?php
$todoName = $_POST['newTask'];
$todoArray = json_decode(file_get_contents("data.json"), true);
$todoArray[$todoName]["completed"]=!$todoArray[$todoName]["completed"];

file_put_contents("data.json", json_encode($todoArray));
header("location: index.php");