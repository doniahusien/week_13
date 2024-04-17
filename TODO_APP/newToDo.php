<?php
$todoName = trim($_POST["newTask"]);

if(isset($todoName)){
    $json= getData();
}
else{
    $json = [];
}

$json[$todoName] = ['completed' => false];
file_put_contents("data.json", json_encode($json));



function getData(){
    if(file_exists("data.json")){
        return json_decode(file_get_contents("data.json"), true);
    }
}


header("Location: index.php");