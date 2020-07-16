<?php

spl_autoload_register(
    function ($name) {
        require_once $name . '.php';
    }
);

$database = new Database();
$message = " ";

/**
 * @param string $email
 * @param string $password
 * @param Database $database
 * @return bool
 */
function checkLogin(
    string $email,
    string $password,
    Database $database
)
{
    return $database->findUserByLoginDetails(
        $email,
        $password
    );
}

/**
 * Register
 */
if (
    isset($_POST['registerEmail']) &&
    isset($_POST['registerPassword'])
) {
    $user = new User(
        $_POST['registerEmail'],
        $_POST['registerPassword']
    );
    if (!$database->findUserByEmail($_POST['registerEmail'])
    ){
        $database->addUserToDatabase($user);
        $message = "Register Success";
    } else {
        $message = "Register Failed there is already user with this email";
    }
}


/**
 * Login
 */
if (
    isset($_POST['loginEmail']) &&
    isset($_POST['loginPassword'])
) {
    if(checkLogin(
        $_POST['loginEmail'],
        $_POST['loginPassword'],
        $database
    )){
        $message = "Login Success";
    }else {
        $message = "Login Failed";
    }
}

include_once 'main.html';