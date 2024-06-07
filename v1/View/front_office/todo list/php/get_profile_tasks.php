<?php

require_once __DIR__ . '/../../../../Controller/todo_tasks_con.php';
require_once __DIR__ . '/../../../../Model/todo_tasks.php';

$todoController = new TodoTaskCon();

if (isset($_POST['profile_id']) && !empty($_POST['profile_id'])) {
    $profile_id = htmlspecialchars($_POST['profile_id']);

    $todoController->listTasksByProfileId($profile_id);

    // Encode data into JSON format
    $json_data = json_encode($tasks);

    // Set appropriate header for JSON response
    header('Content-Type: application/json');
    // Output the JSON-encoded data
    echo $json_data;
} else {
    echo json_encode(array("error" => "Profile id is required"));
}






?>