<?php
session_start();

use app\classes\Database;
use function app\classes\Session;

header('Content-Type: application/json');

include('../classes/Database.php');
include('../classes/Session.php');

function login() {
    $variables = [
        'email' => preg($_POST['email'], '/^\S+$/'),
        'password' => preg($_POST['password'], '/^[A-Za-z0-9@!_-]+$/')
    ];

    $users = new Database('users');
    $result = $users->select('WHERE email = :email LIMIT 1', array(':email' => $variables['email']));
    $row = $result->fetch(PDO::FETCH_ASSOC);

    if(password_verify($variables['password'], $row['password'])) {
        http_response_code(200);
        session()->set('auth', true);

        return json_encode(array('status' => true, 'data' => $row));
    }

    http_response_code(401);
    return json_encode(array('status' => false, 'message' => 'Incorrect email or password'));
}

echo login();