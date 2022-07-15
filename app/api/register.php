<?php

use app\classes\Database;

header('Content-Type: application/json');

include('../classes/Database.php');

function register() {
    $password = trim(preg($_POST['password'],'/^[A-Za-z0-9@!_-]+$/'));
    $passwordConfirm = trim(preg($_POST['password_confirm'],'/^[A-Za-z0-9@!_-]+$/'));

    $variables = [
        'email' => preg($_POST['email'], '/^\S+@\S+\.\S+$/')
    ];

    if($password === $passwordConfirm) {
        $variables['password'] = $password;
    }
    else {
        http_response_code(422);
        return json_encode(array('status' => false, 'message' => 'The passwords entered do not match'));
    }

    $users = new Database('users');
    $result = $users->select('WHERE email = ?', array($variables['email']));

    if($result->rowCount()) {
        http_response_code(400);
        return json_encode(array('status' => false, 'message' => 'Email already taken'));
    }

    $users->insert([
        'email' => $variables['email'],
        'password' => password_hash($variables['password'], PASSWORD_BCRYPT, array('cost' => 12)),
        'role' => '2'
    ]);

    http_response_code(200);
    return json_encode(array('status' => true, 'id' => $users->lastInsertId()));
}

echo register();