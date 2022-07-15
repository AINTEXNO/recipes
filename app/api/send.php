<?php

use app\classes\Database;

header('Content-Type: application/json');

include('../classes/Database.php');

function send() {
    $variables = [
        ':email' => trim(preg($_POST['email'], '/^\S+@\S+\.\S+$/'))
    ];

    $mailings = new Database('mailings');
    $result = $mailings->select('WHERE email=:email', $variables);

    if($result->rowCount()) {
        http_response_code(400);
        return json_encode(array('status' => false, 'message' => 'Email already taken'));
    }

    $mailings->insert([
        'email' => $variables[':email']
    ]);

    http_response_code(200);
    return json_encode(array('status' => true, 'id' => $mailings->lastInsertId()));
}

echo send();